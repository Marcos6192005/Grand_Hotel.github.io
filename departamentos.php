<!DOCTYPE html>
<html>
<head>
    <title>Agregar Departamento</title>
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
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    
    // Directorio donde se guardarán las imágenes
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["imagen"]["name"]);

    // Subir la imagen al servidor
    if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {
        // Insertar los datos en la base de datos
        $sql = "INSERT INTO departamentos (nombre, descripcion, imagen) VALUES ('$nombre', '$descripcion', '$target_file')";

        if ($conn->query($sql) === TRUE) {
            echo "<p style='color: green;'>Departamento agregado correctamente.</p>";
        } else {
            echo "<p style='color: red;'>Error al agregar el departamento: " . $conn->error . "</p>";
        }
    } else {
        echo "<p style='color: red;'>Error al subir la imagen.</p>";
    }

    // Cerrar la conexión
    $conn->close();
}
?>

<form action="" method="post" enctype="multipart/form-data">
    <label>Nombre:</label>
    <input type="text" name="nombre" required><br><br>

    <label>Descripción:</label>
    <textarea name="descripcion" required></textarea><br><br>

    <label>Selecciona una imagen:</label>
    <input type="file" name="imagen" required><br><br>

    <input type="submit" name="submit" value="Agregar Departamento">
</form>

</body>
</html>
