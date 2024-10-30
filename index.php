<?php
session_start();
require 'db.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch all restaurants from the database
$stmt = $pdo->query("
    SELECT restaurants.*, users.username 
    FROM restaurants 
    JOIN users ON restaurants.added_by = users.user_id
");
$restaurants = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GYM BRANDS</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-r from-purple-500 to-pink-500">
    <!-- Logout Button -->
    <a href="logout.php" class="absolute top-5 right-5 bg-red-600 text-white py-2 px-4 rounded hover:bg-red-500">Logout</a>

    <div class="container mx-auto mt-10 bg-white p-6 rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-4">GYM BRANDS</h1>
        <a href="edit.php" class="bg-green-600 text-white py-2 px-4 rounded hover:bg-green-500 mb-4 inline-block">Add Brands</a>

        <table class="min-w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-800 text-white">
                    <th class="border border-gray-300 px-4 py-2">ID</th>
                    <th class="border border-gray-300 px-4 py-2">Name</th>
                    <th class="border border-gray-300 px-4 py-2">Address</th>
                    <th class="border border-gray-300 px-4 py-2">Phone</th>
                    <th class="border border-gray-300 px-4 py-2">Email</th>
                    <th class="border border-gray-300 px-4 py-2">Added by</th>
                    <th class="border border-gray-300 px-4 py-2">Last updated</th>
                    <th class="border border-gray-300 px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($restaurants as $restaurant): ?>
                    <tr class="hover:bg-gray-100">
                        <td class="border border-gray-300 px-4 py-2"><?php echo $restaurant['babershop_id']; ?></td>
                        <td class="border border-gray-300 px-4 py-2"><?php echo $restaurant['name']; ?></td>
                        <td class="border border-gray-300 px-4 py-2"><?php echo $restaurant['address']; ?></td>
                        <td class="border border-gray-300 px-4 py-2"><?php echo $restaurant['phone_number']; ?></td>
                        <td class="border border-gray-300 px-4 py-2"><?php echo $restaurant['email']; ?></td>
                        <td class="border border-gray-300 px-4 py-2"><?php echo $restaurant['username']; ?></td>
                        <td class="border border-gray-300 px-4 py-2"><?php echo $restaurant['last_updated']; ?></td>
                        <td class="border border-gray-300 px-4 py-2">
                            <a href="view.php?id=<?php echo $restaurant['babershop_id']; ?>" class="bg-teal-500 text-black py-1 px-2 rounded hover:bg-teal-400">View</a>
                            <a href="edit.php?id=<?php echo $restaurant['babershop_id']; ?>" class="bg-yellow-500 text-white py-1 px-2 rounded hover:bg-yellow-400">Edit</a>
                            <a href="delete.php?id=<?php echo $restaurant['babershop_id']; ?>" class="bg-red-600 text-white py-1 px-2 rounded hover:bg-red-500" onclick="return confirm('Are you sure you want to delete this restaurant?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
