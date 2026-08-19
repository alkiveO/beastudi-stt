# Analisa Project Beastudi

Tanggal: 2026-08-03

## Ringkasan

Aplikasi **Beastudi** adalah sistem manajemen beasiswa untuk kampus. Dibangun dengan:

- Laravel **10** (PHP ^8.1)
- Livewire **2** (komponen interaktif)
- Fortify (autentikasi)
- DomPDF (cetak PDF: SPB, LPJ, Surat Peringatan)
- Maatwebsite Excel (import/export)
- indoregion (data wilayah)
- Sanctum, dan logging ke Telegram
- Deployment via Docker (`docker-compose.yml`)

## Arsitektur

- Dua guard terpisah: `web` (admin, tabel `users`) dan `mahasiswa` (tabel `mahasiswa`) — `config/auth.php`.
- Tiga role: `admin`, `mahasiswa`, dan `kemas` (guard admin dengan middleware `role:kemas`).
- Pola MVC + Livewire:
  - ~46 komponen Livewire untuk CRUD interaktif (monitoring, prestasi, periode, jalur, kontribusi, master data).
  - Controller klasik untuk download/export dan alur login.
- ~89 file Blade views.

## Fitur Utama

| Area | Fitur |
|---|---|
| Admin | Dashboard + chart Livewire (evaluasi, monitoring, prestasi, prodi, jalur), master data camaba, import mahasiswa/presensi via Excel, kelola periode/jalur/kontribusi-khusus/wilayah, pembimbing akademik, upload dokumen, pengaturan buka/tutup pengumpulan |
| Export | Excel monitoring (kolom matakuliah dinamis + presensi), export mahasiswa |
| PDF | Cetak SPB, LPJ, dan Surat Peringatan |
| Evaluasi | History evaluasi mahasiswa per semester (jenis SP, kontribusi, tanggal) |
| Mahasiswa | Login sendiri, dashboard, data diri, laporan semester (monitoring), cetak surat peringatan |

## Temuan Umum (Perlu Diperbaiki)

### Prioritas Tinggi

1. **Migration tidak lengkap** — tabel `evaluasi`, `krs`, `matakuliah`, `presensi`, `peng_monitoring`, dan `documents` dipakai oleh model namun **tidak punya migration file**. Hanya ada dump `documents.sql`. Fresh-install / `migrate:fresh` akan gagal dan skema DB tidak terdokumentasi/versioned.

2. **`$guarded = []` di banyak model** — mass-assignment terbuka. Sebaiknya pakai `$fillable` eksplisit atau validasi ketat di tiap titik penyimpanan.

3. **Tidak ada test bermakna** — hanya ExampleTest bawaan. Perubahan berisiko regresi tanpa pengaman.

### Keamanan

4. **`.env` ter-commit** berisi `APP_KEY`, `TELEGRAM_LOGGER_BOT_TOKEN`, dan password DB. Juga `APP_DEBUG=true`. `.env` tidak ada di `.gitignore`.

5. **Route `phpinfo()`** di `routes/web.php` terbuka tanpa proteksi — potensi kebocoran informasi di production.

6. **`docker-compose.yml`** berisi password DB hardcoded (dan sudah termodifikasi, belum di-commit).

### Kebersihan Kode

7. **Rute duplikat/berantakan** — export monitoring didefinisikan dua kali (ExportController + closure di `routes/web.php`), indentasi tidak rapi.

8. **Kode mati** — blok di-comment di beberapa komponen (mis. cek `pengumpulanAktif` pada `download()` di `ListMonitoring.php`).

## Catatan Lanjutan

- Masalah spesifik "pengisian laporan semesteran tidak konsisten" dijelaskan terpisah pada `docs/laporan-semester-inconsistency.md`.
