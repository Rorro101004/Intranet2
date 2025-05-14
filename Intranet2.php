<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Intranet</title>
    <link rel="stylesheet" href="Intranet2.css">
</head>



<body>
    <header>
        <h1>Bienvenido a la intranet de RodBi Technology</h1>

    </header>
    <section>
        <div id="left">
            <p><a href="intranet/intranet.php">Ir a la Intranet</a></p>
            <?php
            if (!isset($_SESSION['rol'])) {
                echo "<h1>Seleccione un rol antes de iniciar sesión.</h1>";
            }
            ?>
            <div id="forms">
                <form method="post" class="type">
                    <input type="submit" name="rol" value="Profesor">
                    <input type="submit" name="rol" value="Alumno">
                </form>

                <form method="post" class="user">
                    <label for="usuario">
                        <p>Usuario</p>
                    </label>
                    <input type="text" name="usuario" required><br>
                    <label for="contraseña">
                        <p>Contraseña</p>
                    </label>
                    <input type="password" name="contraseña" required><br>
                    <input type="submit" name="login" value="Login">
                </form>
            </div>
            <?php
            session_start();
            // Verifica si el formulario ha sido enviado

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (isset($_POST['rol'])) {
                    $_SESSION['rol'] = $_POST['rol'];
                    echo "<h2>Bienvenido, " . $_POST['rol'] . "</h2>";
                } elseif (isset($_POST['login'])) {
                    if (isset($_SESSION['rol'])) {
                        $rol = $_SESSION['rol'];
                    } else {
                        $rol = null;
                    }
                    if ($rol == "Alumno") {
                        echo "<a class='pagina' href='https://es.wikipedia.org/wiki/Sistema_inform%C3%A1tico' target='_blank'>Ir a la página de Alumno</a>";
                        exit();
                    } elseif ($rol == "Profesor") {
                        echo "<a class='pagina' href='https://web2.alexiaedu.com/ACWeb/LogOn.aspx?key=%2fNYuvQedqk4%3d' target='_blank'>Ir a la página de Profesor</a>";
                        exit();
                    }
                }
            }

            ?>
        </div>
        <div id="right">
            
            <span><h1>Empresas que colaboran con RodBi Technology</h1></span>
            <div class="empresas">
                <img src="NexTech logo.png" alt="Nextech">
                <img src="microsoft-icon-logo-symbol-free-png.webp" alt="Microsoft">
                <img src="Couleur-logo-IBM.jpg" alt="IBM">
                <img src="R.jpg" alt="Apple">
            </div>
        </div>

    </section>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> RodBi Technology. Todos los derechos reservados.</p>
    </footer>
</body>


</html>