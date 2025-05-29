<!DOCTYPE html>
<html lang="en">
<head>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="p-6">
  <h1 class="text-3xl font-bold mb-4">Welcome to Our Simple Shop</h1>
  <?php if (isLoggedIn()): ?>
    <p class="mb-4">Hello, <?= htmlspecialchars($_SESSION['user_name']) ?>! <a href="index.php?page=logout" class="text-blue-500 underline">Logout</a></p>
    <a href="index.php?page=products" class="bg-green-500 text-white px-4 py-2 rounded">Browse Products</a>
  <?php else: ?>
    <p class="mb-4">Please <a href="index.php?page=login" class="text-blue-500 underline">Login</a> or <a href="index.php?page=register" class="text-blue-500 underline">Register</a></p>
  <?php endif; ?>
</body>
</html>
