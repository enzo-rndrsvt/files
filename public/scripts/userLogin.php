<?php
session_start();
require 'bdd.php';

if (!isset($_POST['nom']) || !isset($_POST['password'])) {
    header('Location: ../login.php');
    exit();
}

$nom = htmlspecialchars($_POST['nom']);
$password = $_POST['password'];

$pdo = connectBDD();
$stmt = $pdo->prepare('SELECT * FROM USERS WHERE username = ?;');
$stmt->execute([$nom]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user'] = $user['user_id'];
    header('Location: ../index.php');
    exit();
} else {
    $_SESSION['message'] = "Nom d'utilisateur ou mot de passe incorrect.";
    header('Location: ../login.php');
    exit();
}
?>