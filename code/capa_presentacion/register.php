<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../src/output.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Validación de contraseñas -->
    <script>
    function validateForm() {
        var password = document.getElementById("password").value;
        var confirmPassword = document.getElementById("confirm_password").value;
        if (password != confirmPassword) {
            Swal.fire({
                title: "Error",
                text: "Las contraseñas no coinciden",
                icon: "error"
            });;
            return false;
        }
        return true;
    }
    </script>

</head>

<body>

    <?php
    session_start();
    if (isset($_SESSION['register_success'])) {
        echo "<script>
            Swal.fire({
                title: 'Éxito',
                text: 'La cuenta ha sido creada correctamente',
                icon: 'success'
            }).then(function() {
                window.location = 'index.php';
            });
        </script>";
        unset($_SESSION['register_success']);
    }
    ?>

    <section class="bg-gray-50">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900">
                <svg class="w-8 h-8 text-black" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                    height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                        d="M7.111 20A3.111 3.111 0 0 1 4 16.889v-12C4 4.398 4.398 4 4.889 4h4.444a.89.89 0 0 1 .89.889v12A3.111 3.111 0 0 1 7.11 20Zm0 0h12a.889.889 0 0 0 .889-.889v-4.444a.889.889 0 0 0-.889-.89h-4.389a.889.889 0 0 0-.62.253l-3.767 3.665a.933.933 0 0 0-.146.185c-.868 1.433-1.581 1.858-3.078 2.12Zm0-3.556h.009m7.933-10.927 3.143 3.143a.889.889 0 0 1 0 1.257l-7.974 7.974v-8.8l3.574-3.574a.889.889 0 0 1 1.257 0Z" />
                </svg>

                AgendaPro
            </a>
            <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                        Registro
                    </h1>
                    <form class="space-y-4 md:space-y-6" action="../capa_negocio/loginController.php?action=register"
                        method="POST" onsubmit="return validateForm()">
                        <div>
                            <label for="username" class="block mb-2 text-sm font-medium text-gray-900">Nombre de
                                usuario</label>
                            <input type="text" name="username" id="username"
                                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-black focus:border-black block w-full p-2.5 "
                                placeholder="Nombre de usuario" required="">
                        </div>
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                            <input type="email" name="email" id="email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-black focus:border-black block w-full p-2.5 "
                                placeholder="name@gmail.com" required="">
                        </div>
                        <div>
                            <label for="password"
                                class="block mb-2 text-sm font-medium text-gray-900">Contraseña</label>
                            <input type="password" name="password" id="password" placeholder="••••••••"
                                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-black focus:border-black block w-full p-2.5 "
                                required="">
                        </div>
                        <div>
                            <label for="confirm_password" class="block mb-2 text-sm font-medium text-gray-900">Repetir
                                contraseña</label>
                            <input type="password" name="confirm_password" id="confirm_password" placeholder="••••••••"
                                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-black focus:border-black block w-full p-2.5 "
                                required="">
                        </div>
                        <button type="submit"
                            class="w-full text-white bg-black focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center">Registrarse</button>
                        <p class="text-sm font-light text-gray-500">
                            ¿Ya tienes una cuenta? <a href="index.php"
                                class="font-medium text-primary-600 hover:underline">Inicia sesión</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script src="../../node_modules/flowbite/dist/flowbite.min.js"></script>

</body>

</html>