<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <title>LPJ Mahasiswa Beastudi</title>

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

        .image {
            margin: 100px 0px;
            text-align: center;
        }

        .mahasiswa {
            line-height: 28px;
            padding-left: 100px;
            margin-bottom: 150px;
        }

        .page-break {
            page-break-before: always;
        }
    </style>
</head>

<body class="container">
    <div class="heading">
        <h3>LAPORAN PERKEMBANGAN <br> AKADEMIK DAN NON AKADEMIK <br> PENERIMA BEASISWA <br> SEMESTER GENAP TAHUN AKADEMIK {{ $periode->nama }} </h3>
    </div>

    <div class="image">
        <img src="{{ public_path('images/sttnf.png') }}" width="250" height="250">
    </div>

    <div class="detail">
        <div class="mahasiswa">
            <table>
                <tr>
                    <td>NAMA</td>
                    <td>:</td>
                    <td>{{ $mahasiswa->nama }}</td>
                </tr>
                <tr>
                    <td>NIM</td>
                    <td>:</td>
                    <td>{{ $mahasiswa->nim }}</td>
                </tr>
                <tr>
                    <td>ANGKATAN</td>
                    <td>:</td>
                    <td>{{ $mahasiswa->tahun_masuk }}</td>
                </tr>
                <tr>
                    <td>PROGRAM STUDI</td>
                    <td>:</td>
                    <td>{{ ucwords($mahasiswa->program_studi) }}</td>
                </tr>
                <tr>
                    <td>SEMESTER</td>
                    <td>:</td>
                    <td>{{ $semester }}</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="heading">
        <h3>SEKOLAH TINGGI TEKNOLOGI TERPADU NURUL FIKRI <br> {{ date('Y') }} </h3>
    </div>

    <div class="page-break"></div>

    @php
        $monitoring = $mahasiswa->monitorings()
            ->where('periode_id', $periode->id)
            ->where('semester', $semester)
            ->first();
    @endphp

    <div class="data_mahasiswa">
        <p><strong>I. DATA MAHASISWA</strong></p>
        <table style="padding-left:15px !important;line-height: 28px;">
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
            <tr>
                <td>Tempat, Tanggal Lahir</td>
                <td>:</td>
                <td>{{ Carbon\Carbon::parse($mahasiswa->tanggal_lahir)->isoFormat('D MM Y') }}</td>
            </tr>
            <tr>
                <td>Jenjang</td>
                <td>:</td>
                <td>S1</td>
            </tr>
            <tr>
                <td>Penasehat Akademik</td>
                <td>:</td>
                <td>{{ $monitoring ? $monitoring->pembimbing_akademik->nama : '' }}</td>
            </tr>
            <tr>
                <td>Program Studi</td>
                <td>:</td>
                <td>{{ ucwords($mahasiswa->program_studi) }}</td>
            </tr>
            <tr>
                <td>Tahun Masuk</td>
                <td>:</td>
                <td>{{ $mahasiswa->tahun_masuk }}</td>
            </tr>
            <tr>
                <td>Target Lulus</td>
                <td>:</td>
                <td></td>
            </tr>
            <tr>
                <td>Alamat Rumah Lengkap</td>
                <td>:</td>
                <td>{{ $mahasiswa->alamat }}</td>
            </tr>
            <tr>
                <td>Nomor WA Aktif</td>
                <td>:</td>
                <td>{{ $mahasiswa->nomor_hp }}</td>
            </tr>
        </table>
    </div>

    <div class="komitmen_mahasiswa" style="text-align:justify;">
        <p><strong>II. KOMITMEN PENERIMA BEASISWA</strong></p>
        <ol>
            <li>Motivasi Agar Dapat Mempertahankan Performa Selama Kuliah</li>
            <p></p>
            <li>Capaian Target Semester Ini</li>
            <p>{{ $monitoring ? $monitoring->deskripsi_capaian : '' }}</p>
            <li>Kendala Yang Dihadapi Semester ini</li>
            <p>{{ $monitoring ? $monitoring->deskripsi_kendala : '' }}</p>
            <li>Langkah Yang Sudah Dilakukan Untuk Mengatasi Masalah Semester ini</li>
            <p></p>
            <li>Target Semester Berikutnya</li>
            <p>{{ $monitoring ? $monitoring->deskripsi_rencana : '' }}</p>
        </ol>
    </div>

    @if($monitoring && $monitoring->status_file_lpj === 'tolak' && $monitoring->keterangan_file_lpj)
    <div style="margin-top:20px;padding:15px;border:1px solid #dc3545;background:#f8d7da;">
        <p><strong>KOMENTAR:</strong></p>
        <p>{{ $monitoring->keterangan_file_lpj }}</p>
    </div>
    @endif

    <div class="page-break"></div>

    <div class="laporan_akademik">
        <p><strong>III. LAPORAN PRESTASI AKADEMIK</strong> (IPK Minimal 3,0)</p>
        <div style="padding-left:15px !important;text-align:justify;">
            <strong>*) Melampirkan KHS Semester Genap TA {{ $periode->nama }} bisa download transkrip nilai dari ais.nurulfikri.ac.id (jika belum ada bisa di cantumkan khs semester sebelum nya)</strong>
        </div>
    </div>

    <div class="page-break"></div>

    <div class="laporan_prestasi">
        <p><strong>IV. LAPORAN PRESTASI</strong></p>
        <div style="padding-left:15px !important;text-align:justify;line-height: 28px; margin-bottom: 25px;">
            A. Prestasi atau Lomba baik eksternal atau internal kampus yang diraih selama menjadi mahasiswa STT Terpadu Nurul Fikri:
        </div>
        <table style="padding-left:20px !important;border:1px solid #000;border-collapse: collapse;" width="100%">
            <tr>
                <th style="border: 1px solid;a">No</th>
                <th style="border: 1px solid;a">Kegiatan</th>
                <th style="border: 1px solid;a">Tingkat</th>
                <th style="border: 1px solid;a">Waktu Pelaksaan</th>
                <th style="border: 1px solid;a">Hasil</th>
            </tr>
            @for($i = 0; $i < 3; $i++)
                <tr>
                    <td style="border: 1px solid;"><p></p></td>
                    <td style="border: 1px solid;"><p></p></td>
                    <td style="border: 1px solid;"><p></p></td>
                    <td style="border: 1px solid;"><p></p></td>
                    <td style="border: 1px solid;"><p></p></td>
                </tr>
            @endfor
        </table>
        <div style="padding-left:20px !important;font-weight:bold">
            <p>*) Kolom "Tingkat" diisi dengan pilihan "kabupaten / kota / provinsi / nasional / internasional".</p>
            <p>*) Melampirkan <i>scan/copy</i> sertifikat/piagam.</p>
        </div>
    </div>

    <div class="page-break"></div>

    <div class="keikutsertaan" style="line-height:28px;text-align:justify;">
        <p><strong>V. KEIKUTSERTAAN PADA ORGANISASI KEMAHASISWAAN INTRA KAMPUS &nbsp;&nbsp;&nbsp; ATAU LFK SELAMA MENJADI MAHASISWA STT TERPADU NURUL FIKRI:</strong></p>
        <table style="padding-left:20px !important;border:1px solid #000;border-collapse: collapse;" width="100%">
            <tr>
                <th style="border: 1px solid;a">No</th>
                <th style="border: 1px solid;a">Nama Organisasi</th>
                <th style="border: 1px solid;a">Aktif Sejak</th>
                <th style="border: 1px solid;a">Akhir Keaktifan</th>
                <th style="border: 1px solid;a">Jabatan</th>
            </tr>
            @for($i = 0; $i < 3; $i++)
                <tr>
                    <td style="border: 1px solid;"><p></p></td>
                    <td style="border: 1px solid;"><p></p></td>
                    <td style="border: 1px solid;"><p></p></td>
                    <td style="border: 1px solid;"><p></p></td>
                    <td style="border: 1px solid;"><p></p></td>
                </tr>
            @endfor
        </table>
        <div style="padding-left:20px !important;font-weight:bold">
            <p>*) Melampirkan scan/copy sertifikat/surat keterangan dari pimpinan organisasi.</p>
        </div>
    </div>

    <div class="page-break"></div>

    <div class="keikutsertaan" style="line-height:28px;text-align:justify;">
        <p><strong>VI. KEIKUTSERTAAN PADA KEGIATAN KEPANITIAAN YANG DIIKUTI &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SELAMA MENJADI MAHASISWA STT TERPADU NURUL FIKRI:</strong></p>
        <table style="padding-left:20px !important;border:1px solid #000;border-collapse: collapse;" width="100%">
            <tr>
                <th style="border: 1px solid;a">No</th>
                <th style="border: 1px solid;a">Kegiatan</th>
                <th style="border: 1px solid;a">Waktu Pelaksanaan</th>
            </tr>
            @for($i = 0; $i < 3; $i++)
                <tr>
                    <td style="border: 1px solid;"><p></p></td>
                    <td style="border: 1px solid;"><p></p></td>
                    <td style="border: 1px solid;"><p></p></td>
                </tr>
            @endfor
        </table>
        <div style="padding-left:20px !important;font-weight:bold">
            <p>*) Melampirkan scan/copy sertifikat/surat keterangan dari ketua panitia.</p>
        </div>
    </div>

    <div class="page-break"></div>

    <div class="laporan_keuangan">
        <p><strong>VII. LAPORAN KEUANGAN PENGGUNAAN DANA BIAYA HIDUP</strong></p>
        <div style="padding-left:15px !important;text-align:justify;line-height: 28px; margin-bottom: 25px;">
            Laporan rata-rata pemakaian dana biaya hidup yang diberikan sebesar Rp 4.200.000,- untuk mahasiswa angkatan 2020 dan Rp 8.400.000,- untuk mahasiswa angkatan 2021, 2022, & 2023 per semester oleh mahasiswa selama satu semester:
        </div>
        <table style="padding-left:20px !important;border:1px solid #000;border-collapse: collapse;" width="100%">
            <tr>
                <th style="border: 1px solid;a">No</th>
                <th style="border: 1px solid;a">Keperluan</th>
                <th style="border: 1px solid;a">Nominal</th>
            </tr>
            @for($i = 0; $i < 3; $i++)
                <tr>
                    <td style="border: 1px solid;"><p></p></td>
                    <td style="border: 1px solid;"><p></p></td>
                    <td style="border: 1px solid;"><p></p></td>
                </tr>
            @endfor
        </table>
        <div style="padding-left:20px !important;font-weight:bold">
            <p>*) khusus mahasiswa beasiswa penerima KIP Kuliah</p>
            <p>*) untuk beasiswa Yayasan tidak perlu isi laporan penggunaan dana</p>
        </div>
    </div>

    <div style="margin-top:50px;padding-left:15px !important;">
        Demikian laporan ini saya buat dengan sebenar-benarnya.
    </div>

    <div style="text-align:right;"></div>

    <div style="margin-top:50px;">
        <table style="width: 100%;">
            <tr>
                <td style="vertical-align:top; width: 50%;"></td>
                <td style="vertical-align:top;text-align:center;">
                    <div style="display: inline-block; padding-top: 5px;">
                        <span>Depok,{{ Carbon\Carbon::now()->isoFormat('D MMMM Y') }} </span> <br>
                        <span style="margin-top:2px;display:block;margin-left:-35px;">Pembuat Laporan</span>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="vertical-align:top; padding-top: 120px;"></td>
                <td style="vertical-align:bottom;text-align:center;">
                    <div style="display: inline-block; padding-top: 5px;">
                        <span style="margin-left:-70px;">{{ $mahasiswa->nama }}</span>
                        <span style="margin-top:2px;display:block;margin-left:-70px;">{{ $mahasiswa->nim }}</span>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</div>

</body>

</html>

