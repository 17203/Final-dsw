<?php
session_start();

// Conexión a la base de datos
try {
    $pdo = new PDO('mysql:host=sql100.infinityfree.com;dbname=if0_37852780_dswfinal2', 'if0_37852780', '9iEuUer5Hz');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Conexión fallida: " . $e->getMessage());
}

// Procesar login o registro
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $email = $_POST['email'] ?? '';  // Obtener el correo electrónico del formulario, si existe

    // Verificar si se está registrando o iniciando sesión
    if (empty($user) || empty($pass)) {
        $error_message = "Los campos de usuario y contraseña son obligatorios.";
    } else {
        // Buscar si el usuario ya existe
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE nombre_usuario = :username");
        $stmt->bindParam(':username', $user);
        $stmt->execute();
        $user_data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user_data) {
            // Si el usuario existe, verificar la contraseña
            if (password_verify($pass, $user_data['contrasena'])) {
                session_start();
                $_SESSION['is_logged'] = true; 
                $_SESSION['user_id'] = $user_data['id_usuario'];
                $_SESSION['username'] = $user_data['nombre_usuario'];  // Guardar el nombre de usuario en la sesión
                header("Location: index.php");
                exit;
            } else {
                $error_message = "Credenciales inválidas.";
            }
        } else {
            // Si el usuario no existe, crear un nuevo usuario
            if (empty($email)) {
                $error_message = "El campo de correo electrónico es obligatorio para registrarse.";
            } else {
                $hashed_password = password_hash($pass, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare("INSERT INTO usuarios (nombre_usuario, correo, contrasena, fecha_registro) VALUES (:username, :email, :password, NOW())");
                $stmt->bindParam(':username', $user);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':password', $hashed_password);

                if ($stmt->execute()) {
                    $success_message = "Usuario creado exitosamente. Ahora puedes iniciar sesión.";
                } else {
                    $error_message = "Error al crear el usuario.";
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #121212; /* Fondo oscuro */
            color: #f8f9fa; /* Texto claro para mayor contraste */
        }
        .container {
            margin-top: 50px;
        }
        h2 {
            color: #FFD700; /* Color dorado para el título */
            text-align: center;
        }
        .card {
            background-color: #1e1e1e; /* Fondo de tarjeta oscuro */
            border: none; /* Sin borde para las tarjetas */
            border-radius: 10px; /* Bordes redondeados */
            padding: 20px; /* Espaciado interno */
        }
        .form-group label {
            color: #d0d0d0; /* Color más claro para las etiquetas */
        }
        .btn-primary {
            background-color: #007bff; /* Color azul para el botón Enviar */
            border-color: #0056b3;
        }
        .btn-primary:hover {
            opacity: 0.9; /* Efecto de opacidad al pasar el mouse */
        }
        .btn-secondary {
            margin-top: 20px; /* Espaciado superior para el botón Volver al Inicio */
            display: block; /* Para centrar el botón */
            width: auto; /* Ancho automático */
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Login o Registro</h2>
    
    <?php if (isset($error_message)): ?>
        <div class="alert alert-danger" role="alert">
            <?= htmlspecialchars($error_message); ?>
        </div>
    <?php endif; ?>

    <?php if (isset($success_message)): ?>
        <div class="alert alert-success" role="alert">
            <?= htmlspecialchars($success_message); ?>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-6 offset-md-3">
            <form action="login.php" method="POST">
                <div class="form-group mb-3">
                    <label for="username">Usuario</label>
                    <input class="form-control" name="username" required />
                </div>
                <div class="form-group mb-3">
                    <label for="password">Contraseña</label>
                    <input type="password" class="form-control" name="password" required />
                </div>
                <div class="form-group mb-3">
                    <label for="email">Correo (para registro)</label>
                    <input type="email" class="form-control" name="email" />
                </div>
                <button class="btn btn-primary w-100" type="submit">Enviar</button> <!-- Botón amplio -->
            </form>
        </div>
    </div>
</div>

<a href="index.php" class="btn btn-secondary">Volver al Inicio</a> <!-- Botón recortado -->

</body>
</html>
