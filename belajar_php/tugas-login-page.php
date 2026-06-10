<?php

$username = '';
$password = '';
$error = '';
$msg = ''; // menambahkan variabel message

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // =============================================
    // TUGAS 1: Tambahkan validasi di sini
    // - Jika username atau password kosong, tampilkan pesan error
    // - Jika username = "admin" dan password = "12345", tampilkan pesan sukses
    // - Jika salah, tampilkan pesan "Username atau password salah!"
    // =============================================

    if ($username == NULL || $password == NULL) { // simbol || artinya 'OR' jadi cukup salah satu aja yg valid, NULL artinya kosong
        $error = 'Username atau password tidak boleh kosong woi!';
    } elseif ($username == 'admin' && $password == '12345') {
        $msg = 'Login sukses bang!';
    } else {
        $error = 'Username atau password salah!';
    }
}

?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Muhamad Alamsyah Ahlul Firdaus - Tugas Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="bg-white p-8 rounded-2xl shadow-lg max-w-sm w-full">
        <h1 class="text-xl font-semibold text-center mb-6">Login</h1>

        <!-- Buat login sukses  -->
        <?php if ($msg == 'Login sukses!'): ?> <!-- variabel message ada isinya, maka akan menampilkan isi msg    -->
            <p class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4 text-sm">
                <?= htmlspecialchars($msg) ?>
            </p>
        <?php endif; ?>

        <!-- Buat error -->
        <?php if ($error): ?> <!-- jika variabel error ada isinya, maka akan menampilkan pesan kesalahannya-->
            <p class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4 text-sm">
                <?= htmlspecialchars($error) ?>
            </p>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Username</label>
                <input
                    type="text"
                    name="username"
                    value="<?= htmlspecialchars($username) ?>"
                    class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Masukkan username">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Password</label>
                <input
                    type="password"
                    name="password"
                    class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Masukkan password">
            </div>

            <!-- ============================================= -->
            <!-- TUGAS 2: Tambahkan checkbox "Remember me"    -->
            <!-- di antara password dan tombol login di bawah  -->
            <!-- ============================================= -->

            <div class="flex items-center mb-4"> <!-- flex dan items-center biar checkbox dan label sejajar  -->
                <input type="checkbox" id="ingat-gweh" name="ingat-gweh" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 cursor-pointer">
                <label for="ingat-gweh" class="ml-2 text-sm text-gray-700 cursor-pointer"> <!-- cursor-pointer buat jadiin cursor pointer ketika mendekat ke objek -->
                    Remember me
                </label>
            </div>

            <button
                type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">
                Login
            </button>
        </form>
    </div>

</body>

</html>