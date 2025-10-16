<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Estudiantes - Prueba</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        .container {
            max-width: 1000px;
            margin: 0 auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .header {
            background: #2c3e50;
            color: white;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            font-size: 2.5em;
            margin-bottom: 10px;
        }
        .content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0;
            min-height: 600px;
        }
        .input-section {
            background: #f8f9fa;
            padding: 30px;
            border-right: 2px solid #e9ecef;
        }
        .output-section {
            background: #1a1a1a;
            padding: 30px;
            color: #00ff00;
            font-family: 'Courier New', monospace;
            overflow-y: auto;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #2c3e50;
        }
        .form-group input {
            width: 100%;
            padding: 12px;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            font-size: 16px;
        }
        .form-group input:focus {
            outline: none;
            border-color: #667eea;
        }
        .btn {
            background: #667eea;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            transition: all 0.3s;
            width: 100%;
            margin: 5px 0;
        }
        .btn:hover {
            background: #5a6fd8;
            transform: translateY(-2px);
        }
        .btn-secondary {
            background: #6c757d;
        }
        .btn-secondary:hover {
            background: #5a6268;
        }
        .json-output {
            white-space: pre-wrap;
            word-wrap: break-word;
            font-size: 12px;
            line-height: 1.4;
        }
        .loading {
            color: #ffa500;
            text-align: center;
            font-style: italic;
        }
        .error {
            color: #ff4444;
        }
        .success {
            color: #00ff00;
        }
        .endpoint-url {
            background: #2d3748;
            padding: 10px;
            border-radius: 5px;
            margin: 10px 0;
            font-size: 11px;
            word-break: break-all;
        }
        @media (max-width: 768px) {
            .content {
                grid-template-columns: 1fr;
            }
            .input-section {
                border-right: none;
                border-bottom: 2px solid #e9ecef;
            }
        }
    </style>
</head>
<body>
    <div style="text-align:center;">
        <a class="btn btn-dashboard" href="index.php?controller=auth&action=dashboard">⬅ Regresar al Dashboard</a>
    </div>
    <div class="container">
        <div class="header">
            <h1>🔍 API de Estudiantes</h1>
            <p>SIRE IESHUANTA - Prueba de endpoints JSON</p>
        </div>
        
        <div class="content">
            <!-- Sección de entrada -->
            <div class="input-section">
                <div class="form-group">
                    <h3>🎯 Buscar Estudiantes</h3>
                    <label for="dni">DNI (8 dígitos):</label>
                    <input type="text" id="dni" placeholder="Ej: 41664487" maxlength="8">
                </div>

                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" placeholder="Ej: Jesus">
                </div>

                <div class="form-group">
                    <label for="apellido">Apellido:</label>
                    <input type="text" id="apellido" placeholder="Ej: ORDOÑEZ">
                </div>

                <button class="btn" onclick="buscarEstudiantes()">🔍 Buscar Estudiantes</button>
                <button class="btn btn-secondary" onclick="limpiarBusqueda()">🧹 Limpiar</button>

                <div class="form-group" style="margin-top: 30px;">
                    <h3>👤 Obtener Estudiante Específico</h3>
                    <label for="dniEspecifico">DNI del estudiante:</label>
                    <input type="text" id="dniEspecifico" placeholder="Ej: 41664487" maxlength="8">
                    <button class="btn" onclick="getEstudiante()">👤 Obtener Estudiante</button>
                </div>
            </div>

            <!-- Sección de salida -->
            <div class="output-section">
                <h3 style="color: white; margin-bottom: 15px;">📊 Respuesta JSON</h3>
                <div id="endpointUrl" class="endpoint-url"></div>
                <div id="jsonOutput" class="json-output">
                    <div class="loading">Esperando solicitud... 👆</div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const API_BASE = 'index.php?controller=api&action=';

        function mostrarURL(endpoint) {
            document.getElementById('endpointUrl').textContent = 'Endpoint: ' + endpoint;
        }

        function mostrarResultado(data, isError = false) {
            const output = document.getElementById('jsonOutput');
            const jsonString = JSON.stringify(data, null, 2);
            
            output.innerHTML = '';
            output.appendChild(document.createTextNode(jsonString));
            
            if (isError) {
                output.className = 'json-output error';
            } else {
                output.className = 'json-output success';
            }
        }

        function mostrarCargando() {
            const output = document.getElementById('jsonOutput');
            output.innerHTML = '<div class="loading">⏳ Cargando...</div>';
            output.className = 'json-output';
        }

        async function hacerRequest(url) {
            mostrarCargando();
            mostrarURL(url);

            try {
                const response = await fetch(url);
                const data = await response.json();
                mostrarResultado(data, !response.ok);
            } catch (error) {
                mostrarResultado({
                    success: false,
                    message: 'Error de conexión',
                    error: error.message
                }, true);
            }
        }

        function buscarEstudiantes() {
            const dni = document.getElementById('dni').value.trim();
            const nombre = document.getElementById('nombre').value.trim();
            const apellido = document.getElementById('apellido').value.trim();
            
            const params = new URLSearchParams();
            if (dni) params.append('dni', dni);
            if (nombre) params.append('nombre', nombre);
            if (apellido) params.append('apellido', apellido);
            
            hacerRequest(API_BASE + 'buscarEstudiantes&' + params.toString());
        }

        function getEstudiante() {
            const dni = document.getElementById('dniEspecifico').value.trim();
            
            if (!dni) {
                alert('Por favor ingrese un DNI');
                return;
            }

            if (!/^\d{8}$/.test(dni)) {
                alert('El DNI debe contener exactamente 8 dígitos');
                return;
            }

            hacerRequest(API_BASE + 'getEstudiante&dni=' + dni);
        }

        function limpiarBusqueda() {
            document.getElementById('dni').value = '';
            document.getElementById('nombre').value = '';
            document.getElementById('apellido').value = '';
            document.getElementById('dniEspecifico').value = '';
            document.getElementById('jsonOutput').innerHTML = '<div class="loading">Esperando solicitud... 👆</div>';
            document.getElementById('endpointUrl').textContent = '';
        }
    </script>
</body>
</html>