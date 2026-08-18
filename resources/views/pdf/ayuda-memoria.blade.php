<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ayuda Memoria - CUI {{ $proyecto->cui }}</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; color: #333; }
        h1 { color: #c2410c; font-size: 18px; border-bottom: 2px solid #c2410c; padding-bottom: 5px; }
        .section { margin-top: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #cbd5e1; padding: 6px 8px; text-align: left; }
        th { background-color: #f1f5f9; }
    </style>
</head>
<body>
    <h1>AYUDA MEMORIA - CUI: {{ $proyecto->cui }}</h1>

    <div class="section">
        <h3>1. DATOS GENERALES</h3>
        <table>
            <tr>
                <th>Proyecto / Alias</th>
                <td>{{ $proyecto->proyecto_alias }}</td>
            </tr>
            <tr>
                <th>Etapa Actual</th>
                <td>{{ $proyecto->etapa_actual }}</td>
            </tr>
            <tr>
                <th>Estado del Proyecto</th>
                <td>{{ $proyecto->estado_proyecto }}</td>
            </tr>
            <tr>
                <th>Monto de Inversión</th>
                <td>S/ {{ number_format($proyecto->monto_inversion, 2) }}</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <h3>2. SITUACIÓN CONTRACTUAL</h3>
        <table>
            <tr>
                <th>Contratista (Ejecución)</th>
                <td>{{ $proyecto->contratista_razon_social ?? 'No registrado' }}</td>
            </tr>
            <tr>
                <th>N° de Contrato Obra</th>
                <td>{{ $proyecto->contratista_numero_contrato ?? '---' }}</td>
            </tr>
            <tr>
                <th>Supervisor</th>
                <td>{{ $proyecto->supervisor_razon_social ?? 'No registrado' }}</td>
            </tr>
        </table>
    </div>
</body>
</html>
