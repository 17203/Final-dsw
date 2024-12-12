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

// Verificar que id_producto1 e id_producto2 estén presentes en la URL
if (!isset($_GET['id_producto1']) || empty($_GET['id_producto1']) || !isset($_GET['id_producto2']) || empty($_GET['id_producto2'])) {
    die("No se proporcionaron productos válidos.");
}

$id_producto1 = (int)$_GET['id_producto1'];
$id_producto2 = (int)$_GET['id_producto2'];

try {
    // Consulta para obtener los detalles del primer producto
    $sql = "SELECT productos.nombre AS producto_nombre, marcas.nombre AS marca_nombre, productos.precio, productos.olor, 
                   tiendas.nombre AS tienda_nombre, productos.imagen 
            FROM productos 
            LEFT JOIN tiendas ON productos.id_tienda = tiendas.id_tienda 
            LEFT JOIN marcas ON productos.id_marca = marcas.id_marca 
            WHERE productos.id_producto IN (:id_producto1, :id_producto2)";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id_producto1' => $id_producto1, ':id_producto2' => $id_producto2]);

    // Obtener los detalles de ambos productos
    $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($productos) < 2) {
        die("Uno o ambos productos no fueron encontrados.");
    }
} catch (PDOException $e) {
    die("Error en la consulta: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Comparar Productos - Esencia Selecta</title>
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
        .product-image {
            height: 300px; /* Altura fija para las imágenes */
            width: 100%; /* Ancho completo */
            object-fit: contain; /* Ajustar imagen sin distorsionar y mantener proporciones */
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .card-title {
            color: #FFD700; /* Color dorado para el título del producto */
        }
        .card-text {
            color: #ffffff; /* Texto blanco para mejor legibilidad */
        }
        .btn-primary {
            margin-top: 20px; /* Espaciado superior para el botón Volver al Inicio */
        }
   </style>
</head>
<body>

<div class="container">
   <h1 class="text-center">Comparar Productos</h1>
   <div class="row mt-4">
       <?php foreach ($productos as $producto): ?>
           <div class="col-md-6 mb-4">
               <div class="card">
                   <img src="<?= htmlspecialchars($producto['imagen']) ?>" class="product-image" alt="<?= htmlspecialchars($producto['producto_nombre']) ?>">
                   <div class="card-body">
                       <h5 class="card-title"><?= htmlspecialchars($producto['producto_nombre']) ?></h5>
                       <p class="card-text">Marca: <?= htmlspecialchars($producto['marca_nombre'] ?? 'Marca no especificada') ?></p>
                       <p class="card-text">Precio: $<?= number_format($producto['precio'], 2) ?></p>
                       <p class="card-text">Olor: <?= htmlspecialchars($producto['olor']) ?></p>
                       <p class="card-text">Se puede comprar en: <?= htmlspecialchars($producto['tienda_nombre'] ?? 'Tienda no especificada') ?></p>
                   </div>
               </div>
           </div>
       <?php endforeach; ?>
   </div>

   <a href="index.php" class="btn btn-primary">Volver al Inicio</a>
</div>

</body>
</html>
