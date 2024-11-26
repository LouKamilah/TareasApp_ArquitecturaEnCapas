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



    <nav class="bg-white w-full z-20 top-0 start-0 border-b border-gray-200">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="https://flowbite.com/" class="flex items-center space-x-3 rtl:space-x-reverse">
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



    <div class="container mx-auto w-[80%] mt-14">
        <div class="relative overflow-x-auto">
            <div class="flex justify-end mb-4">
                <a href="crear.php" class="font-medium text-white bg-black px-3 py-1">Crear Tarea</a>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
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

                $colors = ['bg-blue-50', 'bg-red-50', 'bg-green-50', 'bg-yellow-50'];
                $colorIndex = 0;

                $tareasController = new TareasController();
                $tareas = $tareasController->getTareasByUserId($_SESSION['user_id']);

                foreach ($tareas as $tarea) {
                    $bgColor = $colors[$colorIndex % count($colors)];
                    $colorIndex++;
                    echo "<div class='p-4 mb-4 text-sm text-gray-800 rounded-lg $bgColor'>";
                    echo "<span class='font-medium'></span> {$tarea['titulo']}<br>";
                    echo "<span class='font-medium'></span> {$tarea['descripcion']}<br>";
                    echo "<span class='font-medium'></span> " . formatEstado($tarea['estado']) . "<br>";
                    echo "<span class='font-medium'></span> {$tarea['date_asig']}<br>";
                    echo '<div class="mt-2 flex space-x-2">
                        <form method="GET" action="../capa_presentacion/Editar.php">
                            <input type="hidden" name="id_Tarea" value="' . $tarea['id_Tarea'] . '">
                            <button type="submit" class="font-medium text-green-900 bg-green-200 px-3 py-1 rounded-sm hover:underline">
                                Editar
                            </button>
                        </form>
                        <form method="POST" action="../capa_negocio/tareasController.php?action=eliminar_tarea">
                            <input type="hidden" name="id_Tarea" value="' . $tarea['id_Tarea'] . '">
                            <button type="submit" class="font-medium text-red-900 bg-red-200 px-3 py-1 rounded-sm hover:underline">
                                Eliminar
                            </button>
                        </form>
                    </div>';
                    echo "</div>";
                }
                ?>
            </div>
        </div>
    </div>

    <script src="../../node_modules/flowbite/dist/flowbite.min.js"></script>

</body>

</html>