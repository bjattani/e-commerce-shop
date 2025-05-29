<?php
require_once 'functions.php';

if (!isLoggedIn() || ($_SESSION['user_role'] ?? '') !== 'admin') {
    echo "<p class='text-red-500'>Access denied.</p>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $description = $_POST['description'] ?? '';
    $price = $_POST['price'] ?? 0;

    $stmt = $pdo->prepare("INSERT INTO products (name, description, price) VALUES (?, ?, ?)");
    $stmt->execute([$name, $description, $price]);
    header("Location: index.php?page=admin");
    exit;
}

$products = getProducts($pdo);
?>
<!DOCTYPE html>
<html>
<head><script src="https://cdn.tailwindcss.com"></script></head>
<body class="p-6">
<h2 class="text-2xl mb-4">Admin Panel</h2>
<form method="post" class="mb-6 space-y-2">
    <input name="name" placeholder="Product Name" required class="border p-2 w-full">
    <textarea name="description" placeholder="Description" required class="border p-2 w-full"></textarea>
    <input name="price" type="number" step="0.01" placeholder="Price" required class="border p-2 w-full">
    <button type="submit" class="bg-blue-500 text-white px-4 py-2">Add Product</button>
</form>
<h3 class="text-xl font-bold mb-2">All Products</h3>
<ul>
  <?php foreach ($products as $p): ?>
    <li><?= htmlspecialchars($p['name']) ?> - $<?= $p['price'] ?></li>
  <?php endforeach; ?>
</ul>
</body>
</html>
