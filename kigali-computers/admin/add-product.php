<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) { header('Location: login.php'); exit; }

$productsFile = '../products.json';
$products = json_decode(file_get_contents($productsFile), true) ?? [];

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $price = (float)$_POST['price'] ?? 0;
    $stock = (int)$_POST['stock'] ?? 0;
    $image = '';

    if (empty($name) || $price <= 0) {
        $error = 'Name and price required.';
    } else {
        if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
            $targetDir = "../assets/images/products/";
            $imageName = time() . '_' . basename($_FILES["image"]["name"]);
            $targetFile = $targetDir . $imageName;

            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                $image = $imageName;
            } else {
                $error = 'Image upload failed.';
            }
        }

        if (!$error) {
            $products[] = [
                'name' => $name,
                'price' => $price,
                'stock' => $stock,
                'image' => $image
            ];

            if (file_put_contents($productsFile, json_encode($products, JSON_PRETTY_PRINT))) {
                $success = 'Product added!';
            } else {
                $error = 'Save failed.';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-gray-950 to-indigo-950 min-h-screen text-white p-8">
    <div class="max-w-4xl mx-auto bg-gray-900/80 p-10 rounded-2xl border border-indigo-500/30 shadow-2xl">
        <h1 class="text-4xl font-bold mb-8 text-center">Add New Product</h1>
        <?php if ($success): ?>
            <p class="text-green-400 text-center mb-6 font-bold"><?= $success ?></p>
        <?php endif; ?>
        <?php if ($error): ?>
            <p class="text-red-400 text-center mb-6 font-bold"><?= $error ?></p>
        <?php endif; ?>
        <form method="post" enctype="multipart/form-data" class="space-y-6">
            <input type="text" name="name" placeholder="Product Name" required class="w-full p-4 bg-gray-800 rounded-lg">
            <input type="number" name="price" placeholder="Price (RWF)" required class="w-full p-4 bg-gray-800 rounded-lg">
            <input type="number" name="stock" placeholder="Stock Quantity" required class="w-full p-4 bg-gray-800 rounded-lg">
            <input type="file" name="image" accept="image/*" class="w-full p-4 bg-gray-800 rounded-lg text-gray-400">
            <button type="submit" class="w-full bg-green-600 py-4 rounded-xl font-bold hover:bg-green-700">Add Product</button>
        </form>
        <a href="dashboard.php" class="mt-8 block text-center text-indigo-400 hover:text-indigo-300">Back to Dashboard</a>
    </div>
</body>
</html>