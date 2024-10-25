<?php
// Connect to the SQLite database
$conn = new SQLite3('hotel.db');

// Check connection
if (!$conn) {
    die("Connection failed: " . $conn->lastErrorMsg());
}

// Initialize the $message variable
$message = "";

// Function to check availability
function check_availability($conn, $room_type, $checkin_date, $checkout_date) {
    $sql = "SELECT * FROM reservations WHERE room_type = :room_type AND (checkin_date <= :checkout_date AND checkout_date >= :checkin_date)";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':room_type', $room_type, SQLITE3_TEXT);
    $stmt->bindValue(':checkout_date', $checkout_date, SQLITE3_TEXT);
    $stmt->bindValue(':checkin_date', $checkin_date, SQLITE3_TEXT);
    $result = $stmt->execute();
    return $result->fetchArray(SQLITE3_ASSOC) === false; // If no results, the room is available
}

// Function to make a reservation
function make_reservation($conn, $room_type, $checkin_date, $checkout_date, $adults, $children) {
    $sql = "INSERT INTO reservations (room_type, checkin_date, checkout_date, adults, children) VALUES (:room_type, :checkin_date, :checkout_date, :adults, :children)";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':room_type', $room_type, SQLITE3_TEXT);
    $stmt->bindValue(':checkin_date', $checkin_date, SQLITE3_TEXT);
    $stmt->bindValue(':checkout_date', $checkout_date, SQLITE3_TEXT);
    $stmt->bindValue(':adults', $adults, SQLITE3_INTEGER);
    $stmt->bindValue(':children', $children, SQLITE3_INTEGER);
    return $stmt->execute();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $room_type = $_POST['room'];
    $checkin_date = $_POST['checkin'];
    $checkout_date = $_POST['checkout'];
    $adults = $_POST['adults'];
    $children = $_POST['children'];

    if (isset($_POST['check_availability'])) {
        // Action: Check availability
        if (check_availability($conn, $room_type, $checkin_date, $checkout_date)) {
            $message = "The room is available.";
        } else {
            $message = "Sorry, the room is not available on those dates.";
        }
    }

    if (isset($_POST['reserve'])) {
        // Action: Make a reservation
        if (check_availability($conn, $room_type, $checkin_date, $checkout_date)) {
            if (make_reservation($conn, $room_type, $checkin_date, $checkout_date, $adults, $children)) {
                $message = "Reservation successful!";
            } else {
                $message = "There was an error making the reservation. Please try again.";
            }
        } else {
            $message = "Sorry, the room is not available on those dates.";
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
    <html lang="en">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="scrip-spanish.js">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>The Grand Hotel </title>
    </head>
    <body>

        <header id="main-header">
            <div class="background"></div>
            <div class="overlay-header"></div>
            <div class="content">
                <nav class="arriba">    
                    <ul>
                        <li><a href="Index.php"><i>Español</i></a></li> 
                    </ul>
                </nav>
                <br><br><br><br><br>
                <b>
                    <title>The Grand Hotel</title>
                    <h1>The Grand Hotel</h1>
                    <p>Proyect: <b><i>Feria de logros</i></b></p>
                    <p><b>2° BTVDS</b></p>
                    <p>Enjoy a unique experience</p>
                </b>
            </div>
        </header>
        
        <nav>
            <a href="#content-">About Us</a>
            <a href="#departments">Departments</a>
            <a href="#gallery">Gallery</a>
            <a href="#calendar">Availability</a>
        </nav>
        
        <header id="welcome-header">
            <section id="content-">
                <section class="content-">
                    <div class="background-2"></div>
                    <div class="overlay-2"></div>
                    <div class="content-2">
                        <b><h1>Welcome to "The Grand Hotel"</h1></b>
                        <p>We are pleased to welcome you to our retreat, where comfort and hospitality combine to offer you an unforgettable experience. Our team is here to ensure that your stay is pleasant and relaxing.</p>
                        <p>Enjoy our facilities, explore the charms of the area and do not hesitate to approach our staff for any questions or recommendations. Your satisfaction is our priority.</p>
                        <p>We hope your time with us is memorable. Welcome and have a wonderful stay!</p>
                    </div>
                </section>
            </section>
        </header>
        
            
            <!--imagen prueba-->
            <div class="video-container">
                <center>
                <video width="600" height="300" controls>
                    <source src="Imagenes/Video_mamalon_english.mp4" type="video/mp4">
                </video>
                </center>
            </div>
            
            <!-- Departamentos del hotel -->
            <section id="departments">
                <h2>Our Departments</h2>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <img src="Imagenes/Presentacion8.jpg" alt="Imagen 1" class="card-img-top">
                            <div class="overlay">
                                <div class="card-title"><h1>Reception</h1>Personalized attention 24 hours a day.</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <img src="Imagenes/Presentacion2.jpg" alt="Imagen 2" class="card-img-top">
                            <div class="overlay">
                                <div class="card-title"><h1>Restaurant</h1>Cocina gourmet con platillos internacionales.</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <img src="Imagenes/Presentacion3.jpg" alt="Imagen 3" class="card-img-top">
                            <div class="overlay">
                                <div class="card-title"><h1>Rooms</h1>Comfort and elegance in every room.   </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <img src="Imagenes/Presentacion5(1).jpg" alt="Imagen 4" class="card-img-top">
                            <div class="overlay">
                                <div class="card-title"><h1>Spa</h1>Relax in our luxury spa.</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <img src="Imagenes/Presentacion4.jpg" alt="Imagen 5" class="card-img-top">
                            <div class="overlay">
                                <div class="card-title"><h1>Gym</h1>Modern facilities to keep fit.</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <img src="Imagenes/Presentacion10(1).jpg" alt="Imagen 6" class="card-img-top">
                            <div class="overlay">
                                <div class="card-title"><h1>Meeting room</h1>Enjoy a safe and quiet environment.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            

            <!-- Galería de imágenes -->
            <section id="gallery">
                <h2>Image Gallery</h2>
                <div class="container-2">
                    <div class="sliders-row">
                        <div class="slider-2">
                            <div class="overlay-gallery"></div>
                            <div class="text-overlay">
                                Exterior<br>
                                of the hotel<br>
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
                            <div class="text-overlay">Hotel<br>
                                interior</div>
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
                            <div class="text-overlay">Hotel Pool</div>
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
            

            <!-- Calendario de disponibilidad -->
            <section id="calendar">
                <h1>Booking hotel dates</h1>
                <main>
                    <form id="reservation-form" action="reservas.php" method="POST">
                        <section>
                            <h2>Entry and exit date</h2>
                            <label for="checkin">Entry date:</label>
                            <input type="date" id="checkin" name="checkin" required>
                            <br>
                            <label for="checkout">Departure date:</label>
                            <input type="date" id="checkout" name="checkout" required>
                        </section>
                        <section>
                            <h2>Room and occupants</h2>
                            <label for="room">Room</label>
                            <select id="room" name="room" required>
                                <option value="individual">Individual</option>
                                <option value="doble">Doble</option>
                                <option value="suite">Suite</option>
                                <option value="junior-suite">Junior Suite</option>
                                <option value="presidential-suite">Presidential Suite</option>
                            </select>
                            <br>
                            <label for="adults">Adults  :</label>
                            <input type="number" id="adults" name="adults" min="1" max="4" required>
                            <br>
                            <label for="children">Children:</label>
                            <input type="number" id="children" name="children" min="0" max="3" required>
                        </section>
                        <div class="button-container">
                            <button type="submit">Reserve</button>
                        </div>
                    </form>
                    <div id="availability"></div>
                </main>
            </section>
            
            
            
        <footer>
            <p>&copy; 2024 The Grand Hotel. All rights reserved.</p>
        </footer>
    </body>
    </html>