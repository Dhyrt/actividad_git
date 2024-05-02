<?php
// Verificar si se ha enviado un formulario para agregar una nueva tarea
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["nueva_tarea"])) {
    // Obtener la nueva tarea del formulario
    $nueva_tarea = $_POST["nueva_tarea"];

    // Nombre del archivo donde se guardarán las tareas
    $fileName = "tasks.txt";

    // Abrir el archivo de tareas en modo de escritura (agregar al final)
    $archivo = fopen($fileName, "a");

    // Verificar si se pudo abrir el archivo correctamente
    if (!$archivo) {
        die("No se pudo abrir el archivo para escritura.");
    }

    // Escribir la nueva tarea en el archivo
    $resultado = fwrite($archivo, $nueva_tarea . "\n");

    // Verificar si se pudo escribir en el archivo correctamente
    if (!$resultado) {
        die("No se pudo escribir en el archivo.");
    }

    // Cerrar el archivo
    fclose($archivo);

    // Redirigir de nuevo a la página principal
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Nueva Tarea</title>
    <style>
        /* Estilos */
    </style>
</head>
<body>
    <h1>Agregar Nueva Tarea</h1>
    <div class="container">
        <form action="agregar.php" method="post">
            <label for="nueva_tarea">Nueva Tarea:</label>
            <input type="text" id="nueva_tarea" name="nueva_tarea" required>
            <button type="submit">Agregar</button>
        </form>
    </div>
    <a href="index.php">Volver a la lista de tareas</a>
</body>
</html>
