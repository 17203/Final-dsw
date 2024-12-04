<?php
session_start();

if (isset($_GET['nombre'])) {
    if (!isset($_SESSION['nombres'])) {
        $_SESSION['nombres'] = [];
    }
    $_SESSION['nombres'][] = htmlspecialchars($_GET['nombre']);
    exit;
}

if (isset($_GET['mostrar'])) {
    echo json_encode($_SESSION['nombres'] ?? []);
    exit;
}
header('Location: index.php');
?>
