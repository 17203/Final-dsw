<?php
session_start();
//este archivo solo maneja la logica 
$users = [
    'test' => 'test',
    'test2' => 'test2'
];//esto simula la base de datos
$username = $_GET['username'] ?? null;
$password = $_GET['password'] ?? null;

if (isset($users[$username]) && $users[$username] === $password) {
    $_SESSION['is logged'] = true;
    $_SESSION['username'] = $username;
    echo 'true';// aquí solo se da un verdadero o falso
    header('Location: index.php');
} else {
    echo 'false';
    header('Location: login.php');
}
?>
