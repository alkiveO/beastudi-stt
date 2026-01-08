<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Peringatan Evaluasi Beastudi</title>

    <style>
        body {
            font-family: "Times New Roman", serif;
            font-size: 12pt;
            line-height: 1.6;
            margin: 40px;
        }

        h3 {
            text-align: center;
            margin-bottom: 20px;
            text-transform: uppercase;
        }

        .section {
            margin-top: 20px;
        }

        .data-table {
            width: 100%;
            margin-top: 10px;
        }

        .data-table td {
            padding: 2px 4px;
            vertical-align: top;
        }

        .list {
            margin-left: 20px;
        }

        .signature {
            margin-top: 40px;
            width: 100%;
        }

        .signature td {
            width: 50%;
            text-align: center;
            vertical-align: top;
        }

        .line {
            border-bottom: 1px solid #000;
            margin-top: 60px;
        }

        .page-break {
            page-break-before: always;
        }

        .footer {
            margin-top: 30px;
        }

        small {
            font-size: 10pt;
        }
    </style>
</head>
<body>

<!-- ===================== -->
<!-- SURAT PERINGATAN -->
<!-- ===================== -->
<h3>
    SURAT PERINGATAN<br>
    SEBAGAI HASIL EVALUASI BEASTUDI<br>
    {{ strtoupper($jenis_sp) }}
</h3>

<div class="section">
    Mahasiswa Beastudi dengan data sebagai berikut:
    <table class="data-table">
        <tr>
            <td width="140">Nama</td>
            <td>: {{ $nama }}</td>
        </tr>
        <tr>
            <td>NIM</td>
            <td>: {{ $nim }}</td>
        </tr>
        <tr>
            <td>Program Studi</td>
            <td>: {{ $program_studi }}</td>
        </tr>
        <tr>
            <td>Semester</td>
            <td>: {{ $semester }}</td>
        </tr>
        <tr>
            <td>Periode</td>
            <td>: {{ $periode }}</td>
        </tr>
    </table>
</div>

<div class="section">
    Berdasarkan hasil evaluasi, mahasiswa tersebut **tidak memenuhi kewajiban penerima Beastudi**,
    dengan rincian sebagai berikut:
</div>
@foreach($presensi as $item)
    @if($item['hadir'] < 12)
        <li>
            {{ $item['nama_mk'] }}
            ({{ $item['hadir'] }}/{{ $item['total'] }})
        </li>
    @endif
@endforeach


<div class="section">
    <ol class="list">
        <li>
            Persentase presensi mata kuliah kurang dari ketentuan:
            <ol>
                @foreach($presensi as $item)
                    @if($item['hadir'] < 12)
                        <li>
                            {{ $item['nama_mk'] }}
                            ({{ $item['hadir'] }}/{{ $item['total'] }})
                        </li>
                    @endif
                @endforeach
            </ol>
        </li>

        <li>
            Jenis Surat Peringatan:
            <strong>{{ $jenis_sp }}</strong>
        </li>

        <li>
            Keterangan Evaluasi:
            <em>{{ $keterangan }}</em>
        </li>
    </ol>
</div>

<div class="section">
    Apabila di kemudian hari mahasiswa masih tidak memenuhi kewajiban,
    maka beasiswa dapat **dipertimbangkan untuk dihentikan**.
    <br><br>
    Demikian surat peringatan ini disampaikan untuk dapat diperhatikan dan ditindaklanjuti.
</div>

<div class="footer">
    Depok, {{ \Carbon\Carbon::parse($tanggal_surat)->translatedFormat('d F Y') }}
</div>

<table class="signature">
    <tr>
        <td>
            Ketua Satker Beastudi
            <div class="line"></div>
            <strong>{{ $nama_ketua }}</strong>
        </td>
    </tr>
</table>

<!-- ===================== -->
<!-- PAGE BREAK -->
<!-- ===================== -->
<div class="page-break"></div>

<!-- ===================== -->
<!-- SURAT KOMITMEN -->
<!-- ===================== -->
<h3>
    SURAT PERNYATAAN KOMITMEN<br>
    MEMPERBAIKI DIRI
</h3>

<div class="section">
    Saya yang bertanda tangan di bawah ini:
    <table class="data-table">
        <tr>
            <td width="140">Nama</td>
            <td>: {{ $nama }}</td>
        </tr>
        <tr>
            <td>NIM</td>
            <td>: {{ $nim }}</td>
        </tr>
        <tr>
            <td>Program Studi</td>
            <td>: {{ $program_studi }}</td>
        </tr>
    </table>
</div>

<div class="section">
    Dengan ini menyatakan sanggup memperbaiki diri dan melaksanakan seluruh kewajiban
    sebagai penerima Beastudi sesuai dengan ketentuan yang berlaku.
    <br><br>
    Apabila di kemudian hari saya tidak memenuhi ketentuan tersebut,
    maka saya bersedia menerima sanksi sesuai peraturan yang berlaku.
</div>

<div class="footer">
    Depok, {{ \Carbon\Carbon::parse($tanggal_surat)->translatedFormat('d F Y') }}
</div>

<table class="signature">
    <tr>
        <td>
            Mengetahui,<br>
            Orang Tua / Wali
            <div class="line"></div>
        </td>
        <td>
            Yang Menyatakan,<br>
            Mahasiswa
            <div class="line"></div>
        </td>
    </tr>
</table>

<small>
    Surat ini dicetak secara mandiri oleh mahasiswa melalui Sistem Informasi Beastudi.
</small>

</body>
</html>
