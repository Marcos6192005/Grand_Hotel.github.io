<!DOCTYPE html>
<html>
<head>
    <title>Agregar Imagen a la Galería</title>
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
    
    // Directorio donde se guardarán las imágenes
    $target_dir = "uploads/";

    // Verificar si la carpeta uploads existe, si no, crearla
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $target_file = $target_dir . basename($_FILES["imagen"]["name"]);

    // Subir la imagen al servidor
    if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {
        // Insertar los datos en la base de datos
        $sql = "INSERT INTO Galeria (tipo, imagen) VALUES ('$tipo', '$target_file')";

        if ($conn->query($sql) === TRUE) {
            echo "<p style='color: green;'>Imagen agregada correctamente a la galería.</p>";
        } else {
            echo "<p style='color: red;'>Error al agregar la imagen a la galería: " . $conn->error . "</p>";
        }
    } else {
        echo "<p style='color: red;'>Error al subir la imagen.</p>";
    }

    // Cerrar la conexión
    $conn->close();
}
?>

<form action="" method="post" enctype="multipart/form-data">
    <label>Tipo de imagen:</label>
    <select name="tipo" required>
        <option value="exterior">Exterior</option>
        <option value="interior">Interior</option>
        <option value="piscina">Piscina</option>
        <option value="otro">Otro</option>
    </select><br><br>

    <label>Selecciona una imagen:</label>
    <input type="file" name="imagen" required><br><br>

    <input type="submit" name="submit" value="Agregar Imagen">
</form>

</body>
</html>
