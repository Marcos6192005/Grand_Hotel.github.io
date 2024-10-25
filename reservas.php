<!DOCTYPE html>
<html>
<head>
    <title>Agregar Reserva</title>
</head>
<body>

<?php
if (isset($_POST['submit'])) {
    // Conectar a la base de datos
    $conn = new mysqli('localhost', 'root', '', 'hotel');

    // Comprobar la conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Obtener los datos del formulario
    $fecha_entrada = $_POST['fecha_entrada'];
    $fecha_salida = $_POST['fecha_salida'];
    $tipo_habitacion = $_POST['tipo_habitacion'];
    $adultos = $_POST['adultos'];
    $ninos = $_POST['ninos'];

    // Insertar los datos en la base de datos
    $sql = "INSERT INTO Reservas (fecha_entrada, fecha_salida, tipo_habitacion, adultos, ninos) VALUES ('$fecha_entrada', '$fecha_salida', '$tipo_habitacion', '$adultos', '$ninos')";

    if ($conn->query($sql) === TRUE) {
        echo "<p style='color: green;'>Reserva agregada correctamente.</p>";
    } else {
        echo "<p style='color: red;'>Error al agregar la reserva: " . $conn->error . "</p>";
    }

    // Cerrar la conexión
    $conn->close();
}
?>

<form action="" method="post">
    <label>Fecha de entrada:</label>
    <input type="date" name="fecha_entrada" required><br><br>

    <label>Fecha de salida:</label>
    <input type="date" name="fecha_salida" required><br><br>

    <label>Tipo de habitación:</label>
    <select name="tipo_habitacion" required>
        <option value="individual">Individual</option>
        <option value="doble">Doble</option>
        <option value="suite">Suite</option>
    </select><br><br>

    <label>Adultos:</label>
    <input type="number" name="adultos" min="1" required><br><br>

    <label>Niños:</label>
    <input type="number" name="ninos" min="0" required><br><br>

    <input type="submit" name="submit" value="Agregar Reserva">
</form>

</body>
</html>
