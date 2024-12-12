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
    $sql = "SELECT nombre_usuario, correo FROM usuarios WHERE id_usuario = :id_usuario";
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

// Manejo de actualización de usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nuevo_nombre_usuario = trim($_POST['nombre_usuario']);
    $nuevo_correo = trim($_POST['correo']);

    // Validar los campos (puedes agregar más validaciones según sea necesario)
    if (empty($nuevo_nombre_usuario) || empty($nuevo_correo)) {
        $error = "Todos los campos son obligatorios.";
    } else {
        try {
            // Actualizar los datos del usuario en la base de datos
            $updateSql = "UPDATE usuarios SET nombre_usuario = :nombre_usuario, correo = :correo WHERE id_usuario = :id_usuario";
            $updateStmt = $pdo->prepare($updateSql);
            $updateStmt->execute([
                ':nombre_usuario' => $nuevo_nombre_usuario,
                ':correo' => $nuevo_correo,
                ':id_usuario' => $id_usuario
            ]);

            // Redirigir al perfil después de la actualización
            header("Location: perfil.php");
            exit;
        } catch (PDOException $e) {
            die("Error al actualizar el usuario: " . $e->getMessage());
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center">Editar Usuario</h1>
    
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="post">
        <div class="mb-3">
            <label for="nombre_usuario" class="form-label">Nombre de Usuario</label>
            <input type="text" name="nombre_usuario" id="nombre_usuario" class="form-control" value="<?= htmlspecialchars($usuario['nombre_usuario']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="correo" class="form-label">Correo Electrónico</label>
            <input type="email" name="correo" id="correo" class="form-control" value="<?= htmlspecialchars($usuario['correo']) ?>" required>
        </div>
        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="perfil.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>
