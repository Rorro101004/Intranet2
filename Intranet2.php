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
        <p><a href="intranet/intranet.php">Ir a la Intranet</a></p>
    </header>
    <section>
        <div id="forms">
            <form method="post" class="type">
                <input type="submit" name="rol" value="Profesor">
                <input type="submit" name="rol" value="Alumno">
            </form>

            <form method="post" class="user">
                <label for="usuario">Usuario</label>
                <input type="text" name="usuario" required><br>
                <label for="contraseña">Contraseña</label>
                <input type="password" name="contraseña" required><br>
                <input type="submit" name="login" value="Login">
            </form>
        </div>

        <?php
        session_start(); 

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['rol'])) {
                $_SESSION['rol'] = $_POST['rol']; 
                echo "<h2>Bienvenido, " . $_POST['rol']. "</h2>";
            } elseif (isset($_POST['login'])) {
                if (isset($_SESSION['rol'])) {
                    $rol = $_SESSION['rol']; 
                } else {
                    $rol = null; 
                }
                if ($rol == "Alumno") {
                    echo "<a href='https://es.wikipedia.org/wiki/Sistema_inform%C3%A1tico' target='_blank'>Ir a la página de Alumno</a>";
                    exit();
                } elseif ($rol == "Profesor") {
                    echo "<a href='https://web2.alexiaedu.com/ACWeb/LogOn.aspx?key=%2fNYuvQedqk4%3d' target='_blank'>Ir a la página de Profesor</a>";                    
                    exit();
                } 
            }
        }
        if (!isset($_SESSION['rol'])) {
        echo "<h2>Seleccione un rol antes de iniciar sesión.</h2>";
}
        ?>
    </section>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> RodBi Technology. Todos los derechos reservados.</p>
    </footer>
</body>


</html>