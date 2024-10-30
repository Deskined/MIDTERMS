<?php
require 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    
    $stmt = $pdo->prepare("SELECT * FROM restaurants WHERE babershop_id = ?");
    $stmt->execute([$id]);
    $restaurant = $stmt->fetch();

    if (!$restaurant) {
        echo "Restaurant not found!";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Restaurant</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
<div class="container mx-auto mt-10 bg-white p-6 rounded-lg shadow-lg">
    <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">GYM BRAND Details</h1>
    <table class="min-w-full border-collapse border border-gray-300">
        <tbody>
            <tr>
                <th class="border border-gray-300 px-4 py-2 text-left bg-gray-800 text-white">Name:</th>
                <td class="border border-gray-300 px-4 py-2"><?php echo $restaurant['name']; ?></td>
            </tr>
            <tr>
                <th class="border border-gray-300 px-4 py-2 text-left bg-gray-800 text-white">Address:</th>
                <td class="border border-gray-300 px-4 py-2"><?php echo $restaurant['address']; ?></td>
            </tr>
            <tr>
                <th class="border border-gray-300 px-4 py-2 text-left bg-gray-800 text-white">Phone:</th>
                <td class="border border-gray-300 px-4 py-2"><?php echo $restaurant['phone_number']; ?></td>
            </tr>
            <tr>
                <th class="border border-gray-300 px-4 py-2 text-left bg-gray-800 text-white">Email:</th>
                <td class="border border-gray-300 px-4 py-2"><?php echo $restaurant['email']; ?></td>
            </tr>
        </tbody>
    </table>
    <a href="index.php" class="mt-4 inline-block bg-gray-600 text-white py-2 px-4 rounded hover:bg-gray-500">Back</a>
</div>
</body>
</html>
