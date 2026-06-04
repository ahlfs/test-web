<?php
$produk = [
    ["nama" => "Laptop", "kategori" => "Elektronik", "harga" => 8_500_000],
    ["nama" => "Meja Belajar", "kategori" => "Furnitur", "harga" => 750_000],
    ["nama" => "Headphone", "kategori" => "Aksesoris", "harga" => 350_000],
    ["nama" => "Smartphone", "kategori" => "Elektronik", "harga" => 5_500_000]
];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SHeesh lagi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="max-w-2xl mx-auto mt-10 px-4">
        <h1 class="text-xl font-semifold text-center mb-6">Daftar Produk</h1>
        <table class="w-full border-coallapse bg-white rounded-lg shadow overflow-hidden">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="px-4 py-3 text-left">No</th>
                    <th class="px-4 py-3 text-left">Nama Produk</th>
                    <th class="px-4 py-3 text-left">Kategori</th>
                    <th class="px-4 py-3 text-left">Harga</th>
                </tr>
            </thead>
            <tbody>
                </tbody>
                <?php foreach ($produk as $i => $item): ?>
                    <tr class="border-b even:bg-gray-50">
                        <td class="px-4 py-3"><?= $i + 1 ?></td>
                        <td class="px-4 py-3"><?= htmlspecialchars($item['nama']) ?></td>
                        <td class="px-4 py-3"><?= htmlspecialchars($item['kategori']) ?></td>
                        <td class="px-4 py-3 text-right"><?= number_format($item['harga']) ?></td>
                        
                    </tr>
                    <?php endforeach ?>
                </table>
            </tbody>
        </table>
    </div>
</body>
</html>