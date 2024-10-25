<!DOCTYPE html>
<html>
<head>
    <title>Agregar Habitación</title>
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
    $tipo = $_POST['tipo'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $disponibilidad = isset($_POST['disponibilidad']) ? 1 : 0; // Si el checkbox está marcado, es 1 (true), si no, es 0 (false)

    // Insertar los datos en la base de datos
    $sql = "INSERT INTO Habitaciones (tipo, descripcion, precio, disponibilidad) VALUES ('$tipo', '$descripcion', '$precio', '$disponibilidad')";

    if ($conn->query($sql) === TRUE) {
        echo "<p style='color: green;'>Habitación agregada correctamente.</p>";
    } else {
        echo "<p style='color: red;'>Error al agregar la habitación: " . $conn->error . "</p>";
    }

    // Cerrar la conexión
    $conn->close();
}
?>

<form action="" method="post">
    <label>Tipo de habitación:</label>
    <select name="tipo" required>
        <option value="individual">Individual</option>
        <option value="doble">Doble</option>
        <option value="suite">Suite</option>
    </select><br><br>

    <label>Descripción:</label>
    <textarea name="descripcion" required></textarea><br><br>

    <label>Precio:</label>
    <input type="number" step="0.01" name="precio" required><br><br>

    <label>Disponibilidad:</label>
    <input type="checkbox" name="disponibilidad"> Disponible<br><br>

    <input type="submit" name="submit" value="Agregar Habitación">
</form>

</body>
</html>