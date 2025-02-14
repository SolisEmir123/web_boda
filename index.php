<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Boda</title>
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/app.css">
</head>
<body>
    <div class="container">
    <div class="col-md-5">
    <div class="card card-custom text-center p-4">
        <img src="./imgs/info_inv.jpg" alt="Información de la boda" 
             style="max-width: 100%; height: auto; display: block; margin: 0 auto; margin-bottom: 15px;">
        <div style="display: none;" class="video-container">
            <video id="videoBoda" controls>
                <source src="./videos/boda.mp4" type="video/mp4">
                Tu navegador no soporta la reproducción de video.
            </video>
        </div>          
    </div>
</div>

<div class="col-md-6 right-section">
<div id="exito" class="alert alert-success mt-3" style="display: none;"></div>
<div id="alert" class="alert alert-danger mt-3" style="display: none;"></div>
<form id="confirmationForm" action="guardar_confirmacion.php" method="POST">
        <div class="card card-custom p-3">
            <label for="nombre" class="form-label">Nombre Completo</label>
            <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Ingresa tu nombre" required>
        </div>
        <div class="card card-custom my-2 p-3 text-center">
            <label id="pregunta" class="form-label">¿Asistirás?</label>
            <div id="pregunta2">
                <input type="radio" id="asistire" name="asistencia" value="Sí" required>
                <label for="asistire">Sí</label>
                <input type="radio" id="noAsistire" name="asistencia" value="No" required>
                <label for="noAsistire">No</label>
            </div>
            <button id="btnConfirmar" type="submit" class="btn btn-primary mt-3">Confirmar Asistencia</button>
        </div>
    </form>
</div>
    </div>
    <script src="./bootstrap/js/bootstrap.bundle.js">
        
    </script>
    <script>

        /* document.addEventListener("DOMContentLoaded", function() {
                var video = document.getElementById("videoBoda");

                if (video) {
                    // Esperamos a que el usuario haga clic en la página
                    document.body.addEventListener("click", function() {
                        // Reproducir el video con sonido
                        video.muted = false;  // Desactivar el mute
                        video.volume = 0.2;    // Establecer volumen al 20%
                        video.play();          // Reproducir el video
                    });
                } else {
                    console.error("No se encontró el video.");
                }
            }); */
          

            document.getElementById("confirmationForm").addEventListener("submit", function(event) {
            event.preventDefault(); 

            const nombre = document.getElementById("nombre").value;
            const alerta = document.getElementById("alert");
            const exito = document.getElementById("exito");

            const regex = /^[A-Za-záéíóúÁÉÍÓÚüÜ\s]+$/;

            if (!regex.test(nombre)) {
                alerta.style.display = "block";
                alerta.innerText = "Por favor, ingresa solo texto en el campo de nombre.";

            
                setTimeout(function() {
                    alerta.style.opacity = 0; 
                }, 2000);

                
                setTimeout(function() {
                    alerta.style.display = "none"; 
                    alerta.style.opacity = 1; 
                }, 3000);

                return; 
            }

                exito.style.display = "block";
                exito.innerText = "¡Gracias por confirmar tu asistencia!";

                setTimeout(function() {
                    exito.style.opacity = 0; 
                }, 2000);
                setTimeout(function() {
                    exito.style.display = "none"; 
                    exito.style.opacity = 1; 
                }, 3000);

            const formData = new FormData(this);

            fetch('guardar_confirmacion.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                document.getElementById("btnConfirmar").disabled = true;
                document.getElementById("pregunta").style.display = "none";
                document.getElementById("pregunta2").style.display = "none";
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });

        function confirmarAsistencia() {
        }
    </script>
</body>
</html>