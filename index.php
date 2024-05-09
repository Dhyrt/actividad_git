<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Tareas</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <div class="container">
        <div class="card">
            <h1>Lista de Tareas</h1>
            
            <?php
            // Nombre del archivo donde se guardarán las tareas
            $fileName = "tasks.txt";

            // Función para cargar las tareas desde el archivo de texto
            function loadTasks() {
                global $fileName;
                if (!file_exists($fileName)) {
                    file_put_contents($fileName, ""); // Si el archivo no existe, lo crea
                }
                return file($fileName, FILE_IGNORE_NEW_LINES);
            }

            // Función para guardar las tareas en el archivo de texto
            function saveTasks($tasks) {
                global $fileName;
                file_put_contents($fileName, implode("\n", $tasks));
            }

            // Cargar las tareas desde el archivo
            $tasks = loadTasks();

            if (empty($tasks)) {
                echo "<p class='no-tasks'>No hay tareas pendientes.</p>";
            } else {
                echo "<ul class='task-list'>";
                foreach ($tasks as $task) {
                    $taskDetails = explode('|', $task);
                    if (count($taskDetails) < 2) {
                        echo "<p class='error'>Error en el formato de la tarea: $task</p>";
                        continue;
                    }
                    list($taskName, $completed) = $taskDetails;
                    echo "<li class='" . ($completed == '1' ? 'completed-task' : 'pending-task') . "'>";
                    echo "<input type='checkbox' " . ($completed == '1' ? 'checked' : '') . " disabled> ";
                    echo "<label>$taskName</label>";
                    echo "</li>";
                }
                echo "</ul>";
            }

            ?>
            <div class="buttons">
                <form action="agregar.php" method="GET">
                    <button type="submit" class="button" id="agregar">Agregar tarea</button>
                </form>
                <form action="completar.php" method="GET">
                    <button type="submit" class="button" id="modificar">Marcar completada</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
