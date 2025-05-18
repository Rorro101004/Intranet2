<?php
// Aquí puedes poner código PHP si es necesario
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Error de acceso</title>
    <style>
        body {
            background: #e6e8ea;
            font-family: 'Segoe UI', Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #1a2639;
            min-height: 100vh;
        }

        section {
            max-width: 400px;
            margin: 120px auto 0 auto;
            background: #f7f9fa;
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(34, 58, 94, 0.08);
            padding: 40px 30px 30px 30px;
            text-align: center;
        }

        h1 {
            color: #c0392b;
            font-size: 2rem;
            margin-bottom: 18px;
        }

        p {
            color: #223a5e;
            font-size: 1.1rem;
            margin-bottom: 28px;
        }

        button {
            background: #223a5e;
            color: #fff;
            border: none;
            padding: 10px 28px;
            border-radius: 5px;
            font-size: 1.1rem;
            cursor: pointer;
        }

        button:hover {
            background: #1a2639;
            color: #e6e8ea;
        }
    </style>
</head>

<body>
    <section style="text-align:center; margin-top:100px;">
        <h1 style="color:red;">Error al iniciar sesión</h1>
        <p>No tienes permiso para acceder.</p>
        <form action="rodbi.php" method="get">
            <button type="submit">Volver</button>
        </form>
    </section>
</body>

</html>