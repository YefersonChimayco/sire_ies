<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscador de Estudiantes - IESHUANTA</title>
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
        
        .contenedor {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        
        .encabezado {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        
        .encabezado h1 {
            font-size: 2.5em;
            margin-bottom: 10px;
            font-weight: 300;
        }
        
        .encabezado p {
            opacity: 0.9;
            font-size: 1.2em;
        }
        
        .seccion-busqueda {
            padding: 30px;
            background: #f8f9fa;
            border-bottom: 1px solid #e1e5e9;
        }
        
        .formulario-busqueda {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }
        
        .grupo-busqueda {
            display: flex;
            flex-direction: column;
        }
        
        .grupo-busqueda label {
            margin-bottom: 8px;
            font-weight: 600;
            color: #2c3e50;
            font-size: 14px;
        }
        
        .grupo-busqueda input {
            padding: 12px 15px;
            border: 2px solid #e1e5e9;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s ease;
        }
        
        .grupo-busqueda input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }
        
        .botones-busqueda {
            grid-column: 1 / -1;
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 10px;
        }
        
        .boton {
            padding: 12px 30px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .boton-primario {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        
        .boton-primario:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        
        .boton-secundario {
            background: #6c757d;
            color: white;
        }
        
        .boton-secundario:hover {
            background: #5a6268;
            transform: translateY(-2px);
        }
        
        .seccion-resultados {
            padding: 30px;
        }
        
        .estado-busqueda {
            text-align: center;
            margin-bottom: 20px;
        }
        
        .contador {
            background: #e3f2fd;
            color: #1976d2;
            padding: 10px 20px;
            border-radius: 20px;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 15px;
        }
        
        .grid-estudiantes {
            display: grid;
            gap: 20px;
        }
        
        .tarjeta-estudiante {
            background: white;
            border: 1px solid #e1e5e9;
            border-radius: 12px;
            padding: 25px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        
        .tarjeta-estudiante:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            border-color: #667eea;
        }
        
        .encabezado-tarjeta {
            display: flex;
            justify-content: between;
            align-items: center;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f7fafc;
        }
        
        .nombre-estudiante {
            font-size: 1.4em;
            font-weight: 600;
            color: #2d3748;
            flex: 1;
        }
        
        .estado {
            padding: 6px 15px;
            border-radius: 20px;
            font-size: 0.85em;
            font-weight: 600;
        }
        
        .estado-activo {
            background: #c8f0c9;
            color: #2e7d32;
        }
        
        .estado-inactivo {
            background: #ffcdd2;
            color: #c62828;
        }
        
        .estado-graduado {
            background: #bbdefb;
            color: #1565c0;
        }
        
        .info-estudiante {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 15px;
        }
        
        .grupo-info {
            display: flex;
            flex-direction: column;
        }
        
        .etiqueta {
            font-weight: 600;
            color: #667eea;
            font-size: 0.9em;
            margin-bottom: 5px;
        }
        
        .valor {
            color: #4a5568;
            font-size: 1em;
        }
        
        .sin-resultados {
            text-align: center;
            padding: 60px 30px;
            color: #718096;
        }
        
        .icono-grande {
            font-size: 4em;
            margin-bottom: 20px;
            opacity: 0.5;
        }
        
        .mensaje-carga {
            text-align: center;
            padding: 40px;
            color: #667eea;
        }
        
        .spinner {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #667eea;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
            margin: 0 auto 20px;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        .mensaje-error {
            text-align: center;
            padding: 20px;
            background: #ffebee;
            color: #c62828;
            border-radius: 8px;
            margin: 20px 0;
            border: 1px solid #ffcdd2;
        }
        
        @media (max-width: 768px) {
            .formulario-busqueda {
                grid-template-columns: 1fr;
            }
            
            .botones-busqueda {
                flex-direction: column;
            }
            
            .boton {
                width: 100%;
            }
            
            .encabezado-tarjeta {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
            
            .info-estudiante {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="contenedor">
        <div class="encabezado">
            <h1>🔍 Buscador de Estudiantes</h1>
            <p>Sistema de Consulta - Instituto IESHUANTA</p>
        </div>
        
        <div class="seccion-busqueda">
            <form class="formulario-busqueda" id="formularioBusqueda">
                <div class="grupo-busqueda">
                    <label for="dni">📋 Número de DNI</label>
                    <input type="text" id="dni" placeholder="Ej: 71654321">
                </div>
                
                <div class="grupo-busqueda">
                    <label for="nombre">👤 Nombre</label>
                    <input type="text" id="nombre" placeholder="Ej: María">
                </div>
                
                <div class="grupo-busqueda">
                    <label for="apellido">📝 Apellido</label>
                    <input type="text" id="apellido" placeholder="Ej: García">
                </div>
                
                <div class="botones-busqueda">
                    <button type="submit" class="boton boton-primario">
                        🔍 Buscar Estudiantes
                    </button>
                    <button type="button" class="boton boton-secundario" onclick="limpiarBusqueda()">
                        🗑️ Limpiar
                    </button>
                </div>
            </form>
        </div>
        
        <div class="seccion-resultados">
            <div id="estadoBusqueda"></div>
            <div id="resultados">
                <div class="sin-resultados">
                    <div class="icono-grande">🎓</div>
                    <h3>Bienvenido al Buscador de Estudiantes</h3>
                    <p>Utilice los campos de búsqueda para encontrar estudiantes por DNI, nombre o apellido</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('formularioBusqueda').addEventListener('submit', function(e) {
            e.preventDefault();
            realizarBusqueda();
        });
        
        function realizarBusqueda() {
            const dni = document.getElementById('dni').value.trim();
            const nombre = document.getElementById('nombre').value.trim();
            const apellido = document.getElementById('apellido').value.trim();
            
            // Validar que al menos un campo tenga valor
            if (!dni && !nombre && !apellido) {
                mostrarEstado('⚠️ Por favor, ingrese al menos un criterio de búsqueda', 'error');
                return;
            }
            
            buscarEstudiantes(dni, nombre, apellido);
        }
        
        function buscarEstudiantes(dni, nombre, apellido) {
            const resultados = document.getElementById('resultados');
            const estadoBusqueda = document.getElementById('estadoBusqueda');
            
            // Mostrar estado de carga
            mostrarEstado('Buscando estudiantes...', 'carga');
            resultados.innerHTML = crearSpinner();
            
            // Construir URL de la API
            const parametros = new URLSearchParams();
            if (dni) parametros.append('dni', dni);
            if (nombre) parametros.append('nombre', nombre);
            if (apellido) parametros.append('apellido', apellido);
            
            const url = `index.php?controller=apiestudiante&action=buscar&${parametros.toString()}`;
            
            fetch(url)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`Error ${response.status}: ${response.statusText}`);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.exito) {
                        mostrarResultados(data.datos);
                        mostrarEstado(`✅ Se encontraron ${data.total} estudiante(s)`, 'exito');
                    } else {
                        throw new Error(data.error || 'Error en la búsqueda');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    mostrarEstado(`❌ Error: ${error.message}`, 'error');
                    resultados.innerHTML = crearMensajeError('No se pudieron cargar los resultados');
                });
        }
        
        function mostrarResultados(estudiantes) {
            const resultados = document.getElementById('resultados');
            
            if (estudiantes.length === 0) {
                resultados.innerHTML = crearMensajeSinResultados();
                return;
            }
            
            let html = `<div class="grid-estudiantes">`;
            
            estudiantes.forEach(est => {
                const estadoClase = obtenerClaseEstado(est.estado);
                const estadoTexto = obtenerTextoEstado(est.estado);
                
                html += `
                    <div class="tarjeta-estudiante">
                        <div class="encabezado-tarjeta">
                            <div class="nombre-estudiante">
                                ${est.nombres} ${est.apellido_paterno} ${est.apellido_materno}
                            </div>
                            <div class="estado ${estadoClase}">
                                ${estadoTexto}
                            </div>
                        </div>
                        <div class="info-estudiante">
                            <div class="grupo-info">
                                <span class="etiqueta">🎫 DNI:</span>
                                <span class="valor">${est.dni}</span>
                            </div>
                            <div class="grupo-info">
                                <span class="etiqueta">📚 Programa:</span>
                                <span class="valor">${est.programa_nombre || 'No especificado'}</span>
                            </div>
                            <div class="grupo-info">
                                <span class="etiqueta">📅 Semestre:</span>
                                <span class="valor">${est.semestre_nombre || `Semestre ${est.semestre}`}</span>
                            </div>
                            <div class="grupo-info">
                                <span class="etiqueta">📅 Matrícula:</span>
                                <span class="valor">${formatearFecha(est.fecha_matricula) || 'No registrada'}</span>
                            </div>
                        </div>
                    </div>
                `;
            });
            
            html += `</div>`;
            resultados.innerHTML = html;
        }
        
        function obtenerClaseEstado(estado) {
            const clases = {
                'activo': 'estado-activo',
                'inactivo': 'estado-inactivo',
                'graduado': 'estado-graduado',
                'suspendido': 'estado-inactivo'
            };
            return clases[estado] || 'estado-inactivo';
        }
        
        function obtenerTextoEstado(estado) {
            const textos = {
                'activo': 'Activo',
                'inactivo': 'Inactivo',
                'graduado': 'Graduado',
                'suspendido': 'Suspendido'
            };
            return textos[estado] || 'Inactivo';
        }
        
        function formatearFecha(fecha) {
            if (!fecha || fecha === '0000-00-00') return null;
            return new Date(fecha).toLocaleDateString('es-ES');
        }
        
        function mostrarEstado(mensaje, tipo) {
            const estadoBusqueda = document.getElementById('estadoBusqueda');
            let html = '';
            
            if (tipo === 'exito') {
                html = `<div class="contador">${mensaje}</div>`;
            } else if (tipo === 'error') {
                html = `<div class="mensaje-error">${mensaje}</div>`;
            } else if (tipo === 'carga') {
                html = `<div class="contador">${mensaje}</div>`;
            }
            
            estadoBusqueda.innerHTML = html;
        }
        
        function crearSpinner() {
            return `
                <div class="mensaje-carga">
                    <div class="spinner"></div>
                    <p>Buscando en la base de datos...</p>
                </div>
            `;
        }
        
        function crearMensajeSinResultados() {
            return `
                <div class="sin-resultados">
                    <div class="icono-grande">🔍</div>
                    <h3>No se encontraron estudiantes</h3>
                    <p>No hay resultados que coincidan con los criterios de búsqueda.</p>
                    <p>Intente con otros términos o verifique la información ingresada.</p>
                </div>
            `;
        }
        
        function crearMensajeError(mensaje) {
            return `
                <div class="sin-resultados">
                    <div class="icono-grande">❌</div>
                    <h3>${mensaje}</h3>
                    <p>Por favor, intente nuevamente más tarde.</p>
                </div>
            `;
        }
        
        function limpiarBusqueda() {
            document.getElementById('dni').value = '';
            document.getElementById('nombre').value = '';
            document.getElementById('apellido').value = '';
            document.getElementById('estadoBusqueda').innerHTML = '';
            document.getElementById('resultados').innerHTML = `
                <div class="sin-resultados">
                    <div class="icono-grande">🎓</div>
                    <h3>Bienvenido al Buscador de Estudiantes</h3>
                    <p>Utilice los campos de búsqueda para encontrar estudiantes por DNI, nombre o apellido</p>
                </div>
            `;
        }
        
        // Buscar al presionar Enter en cualquier campo
        document.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                realizarBusqueda();
            }
        });
    </script>
</body>
</html>