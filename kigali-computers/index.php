<?php
$products = json_decode(file_get_contents('products.json'), true) ?? [];
$whatsapp = "https://wa.me/250791641163";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kigali Computers - Tech & Spare Parts</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        .product-card {
            transition: all 0.3s ease;
        }
        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 30px rgba(99, 102, 241, 0.2);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-950 via-indigo-950 to-gray-950 min-h-screen text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Header -->
        <header class="flex flex-col sm:flex-row justify-between items-center mb-16 gap-6">
            <div class="flex items-center gap-4">
                <div class="w-20 h-20 bg-gradient-to-br from-indigo-600 to-blue-600 rounded-3xl flex items-center justify-center text-white font-extrabold text-4xl shadow-2xl">
                    KC
                </div>
                <h1 class="text-4xl sm:text-5xl font-extrabold">Kigali Computers</h1>
            </div>
            <a href="<?= $whatsapp ?>" class="bg-green-600 hover:bg-green-700 px-8 py-4 rounded-full font-bold flex items-center gap-3 transition shadow-lg">
                <i class="fab fa-whatsapp text-2xl"></i> Contact Us
            </a>
        </header>

        <!-- Hero -->
        <div class="text-center mb-20">
            <h2 class="text-5xl sm:text-6xl font-extrabold mb-6 bg-gradient-to-r from-indigo-300 to-purple-300 bg-clip-text text-transparent">
                Welcome to Kigali Computers
            </h2>
            <p class="text-xl sm:text-2xl text-gray-300 max-w-4xl mx-auto">
                Your trusted source for laptops, spare parts, electronics, and accessories in Kigali.
            </p>
        </div>

        <!-- Products Section -->
        <section>
            <h3 class="text-4xl font-bold text-center mb-12">Our Products</h3>

            <?php if ($products): ?>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                    <?php foreach ($products as $p): ?>
                        <div class="bg-gray-900/90 backdrop-blur-lg rounded-2xl overflow-hidden border border-indigo-500/30 shadow-xl product-card">
                            <img src="assets/images/products/<?= $p['image'] ?? 'https://via.placeholder.com/400?text=Product' ?>" alt="<?= htmlspecialchars($p['name']) ?>" class="w-full h-64 object-cover">
                            <div class="p-6">
                                <h4 class="font-bold text-xl mb-2 line-clamp-1" title="<?= htmlspecialchars($p['name']) ?>">
                                    <?= htmlspecialchars($p['name']) ?>
                                </h4>
                                <p class="text-3xl font-bold text-indigo-400 mb-3">
                                    RWF <?= number_format($p['price']) ?>
                                </p>
                                <p class="text-green-400 mb-6 font-medium">
                                    <?= $p['stock'] ?> in stock
                                </p>
                                <a href="<?= $whatsapp ?>?text=<?= urlencode("Muraho! Ndashaka kugura " . $p['name']) ?>" class="block bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 py-3 rounded-xl text-center font-bold transition">
                                    Buy on WhatsApp
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="text-center py-32">
                    <i class="fas fa-box-open text-9xl text-gray-700 mb-10"></i>
                    <p class="text-4xl font-bold mb-6">No products yet</p>
                    <p class="text-xl text-gray-400 mb-10">Login to the admin panel to add products</p>
                    <a href="admin/login.php" class="inline-block bg-indigo-600 hover:bg-indigo-700 px-12 py-6 rounded-full text-2xl font-bold transition shadow-lg">
                        Open Admin Panel
                    </a>
                </div>
            <?php endif; ?>
        </section>

        <!-- Footer -->
        <footer class="text-center mt-24 py-12 text-gray-500 border-t border-gray-800">
            <p>© <?= date('Y') ?> Kigali Computers Ltd. All Rights Reserved.</p>
            <p class="mt-3">+250 791 641 163</p>
        </footer>
    </div>

    <!-- Floating WhatsApp -->
    <a href="<?= $whatsapp ?>" class="fixed bottom-10 right-10 bg-green-600 hover:bg-green-700 text-white p-6 rounded-full shadow-2xl z-50 transition transform hover:scale-110">
        <i class="fab fa-whatsapp text-4xl"></i>
    </a>
</body>
</html>