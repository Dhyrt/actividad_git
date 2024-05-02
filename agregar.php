<?php
// Verificar si se ha enviado un formulario para agregar una nueva tarea
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["nueva_tarea"])) {
    // Obtener la nueva tarea del formulario
    $nueva_tarea = $_POST["nueva_tarea"];

    // Nombre del archivo donde se guardarán las tareas
    $fileName = "tasks.txt";

    // Agregar la nueva tarea al archivo con estado "pendiente" (0)
    $nueva_tarea_linea = "$nueva_tarea|0\n";
    file_put_contents($fileName, $nueva_tarea_linea, FILE_APPEND | LOCK_EX);

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
