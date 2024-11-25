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
        <a href="crear.php" class="font-medium text-white bg-blue-500 px-3 py-1 rounded-sm">Crear Tarea</a>
    </div>
    <div class="relative overflow-x-auto sm:rounded-lg mt-8">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                <tr>
                    <th scope="col" class="p-4">
                    </th>
                    <th scope="col" class="px-6 py-3">
                        N° carga
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Cliente
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Sacos
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Estado
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Fase
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Fecha elaboración
                    </th>
                    <th scope="col" class="px-6 py-3">
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once '../capa_negocio/tareasController.php';

                function formatEstado($estado) {
                    switch ($estado) {
                        case 'pendiente':
                            return 'Pendiente';
                        case 'en_proceso':
                            return 'En Proceso';
                        case 'completo':
                            return 'Completo';
                        default:
                            return $estado;
                    }
                }

                $tareasController = new TareasController();
                $tareas = $tareasController->getTareasByUserId($_SESSION['user_id']); // Asegúrate de que 'user_id' esté en la sesión

                foreach ($tareas as $tarea) {
                    echo "<tr class='border-b odd:bg-white even:bg-gray-50 '>";
                    echo "<td class='w-4 p-4'></td>";
                    echo "<th scope='row' class='px-6 py-4 font-medium text-gray-900 whitespace-nowrap '>{$tarea['id_Tarea']}</th>";
                    echo "<td class='px-6 py-4'>{$tarea['titulo']}</td>";
                    echo "<td class='px-6 py-4'>{$tarea['descripcion']}</td>";
                    echo "<td class='px-6 py-4'>" . formatEstado($tarea['estado']) . "</td>";
                    echo "<td class='px-6 py-4'>{$tarea['date_asig']}</td>";
                    echo "<td class='px-6 py-4'>{$tarea['update_at']}</td>";
                    echo '<td class="px-2 lg:px-1">
                    <form method="GET" action="../capa_presentacion/Editar.php">
                    <input type="hidden" name="id_Tarea" value="' . $tarea['id_Tarea'] . '">
                    <button type="submit" class="font-medium text-green-900 bg-green-200 px-3 py-1 rounded-sm hover:underline">
                    Editar
                    </button>
                    </form>
                    </td>';
                    echo "<td class='px-2 lg:px-1'>
                        <form method='POST' action='../capa_negocio/tareasController.php?action=eliminar_tarea'>
                            <input type='hidden' name='id_Tarea' value='{$tarea['id_Tarea']}'>
                            <button type='submit' class='font-medium text-red-900 bg-red-200 px-3 py-1 rounded-sm hover:underline'>
                                Eliminar
                            </button>
                        </form>
                    </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>


    </div>

    <script src="../../node_modules/flowbite/dist/flowbite.min.js"></script>

</body>

</html>