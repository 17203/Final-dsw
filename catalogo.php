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

// Verificar que id_producto1 esté presente en la URL
if (!isset($_GET['id_producto1']) || empty($_GET['id_producto1'])) {
    die("No se proporcionó un producto válido.");
}

$id_producto1 = (int)$_GET['id_producto1'];

try {
    // Obtener la categoría del producto que se está comparando
    $sql = "SELECT id_categoria FROM productos WHERE id_producto = :id_producto1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id_producto1' => $id_producto1]);
    $categoria_data = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$categoria_data) {
        die("Producto no encontrado.");
    }

    $id_categoria = $categoria_data['id_categoria'];

    // Consulta para obtener productos de la misma categoría, excluyendo el producto actual
    $sql = "SELECT id_producto, nombre AS producto_nombre, imagen 
            FROM productos 
            WHERE id_categoria = :id_categoria AND id_producto != :id_producto1";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id_categoria' => $id_categoria, ':id_producto1' => $id_producto1]);

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
    <title>Seleccionar Producto para Comparar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #121212; /* Fondo oscuro */
            color: #f8f9fa; /* Texto claro para mayor contraste */
        }
        .container {
            margin-top: 20px;
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
            height: 300px; /* Aumentar altura de las imágenes */
            object-fit: cover; /* Ajustar imagen sin distorsionar */
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .card-title {
            color: #FFD700; /* Color dorado para el título del producto */
        }
        .btn-success {
            background-color: #28a745; /* Color verde para Comparar */
            border-color: #218838;
        }
        .btn-success:hover {
            opacity: 0.9; /* Efecto de opacidad al pasar el mouse */
        }
        .btn-primary {
            margin-top: 20px; /* Espaciado superior para el botón Volver al Inicio */
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center">Seleccionar Producto para Comparar</h1>
    <div class="row mt-4">
        <?php foreach ($productos as $producto): ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="<?= htmlspecialchars($producto['imagen']) ?>" class="card-img-top" alt="Imagen del producto">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($producto['producto_nombre']) ?></h5>
                        <a href="comparacion.php?id_producto1=<?= $id_producto1 ?>&id_producto2=<?= $producto['id_producto'] ?>" class="btn btn-success">Comparar</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <a href="index.php" class="btn btn-primary">Volver al Inicio</a>
</div>
</body>
</html>
