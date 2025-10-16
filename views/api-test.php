<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIRE IESHUANTA - API Testing</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; padding: 20px; }
        .container { max-width: 1200px; margin: 0 auto; background: white; border-radius: 15px; box-shadow: 0 20px 40px rgba(0,0,0,0.1); overflow: hidden; }
        .header { background: #2c3e50; color: white; padding: 30px; text-align: center; }
        .header h1 { font-size: 2.5em; margin-bottom: 10px; }
        .header p { font-size: 1.1em; opacity: 0.9; }
        .content { display: grid; grid-template-columns: 1fr 1fr; gap: 0; min-height: 600px; }
        .input-section { background: #f8f9fa; padding: 30px; border-right: 2px solid #e9ecef; }
        .output-section { background: #1a1a1a; padding: 30px; color: #00ff00; font-family: 'Courier New', monospace; overflow-y: auto; }
        .endpoint-group { margin-bottom: 25px; padding: 20px; background: white; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
        .endpoint-group h3 { color: #2c3e50; margin-bottom: 15px; font-size: 1.2em; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: 600; color: #495057; }
        .form-group input, .form-group select { width: 100%; padding: 12px; border: 2px solid #e9ecef; border-radius: 8px; font-size: 14px; transition: border-color 0.3s; }
        .form-group input:focus, .form-group select:focus { outline: none; border-color: #667eea; }
        .btn { background: #667eea; color: white; border: none; padding: 12px 25px; border-radius: 8px; cursor: pointer; font-size: 14px; font-weight: 600; transition: all 0.3s; width: 100%; }
        .btn:hover { background: #5a6fd8; transform: translateY(-2px); }
        .btn-secondary { background: #6c757d; }
        .btn-secondary:hover { background: #5a6268; }
        .json-output { white-space: pre-wrap; word-wrap: break-word; font-size: 12px; line-height: 1.4; }
        .loading { color: #ffa500; text-align: center; font-style: italic; }
        .error { color: #ff4444; }
        .success { color: #00ff00; }
        .endpoint-url { background: #2d3748; padding: 10px; border-radius: 5px; margin: 10px 0; font-size: 11px; word-break: break-all; }
        @media (max-width: 768px) { .content { grid-template-columns: 1fr; } .input-section { border-right: none; border-bottom: 2px solid #e9ecef; } }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🔍 API de Estudiantes - SIRE IESHUANTA</h1>
            <p>Interfaz de prueba para endpoints JSON</p>
        </div>
        
        <div class="content">
            <div class="input-section">
                <div class="endpoint-group">
                    <h3>🔎 Búsqueda General</h3>
                    <div class="form-group">
                        <label for="q">Buscar (nombre, apellido):</label>
                        <input type="text" id="q" placeholder="Ej: Maria, Lopez, etc.">
                    </div>
                    <div class="form-group">
                        <label for="limit_general">Límite de resultados:</label>
                        <input type="number" id="limit_general" value="10" min="1" max="100">
                    </div>
                    <button class="btn" onclick="buscarGeneral()">Buscar Estudiantes</button>
                </div>

                <div class="endpoint-group">
                    <h3>🆔 Búsqueda por DNI</h3>
                    <div class="form-group">
                        <label for="dni">DNI (8 dígitos):</label>
                        <input type="text" id="dni" placeholder="Ej: 41664487" maxlength="8">
                    </div>
                    <button class="btn" onclick="buscarPorDNI()">Buscar por DNI</button>
                </div>

                <div class="endpoint-group">
                    <h3>🎯 Búsqueda Avanzada</h3>
                    <div class="form-group">
                        <label for="nombres">Nombres:</label>
                        <input type="text" id="nombres" placeholder="Ej: Jesus">
                    </div>
                    <div class="form-group">
                        <label for="apellido_paterno">Apellido Paterno:</label>
                        <input type="text" id="apellido_paterno" placeholder="Ej: ORDOÑEZ">
                    </div>
                    <div class="form-group">
                        <label for="apellido_materno">Apellido Materno:</label>
                        <input type="text" id="apellido_materno" placeholder="Ej: GUINEA">
                    </div>
                    <div class="form-group">
                        <label for="estado">Estado:</label>
                        <select id="estado">
                            <option value="">Todos</option>
                            <option value="activo">Activo</option>
                            <option value="inactivo">Inactivo</option>
                            <option value="graduado">Graduado</option>
                            <option value="suspendido">Suspendido</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="limit_avanzado">Límite:</label>
                        <input type="number" id="limit_avanzado" value="20" min="1" max="100">
                    </div>
                    <button class="btn" onclick="buscarAvanzado()">Búsqueda Avanzada</button>
                </div>

                <div class="endpoint-group">
                    <h3>👤 Obtener Estudiante Específico</h3>
                    <div class="form-group">
                        <label for="dni_especifico">DNI del estudiante:</label>
                        <input type="text" id="dni_especifico" placeholder="Ej: 41664487" maxlength="8">
                    </div>
                    <button class="btn" onclick="getEstudiante()">Obtener Estudiante</button>
                </div>

                <div class="endpoint-group">
                    <h3>📚 Documentación</h3>
                    <button class="btn btn-secondary" onclick="getDocumentacion()">Ver Documentación API</button>
                </div>
            </div>

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
        function mostrarURL(endpoint) { document.getElementById('endpointUrl').textContent = 'Endpoint: ' + endpoint; }
        function mostrarResultado(data, isError = false) {
            const output = document.getElementById('jsonOutput');
            const jsonString = JSON.stringify(data, null, 2);
            output.innerHTML = '';
            output.appendChild(document.createTextNode(jsonString));
            output.className = 'json-output ' + (isError ? 'error' : 'success');
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
                mostrarResultado({ success: false, message: 'Error de conexión', error: error.message }, true);
            }
        }
        function buscarGeneral() {
            const q = document.getElementById('q').value.trim();
            const limit = document.getElementById('limit_general').value;
            if (!q) { alert('Por favor ingrese un término de búsqueda'); return; }
            const params = new URLSearchParams({ q: q, limit: limit });
            hacerRequest(API_BASE + 'buscarEstudiantes&' + params.toString());
        }
        function buscarPorDNI() {
            const dni = document.getElementById('dni').value.trim();
            if (!dni) { alert('Por favor ingrese un DNI'); return; }
            if (!/^\d{8}$/.test(dni)) { alert('El DNI debe contener exactamente 8 dígitos'); return; }
            const params = new URLSearchParams({ dni: dni });
            hacerRequest(API_BASE + 'buscarEstudiantes&' + params.toString());
        }
        function buscarAvanzado() {
            const nombres = document.getElementById('nombres').value.trim();
            const apellido_paterno = document.getElementById('apellido_paterno').value.trim();
            const apellido_materno = document.getElementById('apellido_materno').value.trim();
            const estado = document.getElementById('estado').value;
            const limit = document.getElementById('limit_avanzado').value;
            const params = new URLSearchParams();
            if (nombres) params.append('nombres', nombres);
            if (apellido_paterno) params.append('apellido_paterno', apellido_paterno);
            if (apellido_materno) params.append('apellido_materno', apellido_materno);
            if (estado) params.append('estado', estado);
            params.append('limit', limit);
            if (params.toString() === 'limit=' + limit) { params.append('limit', '50'); }
            hacerRequest(API_BASE + 'buscarEstudiantes&' + params.toString());
        }
        function getEstudiante() {
            const dni = document.getElementById('dni_especifico').value.trim();
            if (!dni) { alert('Por favor ingrese un DNI'); return; }
            if (!/^\d{8}$/.test(dni)) { alert('El DNI debe contener exactamente 8 dígitos'); return; }
            hacerRequest(`index.php?controller=api&action=getEstudiante&dni=${dni}`);
        }
        function getDocumentacion() { hacerRequest(API_BASE + 'documentacion'); }
        document.addEventListener('DOMContentLoaded', function() { getDocumentacion(); });
    </script>
</body>
</html>