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
                        if ($rol == "Profesor") {
                            echo '<form action="" method="post" enctype="multipart/form-data">
                                <input type="file" name="archivo" accept=".pdf,.doc,.docx" required>
                                <input type="submit" name="subir" value="Subir archivo">
                                </form>';
                        }
                    }
                }
                $rol = $_SESSION['rol'] ?? null;

                if ($rol === "Profesor" && !isset($_POST['subir'])) {
                    echo '<form action="" method="post" enctype="multipart/form-data">
            <input type="file" name="archivo" accept=".pdf,.doc,.docx" required>
            <input type="submit" name="subir" value="Subir archivo">
          </form>';
                }


                if ($rol === "Profesor" && isset($_POST['subir']) && isset($_FILES['archivo'])) {
                    $tipo = $_FILES["archivo"]["type"];
                    if ($tipo == "application/pdf" || $tipo == "application/msword" || $tipo == "application/vnd.openxmlformats-officedocument.wordprocessingml.document") {
                        $destino = "documentos/" . basename($_FILES["archivo"]["name"]);
                        if (move_uploaded_file($_FILES["archivo"]["tmp_name"], $destino)) {
                            echo "<p style='background-color: black;'>Archivo subido correctamente.</p>";
                        } else {
                            echo "<p>Error al subir el archivo.</p>";
                        }
                    } else {
                        echo "<p>Solo se permiten archivos PDF o DOC/DOCX.</p>";
                    }
                }


                echo "<h3 style='background-color: black;'>Documentos disponibles:</h3>";
                $archivos = glob("documentos/*.{pdf,doc,docx}", GLOB_BRACE);
                if ($archivos) {
                    foreach ($archivos as $archivo) {
                        $nombre = basename($archivo);
                        echo "<a href='$archivo' download>$nombre</a><br>";
                    }
                } else {
                    echo "<p style='background-color: black;'>No hay documentos disponibles.</p>";
                }
                ?>
            </div>
            <div id="right">
                <div class="empre">
                    <span>
                        <h1>Empresas que colaboran con RodBi Technology</h1>
                    </span>
                </div>
                <div class="empresas">
                    <img src="NexTech logo.png" alt="Nextech">
                    <img src="microsoft-logo-microsoft-icon-transparent-free-png.webp" alt="Microsoft">
                    <img src="ibm-logo-cru-repair-louis-9.png" alt="IBM">
                    <img src="9fa92ac5a9498502d2707ced798d763fe7490ecc-1600x1026.png" alt="Apple">
                </div>
            </div>
    </section>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> RodBi Technology. Todos los derechos reservados.</p>
    </footer>
</body>


</html>