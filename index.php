<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="./bootstrap.css">
	<title>Memphis Fried Chicken</title>
</head>

<body>
	<?php
	//Definisikan array berisi lokasi cabang di sini, sesuai INSTRUKSI KERJA #3
	$lokasiCabang = ["Cikarang", "Bekasi", "Karawang", "Bogor"];

	//Urutkan array yang telah didefinisikan di atas di sini, sesuai INSTRUKSI KERJA #4
	sort($lokasiCabang);

	?>

	<div class="container border">
		<img src="logo_mfc.JPG" alt="Logo Memphis Fried Chicken" class="img-fluid d-block my-3" style="max-width: 300px;">

		<h2>Form Pemesanan</h2>

		<br>
		<form action="index.php" method="post" id="formPerhitungan">
			<div class="row">
				<div class="col-lg-5">
					<label for="cabang">Pilih Cabang:</label>
				</div>

				<div class="col-lg-5">
					<select class="form-control mb-1" id="cabang" name="cabang">
						<option value="">- pilih cabang -</option>
						<?php
						// 5. Tampilkan isi array cabang sebagai pilihan dropdown
						foreach ($lokasiCabang as $cabang) {
							echo "<option value='$cabang'>$cabang</option>";
						}
						?>
					</select>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-5">
					<label for="dada">Jumlah Dada Ayam:</label>
				</div>

				<div class="col-lg-5 mb-1">
					<input type="number" class="form-control" id="dada" name="dada" value="0" min="0">
				</div>

			</div>

			<div class="row">
				<div class="col-lg-5">
					<label for="paha">Jumlah Paha Ayam:</label>
				</div>
				<div class="col-lg-5 mb-1">
					<input type="number" class="form-control" id="paha" name="paha" value="0" min="0">
				</div>
			</div>

			<div class="row">
				<div class="col-lg-5">
					<label for="nasi">Jumlah Nasi:</label>
				</div>
				<div class="col-lg-5 mb-1">
					<input type="number" class="form-control" id="nasi" name="nasi" value="0" min="0">
				</div>
			</div>

			<div class="row mt-1">
				<div class="col-lg-5">
					<label>Teknik Menggoreng:</label>
				</div>
				<div class="col-lg-5 ">
					<div class="d-block">
						<div class="form-check mr-3">
							<label class="form-check-label" for="reguler">
								<input class="form-check-input" type="radio" name="speedfry" id="reguler" value="0" checked>
								Reguler
							</label>
						</div>

						<div class="form-check">
							<label class="form-check-label" for="speedfry">
								<input class="form-check-input" type="radio" name="speedfry" id="speedfry" value="1">
								Speed Fry
							</label>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-5">
					<button type="submit" class="btn btn-primary mt-3" name="hitung">Hitung Total Harga</button>
					<a class="btn btn-success mt-3" href="./datapesanan.php">Lihat Daftar Pesanan</a>
				</div>
			</div>
		</form>
	</div>

	<?php

	if (isset($_POST['hitung'])) {

		//! mengambil data pesanan dari form

		$dataPesanan = [
			'cabang' => $_POST['cabang'],
			'dada' => $_POST['dada'],
			'paha' => $_POST['paha'],
			'nasi' => $_POST['nasi'],
			'speedfry' => $_POST['speedfry']
		];

		//! Simpan jumlah masing-masing item yang dipesan dalam variabel-variabel yang telah ditentukan di sini, sesuai INSTRUKSI KERJA #6

		$jmlDada = $dataPesanan['dada'];
		$jmlPaha = $dataPesanan['paha'];
		$jmlNasi = $dataPesanan['nasi'];

		//! Simpan cabang yang dipilih dalam variabel yang telah ditentukan di sini, sesuai INSTRUKSI KERJA #7

		$cabang = $dataPesanan['cabang'];

		//! Simpan pilihan cara menggoreng dalam variabel yang telah ditentukan di sini, sesuai INSTRUKSI KERJA #8

		$speedFry = ($dataPesanan['speedfry'] == 1);

		//! Gunakan pencabangan untuk menentukan harga satuan per item di sini, sesuai INSTRUKSI KERJA #9

		// default adalah 0 (harga yang akan ditampilkan setelah pembelian)
		$hrgDada = 0;
		$hrgPaha = 0;
		$hrgNasi = 0;

		// menentukan harga yang telah ditentukan 
		$hargaDasarDada = 11000;
		$hargaDasarPaha = 8000;
		$hargaDasarNasi = 5000;
		$tambahanSpeedFry = 3000;
		$tambahanCabangCikarang = 1000;
		$tambahanCabangBogor = 2000;

		// Menetapkan harga dasar
		if ($cabang == 'Cikarang') {
			$hrgDada += $hargaDasarDada + $tambahanCabangCikarang;
			$hrgPaha += $hargaDasarPaha + $tambahanCabangCikarang;
			$hrgNasi += $hargaDasarNasi + $tambahanCabangCikarang;
		} elseif ($cabang == "Bogor") {
			$hrgDada += $hargaDasarDada + $tambahanCabangBogor;
			$hrgPaha += $hargaDasarPaha + $tambahanCabangBogor;
			$hrgNasi += $hargaDasarNasi + $tambahanCabangBogor;
		} else {
			$hrgDada += $hargaDasarDada;
			$hrgPaha += $hargaDasarPaha;
			$hrgNasi += $hargaDasarNasi;
		}

		// Menambahkan harga jika ada tambahan Speed Fry (hanya untuk ayam: Dada dan Paha)
		if ($speedFry) {
			$hrgDada += $tambahanSpeedFry;
			$hrgPaha += $tambahanSpeedFry;
		}

		//! Implementasikan fungsi hitung_total_harga_item di sini, sesuai INSTRUKSI KERJA #10 
		function hitung_total_harga_item($hargaSatuan, $jumlahItem) //* parameter harga * satuan #a
		{
			return $hargaSatuan * $jumlahItem; //* #b
		}

		/* #c 
			*fungsi hitung_total_harga_item merupakan fungsi untuk menghitung 
			*total harga item dari harga yang telah ditentukan dikalikan dengan jumlah item yang dipesan
		*/

		//! Gunakan fungsi hitung_total_harga_item untuk menghitung total harga masing-masing item di sini, sesuai INSTRUKSI KERJA #11

		$totDada = hitung_total_harga_item($hrgDada, $jmlDada); // total dada * harga dada
		$totPaha = hitung_total_harga_item($hrgPaha, $jmlPaha); // total paha * harga paha
		$totNasi = hitung_total_harga_item($hrgNasi, $jmlNasi); // total nasi * harga nasi

		//! Hitung total harga semua item yang harus dibayar di sini, sesuai INSTRUKSI KERJA #12

		$totalHarga = $totDada + $totPaha + $totNasi;

		$dataPesanan['hrgDada'] = $hrgDada;
		$dataPesanan['hrgPaha'] = $hrgPaha;
		$dataPesanan['hrgNasi'] = $hrgNasi;
		$dataPesanan['totDada'] = $totDada;
		$dataPesanan['totPaha'] = $totPaha;
		$dataPesanan['totNasi'] = $totNasi;
		$dataPesanan['totalHarga'] = $totalHarga;

		//! Simpan data pemesanan ke dalam file JSON di sini, sesuai INSTRUKSI KERJA #13

		$berkas = "data.json"; // file berkas (tempat data disimpan pada json file)

		$arrayData = []; // data dari pesanan akan disimpan dalam array

		if (file_exists($berkas) && filesize($berkas) > 0) { // cek apakah file ada dan ukurannya lebih dari 0 dan apakah file ada atau tidak
			$dataLama = file_get_contents($berkas); // membaca isi file
			// mengubah data lama dari format JSON ke array asosiatif
			$arrayData = json_decode($dataLama, true); // ambil data lama dan decode ke array asosiatif
			// pastikan data yang diambil adalah array
			if (!is_array($arrayData)) {
				$arrayData = [];
			}
		}

		// menambahkan data pesanan baru ke array data
		$arrayData[] = $dataPesanan;
		$dataJson = json_encode($arrayData, JSON_PRETTY_PRINT);
		// buat data json jika belum ada dengan menulis data ke file
		file_put_contents($berkas, $dataJson);

		// Fungsi untuk memformat angka ke dalam format Rupiah di sini, sesuai INSTRUKSI KERJA #14
		function formatRupiah($angka)
		{
			return number_format($angka, 0, ',', '.');
		}

		//!	Menampilkan data pemesanan.
		//!  KODE DI BAWAH INI TIDAK PERLU DIMODIFIKASI!!!
		echo "
		<br/>

		<div class='container'>
		<div class='row'>

		<div class='col-lg-5'>Cabang:</div>
			<div class='col-lg-5'>" . $cabang . " </div>
		</div>
		<div class='row'>

		<div class='col-lg-5'>Menggunakan teknik speed fry:</div>
			<div class='col-lg-5'>" . ($speedFry ? 'Ya' : 'Tidak') . "</div>
		</div>
        <br>
		<div class='row'>

		<div class='col-lg-5'>Jumlah Dada Ayam:</div>
			<div class='col-lg-5'>" . $jmlDada . "</div>
		</div>
		<div class='row'>

		<div class='col-lg-5'>Harga Satuan Dada Ayam:</div>
			<div class='col-lg-5'>Rp " . formatRupiah($hrgDada) . "</div>
		</div>
		<div class='row'>

		<div class='col-lg-5'>Total Harga Dada Ayam:</div>
			<div class='col-lg-5'>Rp " . formatRupiah($totDada) . "</div>
		</div>
        <br>
		<div class='row'>

		<div class='col-lg-5'>Jumlah Paha Ayam:</div>
			<div class='col-lg-5'>" . $jmlPaha . "</div>
		</div>
		<div class='row'>

		<div class='col-lg-5'>Harga Satuan Paha Ayam:</div>
			<div class='col-lg-5'>Rp " . formatRupiah($hrgPaha) . "</div>
		</div>
		<div class='row'>

		<div class='col-lg-5'>Total Harga Paha Ayam:</div>
			<div class='col-lg-5'>Rp " . formatRupiah($totPaha) . "</div>
		</div>
        <br>

		<div class='row'>
		<div class='col-lg-5'>Jumlah Nasi:</div>
			<div class='col-lg-5'>" . $jmlNasi . "</div>
		</div>
		<div class='row'>

		<div class='col-lg-5'>Harga Satuan Nasi:</div>
			<div class='col-lg-5'>Rp " . formatRupiah($hrgNasi) . "</div>
		</div>
		<div class='row'>

		<div class='col-lg-5'>Total Harga Nasi:</div>
			<div class='col-lg-5'>Rp " . formatRupiah($totNasi) . "</div>
		</div>

        <br>

		<div class='row'>

		<div class='col-lg-5'>Total Harga Keseluruhan:</div>
			<div class='col-lg-5'>Rp " . formatRupiah($totalHarga) . " </div>
		</div>

		<br>
		";
	}
	?>

</body>

</html>