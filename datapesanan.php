<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Memphis Fried Chicken | Data Pesanan</title>
    <link rel="stylesheet" href="./bootstrap.css">

</head>

<body>
    <div class="container my-5">
        <h2 class="text-center mb-4">📝 Rekap Data Pesanan Memphis Fried Chicken</h2>
        <hr>

        <?php
        $berkas = "data.json"; // nama file berkas

        // 1. Cek apakah file JSON ada
        if (!file_exists($berkas) || filesize($berkas) == 0) {
            echo '<div class="alert alert-warning text-center" role="alert">';
            echo 'Belum ada data pesanan yang tersimpan.';
            echo '</div>';
        } else {
            // 2. Baca dan Dekode data
            $dataJson = file_get_contents($berkas);
            $semuaPesanan = json_decode($dataJson, true);

            // 3. Pastikan hasil decode adalah array dan tidak kosong
            if (is_array($semuaPesanan) && count($semuaPesanan) > 0) {

                // Fungsi untuk memformat harga
                function formatRupiah($angka)
                {
                    return 'Rp ' . number_format($angka, 0, ',', '.');
                }

                echo '<div class="table-responsive">';
                echo '<table class="table table-bordered table-striped table-hover">';

                // --- HEADER TABEL ---
                echo '<thead class="thead-dark">';
                echo '<tr>';
                echo '<th>#</th>';
                echo '<th>Cabang</th>';
                echo '<th>Speed Fry</th>';
                echo '<th>Dada (Jml/Hrg Satuan/Total)</th>';
                echo '<th>Paha (Jml/Hrg Satuan/Total)</th>';
                echo '<th>Nasi (Jml/Hrg Satuan/Total)</th>';
                echo '<th>TOTAL HARGA</th>';
                echo '</tr>';
                echo '</thead>';

                // --- BODY TABEL ---
                echo '<tbody>';
                $nomor = 1;
                $grandTotal = 0;

                foreach ($semuaPesanan as $pesanan) {
                    $speedfryStatus = ($pesanan['speedfry'] == 1) ? 'Ya' : 'Tidak/Reguler';
                    $classSpeedFry = ($pesanan['speedfry'] == 1) ? 'text-danger font-weight-bold' : '';

                    echo '<tr>';
                    echo '<td>' . $nomor++ . '</td>';
                    echo '<td>' . $pesanan['cabang'] . '</td>';
                    echo '<td class="' . $classSpeedFry . '">' . $speedfryStatus . '</td>';

                    // Dada
                    echo '<td>';
                    echo 'Jml: <strong>' . $pesanan['dada'] . '</strong><br>';
                    echo 'Hrg Satuan: ' . formatRupiah($pesanan['hrgDada']) . '<br>';
                    echo 'Total: <strong>' . formatRupiah($pesanan['totDada']) . '</strong>';
                    echo '</td>';

                    // Paha
                    echo '<td>';
                    echo 'Jml: <strong>' . $pesanan['paha'] . '</strong><br>';
                    echo 'Hrg Satuan: ' . formatRupiah($pesanan['hrgPaha']) . '<br>';
                    echo 'Total: <strong>' . formatRupiah($pesanan['totPaha']) . '</strong>';
                    echo '</td>';

                    // Nasi
                    echo '<td>';
                    echo 'Jml: <strong>' . $pesanan['nasi'] . '</strong><br>';
                    echo 'Hrg Satuan: ' . formatRupiah($pesanan['hrgNasi']) . '<br>';
                    echo 'Total: <strong>' . formatRupiah($pesanan['totNasi']) . '</strong>';
                    echo '</td>';

                    // Total Keseluruhan Pesanan
                    echo '<td class="table-info font-weight-bold">';
                    echo formatRupiah($pesanan['totalHarga']);
                    echo '</td>';

                    echo '</tr>';

                    $grandTotal += $pesanan['totalHarga'];
                }
                echo '</tbody>';

                // --- FOOTER TABEL (Grand Total) ---
                echo '<tfoot>';
                echo '<tr class="bg-dark text-white">';
                echo '<td colspan="6" class="text-right"><strong>GRAND TOTAL KESELURUHAN</strong></td>';
                echo '<td><strong>' . formatRupiah($grandTotal) . '</strong></td>';
                echo '</tr>';
                echo '</tfoot>';

                echo '</table>';
                echo '</div>'; // close table-responsive

            } else {
                // Jika decode gagal atau array kosong
                echo '<div class="alert alert-danger text-center" role="alert">';
                echo 'Gagal memuat data pesanan. File data.json mungkin rusak atau kosong.';
                echo '</div>';
            }
        }
        ?>

        <p class="mt-4 text-center"><a href="index.php" class="btn btn-secondary">Kembali ke Form Pemesanan</a></p>
    </div>

</body>

</html>