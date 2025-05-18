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
    <style>
        body {
            background: #e6e8ea;
            font-family: 'Segoe UI', Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #1a2639;
        }
        h1 {
            text-align: center;
            margin-top: 30px;
            color: #1a2639;
        }
        a {
            display: block;
            width: fit-content;
            margin: 12px auto;
            color: #fff;
            text-decoration: none;
            font-weight: 500;
            padding: 8px 18px;
            border-radius: 5px;
            background: #223a5e;
        }
        a:hover {
            background: #1a2639;
            color: #e6e8ea;
            text-decoration: underline;
        }
        p {
            text-align: center;
            font-size: 1.1rem;
            color: #223a5e;
        }
    </style>
</head>
<body>
    <h1>Documentación disponible para alumnos</h1>
    <?php
    $archivos = glob(__DIR__ . "/documentos/*.{pdf,doc,docx}", GLOB_BRACE);
    if ($archivos) {
        foreach ($archivos as $archivo) {
            $nombre = basename($archivo);
            echo "<a href='documentos/$nombre' download>$nombre</a><br>";
        }
    } else {
        echo "<p>No hay documentos disponibles.</p>";
    }
    ?>
    <br>
    <a href="../rodbi.php?logout=1">Cerrar sesión</a>
</body>

</html>