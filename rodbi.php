<?php
session_start();
// borrar var dump al terminar todo 
var_dump(
    'PHP_AUTH_USER',
    $_SERVER['PHP_AUTH_USER'] ?? null,
    'rol en $_SESSION',
    $_SESSION['rol'] ?? null
);

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

    // var dump begin
    var_dump(__DIR__ . '/intranet/.htgroup');
    $htgroup_path = __DIR__ . '/intranet/.htgroup';
    var_dump($htgroup_path);
    if (!file_exists($htgroup_path)) {
        exit("El archivo .htgroup NO existe en esa ruta.");
    }
    $htgroup = @file_get_contents($htgroup_path);
    if ($htgroup === false) {
        exit("No se pudo leer el archivo .htgroup aunque existe.");
    }
    echo "Archivo leído correctamente.<br>";
    // var dump end 
    
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
        <span>
            <h1>Bienvenido a la intranet de RodBi Technology</h1>
        </span>
    </header>
    <section>
        <div id="left">
            <form method="get">
                <button type="submit" name="login" value="1">Acceder a la Intranet</button>
            </form>
            <?php if (!empty($_SESSION['rol'])): ?>
                <form method="get">
                    <button type="submit" name="logout" value="1">Cerrar sesión</button>
                </form>
            <?php endif; ?>
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
        <p>&copy; <?php echo date("Y"); ?> RodBi Technology. Todos los derechos reservados.</p>
    </footer>
</body>

</html>