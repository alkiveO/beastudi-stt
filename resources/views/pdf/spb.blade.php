<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <title>SPB Mahasiswa Beastudi</title>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <style>
        .container {
            padding-left: 50px;
            padding-right: 50px;
        }

        .heading {
            text-align: center;
            line-height: 28px;
        }

        .detail,
        .hak-beastudi,
        .kewajiban-beastudi,
        .evaluasi {
            line-height: 25px;
        }

        .kewajiban-beastudi, .evaluasi {
            text-align: justify;
        }

        .mahasiswa {
            padding-left: 45px;
            font-weight: bold;
        }

        .page-break {
            page-break-before: always;
        }
    </style>
</head>

<body class="container">
    <div class="heading">
        <h3>Surat Perjanjian Penerima Beastudi STT-NF <br> Semester Ganjil Tahun Akademik {{ date('Y') . '/' . date('Y') + 1 }}</h3>
    </div>

    <div class="detail">
        <p>Yang bertanda tangan di bawah ini, Saya</p>
        <div class="mahasiswa">
            <table>
                <tr>
                    <td>Nama Lengkap</td>
                    <td>:</td>
                    <td>{{ $mahasiswa->nama }}</td>
                </tr>
                <tr>
                    <td>NIM</td>
                    <td>:</td>
                    <td>{{ $mahasiswa->nim }}</td>
                </tr>
            </table>
        </div>
        <p>Bersedia mengikuti program <strong>Beastudi Sekolah Tinggi Teknologi Terpadu Nurul Fikri</strong> dengan hak dan kewajiban sebagai berikut:</p>
    </div>

    <div class="hak-beastudi">
        <p><strong>Hak peserta beastudi berupa:</strong></p>
        <ol>
            <li>Pembebasan biaya kuliah semester ganjil berdasarkan evaluasi semester sebelumnya yaitu sebesar (100%)</li>
            <li>Biaya Penunjang Pendidikan atau uang saku (bagi mahasiswa KIP-Kuliah)</li>
            <li>Penggunaan Fasilitas Kampus</li>
        </ol>
    </div>

    <div class="kewajiban-beastudi">
        <p><strong>Kewajiban peserta beastudi selama satu semester berupa:</strong></p>
        <ol>
            <li>
                Memiliki Penilaian Akademik (PIC Beastudi) <br>
                a. IPS >= 3,0, IPK >= 3,0, dan nilai matakuliah min. C+ <br>
                b. Presensi setiap mata kuliah hadir min. 13 kali pertemuan
            </li>
            <li><strong>Mengisi SKPI</strong> (surat keterangan pendamping ijazah) selama semester ganjil tahun {{ date('Y') . '/' . date('Y') + 1 }} di <a href="https://siska.nurulfikri.ac.id">siska.nurulfikri.ac.id</a>. (PIC Kemas & Prodi)</li>
            <li><strong>Membuat Laporan Pertanggung Jawaban Beastudi</strong> (draft terlampir menjelang akhir semester di grup beastudi)</li>
            @php
                $monitoring = $mahasiswa->monitoring()
                    ->where('semester', $semester)
                    ->where('periode_id', $periode)
                    ->first();
            @endphp

            @if($monitoring)
                <li class="mb-2"><b>Kontribusi Khusus {{ $monitoring->kontribusi_khusus->nama }}: {{ $monitoring->kontribusi_khusus->pic }} ({{ $monitoring->kontribusi_khusus->telp_pic }})</b>
                    @foreach($monitoring->kontribusi_khusus->item_kontribusi_khusus as $item_kontribusi_khusus)
                        <ul>
                            <li>{{ $item_kontribusi_khusus->nama }}</li>
                        </ul>
                    @endforeach
                </li>
            @endif
            <li>
                <strong>Kontribusi Umum</strong>: Membantu sebar informasi STT-NF yang sudah disiapkan via grup beastudi untuk dishare ke dalam media online/sosmed masing-masing dan offline. (<strong>PIC PMB</strong>) <br>
                <div style="padding:left:10px;">
                    - Follow, Like, Comment dan Share akun Media Sosial STT-NF dan Subscribe akun YouTube STT-NF. <br>
                    - Share Informasi Penerimaan Mahasiswa Baru STT-NF Ke Media Sosial (Group Whatsapp, FB dan Instagram).
                </div>
            </li>

            <div class="page-break"></div>

            <li>Tidak diperkenankan menikah saat menjalankan program beasiswa.</li>
            <li>Tidak diperkenankan pindah kelas karyawan dan pindah program studi.</li>
            <li>Menaati Kode Etik Mahasiswa, peraturan tata tertib dan menjaga nama baik kampus Sekolah Tinggi Teknologi Terpadu Nurul Fikri (STT-NF)</li>
        </ol>
    </div>

    <div class="evaluasi">
        <p><strong>*Evaluasi</strong></p>
        <p>Evaluasi dilakukan diakhir semester ganjil tahun akademik {{ date('Y') . '/' . date('Y') + 1 }} untuk menentukan apakah beasiswa semester selanjutnya tetap berlanjut atau tidak. Jika pada hasil evaluasi akhir semester ganjil tahun ajaran {{ date('Y') . '/' . date('Y') + 1 }} terdapat salah satu indikator kewajiban tidak memenuhi standar pada masing-masing komposisi penilaian, maka saya bersedia untuk menerima sangsi berupa Berita Acara Perkara dan mendapatkan Surat Peringatan sampai dengan pencabutan beasiswa.</p>
    </div>

    <div style="text-align:right;">Depok, {{ Carbon\Carbon::now()->isoFormat('D MMMM Y') }}</div>

    <div>
        <table style="width: 100%;">
            <tr>
                <td style="vertical-align:top; width: 50%;">Mengetahui,</td>
                <td style="width: 50%;"></td>
            </tr>
            <tr>
                <td style="vertical-align:top; padding-top: 85px;">
                    <span style="text-decoration:underline;">Krisna Panji, S.Kom., M.M</span> <br>
                    <span style="padding-left: 15px;">Ketua Satker Beastudi</span>
                </td>
                <td style="vertical-align:bottom;text-align:center;">
                    <div style="border-top: solid #000 1px; display: inline-block; padding-top: 5px;">
                        {{ $mahasiswa->nama }}
                    </div>
                </td>
            </tr>
        </table>
    </div>
</div>

</body>

</html>

