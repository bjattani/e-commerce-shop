<?php
// index.php - Entry point for the application

session_start();
require_once 'db.php';
require_once 'functions.php';

$page = $_GET['page'] ?? 'home';

switch ($page) {
    case 'register':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
            $stmt->execute([$name, $email, $password]);
            header("Location: index.php?page=login");
            exit;
        }
        require 'pages/register.php';
        break;

    case 'login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            if (login($pdo, $email, $password)) {
                header("Location: index.php?page=home");
                exit;
            } else {
                $error = "Invalid credentials.";
            }
        }
        require 'pages/login.php';
        break;

    case 'logout':
        logout();
        break;

    case 'products':
        require 'pages/products.php';
        break;

    case 'cart':
        if (isset($_GET['action']) && $_GET['action'] === 'add' && isset($_GET['id'])) {
            addToCart((int)$_GET['id']);
            header("Location: index.php?page=cart");
            exit;
        }
        require 'pages/cart.php';
        break;

    case 'checkout':
        require 'pages/checkout.php';
        break;

    case 'admin':
        require 'pages/admin.php';
        break;

    case 'payment':
        require 'pages/payment.php';
        break;

    case 'order_history':
        require 'pages/order_history.php';
        break;

    case 'home':
    default:
        require 'pages/home.php';
        break;
}
?>
