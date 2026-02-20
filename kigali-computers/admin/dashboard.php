<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) { header('Location: login.php'); exit; }

$productsFile = '../products.json';
$products = json_decode(file_get_contents($productsFile), true) ?? [];

if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    if (isset($products[$id])) {
        if ($products[$id]['image']) @unlink("../assets/images/products/" . $products[$id]['image']);
        array_splice($products, $id, 1);
        file_put_contents($productsFile, json_encode($products, JSON_PRETTY_PRINT));
    }
    header('Location: dashboard.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-gray-950 via-indigo-950 to-gray-950 min-h-screen text-white p-8">
    <div class="max-w-7xl mx-auto">
        <header class="flex justify-between items-center mb-16">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 bg-gradient-to-br from-indigo-600 to-blue-600 rounded-2xl flex items-center justify-center text-4xl font-bold shadow-lg">KC</div>
                <h1 class="text-4xl font-bold">Admin Dashboard</h1>
            </div>
            <div class="space-x-4">
                <a href="add-product.php" class="bg-green-600 hover:bg-green-700 px-6 py-4 rounded-full font-bold transition shadow-md">Add Product</a>
                <a href="logout.php" class="bg-red-600 hover:bg-red-700 px-6 py-4 rounded-full font-bold transition shadow-md">Logout</a>
            </div>
        </header>

        <h2 class="text-3xl font-bold mb-8">Products List</h2>

        <?php if ($products): ?>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <?php foreach ($products as $id => $p): ?>
                    <div class="bg-gray-900/80 rounded-2xl overflow-hidden border border-gray-800 shadow-lg">
                        <img src="../assets/images/products/<?= $p['image'] ?: 'https://via.placeholder.com/400' ?>" alt="<?= htmlspecialchars($p['name']) ?>" class="w-full h-64 object-cover">
                        <div class="p-6">
                            <h3 class="text-xl font-bold mb-2"><?= htmlspecialchars($p['name']) ?></h3>
                            <p class="text-3xl font-bold text-indigo-400 mb-2">RWF <?= number_format($p['price']) ?></p>
                            <p class="text-green-400 mb-6">Stock: <?= $p['stock'] ?></p>
                            <a href="?delete=<?= $id ?>" onclick="return confirm('Delete this product?')" class="block bg-red-600 hover:bg-red-700 py-3 rounded-full text-center font-bold transition">
                                Delete
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="text-center text-2xl text-gray-400 py-20">No products yet. Add some!</p>
        <?php endif; ?>
    </div>
</body>
</html>