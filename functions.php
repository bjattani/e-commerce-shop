<?php
// functions.php - Common reusable logic

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function login($pdo, $email, $password) {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_role'] = $user['role'];  // Add this
        return true;
    }
    return false;
}

function logout() {
    session_unset();
    session_destroy();
    header("Location: index.php?page=login");
    exit;
}

function getProducts($pdo) {
    $stmt = $pdo->query("SELECT * FROM products");
    return $stmt->fetchAll();
}

function addToCart($product_id) {
    $_SESSION['cart'][$product_id] = ($_SESSION['cart'][$product_id] ?? 0) + 1;
}

function getCartItems($pdo) {
    $items = [];
    if (!empty($_SESSION['cart'])) {
        $placeholders = implode(',', array_fill(0, count($_SESSION['cart']), '?'));
        $stmt = $pdo->prepare("SELECT * FROM products WHERE id IN ($placeholders)");
        $stmt->execute(array_keys($_SESSION['cart']));
        $products = $stmt->fetchAll();
        foreach ($products as $product) {
            $product['quantity'] = $_SESSION['cart'][$product['id']];
            $items[] = $product;
        }
    }
    return $items;
}
?>