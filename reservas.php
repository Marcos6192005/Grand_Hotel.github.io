<?php
// Conectar a la base de datos
$conn = new mysqli('localhost', 'root', '', 'hotel');

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Inicializa la variable $message
$message = "";

// Función para verificar disponibilidad
function check_availability($conn, $tipo_habitacion, $fecha_entrada, $fecha_salida) {
    $sql = "SELECT * FROM reservas WHERE tipo_habitacion = ? AND (fecha_entrada <= ? AND fecha_salida >= ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $tipo_habitacion, $fecha_salida, $fecha_entrada);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows === 0; // Si no hay resultados, la habitación está disponible
}

// Función para realizar una reserva
function make_reservation($conn, $tipo_habitacion, $fecha_entrada, $fecha_salida, $adultos, $ninos) {
    $sql = "INSERT INTO reservas (tipo_habitacion, fecha_entrada, fecha_salida, adultos, ninos) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssii", $tipo_habitacion, $fecha_entrada, $fecha_salida, $adultos, $ninos);
    return $stmt->execute();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tipo_habitacion = $_POST['room'];
    $fecha_entrada = $_POST['checkin'];
    $fecha_salida = $_POST['checkout'];
    $adultos = $_POST['adults'];
    $ninos = $_POST['children'];

    if (isset($_POST['check_availability'])) {
        // Acción: Verificar disponibilidad
        if (check_availability($conn, $tipo_habitacion, $fecha_entrada, $fecha_salida)) {
            $message = "La habitación está disponible.";
        } else {
            $message = "Lo sentimos, la habitación no está disponible en esas fechas.";
        }
    }

    if (isset($_POST['reserve'])) {
        // Acción: Realizar reserva
        if (check_availability($conn, $tipo_habitacion, $fecha_entrada, $fecha_salida)) {
            if (make_reservation($conn, $tipo_habitacion, $fecha_entrada, $fecha_salida, $adultos, $ninos)) {
                $message = "¡Reserva realizada con éxito!";
            } else {
                $message = "Hubo un error al realizar la reserva. Por favor, inténtalo de nuevo.";
            }
        } else {
            $message = "Lo sentimos, la habitación no está disponible en esas fechas.";
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="stylesheet" href="style.css">
    <!-- Corregido el enlace para incluir el archivo JavaScript correctamente -->
    <script src="scrip-spanish.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Grand Hotel</title>
</head>
<body>

<header id="main-header">
    <div class="background"></div>
    <div class="overlay-header"></div>
    <div class="content">
        <nav class="arriba">    
            <ul>
                <li><a href="English.html"><i>English</i></a></li> 
            </ul>
        </nav>
        <br><br><br><br><br>
        <b>
            <h1>The Grand Hotel</h1>
            <p>Proyecto: <b><i>Feria de logros</i></b></p>
            <p><b>2° BTVDS</b></p>
            <p>Disfruta de una experiencia única</p>
        </b>
    </div>
</header>

<nav>
    <a href="#content-">Sobre Nosotros</a>
    <a href="#departments">Departamentos</a>
    <a href="#gallery">Galería</a>
    <a href="#calendar">Disponibilidad</a>
</nav>

<header id="welcome-header">
    <section id="content-">
        <section class="content-">
            <div class="background-2"></div>
            <div class="overlay-2"></div>
            <div class="content-2">
                <b><h1>Bienvenido a The Grand Hotel</h1></b>
                <p>Nos complace recibirlo en nuestro refugio, donde la comodidad y la hospitalidad se combinan para ofrecerle una experiencia inolvidable. Nuestro equipo está aquí para asegurarse de que su estancia sea placentera y relajante.</p>
                <p>Disfrute de nuestras instalaciones, explore los encantos de la zona y no dude en acercarse a nuestro personal para cualquier consulta o recomendación. Su satisfacción es nuestra prioridad.</p>
                <p>Esperamos que su tiempo con nosotros sea memorable. ¡Bienvenido y que tenga una maravillosa estancia!</p>
            </div>
        </section>
    </section>
</header>

<!-- Imagen prueba -->
<div class="video-container">
    <center>
    <video width="600" height="300" controls>
        <source src="Imagenes/Video_mamalon.mp4" type="video/mp4">
    </video>
    </center>
</div>

<!-- Departamentos del hotel -->
<section id="departments">
    <h2>Nuestros Departamentos</h2>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <img src="Imagenes/Presentacion8.jpg" alt="Imagen 1" class="card-img-top">
                <div class="overlay">
                    <div class="card-title"><h1>Recepción</h1>Atención personalizada las 24 horas del día.</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <img src="Imagenes/Presentacion2.jpg" alt="Imagen 2" class="card-img-top">
                <div class="overlay">
                    <div class="card-title"><h1>Restaurante</h1>Cocina gourmet con platillos internacionales.</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <img src="Presentacion3.jpg" alt="Imagen 3" class="card-img-top">
                <div class="overlay">
                    <div class="card-title"><h1>Habitaciones</h1>Comodidad y elegancia en cada habitación.</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <img src="Imagenes/Presentacion5(1).jpg" alt="Imagen 4" class="card-img-top">
                <div class="overlay">
                    <div class="card-title"><h1>Spa</h1>Relájate en nuestro spa de lujo.</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <img src="Imagenes/Presentacion4.jpg" alt="Imagen 5" class="card-img-top">
                <div class="overlay">
                    <div class="card-title"><h1>Gimnasio</h1>Instalaciones modernas para mantenerse en forma.</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <img src="Imagenes/Presentacion10(1).jpg" alt="Imagen 6" class="card-img-top">
                <div class="overlay">
                    <div class="card-title"><h1>Sala de reuniones</h1>Disfruta un ambiente seguro y tranquilo.</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Galería de imágenes -->
<section id="gallery">
    <h2>Galería de Imágenes</h2>
    <div class="container-2">
        <div class="sliders-row">
            <div class="slider-2">
                <div class="overlay-gallery"></div>
                <div class="text-overlay">
                    Exterior<br>
                    del hotel<br>
                </div>
                <ul>
                    <li class="slider___item"><img src="Imagenes/Exterior1.png" alt=""></li>
                    <li class="slider___item"><img src="Imagenes/Exterior2.png" alt=""></li>
                    <li class="slider___item"><img src="Imagenes/Exterior3.png" alt=""></li>
                    <li class="slider___item"><img src="Imagenes/Exterior4.png" alt=""></li>
                    <li class="slider___item"><img src="Imagenes/Exterior5.png" alt=""></li>
                </ul>
            </div>
            <div class="slider-2">
                <div class="overlay-gallery"></div>
                <div class="text-overlay">
                    Interior<br>
                    del hotel</div>
                <ul>
                    <li class="slider___item"><img src="Imagenes/Interior1.png" alt=""></li>
                    <li class="slider___item"><img src="Imagenes/Interior2.png" alt=""></li>
                    <li class="slider___item"><img src="Imagenes/Interior3.png" alt=""></li>
                    <li class="slider___item"><img src="Imagenes/Interior4.png" alt=""></li>
                    <li class="slider___item"><img src="Imagenes/Interior5.png" alt=""></li>
                </ul>
            </div>
            <div class="slider-2">
                <div class="overlay-gallery"></div>
                <div class="text-overlay">
                    Piscina<br>
                    del hotel</div>
                <ul>
                    <li class="slider___item"><img src="Imagenes/Piscina1.png" alt=""></li>
                    <li class="slider___item"><img src="Imagenes/Piscina2.png" alt=""></li>
                    <li class="slider___item"><img src="Imagenes/Piscina3.png" alt=""></li>
                    <li class="slider___item"><img src="Imagenes/Piscina4.png" alt=""></li>
                    <li class="slider___item"><img src="Imagenes/Piscina5.png" alt=""></li>
                </ul>
            </div>
        </div>
    </div>                
</section>

<!-- Calendario de disponibilidad y reserva -->
<section id="calendar">
    <h1>Reserva de fechas de hotel</h1>
    <main>
        <form id="reservation-form" action="" method="POST">
            <section>
                <h2>Fecha de entrada y salida</h2>
                <label for="checkin">Fecha de entrada:</label>
                <input type="date" id="checkin" name="checkin" required>
                <br>
                <label for="checkout">Fecha de salida:</label>
                <input type="date" id="checkout" name="checkout" required>
            </section>
            <section>
                <h2>Habitación y ocupantes</h2>
                <label for="room">Habitación</label>
                <select id="room" name="room" required>
                    <option value="individual">Individual</option>
                    <option value="doble">Doble</option>
                    <option value="suite">Suite</option>
                    <option value="junior-suite">Junior Suite</option>
                    <option value="presidential-suite">Presidential Suite</option>
                </select>
                <br>
                <label for="adults">Adultos:</label>
                <input type="number" id="adults" name="adults" min="1" max="4" required>
                <br>
                <label for="children">Niños:</label>
                <input type="number" id="children" name="children" min="0" max="3" required>
            </section>
            <div class="button-container">
                <!-- Botón para verificar disponibilidad -->
                <button type="submit" name="check_availability">Check Availability</button>
                <!-- Botón para reservar -->
                <button type="submit" name="reserve">Reservar</button>
            </div>
        </form>                   
        <div id="availability"><?php if ($_SERVER["REQUEST_METHOD"] == "POST") { echo $message; } ?></div>
    </main>
</section>

<footer>
    <p>&copy; 2024 The Grand Hotel. Reservados todos los derechos.</p>
    <br>    
    <ul id="down">
        <li id="down-1">
            <a href="https://www.facebook.com/profile.php?id=61566548827807" target="_blank" class="social-icon">
                <i class="fa-brands fa-facebook-f"></i>
                <span style="color: white;"> Facebook</span>
            </a>
        </li>
        <li id="down-2">
            <a href="https://x.com/HotelGrand2ds" target="_blank" class="social-icon">
                <i class="fa-brands fa-x-twitter"></i>
                <span style="color: white;"> Twitter</span>
            </a>
        </li>
        <li>
            <a href="https://www.tiktok.com/@thegrandhotel?is_from_webapp=1&sender_device=pc" target="_blank" class="social-icon">
                <i class="fa-brands fa-tiktok"></i>
                <span style="color: white;"> Tiktok</span>
            </a>
        </li>
        <li>
            <a href="https://www.instagram.com/_thegrandhotel/" target="_blank" class="social-icon">
                <i class="fa-brands fa-instagram"></i>
                <span style="color: white;"> Instagram</span>
            </a>
        </li>
    </ul>
</footer>


</body>
</html>