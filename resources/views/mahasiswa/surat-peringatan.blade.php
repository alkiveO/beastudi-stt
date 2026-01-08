<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Surat Peringatan Evaluasi Beastudi</title>

<style>

/* ===============================
   DOMPDF HEADER & FOOTER
   =============================== */
@page {
    size: A4;
    margin: 160px 60px 140px 60px;
}


/* HEADER */
.header {
    position: fixed;
    top: -160px;
    left: -60px;
    right: -60px;
    height: 140px;
}

.header img {
    width: 100%;
    height: auto;
    display: block;
}

/* FOOTER */
.footer-fixed {
    position: fixed;
    bottom: -180px;
    left: -60px;
    right: -60px;
    height: 120px;
}

.footer-fixed img {
    width: 100%;
    height: auto;
    display: block;
}

body {
    font-family: "Times New Roman", serif;
    font-size: 12pt;
    line-height: 1.3;
    margin: 40px 60px;
}

h3 {
    text-align: center;
    text-transform: uppercase;
    margin-bottom: 10px;
}

.center { text-align: center; }

.section { margin-top: 15px; }

table.data {
    width: 100%;
}

table.data td {
    padding: 2px 0;
    vertical-align: top;
}

ul {
    margin-left: 20px;
}

ul li {
    margin-bottom: 4px;
}

.footer {
    margin-top: 25px;
}

.signature {
    margin-top: 40px;
    width: 100%;
}

.signature td {
    width: 50%;
    text-align: center;
}

.line {
    border-bottom: 1px solid #000;
    width: 200px;
    margin: 60px auto 5px;
    
}
.line2 {
    width: 200px;
    margin: 60px auto 5px;
}

small {
    font-size: 10pt;
}

    ul li {
        margin-bottom: 3px;
    }

</style>
</head>

<body>
<div class="header">
    <img src="{{ public_path('images/ttd/header.jpg') }}" alt="Header">
</div>

<!-- FOOTER -->
<div class="footer-fixed">
    <img src="{{ public_path('images/ttd/footer.jpg') }}" alt="Footer">
</div>
<h3>
    SURAT PERINGATAN SEBAGAI HASIL EVALUASI BEASTUDI {{$jenis_sp}}
</h3>

<div class="section">
    Mahasiswa Beastudi dengan data sebagai berikut:
</div>

<table class="data">
<tr><td width="120">Nama</td><td>: {{ $nama }}</td></tr>
<tr><td>NIM</td><td>: {{ $nim }}</td></tr>
</table>

<div class="section">
    Diberikan peringatan karena tidak melaksanakan kewajiban Penerima Beastudi yaitu:
</div>

<ul>
    <li>
        <b>
        Presensi mata kuliah kurang dari ketentuan: </b>
        <ol>
    @foreach($presensi as $item)
        @if($item['hadir'] < 13)
            <li>
                {{ $item['nama_mk'] }}
                ........................................
                {{ $item['hadir'] }}/{{ $item['total'] }}
            </li>
        @endif
    @endforeach
</ol>
<br>
<table width="90%" cellspacing="0" cellpadding="2">
    @if(($ips !== null && $ips < 3))
        <tr>
            <td width="60%"><li><strong>Indeks Prestasi Semester (IPS)</strong></li></td>
            <td width="2%">:</td>
            <td>{{ $ips }}</td>
        </tr>
    @endif

    @if(($ipk !== null && $ipk < 3))
        <tr>
            <td><li><strong>Indeks Prestasi Kumulatif (IPK)</strong></li></td>
            <td>:</td>
            <td>{{ $ipk }}</td>
        </tr>
    @endif

   @if($kontribusi === 'Tidak')
<tr>
    <td>
        <li><strong>Penilaian Kontribusi</strong></li>
    </td>
    <td>:</td>
    <td>
        <strong>Tidak Memenuhi</strong>
    </td>
</tr>
@endif


    @if(empty($lpj))
        <tr>
            <td><li><strong>Pelaporan LPJ Beastudi</strong></li></td>
            <td>:</td>
            <td><b>Tidak Melaporkan</b></td>
        </tr>
    @endif
</table>





</ul>

<div align="justify" class="section">
    Jika berikutnya masih tidak memenuhi kewajibannya maka akan dapat diputus beasiswanya.
    Demikian peringatan ini disampaikan.
</div>

<div class="footer center">
    Depok, {{ \Carbon\Carbon::parse($tanggal_surat)->translatedFormat('d F Y') }}<br>
    Ketua Satker Beastudi
</div>

<div class="center" style="margin-top: 10px;">
    <img src="{{ public_path('images/ttd/tanda_tangan.jpg') }}"
         alt="TTD Ketua"
         style="width:120px; height:auto;">
</div>

<div class="center">
    <strong>Krisna Panji, S.Kom., M.M</strong>
</div>


<div style="page-break-before: always;"></div>



<h3>SURAT PERNYATAAN KOMITMEN MEMPERBAIKI DIRI</h3>

<div class="section">
    Saya, mahasiswa Beastudi dengan data sebagai berikut:
</div>

<table class="data">
<tr><td width="120">Nama</td><td>: {{ $nama }}</td></tr>
<tr><td>NIM</td><td>: {{ $nim }}</td></tr>
</table>

<div align="justify" class="section">
    Dengan ini menyatakan sanggup memperbaiki diri dan melaksanakan seluruh kewajiban
    sebagai penerima Beastudi sesuai ketentuan yang berlaku.
</div>

<div align="justify" class="section">
    Apabila di kemudian hari saya tidak memenuhi ketentuan tersebut,
    maka saya bersedia menerima sanksi sesuai peraturan yang berlaku.
</div>

<div class="footer center">
    Depok, {{ \Carbon\Carbon::parse($tanggal_surat)->translatedFormat('d F Y') }}
</div>

<table class="signature">
<tr>
<td>
    Mengetahui,<br>
    Orang Tua / Wali
    <br><br>
    <div class="line"></div>
</td>
<td>
    Yang Menyatakan,<br>
    Mahasiswa
    <br><br>
    <div class="line"></div>
</td>
</tr>
</table>


</body>
</html>
