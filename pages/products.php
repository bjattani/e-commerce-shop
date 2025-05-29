<?php
require_once 'functions.php';
$products = getProducts($pdo);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Products</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="p-6">
  <h2 class="text-2xl mb-4">Products</h2>
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
    <?php if (empty($products)): ?>
      <p>No products found. <a href="index.php?page=admin" class="text-blue-500">Add some?</a></p>
    <?php else: ?>
      <?php foreach ($products as $product): ?>
        <div class="border p-4 rounded shadow">
          <h3 class="text-lg font-bold"><?= htmlspecialchars($product['name']) ?></h3>
          <p><?= htmlspecialchars($product['description']) ?></p>
          <p class="text-green-600 font-bold">$<?= number_format($product['price'], 2) ?></p>
          <form method="get" action="index.php">
            <input type="hidden" name="page" value="cart">
            <input type="hidden" name="action" value="add">
            <input type="hidden" name="id" value="<?= $product['id'] ?>">
            <button class="bg-blue-500 text-white px-3 py-1 mt-2 rounded">Add to Cart</button>
          </form>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</body>
</html>
