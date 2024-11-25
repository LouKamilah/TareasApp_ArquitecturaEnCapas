<?php
require_once 'conexion.php';
require_once 'Tarea.php';

// Crear la conexión a la base de datos
$db = new PDO('mysql:host=localhost;dbname=bd_tareasapp_arquitecturaencapas', 'root', '');
$tarea = new Tarea($db);

// Probar método create
echo "Probando 'create':\n";
if ($tarea->create('Tarea de prueba', 'Descripción', '2024-11-25', 'Pendiente', 1)) {
    echo "Tarea creada correctamente.\n";
} else {
    echo "Error al crear tarea.\n";
}

// Probar método show
echo "\nProbando 'show':\n";
$tareas = $tarea->show();
if (!empty($tareas)) {
    print_r($tareas);
} else {
    echo "No se encontraron tareas.\n";
}

// Probar método update
echo "\nProbando 'update':\n";
if ($tarea->update('Nueva tarea', 'Nueva descripción', '2024-11-26', 'Completada', '2024-11-25 15:00:00', 1)) {
    echo "Tarea actualizada correctamente.\n";
} else {
    echo "Error al actualizar tarea.\n";
}

// Probar método delete
echo "\nProbando 'delete':\n";
if ($tarea->delete(1)) {
    echo "Tarea eliminada correctamente.\n";
} else {
    echo "Error al eliminar tarea.\n";
}
?>