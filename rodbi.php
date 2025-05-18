<?php
session_start();
// // borrar var dump al terminar todo 
// var_dump(
//     'PHP_AUTH_USER',
//     $_SERVER['PHP_AUTH_USER'] ?? null,
//     'rol en $_SESSION',
//     $_SESSION['rol'] ?? null
// );

// 1) Logout: destruye sesión y redirige al inicio
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();

    header('HTTP/1.0 401 Unauthorized');
    header('WWW-Authenticate: Basic realm="Intranet RodBi"');

    echo '<!DOCTYPE html><html><head>'
        . '<meta http-equiv="refresh" content="0;url=rodbi.php" />'
        . '</head><body></body></html>';
    exit;
}

// Login: al pulsar el botón “Acceder”
if (isset($_GET['login'])) {
    if (!isset($_SERVER['PHP_AUTH_USER'])) {
        header('WWW-Authenticate: Basic realm="Intranet RodBi"');
        header('HTTP/1.0 401 Unauthorized');
        exit;
    }

    $user = $_SERVER['PHP_AUTH_USER'];
    $htgroup = @file_get_contents(__DIR__ . '/intranet/.htgroup');
    if ($htgroup === false) {
        exit("Error leyendo configuración de grupos.");
    }

    // Detectar rol en .htgroup
    if (preg_match('/^profesores:\s*.*\b' . preg_quote($user, '/') . '\b/mi', $htgroup)) {
        $_SESSION['rol'] = 'Profesor';
        header('Location: intranet/intranet.php');
        exit;
    }
    if (preg_match('/^alumnos:\s*.*\b' . preg_quote($user, '/') . '\b/mi', $htgroup)) {
        $_SESSION['rol'] = 'Alumno';
        header('Location: intranet/readonly.php');
        exit;
    }

    header('Location: errorAccess.php');
    exit;
}

if (!empty($_SESSION['rol'])) {
    if ($_SESSION['rol'] === 'Profesor') {
        header('Location: intranet/intranet.php');
        exit;
    }
    if ($_SESSION['rol'] === 'Alumno') {
        header('Location: intranet/readonly.php');
        exit;
    }
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
        <h1>RodBi Technology</h1>
        <img src="imagenes/rodbiLogoBl.png" alt="rodbilogo">
    </header>
    <section>
        <div id="left">
            <div class="logo-title">
                <img src="imagenes/rodbiLogo.png" alt="rodbilogo">
                <h1 class="about-mini">Welcome to the RodBi intranet</h1>
            </div>
            <div class="about-mini">
                <p>
                    The RodBi Technology Intranet gives you secure access to key documents and resources, making collaboration with our team simple and efficient.
                </p>
            </div>
            <div class="actions">
                <form method="get">
                    <button type="submit" name="login" value="1">Access the Intranet</button>
                </form>
                <?php if (!empty($_SESSION['rol'])): ?>
                <form method="get">
                    <button type="submit" name="logout" value="1">Log out</button>
                </form>
                <?php endif; ?>
            </div>
        </div>
        <div id="right">
            <div class="empre">
                <span>
                    <h1>Companies collaborating with RodBi Technology</h1>
                </span>
            </div>
            <div class="empresas">
                <img src="imagenes/Brands.png" alt="Brands">
            </div>
        </div>
    </section>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> RodBi Technology. All rights reserved.</p>
    </footer>
</body>

</html>