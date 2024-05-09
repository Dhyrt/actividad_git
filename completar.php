<?php
// Verificar si se ha enviado un formulario para marcar una tarea como completada
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["task_index"])) {
    // Obtener el índice de la tarea que se marcará como completada
    $task_index = $_POST["task_index"];

    // Nombre del archivo donde se guardan las tareas
    $fileName = "tasks.txt";

    // Cargar las tareas desde el archivo
    $tasks = file($fileName, FILE_IGNORE_NEW_LINES);

    // Verificar si el índice de la tarea es válido
    if ($task_index >= 0 && $task_index < count($tasks)) {
        // Marcar la tarea como completada cambiando su estado de '0' a '1'
        $taskDetails = explode('|', $tasks[$task_index]);
        $taskDetails[1] = '1'; // Cambiar el estado a completada
        $tasks[$task_index] = implode('|', $taskDetails);

        // Guardar las tareas actualizadas en el archivo
        file_put_contents($fileName, implode("\n", $tasks));
    }

    // Redirigir de vuelta a la página principal
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marcar Tarea como Completada</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <div class="container">
        <div class="card">
        <h1>Marcar Tarea como Completada</h1>
            <form action="completar.php" method="post">
                <label for="task_index">Seleccione la tarea a marcar como completada:</label>
                <select id="task_index" name="task_index">
                    <?php
                    // Nombre del archivo donde se guardan las tareas
                    $fileName = "tasks.txt";

                    // Cargar las tareas desde el archivo
                    $tasks = file($fileName, FILE_IGNORE_NEW_LINES);

                    // Mostrar las tareas como opciones en el select
                    foreach ($tasks as $index => $task) {
                        echo "<option value='$index'>$task</option>";
                    }
                    ?>
                </select>
                <div class="buttons">
                    <button type="submit" class="button" id="modificar">Marcar como Completada</button>
                    <form action="index.php" method="GET">
                        <button type="submit" class="button" id="volver">Volver</button>
                    </form>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
