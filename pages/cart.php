<?php
require_once 'functions.php';
$cartItems = getCartItems($pdo);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Cart</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="p-6">
  <h2 class="text-2xl mb-4">Shopping Cart</h2>
  <?php if (empty($cartItems)): ?>
    <p>Your cart is empty. <a href="index.php?page=products" class="text-blue-500">Shop now</a>.</p>
  <?php else: ?>
    <table class="table-auto w-full mb-6">
      <thead>
        <tr>
          <th class="border px-4 py-2">Product</th>
          <th class="border px-4 py-2">Quantity</th>
          <th class="border px-4 py-2">Price</th>
        </tr>
      </thead>
      <tbody>
        <?php $total = 0; ?>
        <?php foreach ($cartItems as $item): ?>
          <?php $subtotal = $item['price'] * $item['quantity']; $total += $subtotal; ?>
          <tr>
            <td class="border px-4 py-2"><?= htmlspecialchars($item['name']) ?></td>
            <td class="border px-4 py-2"><?= $item['quantity'] ?></td>
            <td class="border px-4 py-2">$<?= number_format($subtotal, 2) ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <p class="text-xl font-bold mb-4">Total: $<?= number_format($total, 2) ?></p>
    <a href="index.php?page=checkout" class="bg-green-500 text-white px-4 py-2 rounded">Proceed to Checkout</a>
  <?php endif; ?>
</body>
</html>
