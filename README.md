# CRM Application

## Overview
Aplikasi Customer Relationship Management (CRM) ini dikembangkan menggunakan **PHP 8.2** dan **Laravel 11**. Aplikasi ini memiliki sistem manajemen hak akses yang dinamis dengan tiga peran utama secara default: **Sales**, **Manager**, dan **Superadmin**. **Superadmin** dapat menambah dan mengatur hak akses untuk peran lainnya sesuai kebutuhan.

## Flow Aplikasi
1. **Sales** dapat menambahkan calon pelanggan dengan status **Draft**.
2. Calon pelanggan yang berstatus **Draft** dapat **diedit**, **dihapus**, atau **diajukan** oleh Sales.
3. Setelah diajukan, Sales hanya dapat melihat riwayat pelanggan tanpa bisa mengubahnya.
4. **Manager** memiliki akses untuk **menyetujui** atau **menolak** calon pelanggan.
5. Jika disetujui oleh Manager, calon pelanggan akan menjadi **Member** secara otomatis.

## Fitur
- **Manajemen Data Master:**
  - **User**, **Product**, dan **Hak Akses**.
- **Manajemen Customer:**
  - Sales dapat menambahkan dan mengelola calon pelanggan.
  - Manager dapat menyetujui atau menolak pelanggan.
  - Pelanggan yang disetujui menjadi Member.
- **Struktur Modular (HMVC)** untuk organisasi kode yang lebih terstruktur.
- **Sistem Hak Akses Dinamis** yang dirancang secara custom.
- **Interaksi Berbasis AJAX** menggunakan **jQuery** untuk pengalaman pengguna yang lebih responsif.
- **Yajra DataTables** dengan **Server-side Processing** untuk pengelolaan data yang lebih efisien.
- **Service Layer** untuk memisahkan logika bisnis agar controller tetap ringan.
- **Tampilan berbasis Template Admin Free dari SoftUI** untuk antarmuka yang lebih modern dan responsif.

## Penjelasan Teknis
Aplikasi ini menggunakan pendekatan **modular (HMVC)**, di mana setiap fitur dikelompokkan dalam satu modul yang terdiri dari **Model, View, Controller, Route, dan Service**. 

- **Role dan Permission**
  - Sistem hak akses dirancang sendiri tanpa menggunakan package pihak ketiga.
  - Hak akses bersifat dinamis, bisa ditambah dan diatur oleh Superadmin.
- **Penggunaan Service Layer**
  - Memisahkan logika bisnis dari Controller agar lebih terstruktur.
  - Memudahkan pengelolaan dan perawatan kode.
- **Penggunaan AJAX dan Yajra DataTables**
  - Memungkinkan pemrosesan data secara **server-side**.
  - Meningkatkan efisiensi dalam pengambilan dan penyajian data.
- **Penggunaan Template Admin SoftUI**
  - Membantu dalam pengembangan tampilan yang lebih profesional dan user-friendly.
  - Mengoptimalkan pengalaman pengguna dengan desain yang modern dan responsif.

## Instalasi
1. Unzip arsip yang telah diunduh.
2. Salin dan tempel folder proyek ke dalam direktori proyek Anda, lalu ubah namanya sesuai kebutuhan.
3. Import database dari file `dimas_crm.sql` ke dalam server **MySQL** Anda.
4. Jalankan perintah berikut di terminal:
   ```bash
   composer install
   ```
5. Salin `.env.example` menjadi `.env` lalu perbarui konfigurasi database.
6. Generate application key:
   ```bash
   php artisan key:generate
   ```
7. Jalankan migrasi dan seeder untuk mengisi data awal:
   ```bash
   php artisan migrate --seed
   ```
8. Jalankan server pengembangan:
   ```bash
   php artisan serve
   ```
9. Akses aplikasi melalui URL yang diberikan.

## Akun Demo
**Superadmin**
- Email: superadmin@mail.com
- Password: secret

**Sales**
- Email: sales1@mail.com | Password: password123
- Email: sales2@mail.com | Password: password123

**Manager**
- Email: manager@mail.com | Password: password123

## Dependencies
- PHP 8.2
- Laravel 11
- MySQL
- jQuery
- Yajra DataTables
- AJAX
- SoftUI Admin Template