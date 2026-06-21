<?php
function hitungNisab(float $hargaEmas) {
    return $hargaEmas * 85;
}

function hitungKekayaanBersih(float $tabungan, float $investasi, float $emas, float $hutang) {
    $totalAset = $tabungan + $investasi + $emas;
    return $totalAset - $hutang;
}

function hitungZakatMal(float $kekayaanBersih, float $nisab) {
    if ($kekayaanBersih >= $nisab) {
        return $kekayaanBersih * 0.025; // zakat mal 2.5% dari kekayaan bersih
    }
    return 0.0;
}

// deklarasi variabel yang dibutuhkan
$hargaEmas = 2429499; // harga emas sekarang dari https://harga-emas.org/
$tabungan = null;
$investasi = null;
$emas = null;
$hutang = null;
$error = '';
$perhitungan = false;

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $perhitungan = true;
    $tabungan = isset($_POST['tabungan']) && $_POST['tabungan'] !== '' ? (float)$_POST['tabungan'] : 0.0;
    $investasi = isset($_POST['investasi']) && $_POST['investasi'] !== '' ? (float)$_POST['investasi'] : 0.0;
    $emas = isset($_POST['emas']) && $_POST['emas'] !== '' ? (float)$_POST['emas'] : 0.0;
    $hutang = isset($_POST['hutang']) && $_POST['hutang'] !== '' ? (float)$_POST['hutang'] : 0.0;

    // nilai tidak boleh negatif
    if ($tabungan < 0 || $investasi < 0 || $emas < 0 || $hutang < 0) {
        $error = 'Nilai harta atau hutang tidak boleh bernilai negatif!';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kalkulator Zakat Mal</title>
</head>
<body>

    <h1>Kalkulator Zakat Mal</h1>
   
    <hr>

    <h2>Masukan Nilai Harta Anda</h2>
    <form method="POST" action="">
        <table border="0" cellpadding="5">

            <tr>
                <td><label for="tabungan">Asset Mata Uang (Uang Tunai / Tabungan / Deposito)</label></td>
                <td>Rp. <input type="number" name="tabungan" id="tabungan" min="0" step="any" value="<?php echo $perhitungan ? htmlspecialchars($tabungan) : 0; ?>" placeholder="0"></td> <!-- step="any" digunakan agar inputan bisa berupa desimal -->
                <td></td>
            </tr>
            <tr>
                <td><label for="investasi">Asset Investasi (Saham / Reksadana / Crypto)</label></td>
                <td>Rp. <input type="number" name="investasi" id="investasi" min="0" step="any" value="<?php echo $perhitungan ? htmlspecialchars($investasi) : 0; ?>" placeholder="0"></td>
                <td></td>
            </tr>
            <tr>
                <td><label for="emas">Asset Logam Mulia (Emas / Perak)</label></td>
                <td>Rp. <input type="number" name="emas" id="emas" min="0" step="any" value="<?php echo $perhitungan ? htmlspecialchars($emas) : 0; ?>" placeholder="0"></td>
                <td></td>
            </tr>

            <tr>
                <td><label for="hutang">Hutang</label></td>
                <td>Rp. <input type="number" name="hutang" id="hutang" min="0" step="any" value="<?php echo $perhitungan ? htmlspecialchars($hutang) : 0; ?>" placeholder="0"></td>
            </tr>
            <tr>
                <td></td>
                <td colspan="2">
                    <button type="submit">Hitung Zakat</button>
                </td>
            </tr>
        </table>
    </form>

    <hr>

    <?php if ($perhitungan === true): ?> <!-- ketika perhitungan bernilai true maka tampilkan hasil perhitungan -->
        <h2>Hasil Perhitungan</h2>

        <?php if ($error !== ''): ?> <!-- jika perhitungan menampilkan error maka tampilkan error -->
            <p style="color: red;"><strong><?php echo htmlspecialchars($error); ?></strong></p>
        <?php else: ?>
            <?php
            $nisab = hitungNisab($hargaEmas);
            $kekayaanBersih = hitungKekayaanBersih($tabungan, $investasi, $emas, $hutang);
            $zakatMal = hitungZakatMal($kekayaanBersih, $nisab);
            $wajibZakat = $kekayaanBersih >= $nisab;
            ?>

            <table border="1" cellpadding="8" cellspacing="0">
                <thead>
                    <tr style="background-color: grey; color: white;">
                        <th>Keterangan</th>
                        <th>Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Harga Emas Sekarang (per Gram)</strong></td>
                        <td>Rp <?php echo number_format($hargaEmas, 2, ',', '.'); ?> (<a href="https://harga-emas.org/" target="_blank">harga-emas.org</a>)</td> <!-- number_format digunakan untuk memformat angka menjadi format mata uang -->
                    </tr>
                    <tr>
                        <td><strong>Batas Nisab (85 gram Emas)</strong></td>
                        <td>Rp <?php echo number_format($nisab, 2, ',', '.'); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Total Asset</strong></td>
                        <td>Rp <?php echo number_format($tabungan + $investasi + $emas, 2, ',', '.'); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Total Hutang</strong></td>
                        <td>Rp <?php echo number_format($hutang, 2, ',', '.'); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Kekayaan Bersih Wajib Zakat</strong></td>
                        <td><strong>Rp <?php echo number_format($kekayaanBersih, 2, ',', '.'); ?></strong></td>
                    </tr>
                    <tr>
                        <td><strong>Status Kewajiban Zakat</strong></td>
                        <td>
                            <?php if ($wajibZakat === true): ?> <!-- jika wajibZakat bernilai true maka tampilkan WAJIB ZAKAT -->
                                <strong style="color: green">WAJIB ZAKAT</strong> (Kekayaan bersih melebihi/sama dengan batas Nisab)
                            <?php else: ?> <!-- jika tidak maka tampilkan BELUM WAJIB ZAKAT -->
                                <strong style="color: red">BELUM WAJIB ZAKAT</strong> (Kekayaan bersih belum mencapai batas Nisab)
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr style="background-color: green; color: white">
                        <td><strong>Zakat yang Wajib Dikeluarkan (2,5%)</strong></td>
                        <td>
                            <strong>
                                Rp <?php echo number_format($zakatMal, 2, ',', '.'); ?>
                            </strong>
                        </td>
                    </tr>
                </tbody>
            </table>

        <?php endif; ?>
    <?php else: ?>
        <p>Silakan isi form di atas dan klik tombol Hitung Zakat untuk melihat hasil perhitungan.</p>
    <?php endif; ?>

</body>
</html>
