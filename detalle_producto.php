<?php
// Iniciar sesión
session_start();

// Conexión a la base de datos
try {
    $pdo = new PDO('mysql:host=sql100.infinityfree.com;dbname=if0_37852780_dswfinal2', 'if0_37852780', '9iEuUer5Hz');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión a la base de datos: " . $e->getMessage());
}

// Verificar que id_producto esté presente en la URL
if (!isset($_GET['id_producto']) || empty($_GET['id_producto'])) {
    die("No se proporcionó un producto válido.");
}

$id_producto = (int)$_GET['id_producto'];

try {
    // Consulta para obtener los detalles del producto junto con el nombre de la tienda y la marca
    $sql = "SELECT productos.nombre AS producto_nombre, marcas.nombre AS marca_nombre, productos.precio, productos.olor, 
                   tiendas.nombre AS tienda_nombre, productos.imagen, productos.id_categoria 
            FROM productos 
            LEFT JOIN tiendas ON productos.id_tienda = tiendas.id_tienda 
            LEFT JOIN marcas ON productos.id_marca = marcas.id_marca 
            WHERE productos.id_producto = :id_producto";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id_producto' => $id_producto]);

    $producto = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$producto) {
        die("Producto no encontrado.");
    }
} catch (PDOException $e) {
    die("Error en la consulta: " . $e->getMessage());
}

// Determinar el ID de categoría
$id_categoria = (int)$producto['id_categoria'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Esencia Selecta - Detalle del Producto</title>
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
            display: flex; /* Usar flexbox para alinear imagen y texto */
            flex-direction: row; /* Alinear en fila */
            transition: transform 0.2s; /* Efecto de transición */
        }
        .card:hover {
            transform: scale(1.05); /* Efecto de aumento al pasar el mouse */
        }
        .product-image {
            width: 50%; /* Ancho de la imagen */
            height: auto; /* Altura automática para mantener proporciones */
            object-fit: cover; /* Ajustar imagen sin distorsionar */
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
        }
        .card-body {
            padding: 20px; /* Espaciado interno del cuerpo de la tarjeta */
            display: flex;
            flex-direction: column; /* Alinear texto verticalmente */
            justify-content: space-between; /* Espacio entre elementos */
        }
        .card-title {
            color: #FFD700; /* Color dorado para el título del producto */
        }
        .card-text {
            color: #ffffff; /* Texto blanco para mejor legibilidad */
        }
        .btn-success {
            background-color: #28a745; /* Color verde para Agregar al Carrito */
            border-color: #218838;
        }
        .btn-success:hover {
            opacity: 0.9; /* Efecto de opacidad al pasar el mouse */
        }
        .btn-secondary, .btn-primary {
            margin-top: 10px; /* Espaciado superior para botones secundarios y primarios */
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center">Detalle del Producto</h1>
    <div class="card mt-4">
        <img src="<?= htmlspecialchars($producto['imagen']) ?>" class="product-image" alt="Imagen del producto">
        <div class="card-body">
            <h5 class="card-title">Nombre: <?= htmlspecialchars($producto['producto_nombre']) ?></h5>
            <p class="card-text">Marca: <?= htmlspecialchars($producto['marca_nombre'] ?? 'Marca no especificada') ?></p>
            <p class="card-text">Precio: $<?= number_format($producto['precio'], 2) ?></p>
            <p class="card-text">Olor: <?= htmlspecialchars($producto['olor']) ?></p>
            <p class="card-text">Se puede comprar en: <?= htmlspecialchars($producto['tienda_nombre'] ?? 'Tienda no especificada') ?></p>

            <!-- Botones -->
            <form action="carrito.php" method="POST" style="display:inline;">
                <input type="hidden" name="id_producto" value="<?= $id_producto ?>">
                <button type="submit" class="btn btn-success">Agregar al Carrito</button>
            </form>

            <!-- Otros botones -->
            <a href="pagina_general.php?id_categoria=<?= $id_categoria ?>" class="btn btn-secondary">Volver a la Categoría</a>
            <a href="index.php" class="btn btn-primary">Volver al Inicio</a>
            <a href="catalogo.php?id_producto1=<?= $id_producto ?>" class="btn btn-primary">Comparar</a>
        </div>
    </div>
</div>
</body>
</html>
