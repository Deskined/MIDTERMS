<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
    $email = $_POST['email'];

    // Check if username already exists
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    if ($stmt->fetch()) {
        echo "Username is already taken.";
    } else {
        // Insert the new user into the database
        $stmt = $pdo->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
        if ($stmt->execute([$username, $password, $email])) {
            echo "Registration successful. <a href='login.php'>Login here</a>";
        } else {
            echo "Error in registration.";
        }
    }
}
?>

<!-- HTML Registration Form -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-r from-blue-400 to-cyan-400 flex items-center justify-center h-screen">
    <div class="text-center text-white mb-6">
        <h2 class="text-3xl font-bold mb-4">Register</h2>
        <p class="text-xl">John Allen Kim Samin</p>
    </div>
    <form method="POST" action="register.php" class="bg-white p-6 rounded-lg shadow-lg w-80">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="username">Username:</label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight mb-4 focus:outline-none focus:shadow-outline" type="text" id="username" name="username" required>

        <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Password:</label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight mb-4 focus:outline-none focus:shadow-outline" type="password" id="password" name="password" required>

        <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Email:</label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight mb-4 focus:outline-none focus:shadow-outline" type="email" id="email" name="email">

        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">Register</button>
    </form>
</body>
</html>

 