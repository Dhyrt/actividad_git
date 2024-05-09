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
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <div class="container">
    <div class="card">
            <h1>Agregar Nueva Tarea</h1>
            <form action="agregar.php" method="post">
                <label for="nueva_tarea">Nueva Tarea:</label>
                <input type="text" id="nueva_tarea" name="nueva_tarea" class="input-field">
                <div class="buttons">
                    <button type="submit" class="button" id="agregar">Agregar</button>
                    <form action="index.php" method="GET">
                    <button type="submit" class="button" id="volver">Volver</button>
                    </form>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
