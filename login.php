<?php
session_start();
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['username'] = $user['username'];
        header("Location: index.php"); // Redirect to a protected page
        exit();
    } else {
        echo "Invalid username or password.";
    }
}
?>


<!-- HTML Login Form -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-r from-purple-500 to-pink-500 flex items-center justify-center h-screen">
    <div class="text-center text-white mb-6">
        <h2 class="text-3xl font-bold mb-4">Login</h2>
        <p class="text-xl">John Allen Kim Samin</p>
    </div>
    <form method="POST" action="login.php" class="bg-white p-8 rounded-lg shadow-lg w-80">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="username">Username:</label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight mb-4 focus:outline-none focus:shadow-outline" type="text" id="username" name="username" required>

        <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Password:</label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight mb-4 focus:outline-none focus:shadow-outline" type="password" id="password" name="password" required>

        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">Login</button>
        <a href="register.php" class="text-blue-500 hover:underline block mt-4">Register</a>
    </form>
</body>
</html>
