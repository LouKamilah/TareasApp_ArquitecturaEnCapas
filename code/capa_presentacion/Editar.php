<?php
require_once '../capa_negocio/tareasController.php';

// Verifica si se recibió el ID de la tarea
if (!isset($_GET['id_Tarea'])) {
    header("Location: home.php");
    exit();
}

$id_Tarea = $_GET['id_Tarea'];

$tareasController = new TareasController();
$tarea = $tareasController->getTareaById($id_Tarea); // Suponiendo que esta función existe en el controlador

if (!$tarea) {
    echo "Error: Tarea no encontrada.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tarea</title>
    <link href="../src/output.css" rel="stylesheet">
</head>
<body>
    <h1>Editar Tarea</h1>
    <form method="POST" action="tareasController.php?action=editar_tarea">
        <input type="hidden" name="id_Tarea" value="<?php echo $tarea['id_Tarea']; ?>">
        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" value="<?php echo $tarea['titulo']; ?>" required>
        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" required><?php echo $tarea['descripcion']; ?></textarea>
        <label for="estado">Estado:</label>
        <select id="estado" name="estado" required>
            <option value="pendiente" <?php echo $tarea['estado'] === 'pendiente' ? 'selected' : ''; ?>>Pendiente</option>
            <option value="completada" <?php echo $tarea['estado'] === 'completada' ? 'selected' : ''; ?>>Completada</option>
        </select>
        <button type="submit">Guardar Cambios</button>
    </form>
</body>
</html>