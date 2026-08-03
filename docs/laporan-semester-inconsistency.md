# Catatan: Pengisian Laporan Semesteran Tidak Konsisten

Tanggal: 2026-08-03

## Gejala

Pengguna (mahasiswa) melaporkan bahwa pengisian **laporan semesteran (monitoring)** sering tidak konsisten.

## Penyebab LANGSUNG (di kode, paling berdampak)

1. **Prestasi tidak pernah dihapus/di-update saat laporan diedit**
   - `app/Http/Livewire/Mahasiswa/CreateMonitoring.php` — `store()` hanya `Prestasi::create()` dalam `foreach`.
   - Karena penyimpanan memakai `updateOrCreate`, tiap simpan ulang **menumpuk prestasi duplikat**, dan prestasi yang dihapus di form tetap tersisa di DB.
   - Akibat: data prestasi yang dilihat admin tidak konsisten dengan laporan yang diisi mahasiswa.

2. **Tidak ada unique constraint** di tabel `monitoring` untuk `(nim, semester, periode_id)`
   - Migration `2024_06_15_060406_create_monitoring_table.php` tidak mendefinisikannya.
   - `updateOrCreate` hanya aman di level kode; double-click / race condition dapat membuat **duplikat row**.

3. **Validasi IPK/IPS salah** — `CreateMonitoring.php:55-56` memakai `min:4`
   - Karena tidak ada rule `numeric`, Laravel menafsirkan `min` sebagai **panjang string** (lihat `ValidatesAttributes::getSize`).
   - Akibat:
     - `3.5` (3 karakter) **ditolak** padahal IPK valid → mahasiswa mendapat error "min/max 4 karakter" yang membingungkan.
     - `5.00` atau `9.99` (4 karakter) **lolos** walau mustahil → nilai tidak wajar tersimpan.
     - Tidak ada validasi rentang 0–4.

4. **`tanggal_isi` tanpa validasi `date`** (`:53`) → tanggal tidak konsisten.

5. **Konvensi path file tidak konsisten**
   - SPB/LPJ disimpan `basename()` (`:343-344`), sedangkan prestasi disimpan path lengkap (`:357`).
   - Berpotensi link/download rusak di sisi admin.

6. **`file_lpj` dibuat nullable** (migration `2025_02_10_150252_modify_column_nullable.php`, sesuai catatan README) padahal di form `required`
   - Jika row dibuat via jalur lain (import/seed), kolom kosong → export LPJ menampilkan "Tidak Ada".

## Penyebab TIDAK LANGSUNG

- **Migration hilang untuk `krs`, `matakuliah`, `presensi`, `evaluasi`, `peng_monitoring`** — tabel dibuat manual tanpa versioning. Kolom presensi per matakuliah di export (`app/Exports/ExportMonitoring.php:122`) bergantung pada relasi `krs → presensi`; skema dev vs prod bisa meleset.
- **Tidak ada test** — tidak ada pengaman agar bug validasi/prestasi di atas tidak terulang.
- **`$guarded = []`** — memungkinkan field tak terduga ikut tersimpan.

## Yang TIDAK Berpengaruh pada Masalah Ini

- Secret di `.env`, route `phpinfo()`, dan rute duplikat export (isu keamanan/kebersihan kode, bukan penyebab inkonsistensi data).

## Rencana Perbaikan yang Disarankan

1. Tambah unique index `(nim, semester, periode_id)` pada tabel `monitoring` (migration baru).
2. Perbaiki validasi IPK/IPS: `numeric|between:0,4` (atau min/max sesuai kebijakan) + format konsisten.
3. Ubah logika `store()`: saat edit, hapus prestasi lama yang tidak ada lagi di form, dan hindari duplikasi.
4. Buat migration untuk tabel yang hilang (`evaluasi`, `krs`, `matakuliah`, `presensi`, `peng_monitoring`, `documents`).
5. Tambahkan validasi `date` untuk `tanggal_isi`.
6. Samakan konvensi penyimpanan path file (SPB/LPJ/prestasi).
