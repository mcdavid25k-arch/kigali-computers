<?php
session_start();
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    if ($username === 'admin' && $password === 'admin2025') {
        $_SESSION['admin_logged_in'] = true;
        header('Location: dashboard.php');
        exit;
    } else {
        $error = 'Incorrect username or password!';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kigali Computers - Admin Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-gray-950 via-indigo-950 to-gray-950 min-h-screen flex items-center justify-center text-white">
    <div class="w-full max-w-md p-12 bg-gray-900/90 backdrop-blur-2xl rounded-3xl border border-indigo-500/30 shadow-2xl">
        <div class="flex justify-center mb-10">
            <div class="w-24 h-24 bg-gradient-to-br from-indigo-600 to-blue-600 rounded-full flex items-center justify-center text-5xl font-extrabold shadow-2xl transform hover:rotate-6 transition-transform duration-500">
                KC
            </div>
        </div>
        <h1 class="text-5xl font-extrabold text-center mb-3 tracking-tight bg-gradient-to-r from-indigo-300 to-purple-300 bg-clip-text text-transparent">
            Kigali Computers
        </h1>
        <p class="text-center text-gray-400 text-xl mb-12">Admin Portal</p>
        <?php if ($error): ?>
            <p class="text-red-400 text-center mb-8 bg-red-950/50 p-4 rounded-xl border border-red-500/30"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
        <form method="post" class="space-y-8">
            <input type="text" name="username" placeholder="Username" required class="w-full p-5 bg-gray-800/70 border border-gray-700 rounded-2xl text-white placeholder-gray-400 focus:outline-none focus:border-indigo-500 transition">
            <input type="password" name="password" placeholder="Password" required class="w-full p-5 bg-gray-800/70 border border-gray-700 rounded-2xl text-white placeholder-gray-400 focus:outline-none focus:border-indigo-500 transition">
            <button type="submit" class="w-full py-5 bg-gradient-to-r from-indigo-600 via-purple-600 to-indigo-600 hover:from-indigo-700 hover:via-purple-700 hover:to-indigo-700 text-white font-bold text-lg rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300">
                Secure Login
            </button>
        </form>
        <p class="text-center text-gray-500 text-sm mt-12">
            © 2024 Kigali Computers Ltd. All Rights Reserved.
        </p>
    </div>
</body>
</html>