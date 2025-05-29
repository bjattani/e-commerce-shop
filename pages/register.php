<!DOCTYPE html>
<html lang="en">
<head>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="p-6">
  <h2 class="text-2xl mb-4">Register</h2>
  <form method="post" action="">
    <input type="text" name="name" placeholder="Name" required class="border p-2 mb-2 block w-full">
    <input type="email" name="email" placeholder="Email" required class="border p-2 mb-2 block w-full">
    <input type="password" name="password" placeholder="Password" required class="border p-2 mb-4 block w-full">
    <button type="submit" class="bg-blue-500 text-white px-4 py-2">Register</button>
  </form>
  <p class="mt-4">Already have an account? <a href="index.php?page=login" class="text-blue-500">Login here</a>.</p>
</body>
</html>
