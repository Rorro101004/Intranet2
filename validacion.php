<?php
if ($_FILES["file"]["type"] == "application/pdf" || $_FILES["file"]["type"] == "application/msword") {
    move_uploaded_file($_FILES["file"]["tmp_name"], "uploads/" . $_FILES["file"]["name"]);
    echo "Archivo subido correctamente.";
} else {
    echo "Solo se permiten archivos PDF y DOC.";
}
?>