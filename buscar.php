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

// Verificar si se proporcionó una consulta de búsqueda
if (!isset($_GET['query']) || empty(trim($_GET['query']))) {
    die("No se proporcionó una consulta válida.");
}

$query = trim($_GET['query']);

try {
    // Consultar la base de datos para buscar el producto
    $sql = "SELECT id_producto FROM productos WHERE nombre LIKE :query LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':query' => '%' . $query . '%']);

    $producto = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($producto) {
        // Redirigir a la página de detalles del producto encontrado
        header("Location: detalle_producto.php?id_producto=" . $producto['id_producto']);
        exit;
    } else {
        echo "No se encontró ningún producto con ese nombre.";
    }
} catch (PDOException $e) {
    die("Error en la consulta: " . $e->getMessage());
}
?>
