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

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirigir a login si no está autenticado
    exit;
}

// Obtener el ID del usuario de la sesión
$id_usuario = $_SESSION['user_id'];

try {
    // Consulta para obtener los detalles del usuario
    $sql = "SELECT nombre_usuario, correo, fecha_registro FROM usuarios WHERE id_usuario = :id_usuario";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id_usuario' => $id_usuario]);

    // Obtener los datos del usuario
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$usuario) {
        die("Usuario no encontrado.");
    }
} catch (PDOException $e) {
    die("Error en la consulta: " . $e->getMessage());
}

// Manejo de eliminación de usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    try {
        // Eliminar el usuario de la base de datos
        $deleteSql = "DELETE FROM usuarios WHERE id_usuario = :id_usuario";
        $deleteStmt = $pdo->prepare($deleteSql);
        $deleteStmt->execute([':id_usuario' => $id_usuario]);
        
        // Cerrar sesión y redirigir a login
        session_destroy();
        header("Location: login.php");
        exit;
    } catch (PDOException $e) {
        die("Error al eliminar el usuario: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Perfil del Usuario</title>
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
        }
        .card-title {
            color: #FFD700; /* Color dorado para el título */
        }
        .card-text {
            color: #d0d0d0; /* Color más claro para el texto descriptivo */
        }
        .btn-success {
            background-color: #28a745; /* Color verde para Borrar Usuario */
            border-color: #218838;
        }
        .btn-danger {
            background-color: #dc3545; /* Color rojo para Borrar Usuario */
            border-color: #c82333;
        }
        .btn-primary, .btn-outline-secondary {
            margin-top: 10px; /* Espaciado superior para botones */
        }
        .tachado:hover {
            text-decoration: line-through;
            cursor: pointer;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center">Perfil del Usuario</h1>
    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title">Nombre de Usuario: <?= htmlspecialchars($usuario['nombre_usuario']) ?> 
                <a href="editar_usuario.php?id=<?= $id_usuario ?>" class="btn btn-warning btn-sm">Editar</a>
            </h5>
            <p class="card-text">Correo: <?= htmlspecialchars($usuario['correo']) ?></p>
            <p class="card-text">Fecha de Registro: <?= htmlspecialchars($usuario['fecha_registro']) ?></p>
            <a href="index.php" class="btn btn-primary">Volver al Inicio</a>
            <a href="logout.php" class="btn btn-outline-secondary">Cerrar Sesión</a>
            
            <!-- Botón para borrar usuario con confirmación -->
            <button class="btn btn-danger tachado" onclick="confirmDelete()">Borrar Usuario</button>
        </div>
    </div>
</div>

<script>
function confirmDelete() {
    if (confirm("¿Estás seguro de que deseas borrar tu cuenta? Esta acción no se puede deshacer.")) {
        // Si el usuario confirma, se envía el formulario para borrar
        const form = document.createElement('form');
        form.method = 'POST';
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'delete';
        form.appendChild(input);
        document.body.appendChild(form);
        form.submit();
    }
}
</script>

</body>
</html>
