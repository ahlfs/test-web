<?php
require_once 'vendor/autoload.php'; // library faker ada di folder vendor

$count = isset($_GET['count']) && $_GET['count'] !== '' ? (int)$_GET['count'] : null; // Jika data count gak ada atau gak ada isinya maka defaultnya null

if ($count !== null) {
    // Membatasi input minimal dan makismal
    if ($count < 1) $count = 1;
    if ($count > 100) $count = 100;
}

$faker = Faker\Factory::create('id_ID');  // Menggunakan data Faker dari Indonesia
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Generator Identitas Palsu </title>
</head>

<body>
    <h1>Generator Identitas Palsu</h1>

    <form method="GET" action="">
        <p>
            <label for="count">Jumlah Orang :</label>
            <input type="number" name="count" id="count" min="1" max="100" value="<?php echo htmlspecialchars($count); ?>"> <!-- value akan menampilkan jumlah orang yang ingin di-generate agar tidak ter-refresh ketika submit -->
        </p>
        <p>
            <button type="submit">OKE GAS</button>
        </p>
    </form>

    <hr>

    <?php if ($count !== null): ?>
        <h2>Daftar <?php echo htmlspecialchars($count); ?> Identitas Palsu</h2>
        <table border="1" cellpadding="8" cellspacing="0">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>Tanggal Lahir</th>
                    <th>Nomor Telepon</th>
                    <th>E-mail</th>
                    <th>Alamat</th>
                    <th>Pekerjaan & Perusahaan</th>
                </tr>
            </thead>
            <tbody>
                <?php for ($i = 1; $i <= $count; $i++): // Untuk melakukan perulangan sesuai input user
                    $gender = $faker->randomElement(['male', 'female']); // Memilih jenis kelaminnya secara random        
                    $name = $faker->name($gender); // Ambil nama berdasarkan gendernya
                ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo htmlspecialchars($name); ?></td>
                        <td><?php echo $gender === 'male' ? 'Laki-laki' : 'Perempuan'; ?></td> <!-- Kalau gender = male outputnya Laki-laki, kalau else maka outputnya Perempuan -->
                        <td><?php echo $faker->date('d-m-Y'); ?></td>
                        <td><?php echo htmlspecialchars($faker->phoneNumber); ?></td>
                        <td><?php echo htmlspecialchars($faker->safeEmail); ?></td>
                        <td><?php echo htmlspecialchars($faker->address); ?></td>
                        <td><?php echo htmlspecialchars($faker->jobTitle); ?> di <?php echo htmlspecialchars($faker->company); ?></td>
                    </tr>
                <?php endfor; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p style="color: red; font-weight: bold;">Silakan masukkan jumlah orang yang ingin di-generate!</p>
    <?php endif; ?>

</body>

</html>