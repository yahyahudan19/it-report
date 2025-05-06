# IT Report App - RSUD Karsa Husada Batu

Selamat datang di **IT Report App**, sebuah aplikasi manajemen kegiatan dan pelaporan harian yang dirancang khusus untuk mendukung kebutuhan unit IT maupun non-IT di **RSUD Karsa Husada Batu**. Aplikasi ini bertujuan untuk meningkatkan efisiensi, transparansi, dan akurasi dalam evaluasi serta monitoring kinerja staf.

---

## ✨ Fitur Utama
- **Manajemen Kegiatan**: Catat, kelola, dan pantau kegiatan harian dengan mudah.
- **Pelaporan Harian**: Laporan otomatis untuk mempermudah dokumentasi pekerjaan.
- **Evaluasi Kinerja**: Analisis performa staf berdasarkan data pelaporan.
- **Dukungan Multi-Unit**: Dapat digunakan oleh unit IT maupun non-IT.
- **Dashboard Interaktif**: Visualisasi data untuk monitoring yang lebih efektif.

---

## 🛠️ Teknologi yang Digunakan
- **Framework**: Laravel 12
- **Database**: MySQL
- **Web Server**: Nginx

---

## 🚀 Cara Instalasi
1. Clone repository ini:
    ```bash
    git clone https://github.com/yahyahudan19/it-report.git
    ```
2. Masuk ke direktori proyek:
    ```bash
    cd it-report
    ```
3. Install dependensi menggunakan Composer:
    ```bash
    composer install
    ```
4. Buat file `.env` dan sesuaikan konfigurasi database:
    ```bash
    cp .env.example .env
    ```
5. Generate application key:
    ```bash
    php artisan key:generate
    ```
6. Migrasi database:
    ```bash
    php artisan migrate
    ```
7. Jalankan server lokal:
    ```bash
    php artisan serve
    ```

---

## 📊 Penggunaan
1. Login ke aplikasi menggunakan akun yang telah dibuat oleh admin.
2. Tambahkan kegiatan harian melalui menu **Kegiatan**.
3. Lihat laporan harian dan evaluasi kinerja melalui dashboard.

---

## 🤝 Kontribusi
Kami menyambut kontribusi dari siapa saja! Jika Anda ingin berkontribusi, silakan fork repository ini dan buat pull request. Pastikan untuk membaca [CONTRIBUTING.md](CONTRIBUTING.md) terlebih dahulu.

---

## 📄 Lisensi
Proyek ini dilisensikan di bawah [MIT License](LICENSE).

---

## 📞 Kontak
Jika Anda memiliki pertanyaan atau masukan, silakan hubungi kami melalui:
- **Email**: yahya@rsudkarsahusada.id
- **Telepon**: (0341) 123-4567

Terima kasih telah menggunakan **IT Report App**!  