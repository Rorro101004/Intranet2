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
    <title>Student Documentation</title>
    <style>
        @font-face {
            font-family: 'Comfortaa';
            src: url('../fonts/Comfortaa-SemiBold.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
        }
        body {
            background: #e6e8ea;
            font-family: 'Comfortaa', Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #1a2639;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        header {
            background-color: #e7f1ff;
            color: #ffffff;
            padding: 10px 30px;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            top: 0;
            height: 5vw;
            box-sizing: border-box;
            gap: 20px;
        }
        header h1 {
            margin: 0;
            font-size: 2.2rem;
            font-family: 'Comfortaa', Arial, sans-serif;
        }
        header img {
            height: 30px;
            width: auto;
            margin-left: 0;
        }
        main {
            flex: 1 0 auto;
            max-width: 600px;
            margin: 40px auto 0 auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(34,58,94,0.08);
            padding: 32px 36px;
        }
        h1 {
            text-align: center;
            margin-top: 30px;
            color: #223a5e;
            font-size: 2.2rem;
            font-family: 'Comfortaa', Arial, sans-serif;
            letter-spacing: 1px;
        }
        a {
            display: block;
            width: fit-content;
            margin: 16px auto;
            color: #fff;
            text-decoration: none;
            font-weight: 500;
            padding: 10px 22px;
            border-radius: 5px;
            background: linear-gradient(90deg, #007BFF 0%, #8f5cff 100%);
            font-size: 1.2rem;
            transition: background 0.4s, color 0.2s, transform 0.2s;
            box-shadow: 0 2px 6px rgba(0,0,0,0.08);
        }
        a:hover {
            background: linear-gradient(90deg, #ffe259 0%, #ffa751 100%);
            color: #222;
            text-decoration: underline;
            transform: scale(1.05);
        }
        p {
            text-align: center;
            font-size: 1.1rem;
            color: #223a5e;
            margin: 10px 0;
        }
        footer {
            background-color: rgb(0, 0, 0);
            color: white;
            padding: 10px;
            text-align: center;
            width: 100%;
            height: 10vh;
            flex-shrink: 0;
            margin-top: auto;
            position: relative;
            bottom: 0;
        }
    </style>
</head>
<body>
    <header>
        <h1>RodBi Technology</h1>
        <img src="../imagenes/rodbiLogoBl.png" alt="rodbilogo">
    </header>
    <main>
        <h1>Available Documentation for Students</h1>
        <?php
        $archivos = glob(__DIR__ . "/documentos/*.{pdf,doc,docx}", GLOB_BRACE);
        if ($archivos) {
            foreach ($archivos as $archivo) {
                $nombre = basename($archivo);
                echo "<a href='documentos/$nombre' download>$nombre</a><br>";
            }
        } else {
            echo "<p>No documents available.</p>";
        }
        ?>
        <br>
        <a href="../rodbi.php?logout=1">Log out</a>
    </main>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> RodBi Technology. All rights reserved.</p>
    </footer>
</body>

</html>