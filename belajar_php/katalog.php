<?php
$produk = [
    [
        "thumb" => "https://images.unsplash.com/photo-1496181133206-80ce9b88a853?w=400&h=300&fit=crop",
        "title" => "Laptop Pro 15",
        "desc"  => "Prosesor cepat, layar 15 inci, cocok untuk kerja dan kuliah.",
        "price" => 8_500_000,
    ],
    [
        "thumb" => "https://images.unsplash.com/photo-1540574163026-643ea20ade25?w=400&h=300&fit=crop",
        "title" => "Meja Belajar Kayu",
        "desc"  => "Meja minimalis dari kayu jati, kuat dan tahan lama.",
        "price" => 750_000,
    ],
    [
        "thumb" => "https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=400&h=300&fit=crop",
        "title" => "Headphone Wireless",
        "desc"  => "Suara jernih, noise cancelling, baterai tahan 30 jam.",
        "price" => 350_000,
    ]
];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>

    <body class="bg-gray-100 min-h-screen">
        <div class="max-w-5xl mx-auto py-10 px-4">
            <h1 class="text-2xl font-semibold text-center mb-8">Katalog Produk</h1>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($produk as $item): ?>
                    <div class="bg-white rounded-xl shadow overflow-hidden">
                        <img src="<?= $item['thumb'] ?>" alt="<?= htmlspecialchars($item['title']) ?>" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h2 class="font-semibold text-lg mb-1">
                                <?= htmlspecialchars($item['title']) ?>
                            </h2>
                            <p class="text-gray-600 text-sm mb-3">
                                <?= htmlspecialchars($item['desc']) ?>
                            </p>
                            <span class="text-blue-600 font-bold">
                                Rp <?= number_format($item['price'], 0, ',', '.') ?>
                            </span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </body>
</body>

</html>