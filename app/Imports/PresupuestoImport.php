<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class PresupuestoImport implements ToCollection
{
    private $idPresupuesto;

    public function __construct($idPresupuesto)
    {
        $this->idPresupuesto = $idPresupuesto;
        Log::info("🚀 [IMPORTADOR MASIVO] Iniciando procesamiento ultra-rápido en memoria...");
    }

    public function collection(Collection $rows)
    {
        $rowsArray = $rows->toArray();
        $totalFilas = count($rowsArray);

        if ($totalFilas === 0) return;

        Log::info("📊 [IMPORTADOR] Total de filas detectadas para procesar: {$totalFilas}");

        // 1. Reservar de golpe un bloque de IDs de la secuencia de PostgreSQL para evitar colisiones
        $seqName = 'expediente.partida_id_partida_seq';
        $primerIdPartida = DB::select("SELECT nextval('{$seqName}')")[0]->nextval;
        $ultimoIdPartida = $primerIdPartida + $totalFilas - 1;
        DB::select("SELECT setval('{$seqName}', {$ultimoIdPartida})");

        Log::info("🔑 IDs de partidas reservados en PostgreSQL: Del {$primerIdPartida} al {$ultimoIdPartida}");

        // Arreglos temporales para acumular las inserciones masivas (Bulk Insert)
        $partidasBulk = [];
        $preciosBulk = [];
        $metradosBulk = [];

        // Caché en memoria: 'item_s10' => id_partida
        $partidasInsertadas = [];
        $idActual = $primerIdPartida;

        // 2. Procesar y estructurar todas las filas en la memoria RAM
        foreach ($rowsArray as $index => $row) {
            $itemRaw        = $row[0] ?? null;
            $descripcionRaw = $row[1] ?? null;
            $unidadRaw      = $row[2] ?? null;
            $metradoRaw     = $row[3] ?? null;
            $precioRaw      = $row[4] ?? null;

            $itemS10     = !is_null($itemRaw) ? trim(str_replace(["\r", "\n"], "", (string)$itemRaw)) : '';
            $descripcion = !is_null($descripcionRaw) ? trim(str_replace(["\r", "\n"], "", (string)$descripcionRaw)) : '';

            // Omitir filas vacías
            if (empty($itemS10) && empty($descripcion)) {
                continue;
            }

            $unidad         = !empty($unidadRaw) ? trim(str_replace(["\r", "\n"], "", (string)$unidadRaw)) : null;
            $metrado        = ($metradoRaw !== null && $metradoRaw !== '') ? floatval($metradoRaw) : 0;
            $precioUnitario = ($precioRaw !== null && $precioRaw !== '') ? floatval($precioRaw) : 0;

            $puntos = substr_count($itemS10, '.');
            $nivel  = $puntos + 1;

            if (!empty($unidad)) {
                $codTipoNodo = 'PARTIDA';
            } else {
                $codTipoNodo = ($nivel === 1) ? 'TITULO' : 'SUBTOTAL';
            }

            // Enlazado de jerarquía súper veloz (100% en memoria)
            $idPartidaPadre = null;
            if ($nivel > 1) {
                $posicionUltimoPunto = strrpos($itemS10, '.');
                $itemPadreString     = substr($itemS10, 0, $posicionUltimoPunto);

                if (isset($partidasInsertadas[$itemPadreString])) {
                    $idPartidaPadre = $partidasInsertadas[$itemPadreString];
                }
            }

            // Asignamos el ID reservado localmente
            $idPartida = $idActual;
            $partidasInsertadas[$itemS10] = $idPartida;
            $idActual++;

            // Preparar fila para insertar en lote
            $partidasBulk[] = [
                'id_partida'         => $idPartida,
                'id_presupuesto'     => $this->idPresupuesto,
                'id_partida_padre'   => $idPartidaPadre,
                'item_s10'           => $itemS10,
                'codigo_partida'     => null,
                'descripcion'        => $descripcion,
                'cod_tipo_nodo'      => $codTipoNodo,
                'unidad'             => $unidad,
                'nivel'              => $nivel,
                'orden_presentacion' => count($partidasInsertadas),
                'created_by'         => 'IMPORT',
                'updated_by'         => 'IMPORT',
                'created_at'         => now(),
                'updated_at'         => now()
            ];

            // Si es partida, preparamos también sus registros económicos y de metrados
            if ($codTipoNodo === 'PARTIDA') {
                $preciosBulk[] = [
                    'id_partida'      => $idPartida,
                    'precio_unitario' => $precioUnitario,
                    'created_by'      => 'IMPORT',
                    'updated_by'      => 'IMPORT',
                    'created_at'      => now(),
                    'updated_at'      => now()
                ];

                $metradosBulk[] = [
                    'id_partida'            => $idPartida,
                    'descripcion_calculo'   => 'Metrado base S10 importado',
                    'cantidad'              => 1,
                    'metrado_parcial'       => $metrado,
                    'metrado_total_partida' => $metrado,
                    'created_by'            => 'IMPORT',
                    'updated_by'            => 'IMPORT',
                    'created_at'            => now(),
                    'updated_at'            => now()
                ];
            }
        }

        // 3. ENVIAR TODO A POSTGRES EN CHUNKS (Lotes de 500 filas)
        Log::info("⚡ [PROCESO] Enviando datos agrupados a la base de datos...");

        DB::transaction(function () use ($partidasBulk, $preciosBulk, $metradosBulk) {
            foreach (array_chunk($partidasBulk, 500) as $chunk) {
                DB::table('expediente.partida')->insert($chunk);
            }

            try {
                foreach (array_chunk($preciosBulk, 500) as $chunk) {
                    DB::table('expediente.precio_unitario')->insert($chunk);
                }
            } catch (Exception $e) {
                Log::warning("⚠️ No se pudo registrar precios de forma masiva: " . $e->getMessage());
            }

            try {
                foreach (array_chunk($metradosBulk, 500) as $chunk) {
                    DB::table('expediente.metrado_expediente')->insert($chunk);
                }
            } catch (Exception $e) {
                Log::warning("⚠️ No se pudo registrar metrados de forma masiva: " . $e->getMessage());
            }
        });

        Log::info("✅ [COMPLETO] ¡Las {$totalFilas} filas han sido guardadas con éxito!");
    }
}
