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
    <title>Esencia Selecta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #121212; /* Fondo oscuro */
            color: #e0e0e0; /* Texto claro y suave */
            font-family: 'Arial', sans-serif;
        }
        .container {
            margin-top: 50px;
        }
        h2 {
            color: #82a6b1; /* Color suave para el título */
            text-align: center;
            margin-bottom: 30px; /* Espacio inferior */
        }
        .bordered-box {
            border: 2px solid #726953; /* Borde color gris suave */
            border-radius: 10px;
            padding: 20px;
            background-color: #2b2b2b; /* Fondo más claro que el fondo general */
            margin-bottom: 20px;
        }
        .alert-success {
            background-color: #66462c; /* Color marrón suave para la alerta */
            border-color: #5b3000; /* Color marrón oscuro para el borde */
        }
        .btn-primary {
            background-color: #82a6b1; /* Botón azul suave */
            border-color: #76877d;
        }
        .btn-danger {
            background-color: #dc3545; /* Botón de logout rojo */
            border-color: #c82333;
        }
        a {
            color: #726953; /* Enlaces en color gris suave */
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline; /* Subrayar enlaces al pasar el mouse */
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #726953; /* Borde gris suave para la barra de búsqueda */
            margin-top: 10px;
            background-color: #3b3b3b; /* Fondo oscuro para la barra de búsqueda */
            color: #ffffff; /* Texto blanco en la barra de búsqueda */
        }
        button {
            margin-top: 10px;
        }
        footer {
            background-color: #726953; /* Fondo gris suave del pie de página */
            color: white; /* Texto blanco en el pie de página */
            padding: 20px 0;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container text-center">
        <h2>Bienvenido a Esencia Selecta</h2>
        
        <?php if ($username): ?>
            <!-- Mostrar mensaje de bienvenida si la sesión está iniciada -->
            <div class="alert alert-success" role="alert">
                ¡Bienvenido, <?= htmlspecialchars($username); ?>!
            </div>
        <?php endif; ?>

        <div class="row bordered-box">
            <div class="col">
                <img src="https://i.postimg.cc/tT0pcKx6/4-removebg-preview-1.png" class="img-fluid" style="max-width: 40%;">
            </div>
            <div class="col">
                <!-- Barra de búsqueda -->
                <form action="buscar.php" method="GET">
                    <input type="text" name="query" placeholder="Buscar en la página" required>
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </form>
            </div>
            <div class="col">
                <!-- Opciones varias -->
                <button class="btn btn-secondary">
                    <a href="carrito.php" style="color:white;">Carrito</a>
                </button>
                <?php if ($username): ?>
                    <!-- Botón visible cuando hay sesión iniciada -->
                    <button class="btn btn-info"><a href="perfil.php" style="color:white;">Perfil</a></button>
                    <button class="btn btn-danger">
                        <a href="logout.php" style="text-decoration: none; color: white;">Logout</a>
                    </button>
                <?php else: ?>
                    <!-- Botón visible cuando no hay sesión iniciada -->
                    <button class="btn btn-success"><a href="login.php" style="color:white;">Login</a></button>
                <?php endif; ?>
            </div>
        </div>

        <div class="row bordered-box">
            <div class="col-md">
                <!-- Catálogo de productos -->
                <h4>Categorías:</h4>
                <ul class="list-unstyled">
                    <li><a href="pagina_general.php?id_categoria=1">Fragancia para hombres</a></li>
                    <li><a href="pagina_general.php?id_categoria=2">Fragancia para Mujeres</a></li>
                    <li><a href="pagina_general.php?id_categoria=3">Shampoo</a></li>
                    <li><a href="pagina_general.php?id_categoria=4">Crema corporal</a></li>
                </ul>
            </div>
        </div>

    </div>

    <!-- Pie de página -->
    <footer>
        <p>&copy; <?= date("Y"); ?> Esencia Selecta. Todos los derechos reservados.</p>
        <p><a href="presentacion.php" style="color:white;">Presentación</a></p>
    </footer>

</body>
</html>
