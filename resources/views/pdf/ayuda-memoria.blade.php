<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ayuda Memoria - CUI {{ $proyecto->cui ?? '2395187' }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            color: #333;
            line-height: 1.3;
            margin: 0;
            padding: 0;
        }
        h1, h2, h3 { text-align: center; margin: 3px 0; }
        h1 { font-size: 16px; font-weight: bold; }
        h2 { font-size: 12px; font-weight: normal; }
        h3 { font-size: 14px; font-weight: bold; margin-bottom: 15px; }
        .coordinacion { text-align: center; font-size: 11px; font-weight: bold; margin-bottom: 20px; }

        .section-title {
            font-size: 11px;
            background-color: #1e293b;
            color: #ffffff;
            padding: 6px;
            margin-top: 15px;
            margin-bottom: 5px;
            font-weight: bold;
            text-transform: uppercase;
            page-break-after: avoid;
        }

        .sub-title {
            font-weight: bold;
            font-size: 10px;
            background-color: #e2e8f0;
            padding: 4px;
            margin-top: 10px;
            margin-bottom: 5px;
            page-break-after: avoid;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
            page-break-inside: auto;
        }
        tr {
            page-break-inside: avoid;
            page-break-after: auto;
        }
        th, td {
            border: 1px solid #cbd5e1;
            padding: 5px;
            text-align: left;
            vertical-align: top;
            page-break-inside: avoid;
        }
        th {
            background-color: #f8fafc;
            width: 35%;
            font-weight: bold;
            color: #475569;
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .bg-light { background-color: #f1f5f9; }

        .text-block {
            border: 1px solid #cbd5e1;
            padding: 8px;
            text-align: justify;
            margin-bottom: 10px;
            page-break-inside: auto; /* Permitir que el texto largo se divida naturalmente entre páginas */
        }
    </style>
</head>
<body>

    <h1>AYUDA MEMORIA</h1>
    <h2>{{ $proyecto->fecha_reporte ?? '14/08/2026' }}</h2>
    <h3>CARABAYLLO – CUI {{ $proyecto->cui ?? '2395187' }}</h3>
    <div class="text-center" style="margin-bottom: 5px;">{{ $proyecto->nombre_inversion ?? '“MEJORAMIENTO Y AMPLIACIÓN DEL SISTEMA DE AGUA POTABLE Y ALCANTARILLADO DE LOS SECTORES 359 Y 360 Y NUEVAS HABILITACIONES ESQUEMA INTEGRAL CARABAYLLO - SECTORES 352, 353, 355, 356, 357, 358. DISTRITO DE SAN ANTONIO (HUAROCHIRÍ) DISTRITO DE CARABAYLLO - PROVINCIA DE LIMA - DEPARTAMENTO DE LIMA”' }}</div>
    <div class="coordinacion">COORDINACIÓN DE PROYECTO: {{ $proyecto->coordinador_proyecto ?? 'JESSICA DAVALOS FLORES' }}</div>

    <!-- DATOS GENERALES -->
    <div class="section-title">DATOS GENERALES</div>
    <table>
        <tr>
            <th>Distrito de Intervención</th>
            <td>{{ $proyecto->distrito ?? 'Carabayllo – San Antonio (Huarochirí)' }}</td>
        </tr>
        <tr>
            <th>Población Beneficiaria Año 01</th>
            <td>{{ $proyecto->poblacion_ano_1 ?? '279,677 habitantes / Viviendas' }}</td>
        </tr>
        <tr>
            <th>Población Beneficiaria Año 20</th>
            <td>{{ $proyecto->poblacion_ano_20 ?? '426,441 habitantes / Viviendas' }}</td>
        </tr>
        <tr>
            <th>Habilitaciones</th>
            <td>{{ $proyecto->total_habilitaciones ?? '261 viviendas' }}</td>
        </tr>
        <tr>
            <th>Conexiones de Agua Potable Nuevas</th>
            <td>{{ $proyecto->conexiones_agua_nuevas ?? '12,055 und' }}</td>
        </tr>
        <tr>
            <th>Conexiones de Agua Potable Mejoradas</th>
            <td>{{ $proyecto->conexiones_agua_mejoradas ?? '794 und' }}</td>
        </tr>
        <tr>
            <th>Conexiones de Alcantarillado Nuevas</th>
            <td>{{ $proyecto->conexiones_alcantarillado_nuevas ?? '11,995 und' }}</td>
        </tr>
        <tr>
            <th>Conexiones de Alcantarillado Mejoradas</th>
            <td>{{ $proyecto->conexiones_alcantarillado_mejoradas ?? '984 und' }}</td>
        </tr>
        <tr>
            <th>Fecha Viabilidad</th>
            <td>{{ $proyecto->fecha_viabilidad ?? '14/02/2018' }}</td>
        </tr>
        <tr>
            <th>Tipo de Intervención</th>
            <td>{{ $proyecto->tipo_intervencion ?? 'OBRA' }}</td>
        </tr>
        <tr>
            <th>Estado del Proyecto</th>
            <td>{{ $proyecto->estado_proyecto ?? 'EN EJECUCIÓN Obra' }}</td>
        </tr>
        <tr>
            <th>Estado del Contrato</th>
            <td>{{ $proyecto->estado_contrato ?? 'VIGENTE' }}</td>
        </tr>
        <tr>
            <th>Coordinador Técnico proyecto PASLC</th>
            <td>{{ $proyecto->coordinador_tecnico ?? 'JESSICA DAVALOS FLORES' }}</td>
        </tr>
        <tr>
            <th>Coordinador Social proyecto PASLC</th>
            <td>{{ $proyecto->coordinador_social ?? '-' }}</td>
        </tr>
        <tr>
            <th>Responsable Técnico de SEDAPAL</th>
            <td>{{ $proyecto->responsable_sedapal ?? 'FRANCIS ALBERTO MAMANI BUENO' }}</td>
        </tr>
    </table>

    <!-- SITUACIÓN CONTRACTUAL -->
    <div class="section-title">SITUACIÓN CONTRACTUAL – CONTROL DE PLAZOS</div>

    <div class="sub-title">COMPONENTE: OBRA</div>
    <table>
        <tr>
            <th>Contratista</th>
            <td>
                {{ $proyecto->obra_contratista ?? 'CONSORCIO LIMA NORTE' }}<br>
                <small>Conformado por:</small><br>
                - JAGUI S.A.C<br>
                - HGD CONTRATISTAS S.A.C<br>
                - MARQUISA S.A.C CONTRATISTAS GENERALES<br>
                - MEJESA S.R.L.
            </td>
        </tr>
        <tr>
            <th>Contrato Obra</th>
            <td>{{ $proyecto->obra_contrato ?? 'Contrato N.º 13-2025-VIVIENDA-PASLC' }}</td>
        </tr>
        <tr>
            <th>Fecha Firma Contrato</th>
            <td>{{ $proyecto->obra_fecha_firma ?? '30 de mayo 2025' }}</td>
        </tr>
        <tr>
            <th>Monto Contrato</th>
            <td>{{ $proyecto->obra_monto_contrato ?? 'S/ 806´093,923.08' }}</td>
        </tr>
        <tr>
            <th>Plazo Ejecución Contractual</th>
            <td>{{ $proyecto->obra_plazo_contractual ?? '1,080 d.c. (3 años)' }}</td>
        </tr>
        <tr>
            <th>Fecha Inicio Contractual</th>
            <td>{{ $proyecto->obra_fecha_inicio ?? '05 de agosto 2025' }}</td>
        </tr>
        <tr>
            <th>Fecha Termino Contractual</th>
            <td>{{ $proyecto->obra_fecha_termino ?? '19 de julio 2028' }}</td>
        </tr>
        <tr>
            <th>Suspensión de Plazo</th>
            <td>{{ $proyecto->obra_suspensiones ?? '-' }}</td>
        </tr>
        <tr>
            <th>Ampliaciones de Plazo</th>
            <td>{!! nl2br(e($proyecto->obra_ampliaciones ?? "N° 01 (48 dc - Decisión N°01 de JRD)\nN° 04 (49 dc - Decisión N°02 de JRD)\nN° 05 (52 dc - Decisión N°03 de JRD)\nN° 07 (19 dc - Decisión N°04 de JRD)\nN° 08 (38 dc - Decisión N°05 de JRD)\nN° 14 (143 dc – Resolución N° 99-2026)\nN° 15 (128 dc – Resolución N° 119-2026)")) !!}</td>
        </tr>
        <tr>
            <th>Plazo Ejecución Vigente</th>
            <td>{{ $proyecto->obra_plazo_vigente ?? '1132' }}</td>
        </tr>
        <tr>
            <th>Fecha Culminación Vigente</th>
            <td>{{ $proyecto->obra_fecha_culminacion_vigente ?? '05 de setiembre 2028 (de acuerdo al cronograma aprobado por la Decisión N°02 y 03), falta la actualización de los cronogramas por la SAP 07, 08, 14 Y 15.' }}</td>
        </tr>
        <tr>
            <th>Fecha Culminación Programada</th>
            <td>{{ $proyecto->obra_fecha_culminacion_programada ?? '31 de enero 2029 – Considerando las actualizaciones de los cronogramas' }}</td>
        </tr>
        <tr>
            <th>% Avance Físico Programado</th>
            <td>{{ $proyecto->obra_avance_programado ?? '19.30%' }}</td>
        </tr>
        <tr>
            <th>% Avance Físico Ejecutado</th>
            <td>{{ $proyecto->obra_avance_ejecutado ?? '16.21%' }}</td>
        </tr>
    </table>

    <div class="sub-title">SUPERVISIÓN</div>
    <table>
        <tr>
            <th>Supervisor</th>
            <td>{{ $proyecto->sup_supervisor ?? 'Acruta & Tapia Ingenieros S.A.C.' }}</td>
        </tr>
        <tr>
            <th>Contrato</th>
            <td>{{ $proyecto->sup_contrato ?? 'Contrato N.º 19-2025-VIVIENDA-PASLC' }}</td>
        </tr>
        <tr>
            <th>Fecha Firma Contrato</th>
            <td>{{ $proyecto->sup_fecha_firma ?? '16 de julio 2025' }}</td>
        </tr>
        <tr>
            <th>Monto Contrato</th>
            <td>{{ $proyecto->sup_monto_contrato ?? 'S/ 22´601,534.05' }}</td>
        </tr>
        <tr>
            <th>Plazo Ejecución Contractual</th>
            <td>{{ $proyecto->sup_plazo_contractual ?? '1,188 d.c. (3.30 años)' }}</td>
        </tr>
        <tr>
            <th>Fecha Inicio Contractual</th>
            <td>{{ $proyecto->sup_fecha_inicio ?? '05 de agosto 2025' }}</td>
        </tr>
        <tr>
            <th>Fecha Término Contractual</th>
            <td>{{ $proyecto->sup_fecha_termino ?? '09 de setiembre 2028' }}</td>
        </tr>
        <tr>
            <th>Suspensión de Plazo</th>
            <td>{{ $proyecto->sup_suspensiones ?? '-' }}</td>
        </tr>
        <tr>
            <th>Ampliaciones de Plazo</th>
            <td>{{ $proyecto->sup_ampliaciones ?? '-' }}</td>
        </tr>
        <tr>
            <th>Plazo Ejecución Vigente</th>
            <td>{{ $proyecto->sup_plazo_vigente ?? '1132 contractual + 195 por Ampliaciones de Plazo al supervisor' }}</td>
        </tr>
        <tr>
            <th>Fecha Culminación Vigente</th>
            <td>{{ $proyecto->sup_fecha_culminacion_vigente ?? '05 de setiembre 2028' }}</td>
        </tr>
        <tr>
            <th>Fecha Culminación Programada</th>
            <td>{{ $proyecto->sup_fecha_culminacion_programada ?? '31 de enero 2029 – Considerando las actualizaciones de los cronogramas' }}</td>
        </tr>
        <tr>
            <th>Entregables Aprobados / En Revisión / Por Presentar</th>
            <td>Aprobados: {{ $proyecto->sup_entregables_aprobados ?? '-' }} | En Revisión: {{ $proyecto->sup_entregables_revision ?? '-' }} | Por Presentar: {{ $proyecto->sup_entregables_presentar ?? '-' }}</td>
        </tr>
    </table>

    <!-- SITUACIÓN FINANCIERA -->
    <div class="section-title">SITUACIÓN FINANCIERA</div>
    <table>
        <tr>
            <th>Monto Total de Inversión</th>
            <td>{{ $proyecto->monto_total_inversion ?? 'S/ 812,540,550.15' }}</td>
        </tr>
        <tr>
            <th>Avance Financiero 2022</th>
            <td>PIA: S/ 1,101,150.00 | PIM: S/ 2,275,670.00 | DEVENGADO: S/ 2,160,560.00</td>
        </tr>
        <tr>
            <th>Avance Financiero 2023</th>
            <td>PIA: S/ 128,633,558.00 | PIM: S/ 11,512,541.00 | DEVENGADO: S/ 11,193,989.00</td>
        </tr>
        <tr>
            <th>Avance Financiero 2024</th>
            <td>PIA: S/ 98,470,420.00 | PIM: S/ 1,672,132.00 | DEVENGADO: S/ 1,672,130.00</td>
        </tr>
        <tr>
            <th>Avance Financiero 2025</th>
            <td>PIA: S/ 17,128M | PIM: S/ 165,206M | DEVENGADO: S/ 190,732.154M (% Acumulado: 1.67%)</td>
        </tr>
        <tr>
            <th>Avance Financiero 2026</th>
            <td>PIA: S/ 136,215.81M | PIM: S/ 150,215.81M | DEVENGADO: S/ 145,816.88M (Programado: S/ 232,953.13M)</td>
        </tr>
        <tr>
            <th>Devengado Acumulado a la Fecha</th>
            <td>{{ $proyecto->devengado_acumulado ?? 'S/ 340,435.08M (% Avance Acumulado: 38.4%)' }}</td>
        </tr>
    </table>

    <div class="sub-title">COMPONENTE OBRA / SUPERVISIÓN (FINANCIERO)</div>
    <table>
        <tr>
            <th>OBRA - MONTO CONTRATO</th>
            <td>{{ $proyecto->obra_monto_financiero ?? 'S/ 806´093,923.08' }}</td>
        </tr>
        <tr>
            <th>Cartas Fianza / Adelantos</th>
            <td>
                Fiel Cumplimiento: {{ $proyecto->obra_fianza ?? 'Contratista solicitó la retención de garantía por fiel cumplimiento' }}<br>
                Adelanto Directo (Fideicomiso): {{ $proyecto->obra_adelanto_directo ?? 'S/ 80´609,392.31' }}<br>
                Adelanto Materiales (Fideicomiso): {{ $proyecto->obra_adelanto_materiales ?? 'S/ 128,365,210.33' }}
            </td>
        </tr>
        <tr>
            <th>Valorizaciones Pagadas / Aprobadas / Programadas</th>
            <td>Pagadas: 11 - S/ 101,796,443.61 | Aprobadas por Pagar: - | Programadas: -</td>
        </tr>
        <tr>
            <th>Adicionales / Mayores Metrados</th>
            <td>Adicionales Aprobados: 5 (-) | Mayores Metrados Aprobados: -</td>
        </tr>
        <tr>
            <th>SUPERVISIÓN - MONTO DE CONTRATO</th>
            <td>{{ $proyecto->sup_monto_financiero ?? 'S/ 22´601,534.05' }}</td>
        </tr>
        <tr>
            <th>Entregables Pagados Acumulado</th>
            <td>{{ $proyecto->sup_entregables_pagados ?? '11 – (S/ 6,966,890.53)' }}</td>
        </tr>
        <tr>
            <th>Entregables Aprobados por Pagar / En Revisión / Por Presentar</th>
            <td>Aprobados por Pagar: - | En Revisión: - | Por Presentar: - | Modificaciones Contractuales: -</td>
        </tr>
    </table>

    <!-- ESTADO SITUACIONAL -->
    <div class="section-title">ESTADO SITUACIONAL</div>
    <div class="text-block">
        <strong>AVANCE DE OBRA</strong><br>
        La ejecución de Obra cuenta con un avance físico del 16.21% de un programado de 19.30%, por lo cual se encuentra atrasada.<br><br>
        <strong>COORDINACIONES / AUTORIZACIONES / PERMISOS</strong><br>
        - Se cuenta con el Plan de Monitoreo Arqueológico Aprobado, no hay restricciones por arqueología.<br>
        - Se cuenta con los permisos de ejecución de obra por parte de la Municipalidad de Carabayllo y la Municipalidad Metropolitana de Lima.<br><br>
        <strong>MODIFICACIONES CONTRACTUALES</strong><br>
        - En fecha 13.06.2025 se suscribe la Adenda N°01 al Contrato N° 013-2025-VIVIENDA-VMCS-PASLC acordando diferir el inicio del plazo debido a la falta de suscripción del contrato de supervisión.<br>
        - En fecha 17.10.2025 se suscribe la Adenda N°02 modificando las seis (06) fórmulas polinómicas del Expediente Técnico.<br><br>
        <strong>SUPERVISIÓN</strong><br>
        La supervisión de la obra se encuentra a cargo de la empresa Acruta & Tapia.
    </div>

    <!-- PUNTOS CRÍTICOS Y ACCIONES -->
    <div class="section-title">PUNTOS CRÍTICOS Y ACCIONES DE MITIGACIÓN</div>
    <div class="text-block">
        <strong>1. Falta de libre disponibilidad del RAP-07</strong><br>
        <em>Acción:</em> El equipo de saneamiento físico legal evalúa la documentación presentada por el nuevo posesionario para verificar su validez y definir la estrategia.<br><br>
        <strong>2. Demora del proyectista respecto a Muros de Contención y Tunnel Liner</strong><br>
        <em>Acción:</em> Se reitera al proyectista la absolución integral; de persistir, se solicitará apoyo a los especialistas de la UGI.<br><br>
        <strong>3. Falta de disponibilidad presupuestal para pagos de julio a diciembre 2026</strong><br>
        <em>Acción:</em> La Unidad de Gestión de Inversiones ha solicitado una demanda adicional para cubrir los pagos a realizarse.<br><br>
        <strong>4. Expedientes de Media Tensión vencidos</strong><br>
        <em>Acción:</em> Se planteará al contratista realizar una consulta conjunta a la JRD para definir a quién corresponde la obligación de actualización.
    </div>

    <!-- HITOS DE CONTROL -->
    <div class="section-title">HITOS DE CONTROL / PRÓXIMAS ACCIONES</div>
    <table>
        <tr>
            <th>Hito de Control OCI</th>
            <td>HITO DE CONTROL 15: Con fecha 10.07.2026, el PASLC comunicó que la situación N°01 fue corregida y solicitó 45 días de ampliación de plazo para superar la situación adversa N°02 del Informe de Hito de Control N°022-2026-OCI/5303-SCC.</td>
        </tr>
        <tr>
            <th>Fecha - Última Acción Realizada</th>
            <td>30.07.2026 – Conformidad a la Valorización de Obra 11</td>
        </tr>
        <tr>
            <th>Fecha - Próximo Hito Técnico</th>
            <td>18.08.2026 – Notificación sobre la solicitud de Prestación Adicional N° 13 y N° 17.</td>
        </tr>
    </table>

    <div style="page-break-after: always;"></div>

    <!-- ANEXO I: VALORIZACIONES Y ADICIONALES -->
    <div class="section-title">ANEXO I: VALORIZACIONES Y ADICIONALES DE OBRA</div>

    <div class="sub-title">OBRA - VALORIZACIONES</div>
    <table>
        <tr class="bg-light">
            <th class="text-center">N°</th>
            <th class="text-center">Monto Valorizado</th>
            <th class="text-center">Fecha Pres. Real</th>
            <th class="text-center">Fecha Aprobación</th>
            <th class="text-center">Estado</th>
            <th class="text-center">Responsable</th>
        </tr>
        <tr><td class="text-center">Adelanto Directo</td><td class="text-center">-</td><td class="text-center">Por fideicomiso</td><td class="text-center">Por fideicomiso</td><td class="text-center">PAGO</td><td class="text-center">TESORERIA</td></tr>
        <tr><td class="text-center">Adelanto Materiales</td><td class="text-center">-</td><td class="text-center">Por fideicomiso</td><td class="text-center">Por fideicomiso</td><td class="text-center">PAGO</td><td class="text-center">TESORERIA</td></tr>
        <tr><td class="text-center">1</td><td class="text-center">236,753.56</td><td class="text-center">29/08/2025</td><td class="text-center">22/09/2025</td><td class="text-center">PAGO</td><td class="text-center">TESORERIA</td></tr>
        <tr><td class="text-center">2</td><td class="text-center">1´643,620.38</td><td class="text-center">30/09/2025</td><td class="text-center">30/10/2025</td><td class="text-center">PAGO</td><td class="text-center">TESORERIA</td></tr>
        <tr><td class="text-center">3</td><td class="text-center">3´397,170.74</td><td class="text-center">31/10/2025</td><td class="text-center">29/12/2025</td><td class="text-center">PAGO</td><td class="text-center">TESORERIA</td></tr>
        <tr><td class="text-center">4</td><td class="text-center">7´808,640.01</td><td class="text-center">29/11/2025</td><td class="text-center">29/12/2025</td><td class="text-center">PAGO</td><td class="text-center">TESORERIA</td></tr>
        <tr><td class="text-center">5</td><td class="text-center">14,926,244.78</td><td class="text-center">31/12/2025</td><td class="text-center">20/01/2025</td><td class="text-center">PAGO</td><td class="text-center">TESORERIA</td></tr>
        <tr><td class="text-center">6</td><td class="text-center">11,422,075.89</td><td class="text-center">31/01/2026</td><td class="text-center">20/02/2026</td><td class="text-center">PAGO</td><td class="text-center">TESORERIA</td></tr>
        <tr><td class="text-center">7</td><td class="text-center">12,555,603.51</td><td class="text-center">28/02/2026</td><td class="text-center">13/03/2026</td><td class="text-center">PAGO</td><td class="text-center">TESORERIA</td></tr>
        <tr><td class="text-center">8</td><td class="text-center">9,244,051.81</td><td class="text-center">31/03/2026</td><td class="text-center">17/04/2026</td><td class="text-center">PAGO</td><td class="text-center">TESORERIA</td></tr>
        <tr><td class="text-center">9</td><td class="text-center">13,197,594.88</td><td class="text-center">30/04/2026</td><td class="text-center">15/05/2026</td><td class="text-center">PAGO</td><td class="text-center">TESORERIA</td></tr>
        <tr><td class="text-center">10</td><td class="text-center">11,182,076.65</td><td class="text-center">31/05/2026</td><td class="text-center">24/06/2026</td><td class="text-center">PAGO</td><td class="text-center">TESORERIA</td></tr>
    </table>

    <div class="sub-title">OBRA - ADICIONALES</div>
    <table>
        <tr class="bg-light">
            <th class="text-center">N°</th>
            <th class="text-center">F. Presentación</th>
            <th class="text-center">Resolución</th>
            <th class="text-center">F. Aprobación</th>
            <th class="text-center">Estado</th>
            <th class="text-center">Responsable</th>
        </tr>
        <tr><td class="text-center">1</td><td class="text-center">06.10.2025</td><td class="text-center">RD 076-2025</td><td class="text-center">18.12.2025</td><td class="text-center">IMPROCEDENTE</td><td class="text-center">UGI</td></tr>
        <tr><td class="text-center">2</td><td class="text-center">10.12.2025</td><td class="text-center">RD 002-2026</td><td class="text-center">09.01.2026</td><td class="text-center">PROCEDENTE</td><td class="text-center">UGI</td></tr>
        <tr><td class="text-center">3</td><td class="text-center">03.03.2026</td><td class="text-center">RD 052-2026</td><td class="text-center">13.04.2026</td><td class="text-center">IMPROCEDENTE</td><td class="text-center">UGI</td></tr>
        <tr><td class="text-center">4</td><td class="text-center">09.02.2026</td><td class="text-center">RD 055-2026</td><td class="text-center">17.04.2026</td><td class="text-center">IMPROCEDENTE</td><td class="text-center">UGI</td></tr>
        <tr><td class="text-center">5</td><td class="text-center">17.01.2026</td><td class="text-center">RD 062-2026</td><td class="text-center">11.05.2026</td><td class="text-center">PROCEDENTE</td><td class="text-center">UGI</td></tr>
        <tr><td class="text-center">6</td><td class="text-center">07.02.2026</td><td class="text-center">RD 065-2026</td><td class="text-center">21.05.2026</td><td class="text-center">PROCEDENTE</td><td class="text-center">UGI</td></tr>
        <tr><td class="text-center">7</td><td class="text-center">18.05.2026</td><td class="text-center">RD 080-2026</td><td class="text-center">17.06.2026</td><td class="text-center">IMPROCEDENTE</td><td class="text-center">UGI</td></tr>
        <tr><td class="text-center">8</td><td class="text-center">29.06.2026</td><td class="text-center">RD 111-2026</td><td class="text-center">04.08.2026</td><td class="text-center">PROCEDENTE</td><td class="text-center">UGI</td></tr>
        <tr><td class="text-center">9</td><td class="text-center">13.07.2026</td><td class="text-center">RD 114-2026</td><td class="text-center">04.08.2026</td><td class="text-center">IMPROCEDENTE</td><td class="text-center">UGI</td></tr>
        <tr><td class="text-center">10</td><td class="text-center">29.06.2026</td><td class="text-center">RD 121-2026</td><td class="text-center">12.08.2026</td><td class="text-center">PROCEDENTE</td><td class="text-center">UGI</td></tr>
    </table>

    <div class="sub-title">SUPERVISIÓN - ENTREGABLES</div>
    <table>
        <tr class="bg-light">
            <th class="text-center">Entregable</th>
            <th class="text-center">Monto Valorizado</th>
            <th class="text-center">F. Presentación Real</th>
            <th class="text-center">F. Aprobación</th>
            <th class="text-center">Estado</th>
            <th class="text-center">Responsable</th>
        </tr>
        <tr><td class="text-center">Valorización N° 1</td><td class="text-center">552,404.66</td><td class="text-center">06.10.2025</td><td class="text-center">10.10.2025</td><td class="text-center">PAGO</td><td class="text-center">TESORERIA</td></tr>
        <tr><td class="text-center">Valorización N° 2</td><td class="text-center">607,708.07</td><td class="text-center">27.10.2025</td><td class="text-center">21.11.2025</td><td class="text-center">PAGO</td><td class="text-center">TESORERIA</td></tr>
        <tr><td class="text-center">Valorización N° 3</td><td class="text-center">643,166.49</td><td class="text-center">28.11.2025</td><td class="text-center">28.11.2025</td><td class="text-center">PAGO</td><td class="text-center">TESORERIA</td></tr>
        <tr><td class="text-center">Valorización N° 4</td><td class="text-center">631,643.50</td><td class="text-center">22.12.2025</td><td class="text-center">22.12.2025</td><td class="text-center">PAGO</td><td class="text-center">TESORERIA</td></tr>
        <tr><td class="text-center">Valorización N° 5</td><td class="text-center">676,714.00</td><td class="text-center">22.01.2026</td><td class="text-center">28.01.2026</td><td class="text-center">PAGO</td><td class="text-center">TESORERIA</td></tr>
        <tr><td class="text-center">Valorización N° 6</td><td class="text-center">652,843.79</td><td class="text-center">19.02.2026</td><td class="text-center">20.02.2026</td><td class="text-center">PAGO</td><td class="text-center">TESORERIA</td></tr>
        <tr><td class="text-center">Valorización N° 7</td><td class="text-center">617,159.94</td><td class="text-center">23.03.2026</td><td class="text-center">13.04.2026</td><td class="text-center">PAGO</td><td class="text-center">TESORERIA</td></tr>
        <tr><td class="text-center">Valorización N° 8</td><td class="text-center">666,715.29</td><td class="text-center">27.04.2026</td><td class="text-center">05.05.2026</td><td class="text-center">PAGO</td><td class="text-center">TESORERIA</td></tr>
        <tr><td class="text-center">Valorización N° 9</td><td class="text-center">648,553.35</td><td class="text-center">26.05.2026</td><td class="text-center">27.05.2026</td><td class="text-center">PAGO</td><td class="text-center">TESORERIA</td></tr>
        <tr><td class="text-center">Valorización N° 10</td><td class="text-center">669,112.55</td><td class="text-center">25.06.2026</td><td class="text-center">26.06.2026</td><td class="text-center">PAGO</td><td class="text-center">TESORERIA</td></tr>
        <tr><td class="text-center">Valorización N° 11</td><td class="text-center">648,984.96</td><td class="text-center">21.07.2026</td><td class="text-center">21.07.2026</td><td class="text-center">PAGO</td><td class="text-center">TESORERIA</td></tr>
    </table>

    <!-- LEYENDA DE ESTADOS Y RESPONSABLES -->
    <div class="sub-title">LEYENDA DE ESTADOS Y RESPONSABLES</div>
    <table>
        <tr><th>En elaboración</th><td>Consultor</td><th>En revisión</th><td>Supervisor</td></tr>
        <tr><th>Para firma de Conformidad</th><td>Coordinador UGI</td><th>Pago</th><td>Ejecutivo UGI</td></tr>
        <tr><th>Habilitación de recursos</th><td>Logística UA</td><th>Procedente / Improcedente</th><td>Contabilidad UA / Tesorería UA / Presupuesto</td></tr>
    </table>

    <div style="page-break-after: always;"></div>

    <!-- ANEXOS II Y III -->
    <div class="section-title">ANEXO II Y III: UBICACIÓN Y DESCRIPCIÓN DEL PROYECTO</div>
    <div class="text-block">
        <strong>ANEXO II: UBICACIÓN DE PROYECTO</strong><br>
        Distrito de Carabayllo, Provincia de Lima - Departamento de Lima<br>
        Link: <a href="https://maps.app.goo.gl/a36MRnsJRTYx4ERj7" target="_blank">https://maps.app.goo.gl/a36MRnsJRTYx4ERj7</a><br><br>

        <strong>ANEXO III: DESCRIPCIÓN DEL PROYECTO</strong><br><br>
        <strong>Fuente de agua:</strong> Línea de Refuerzo Chillón<br>
        <strong>Fuente de descarga:</strong> -<br><br>

        <strong>OBRAS DE AGUA POTABLE PROYECTADAS:</strong><br>
        • 14 reservorios proyectados.<br>
        • 02 cisternas proyectadas.<br>
        • 07 reservorios para rehabilitar.<br>
        • 01 estación Booster.<br>
        • 08 pozos para rehabilitar.<br>
        • 05 pozos para anular.<br>
        • 24.3 Km. de líneas de impulsión proyectadas y mejoradas.<br>
        • 2.3 Km. de líneas de conducción proyectadas y mejoradas.<br>
        • 61.7 Km. de troncales estratégicas.<br>
        • 201.4 Km. de redes secundarias proyectadas.<br>
        • 10.1 Km. de redes secundarias mejoradas.<br>
        • 12,055 nuevas conexiones domiciliarias de agua potable.<br>
        • 794 conexiones rehabilitadas de agua potable.<br><br>

        <strong>OBRAS DE ALCANTARILLADO PROYECTADAS:</strong><br>
        • 30.1 Km. de colectores principales de alcantarillado.<br>
        • 1.9 Km. de tuberías de rebose.<br>
        • 166.1 Km. de redes secundarias proyectadas.<br>
        • 9.6 Km. de redes secundarias mejoradas.<br>
        • 11,995 nuevas conexiones domiciliarias de alcantarillado.<br>
        • 984 conexiones rehabilitadas de alcantarillado.
    </div>

</body>
</html>
