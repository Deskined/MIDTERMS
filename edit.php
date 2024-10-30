<?php
require 'db.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: /login/login.php');
    exit;
}

$babershop_id = '';
$name = '';
$address = '';
$phone = '';
$email = '';
$added_by = $_SESSION['user_id'];

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM restaurants WHERE babershop_id = ?");
    $stmt->execute([$id]);
    $restaurant = $stmt->fetch();

    $babershop_id = $restaurant['babershop_id'];
    $name = $restaurant['name'];
    $address = $restaurant['address'];
    $phone = $restaurant['phone_number'];
    $email = $restaurant['email'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    if ($babershop_id) {
        $stmt = $pdo->prepare("UPDATE restaurants SET name = ?, address = ?, phone_number = ?, email = ? WHERE babershop_id = ?");
        $stmt->execute([$name, $address, $phone, $email, $babershop_id]);
    } else { 
        $stmt = $pdo->prepare("INSERT INTO restaurants (name, address, phone_number, email, added_by) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$name, $address, $phone, $email, $added_by]);
    }

    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $babershop_id ? 'Edit' : 'Add'; ?> GYM BRAND</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
<div class="container mx-auto mt-10 bg-white p-6 rounded-lg shadow-lg">
    <h1 class="text-3xl font-bold text-center text-gray-800 mb-6"><?php echo $babershop_id ? 'Edit' : 'Add'; ?> GYM BRAND</h1>

    <form method="POST" action="">
        <div class="mb-4">
            <label for="name" class="block text-gray-700">Name</label>
            <input type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" id="name" name="name" value="<?php echo $name; ?>" required>
        </div>
        <div class="mb-4">
            <label for="address" class="block text-gray-700">Address</label>
            <input type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" id="address" name="address" value="<?php echo $address; ?>" required>
        </div>
        <div class="mb-4">
            <label for="phone" class="block text-gray-700">Phone</label>
            <input type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" id="phone" name="phone" value="<?php echo $phone; ?>" required>
        </div>
        <div class="mb-4">
            <label for="email" class="block text-gray-700">Email</label>
            <input type="email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" id="email" name="email" value="<?php echo $email; ?>" required>
        </div>
        <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-500">Save</button>
        <a href="index.php" class="ml-4 bg-gray-600 text-white py-2 px-4 rounded hover:bg-gray-500">Cancel</a>
    </form>
</div>
</body>
</html>
