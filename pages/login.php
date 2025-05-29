<!DOCTYPE html>
<html lang="en">
<head>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="p-6">
  <h2 class="text-2xl mb-4">Login</h2>
  <?php if (!empty($error)): ?>
    <p class="text-red-500"><?= $error ?></p>
  <?php endif; ?>
  <form method="post" action="">
    <input type="email" name="email" placeholder="Email" required class="border p-2 mb-2 block w-full">
    <input type="password" name="password" placeholder="Password" required class="border p-2 mb-4 block w-full">
    <button type="submit" class="bg-green-500 text-white px-4 py-2">Login</button>
  </form>
  <p class="mt-4">Don't have an account? <a href="index.php?page=register" class="text-blue-500">Register here</a>.</p>
</body>
</html>
