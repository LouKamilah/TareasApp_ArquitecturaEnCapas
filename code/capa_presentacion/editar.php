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

<body class="bg-gray-100">

    <nav class="bg-white w-full z-20 top-0 start-0 border-b border-gray-200">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
                <svg class="w-8 h-8 text-black" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                    height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                        d="M7.111 20A3.111 3.111 0 0 1 4 16.889v-12C4 4.398 4.398 4 4.889 4h4.444a.89.89 0 0 1 .89.889v12A3.111 3.111 0 0 1 7.11 20Zm0 0h12a.889.889 0 0 0 .889-.889v-4.444a.889.889 0 0 0-.889-.89h-4.389a.889.889 0 0 0-.62.253l-3.767 3.665a.933.933 0 0 0-.146.185c-.868 1.433-1.581 1.858-3.078 2.12Zm0-3.556h.009m7.933-10.927 3.143 3.143a.889.889 0 0 1 0 1.257l-7.974 7.974v-8.8l3.574-3.574a.889.889 0 0 1 1.257 0Z" />
                </svg>
                <span class="self-center text-2xl font-semibold whitespace-nowrap">AgendaPro</span>
            </a>
            <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">

                <form action="../capa_negocio/loginController.php?action=logout" method="post">
                    <button type="submit" class="font-medium text-white bg-black px-3 py-1 rounded-sm">Cerrar
                        sesión</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-semibold mb-4 text-center">Editar Tarea</h1>
        <form method="POST" action="../capa_negocio/tareasController.php?action=editar_tarea"
            class="bg-white p-6 rounded shadow-md">
            <input type="hidden" name="id_Tarea" value="<?php echo $tarea['id_Tarea']; ?>">
            <div class="mb-4">
                <label for="titulo" class="block text-gray-700">Título:</label>
                <input type="text" id="titulo" name="titulo" value="<?php echo $tarea['titulo']; ?>" required
                    class="w-full p-2 border border-gray-300 rounded mt-1">
            </div>
            <div class="mb-4">
                <label for="descripcion" class="block text-gray-700">Descripción:</label>
                <textarea id="descripcion" name="descripcion" required
                    class="w-full p-2 border border-gray-300 rounded mt-1"><?php echo $tarea['descripcion']; ?></textarea>
            </div>
            <div class="mb-4">
                <label for="estado" class="block text-gray-700">Estado:</label>
                <select id="estado" name="estado" required class="w-full p-2 border border-gray-300 rounded mt-1">
                    <option value="pendiente">Pendiente</option>
                    <option value="en_proceso">En Proceso</option>
                    <option value="completo">Completo</option>
                </select>
            </div>
            <button type="submit" class="bg-black text-white px-4 py-2 rounded">Guardar Cambios</button>
        </form>
    </div>
</body>

</html>