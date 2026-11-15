# Laporan Praktikum 7: Pemrograman Server-Side dengan PHP
**Nama:** Lucky Danang Aryeswara  
**NIM:** 312510482  
**Mata Kuliah:** Pemrograman Web    
**Topik:** Pemrograman Server-Side dengan PHP

## A. Tujuan Praktikum
* Memahami perbedaan pemrosesan *client-side* dan *server-side*.
* Mengenali sintaks PHP dan menjalankan file PHP melalui server lokal.
* Menggunakan variabel, tipe data, operator, percabangan, perulangan, dan *function*.
* Menerima dan memproses data dari form HTML menggunakan metode `GET` dan `POST`.
* Melakukan validasi dan sanitasi input dasar sebelum data ditampilkan atau diproses.
* Membangun aplikasi sederhana yang menerima, memproses, dan menampilkan data pengguna.

## B. Perangkat yang Digunakan
* Laptop / PC
* Web Browser (Chrome / Edge / Firefox)
* Visual Studio Code (Code Editor)
* PHP Interpreter
* XAMPP / Laragon (Web Server Lokal Apache)

## C. Cara Menjalankan Server Lokal
1. Buka aplikasi **XAMPP Control Panel**, lalu klik tombol **Start** pada modul **Apache**.
2. Pastikan folder proyek `Lab7Web_PHP` sudah berada di dalam direktori `htdocs` (contoh: `C:\xampp\htdocs\Lab7Web_PHP`).
3. Buka web browser, lalu akses proyek melalui alamat URL: `http://localhost/Lab7Web_PHP/`.
4. Klik file latihan yang ingin dijalankan (misalnya `latihan1.php` atau `miniproject.php`).
5. **Catatan:** Jangan membuka file `.php` langsung melalui klik ganda di File Explorer, karena kode PHP membutuhkan web server untuk dapat dieksekusi.

## D. Struktur File Proyek
```text
Lab7Web_PHP/
├── latihan1.php      # Dasar penulisan sintaks dan eksekusi skrip PHP
├── latihan2.php      # Penggunaan variabel, operator aritmatika, dan percabangan
├── latihan3.php      # Perulangan foreach dan manipulasi array
├── latihan4.php      # Pembuatan dan pemanggilan function
├── latihan5.php      # Pemrosesan form HTML menggunakan metode GET
├── latihan6.php      # Pemrosesan form HTML menggunakan metode POST dan sanitasi
├── latihan7.php      # Pengolahan data transaksi sederhana dengan validasi angka
├── miniproject.php   # Aplikasi Formulir Data Mahasiswa dengan validasi server-side
└── README.md         # Dokumentasi laporan praktikum
```

## E. Hasil Pengujian Kasus Input (Valid & Tidak Valid)
Berikut adalah hasil pengujian validasi sisi server (*server-side validation*) pada aplikasi **Mini Project (Formulir Data Mahasiswa)**:

### 1. Kasus Input Valid
* **Kasus Valid 1 (Data Lengkap & Format Sesuai):**
  * **Input:** 
    * Nama: `Budi Santoso`
    * NIM: `312510482`
    * Program Studi: `Teknik Informatika`
    * Semester: `3`
    * Email: `budi.santoso@mhs.ac.id`
  * **Hasil:** Sistem berhasil melewati seluruh validasi tanpa ada pesan kesalahan. Data diproses dan ditampilkan kembali pada bagian *Ringkasan Data Mahasiswa* secara aman menggunakan fungsi `htmlspecialchars()`.

* **Kasus Valid 2 (Batas Rentang Angka Maksimal & Karakter Khusus):**
  * **Input:** 
    * Nama: `Siti A'isyah` (mengandung tanda kutip tunggal)
    * NIM: `312510999`
    * Program Studi: `Sistem Informasi`
    * Semester: `14` (batas maksimal semester)
    * Email: `siti14@domain.com`
  * **Hasil:** Validasi semester (`1-14`) terpenuhi. Karakter tanda kutip pada nama berhasil disanitasi dengan `ENT_QUOTES` sehingga tidak merusak struktur HTML maupun menyebabkan celah keamanan.

### 2. Kasus Input Tidak Valid
* **Kasus Tidak Valid 1 (Kolom Wajib Dikosongkan / Hanya Berisi Spasi):**
  * **Input:** 
    * Nama: `"   "` (hanya spasi)
    * NIM: `""` (kosong)
    * Program Studi: `Teknik Informatika`
    * Semester: `4`
    * Email: `mahasiswa@kampus.ac.id`
  * **Hasil:** Fungsi `trim()` menghapus spasi berlebih sehingga terdeteksi kosong. Sistem menolak pengiriman data dan menampilkan pesan error berwarna merah: *"Nama wajib diisi."* dan *"NIM wajib diisi."*

* **Kasus Tidak Valid 2 (Format Email Salah & Semester di Luar Rentang):**
  * **Input:** 
    * Nama: `Andi Wijaya`
    * NIM: `312510111`
    * Program Studi: `Teknik Informatika`
    * Semester: `15` (melebihi batas maksimal 14)
    * Email: `andiwijaya.com` (tidak menggunakan format email yang valid)
  * **Hasil:** Fungsi `filter_var(..., FILTER_VALIDATE_EMAIL)` dan pengecekan rentang angka menggagalkan proses simpan. Sistem memunculkan pesan peringatan: *"Format email tidak valid."* dan *"Semester harus berupa angka 1-14."*

## F. Ringkasan Hasil
Seluruh latihan (Latihan 1 hingga 7) dan Mini Project telah berhasil diimplementasikan dan diuji pada server lokal Apache. Pemisahan logika pemrosesan PHP dengan tampilan HTML membuat kode lebih terstruktur, sementara penerapan validasi *server-side* dan fungsi `htmlspecialchars()` efektif menjaga keakuratan data serta mencegah risiko injeksi skrip berbahaya (XSS).