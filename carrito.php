<?php 
session_start();

// Inicializar el carrito si no existe
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

// Conexión a la base de datos
try {
    $pdo = new PDO('mysql:host=sql100.infinityfree.com;dbname=if0_37852780_dswfinal2', 'if0_37852780', '9iEuUer5Hz');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión a la base de datos: " . $e->getMessage());
}

// Verificar si se ha enviado un producto para agregar al carrito
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_producto'])) {
    $id_producto = (int)$_POST['id_producto'];
    $_SESSION['carrito'][] = $id_producto; // Agregar el ID del producto al carrito
    header("Location: carrito.php");
    exit;
}

// Manejar la eliminación de productos del carrito
if (isset($_GET['remove'])) {
    $id_to_remove = (int)$_GET['remove'];
    if (($key = array_search($id_to_remove, $_SESSION['carrito'])) !== false) {
        unset($_SESSION['carrito'][$key]); // Eliminar el producto específico del carrito
        $_SESSION['carrito'] = array_values($_SESSION['carrito']); // Reindexar el array
    }
}

// Manejar la limpieza del carrito
if (isset($_POST['clear_cart'])) {
    $_SESSION['carrito'] = []; // Vaciar el carrito
}

// Mostrar contenido del carrito
if (isset($_SESSION['is_logged']) && $_SESSION['is_logged']) {
    echo "Bienvenido a su carrito {$_SESSION['username']}";
} else {
    echo "Sesión no iniciada";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Carrito</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<style>
        body {
            background-color: #121212; /* Fondo oscuro */
            color: #f8f9fa; /* Texto claro para mayor contraste */
        }
        .container {
            margin-top: 20px;
        }
        h1 {
            color: #FFD700; /* Color dorado para el título */
        }
        .card {
            background-color: #1e1e1e; /* Fondo de tarjeta oscuro */
            border: none; /* Sin borde para las tarjetas */
            border-radius: 10px; /* Bordes redondeados */
            margin-bottom: 20px; /* Espaciado inferior */
            padding: 15px; /* Espaciado interno */
        }
        .list-group-item {
            color: #ffffff; /* Color blanco para el texto de los productos */
        }
        .btn-danger {
            background-color: #dc3545; /* Color rojo para Eliminar */
            border-color: #c82333;
        }
        .btn-danger:hover {
            opacity: 0.9; /* Efecto de opacidad al pasar el mouse */
        }
        .btn-primary {
            margin-top: 20px; /* Espaciado superior para el botón Volver al Inicio */
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h1 class="text-center">Carrito de Compras</h1>

    <?php if (!empty($_SESSION['carrito'])): ?>
        <div class="row">
            <div class="col-md-12">
                <ul class="list-group">
                    <?php 
                    $total_precio = 0; // Inicializar el total

                    // Obtener detalles de los productos en el carrito
                    foreach ($_SESSION['carrito'] as $id_producto): 
                        // Consulta para obtener detalles del producto
                        $sql = "SELECT nombre, precio FROM productos WHERE id_producto = :id_producto";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute([':id_producto' => $id_producto]);
                        $producto = $stmt->fetch(PDO::FETCH_ASSOC);

                        // Verificar si se encontró el producto
                        if ($producto): 
                            // Sumar el precio al total
                            $total_precio += $producto['precio'];
                    ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center card">
                            Producto: <?= htmlspecialchars($producto['nombre']) ?> - Precio: $<?= number_format($producto['precio'], 2) ?>
                            <div>
                                <a href="?remove=<?= htmlspecialchars($id_producto) ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?');">Eliminar</a>
                                <a href="detalle_producto.php?id_producto=<?= htmlspecialchars($id_producto) ?>" class="btn btn-info btn-sm">Ver</a>
                            </div>
                        </li>
                    <?php else: ?>
                        <li class="list-group-item">Producto con ID <?= htmlspecialchars($id_producto) ?> no encontrado.</li>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </ul>

                <!-- Mostrar el total -->
                <h3 class="mt-4">Total: $<?= number_format($total_precio, 2) ?></h3>

                <!-- Botón para vaciar todo el carrito -->
                <form action="carrito.php" method="POST" style="display:inline;">
                    <button type="submit" name="clear_cart" class="btn btn-danger">Vaciar Carrito</button>
                </form>
            </div>
        </div>

    <?php else: ?>
        <p>No hay productos en su carrito.</p>
    <?php endif; ?>

    <a href="index.php" class="btn btn-primary">Volver al Inicio</a>
</div>

</body>
</html>
