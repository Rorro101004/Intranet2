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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>hola alumno</h1>
</body>
</html>