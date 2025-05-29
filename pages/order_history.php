<?php
$userId = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY created_at DESC");
$stmt->execute([$userId]);
$orders = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html><head><script src="https://cdn.tailwindcss.com"></script></head>
<body class="p-6">
  <h2 class="text-2xl mb-4">Your Orders</h2>
  <?php foreach ($orders as $order): ?>
    <div class="border p-4 mb-2 rounded">
      <p><strong>Items:</strong> <?= htmlspecialchars($order['items']) ?></p>
      <p><strong>Total:</strong> $<?= number_format($order['total'], 2) ?></p>
      <p class="text-gray-500 text-sm"><?= $order['created_at'] ?></p>
    </div>
  <?php endforeach; ?>
</body>
</html>
