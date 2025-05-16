<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="intra.css">  
</head>
<body>
    <h1> Bienvenido profesor </h1>
    <?php
    $rol = $_SESSION['rol'] ?? null;
        echo '<form action="" method="post" enctype="multipart/form-data">
                    <input type="file" name="archivo" accept=".pdf,.doc,.docx" required>
                    <input type="submit" name="subir" value="Subir archivo">
                    </form>';
                if ($rol === "Profesor" && isset($_POST['subir']) && isset($_FILES['archivo'])) {
                    $tipo = $_FILES["archivo"]["type"];
                    if ($tipo == "application/pdf" || $tipo == "application/msword" || $tipo == "application/vnd.openxmlformats-officedocument.wordprocessingml.document") {
                        $destino = "documentos/" . basename($_FILES["archivo"]["name"]);
                        if (move_uploaded_file($_FILES["archivo"]["tmp_name"], $destino)) {
                            echo "<p >Archivo subido correctamente.</p>";
                        } else {
                            echo "<p>Error al subir el archivo.</p>";
                        }
                    } else {
                        echo "<p>Solo se permiten archivos PDF o DOC/DOCX.</p>";
                    }
                }


                echo "<h3>Documentos disponibles:</h3>";
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
</body>
</html>