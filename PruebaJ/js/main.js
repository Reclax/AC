document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('loginForm');
    const registerForm = document.getElementById('registerForm');
    const surveyForm = document.getElementById('surveyForm');
    const cancelButton = document.getElementById('cancelButton');

    // Función para depurar mensajes
    function debugLog(message) {
        console.log(message);
    }

    // Verificar la sesión al cargar la página
    function checkSession() {
        const userId = sessionStorage.getItem('userId');
        const isAdmin = sessionStorage.getItem('isAdmin');
        const currentPath = window.location.pathname;

        debugLog(`Current Path: ${currentPath}`);
        debugLog(`User ID: ${userId}`);
        debugLog(`Is Admin: ${isAdmin}`);

        if (currentPath.includes('survey.html')) {
            if (!userId) {
                debugLog('No user ID found, redirecting to login');
                window.location.href = 'login.html';
                return;
            }
            debugLog('User ID found, staying on survey page');
        }

        if (currentPath.includes('admin_report.html') && (!userId || isAdmin !== '1')) {
            debugLog('Unauthorized access to admin report');
            window.location.href = 'login.html';
        }
    }

    // Ejecutar la verificación de sesión al cargar la página
    checkSession();

    if (loginForm) {
        loginForm.addEventListener('submit', function(event) {
            event.preventDefault();
            const cedula = document.getElementById('cedula').value;
            const clave = document.getElementById('clave').value;

            fetch('php/login.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ cedula, clave })
            })
            .then(response => response.json())
            .then(data => {
                debugLog('Login Response:');
                debugLog(JSON.stringify(data));

                if (data.success) {
                    sessionStorage.setItem('userId', data.userId);
                    sessionStorage.setItem('isAdmin', data.isAdmin);
                    sessionStorage.setItem('nombre', data.nombre);
                    sessionStorage.setItem('apellido', data.apellido);

                    debugLog(`Redirecting - Is Admin: ${data.isAdmin}`);

                    if (data.isAdmin === 1 || data.isAdmin === '1') {
                        window.location.href = 'admin_report.html';
                    } else {
                        window.location.href = 'survey.html';
                    }
                } else {
                    alert('Credenciales inválidas');
                }
            })
            .catch(error => {
                debugLog(`Login Error: ${error}`);
                console.error('Error:', error);
            });
        });
    }

    if (registerForm) {
        registerForm.addEventListener('submit', function(event) {
            event.preventDefault();
            const cedula = document.getElementById('cedula').value;
            const nombre = document.getElementById('nombre').value;
            const apellido = document.getElementById('apellido').value;
            const clave = document.getElementById('clave').value;

            fetch('php/register.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ cedula, nombre, apellido, clave })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Registro exitoso');
                    window.location.href = 'login.html';
                } else {
                    alert('Error al registrar');
                }
            })
            .catch(error => console.error('Error:', error));
        });
    }

    if (surveyForm) {
        const userId = sessionStorage.getItem('userId');
        const nombre = sessionStorage.getItem('nombre');
        const apellido = sessionStorage.getItem('apellido');

        if (!userId) {
            window.location.href = 'login.html';
        }

        document.getElementById('nombre').value = nombre;
        document.getElementById('apellido').value = apellido;

        surveyForm.addEventListener('submit', function(event) {
            event.preventDefault();
            const pregunta1 = document.querySelector('input[name="pregunta1"]:checked')?.value;
            const pregunta2 = document.querySelector('input[name="pregunta2"]:checked')?.value;

            if (!pregunta1 || !pregunta2) {
                alert('Debe responder todas las preguntas');
                return;
            }

            fetch('php/survey.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ userId, pregunta1, pregunta2 })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Encuesta guardada exitosamente');
                    window.location.href = 'index.html';
                } else {
                    alert('Error al guardar la encuesta');
                }
            })
            .catch(error => console.error('Error:', error));
        });

        cancelButton.addEventListener('click', function() {
            sessionStorage.clear();
            window.location.href = 'index.html';
        });
    }

    if (document.getElementById('report')) {
        const isAdmin = sessionStorage.getItem('isAdmin');
        if (!isAdmin || isAdmin !== '1') {
            window.location.href = 'login.html';
        }

        fetch('php/admin_report.php')
        .then(response => response.json())
        .then(data => {
            document.getElementById('pregunta1Si').textContent = data.pregunta1.SI || 0;
            document.getElementById('pregunta1No').textContent = data.pregunta1.NO || 0;
            document.getElementById('pregunta2Si').textContent = data.pregunta2.SI || 0;
            document.getElementById('pregunta2No').textContent = data.pregunta2.NO || 0;
        })
        .catch(error => console.error('Error:', error));
    }
});
