<?php
try {
    $pdo = new PDO('mysql:host=sql100.infinityfree.com;dbname=if0_37852780_dswfinal2', 'if0_37852780', '9iEuUer5Hz'); // Cambia los datos según tu configuración
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Conexión fallida: " . $e->getMessage());
}

// Verificar que id_categoria esté presente en la URL
if (!isset($_GET['id_categoria']) || empty($_GET['id_categoria'])) {
    die("No se proporcionó una categoría válida.");
}

$id_categoria = (int)$_GET['id_categoria'];

try {
    // Consulta para obtener productos de la categoría seleccionada
    $sql = "SELECT id_producto, nombre, precio, imagen FROM productos WHERE id_categoria = :id_categoria";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id_categoria' => $id_categoria]);

    $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error en la consulta: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Esencia Selecta - Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #121212; /* Fondo oscuro */
            color: #e0e0e0; /* Texto claro */
        }
        .container {
            margin-top: 50px;
        }
        h1 {
            color: #82a6b1; /* Color suave para el título */
            text-align: center;
            margin-bottom: 30px; /* Espacio inferior */
        }
        .card {
            border: none; /* Sin borde para las tarjetas */
            border-radius: 10px; /* Bordes redondeados */
            background-color: #1e1e1e; /* Fondo de tarjeta oscuro */
            transition: transform 0.2s; /* Efecto de transición */
        }
        .card:hover {
            transform: scale(1.05); /* Efecto de aumento al pasar el mouse */
        }
        .card-img-top {
            height: 300px; /* Altura fija para las imágenes */
            object-fit: cover; /* Ajustar imagen sin distorsionar */
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .card-title {
            color: #FFD700; /* Color dorado para el título del producto */
        }
        .card-text {
            color: #d0d0d0; /* Texto claro para mejor legibilidad */
        }
        .btn-info {
            background-color: #5b3000; /* Color marrón suave para Ver Detalle */
            border-color: #66462c;
        }
        .btn-success {
            background-color: #28a745; /* Color verde para Agregar al Carrito */
            border-color: #218838;
        }
        .btn-info:hover, .btn-success:hover {
            opacity: 0.9; /* Efecto de opacidad al pasar el mouse */
        }

        /* Estilos del menú lateral */
        .sidenav {
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #111;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
        }

        .sidenav a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 25px;
            color: #818181;
            display: block;
            transition: 0.3s;
        }

        .sidenav a:hover {
            color: #f1f1f1;
        }

        .sidenav .closebtn {
            position: absolute;
            top: 20px;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
        }

        /* Estilo del botón hamburguesa */
        .menu-btn {
            font-size: 30px;
            cursor: pointer;
            position: absolute;
            top: 15px;
            left: 15px;
            color: white; 
        }
    </style>
</head>
<body>

<div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <a href="index.php">Inicio</a>
    <a href="carrito.php">Carrito</a>
    <a href="perfil.php">Perfil</a>
    <a href="pagina_general.php?id_categoria=1">Fragancias H</a>
    <a href="pagina_general.php?id_categoria=2">Fragancias M</a>
    <a href="pagina_general.php?id_categoria=3">Shampoo</a>
    <a href="pagina_general.php?id_categoria=4">Cremas</a>
</div>

<span class="menu-btn" onclick="openNav()">&#9776;</span>

<div class="container mt-5" id="main">
    <h1 class="text-center mb-4">Productos</h1>
    <div class="row mt-4">
        <?php foreach ($productos as $producto): ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="<?= htmlspecialchars($producto['imagen']) ?>" class="card-img-top" alt="<?= htmlspecialchars($producto['nombre']) ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($producto['nombre']) ?></h5>
                        <p class="card-text">Precio: $<?= number_format($producto['precio'], 2) ?></p>

                        <!-- Botón Ver Detalle -->
                        <a href="detalle_producto.php?id_producto=<?= $producto['id_producto'] ?>" class="btn btn-info">Ver Detalle</a>

                        <!-- Botón Agregar al Carrito -->
                        <form action="carrito.php" method="POST" style="display:inline;">
                            <input type="hidden" name="id_producto" value="<?= $producto['id_producto'] ?>">
                            <button type="submit" class="btn btn-success">Agregar al Carrito</button>
                        </form>

                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script>
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}
</script>

<footer class="text-center py-4 bg-light">
    <p>&copy; <?= date("Y"); ?> Esencia Selecta. Todos los derechos reservados.</p>
</footer>

</body>
</html>
