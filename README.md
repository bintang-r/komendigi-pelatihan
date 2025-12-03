# 🍗 Memphis Fried Chicken (MFC) Ordering System

Aplikasi web sederhana berbasis PHP yang dikembangkan untuk mengelola pemesanan dan perhitungan total harga untuk menu Memphis Fried Chicken (MFC) berdasarkan lokasi cabang dan pilihan teknik penggorengan.

## ✨ Fitur Utama

- **Formulir Pemesanan:** Antarmuka yang mudah digunakan untuk memesan Dada Ayam, Paha Ayam, dan Nasi.
- **Perhitungan Harga Dinamis:** Menghitung total harga secara real-time berdasarkan:
  - **Lokasi Cabang:** Harga item disesuaikan (Cabang Cikarang memiliki harga yang berbeda).
  - **Teknik Penggorengan:** Harga ayam disesuaikan jika menggunakan teknik "Speed Fry".
- **Penyimpanan Data:** Menyimpan setiap transaksi pemesanan ke dalam file **`data.json`**.
- **Rekap Data:** Halaman terpisah (`datapesanan.php`) untuk menampilkan riwayat semua pesanan dalam format tabel Bootstrap.

## 🛠️ Instalasi dan Prasyarat

Untuk menjalankan aplikasi ini, Anda memerlukan lingkungan server lokal dengan dukungan PHP.

1.  **Web Server:** Pastikan Anda memiliki server lokal (seperti **XAMPP**, **WAMP**, atau **Laragon**) yang terinstal dan berjalan.
2.  **Penempatan File:** Pindahkan folder proyek ke direktori `htdocs` (untuk XAMPP) atau direktori root server lokal Anda.
3.  **Akses Aplikasi:** Buka browser dan akses aplikasi melalui URL berikut:
    ```
    http://localhost/SoalAyamGoreng/index.php
    ```

## ⚙️ Struktur Proyek

| File/Folder       | Deskripsi                                                                                                     |
| :---------------- | :------------------------------------------------------------------------------------------------------------ |
| `index.php`       | Halaman utama. Berisi formulir pemesanan dan logika perhitungan harga, serta proses penyimpanan data ke JSON. |
| `datapesanan.php` | Halaman rekap. Membaca dan menampilkan semua data pesanan dari `data.json` dalam format tabel Bootstrap.      |
| `data.json`       | File database non-relasional yang menyimpan riwayat semua transaksi pemesanan.                                |
| `bootstrap.css`   | Library Bootstrap 4 yang digunakan untuk _styling_ antarmuka.                                                 |
| `logo_mfc.JPG`    | Logo Memphis Fried Chicken (asumsi file gambar ada).                                                          |

## 📐 Logika Perhitungan Harga

Perhitungan harga mengikuti aturan bisnis (Business Rules) MFC:

| Item          | Harga Dasar (Bekasi, Karawang, Bogor) | Kenaikan Cikarang | Speed Fry (Hanya Ayam) |
| :------------ | :------------------------------------ | :---------------- | :--------------------- |
| **Dada Ayam** | Rp 11.000                             | + Rp 1.000        | + Rp 3.000             |
| **Paha Ayam** | Rp 8.000                              | + Rp 1.000        | + Rp 3.000             |
| **Nasi**      | Rp 5.000                              | + Rp 1.000        | Tidak Berpengaruh      |

**Contoh Perhitungan:**

- Pesan Dada Ayam (1 pcs) di **Cikarang** dengan **Speed Fry**:
  - Rp 11.000 (Dasar) + Rp 1.000 (Cikarang) + Rp 3.000 (Speed Fry) = **Rp 15.000**
