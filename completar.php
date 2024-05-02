<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marcar tarea como completada</title>
</head>
<body>
    <h1>Marcar tarea como completada</h1>
    
    <?php
    // Nombre del archivo donde se guardan las tareas
    $fileName = "tasks.txt";

    // Función para cargar las tareas desde el archivo de texto
    function loadTasks() {
        global $fileName;
        if (!file_exists($fileName)) {
            return array(); // Si el archivo no existe, retornamos un array vacío
        }
        return file($fileName, FILE_IGNORE_NEW_LINES);
    }

    // Función para guardar las tareas en el archivo de texto
    function saveTasks($tasks) {
        global $fileName;
        file_put_contents($fileName, implode("\n", $tasks));
    }

    // Verificar si se envió un formulario para marcar una tarea como completada
    if (isset($_POST['task_index']) && isset($_POST['completed'])) {
        $taskIndex = $_POST['task_index'];
        $tasks = loadTasks();
        
        // Marcar la tarea como completada si el índice es válido
        if (isset($tasks[$taskIndex])) {
            $tasks[$taskIndex] = rtrim($tasks[$taskIndex]) . " [Completada]";
            saveTasks($tasks);
        }
    }

    // Redireccionar a la página principal después de marcar la tarea como completada
    header("Location: index.php");
    exit;
    ?>

</body>
</html>
