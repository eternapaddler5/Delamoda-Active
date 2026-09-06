<?php
session_start();
require '../includes/db.php';

$adminCheck = $pdo->query("SELECT COUNT(*) FROM users WHERE role IN ('admin', 'super_admin')")->fetchColumn();
$isFirstTimeSetup = ($adminCheck == 0);

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if ($isFirstTimeSetup) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO users (email, password_hash, role) VALUES (?, ?, 'super_admin')");
        $stmt->execute([$email, $hash]);

        $_SESSION['admin_logged_in'] = true;
        header("Location: index.php");
        exit;
    } else {
        $stmt = $pdo->prepare("SELECT id, password_hash FROM users WHERE email = ? AND role IN ('admin', 'super_admin')");
        $stmt->execute([$email]);
        $admin = $stmt->fetch();

        if ($admin && password_verify($password, $admin['password_hash'])) {
            $_SESSION['admin_logged_in'] = true;
            header("Location: index.php");
            exit;
        } else {
            $error = "Invalid email or password.";
        }
    }
}

$adminTitle = 'Login';
require 'includes/admin-head.php';
?>
<body class="bg-zinc-950 antialiased text-white min-h-screen relative overflow-x-hidden overflow-y-auto">
    <img src="../assets/images/IMG-20260902-WA0076.jpg" alt="" class="fixed inset-0 w-full h-full object-cover opacity-15 pointer-events-none" aria-hidden="true">
    <div class="fixed inset-0 bg-gradient-to-br from-zinc-950 via-zinc-950/95 to-rose-950/30 pointer-events-none" aria-hidden="true"></div>

    <div class="relative z-10 min-h-screen flex flex-col justify-center py-10 px-4 sm:py-16">
        <div class="w-full max-w-md mx-auto">
        <div class="text-center mb-8">
            <img src="../assets/images/IMG-20260902-WA0086.jpg" alt="Delamoda Active" class="h-16 w-16 object-contain mx-auto mb-4">
            <h1 class="font-display text-3xl font-bold uppercase tracking-widest">Delamoda</h1>
            <p class="text-rose-500 text-xs font-bold uppercase tracking-[0.35em] mt-1">Admin Portal</p>
        </div>

        <div class="bg-zinc-900/80 backdrop-blur border border-zinc-800 p-8 sm:p-10">
            <p class="text-zinc-400 text-xs font-bold uppercase tracking-wider text-center mb-8">
                <?= $isFirstTimeSetup ? 'Create your master admin account' : 'Sign in to manage your store' ?>
            </p>

            <?php if ($error): ?>
                <div class="bg-rose-600/20 border border-rose-600 text-rose-400 text-xs font-bold uppercase p-3 mb-6 text-center">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <form method="POST" class="space-y-5">
                <div>
                    <label class="block text-xs font-bold uppercase mb-2 text-zinc-500 tracking-wider">Email</label>
                    <input type="email" name="email" required class="w-full p-4 bg-zinc-950 border border-zinc-800 text-white focus:outline-none focus:border-rose-600 transition-colors">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase mb-2 text-zinc-500 tracking-wider">Password</label>
                    <input type="password" name="password" required class="w-full p-4 bg-zinc-950 border border-zinc-800 text-white focus:outline-none focus:border-rose-600 transition-colors">
                </div>
                <button type="submit" class="w-full bg-rose-600 text-white py-4 font-bold uppercase tracking-widest hover:bg-rose-700 transition-colors mt-2">
                    <?= $isFirstTimeSetup ? 'Create Account' : 'Sign In' ?>
                </button>
            </form>
        </div>

        <p class="text-center mt-6">
            <a href="../index.php" class="text-xs text-zinc-600 hover:text-zinc-400 uppercase tracking-wider transition-colors">&larr; Back to Store</a>
        </p>
        </div>
    </div>
</body>
</html>
