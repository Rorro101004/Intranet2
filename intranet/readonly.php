<?php
session_start();
if (!isset($_SESSION['rol'])) {
    header('Location: ../rodbi.php');
    exit;
}
if ($_SESSION['rol'] !== 'Alumno') {
    header('HTTP/1.0 403 Forbidden');
    exit("Solo alumnos.");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documentación para alumnos</title>
</head>
<body>
    <h1>Documentación disponible para alumnos</h1>
    <?php
    // Listar documentos disponibles para descargar
    $archivos = glob("documentos/*.{pdf,doc,docx}", GLOB_BRACE);
    if ($archivos) {
        foreach ($archivos as $archivo) {
            $nombre = basename($archivo);
            echo "<a href='$archivo' download>$nombre</a><br>";
        }
    } else {
        echo "<p>No hay documentos disponibles.</p>";
    }
    ?>
    <br>
    <a href="../rodbi.php?logout=1">Cerrar sesión</a>
</body>
</html>