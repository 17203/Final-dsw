<?php
try {
    $pdo = new PDO('mysql:host=sql100.infinityfree.com;dbname=if0_37852780_dswfinal2', 'if0_37852780', '9iEuUer5Hz'); // Cambia los datos según tu configuración
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Conexión fallida: " . $e->getMessage());
}
session_start(); // Iniciar sesión al principio del archivo

// Verificar si la sesión está activa
$username = null; // Inicializar el nombre como null
if (isset($_SESSION['is_logged']) && $_SESSION['is_logged']) {
    $username = $_SESSION['username']; // Obtener el nombre de usuario de la sesión
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Esencia Selecta - Encuentra tu Esencia Perfecta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #121212; /* Fondo oscuro */
            color: #e0e0e0; /* Texto claro */
            font-family: 'Arial', sans-serif;
        }
        .hero {
            background-color: #5b3000; /* Color de fondo */
            color: white;
            text-align: center;
            padding: 80px 20px; /* Ajustar el padding */
            margin-bottom: 40px; /* Espacio inferior */
        }
        .hero h1 {
            font-size: 3rem;
            font-weight: bold;
        }
        .hero p {
            font-size: 1.5rem;
            margin-top: 20px;
        }
        .btn-custom {
            background-color: #82a6b1; /* Botón azul suave */
            color: white;
            font-size: 1.2rem;
            padding: 10px 20px;
            border-radius: 5px;
        }
        .btn-custom:hover {
            background-color: #76877d; /* Color más oscuro al pasar el mouse */
        }
        .info-section {
            padding: 40px 20px; /* Ajustar el padding */
            background-color: #66462c; /* Fondo marrón suave */
            border-radius: 10px;
            margin-bottom: 40px; /* Espacio inferior */
        }
        .info-section h2 {
            margin-bottom: 20px;
            color: #f0c674; /* Color dorado suave para los encabezados */
        }
        footer {
            background-color: #726953; /* Fondo gris suave */
            color: white; /* Texto blanco en el pie de página */
            padding: 20px 0;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="hero">
            <h1>Esencia Selecta</h1>
            <p>Descubre, compara y encuentra los mejores productos de belleza para ti.</p>
            <a href="index.php" class="btn btn-custom">Ir al Catálogo</a>
        </div>

        <div class="info-section">
            <h2>¿Qué hacemos?</h2>
            <p>En <strong>Esencia Selecta</strong>, te ayudamos a explorar una amplia variedad de productos de belleza como perfumes, shampoos, y cremas para el cuidado personal. ¡Compara precios, características y lugares donde comprarlos para tomar la mejor decisión!</p>
            <p>Nuestro objetivo es que encuentres el producto perfecto para tu estilo y presupuesto, ya sea que busques algo económico o un lujo exclusivo.</p>
            <p>¡Descubre todo lo que necesitas para verte y sentirte increíble en un solo lugar!</p>
        </div>

        <footer>
            <p>&copy; <?= date("Y"); ?> Esencia Selecta. Todos los derechos reservados.</p>
            <p><a href="presentacion.php" style="color:white;">Presentación</a></p>
        </footer>
    </div>

</body>
</html>
