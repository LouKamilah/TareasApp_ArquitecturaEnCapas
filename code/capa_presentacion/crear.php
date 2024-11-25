<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../src/output.css" rel="stylesheet">
    <title>TO DO APP</title>
</head>

<body>
    <div class="flex justify-end p-4">
        <form action="../capa_negocio/loginController.php?action=logout" method="post">
            <button type="submit" class="font-medium text-white bg-black px-3 py-1 rounded-sm">Cerrar
                sesión</button>
        </form>
    </div>
    <div class="flex justify-end p-4">
        <form action="../capa_negocio/tareasController.php?action=crear_tarea" method="post">
            <input type="text" name="titulo" placeholder="Título" required>
            <input type="text" name="descripcion" placeholder="Descripción" required>
            <input type="date" name="date_asig" required>
            <select id="estado" name="estado" required>
                <option value="pendiente">Pendiente</option>
                <option value="en_proceso">En Proceso</option>
                <option value="completo">Completo</option>
            </select>
            <button type="submit" class="font-medium text-white bg-blue-500 px-3 py-1 rounded-sm">Crear Tarea</button>
        </form>
    </div>

    <script src="../../node_modules/flowbite/dist/flowbite.min.js"></script>

</body>

</html>