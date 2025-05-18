<?php
session_start();

if (isset($_GET['login'])) {
    if (!isset($_SERVER['PHP_AUTH_USER'])) {
        header('WWW-Authenticate: Basic realm="Intranet RodBi"');
        header('HTTP/1.0 401 Unauthorized');
        exit("Necesitas autenticarte para entrar.");
    }

    $user = $_SERVER['PHP_AUTH_USER'];
    $htgroup = file_get_contents(__DIR__ . '/intranet/.htgroup');

    error_log("DEBUG: user={$user}");
    error_log("DEBUG: htgroup:\n" . $htgroup);

    // Profesores
    if (preg_match('/^profesores:\s*.*\b' . preg_quote($user) . '\b/mi', $htgroup)) {
        $_SESSION['rol'] = 'Profesor';
        header('Location: intranet/intranet.php');
        exit;
    }
    // Alumnos
    if (preg_match('/^alumnos:\s*.*\b' . preg_quote($user) . '\b/mi', $htgroup)) {
        $_SESSION['rol'] = 'Alumno';
        header('Location: intranet/readonly.php');
        exit;
    }


    header('Location: errorAccess.php');
    exit;
}
?>


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
        <span>
            <h1>Bienvenido a la intranet de RodBi Technology</h1>
        </span>
    </header>
    <section>
        <div id="left">
            <form method="get" action="">
                <button type="submit" name="login" value="1">Acceder a la Intranet</button>
            </form>
        </div>
        <div id="right">
            <div class="empre">
                <span>
                    <h1>Empresas que colaboran con RodBi Technology</h1>
                </span>
            </div>
            <div class="empresas">
                <img src="imagenes/NexTech logo.png" alt="Nextech">
                <img src="imagenes/microsoft-logo-microsoft-icon-transparent-free-png.webp" alt="Microsoft">
                <img src="imagenes/ibm-logo-cru-repair-louis-9.png" alt="IBM">
                <img src="imagenes/9fa92ac5a9498502d2707ced798d763fe7490ecc-1600x1026.png" alt="Apple">
            </div>
        </div>
    </section>
    <footer>
        <?php if (isset($error)) { ?>
            <p style="color:red;"><?php echo $error; ?></p>
        <?php } ?>
        <p>&copy; <?php echo date("Y"); ?> RodBi Technology. Todos los derechos reservados.</p>
    </footer>
</body>

</html>