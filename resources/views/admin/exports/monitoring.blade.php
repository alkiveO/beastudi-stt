<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>

<body>
    <table>
        <tbody>
            <tr>
                <td rowspan="2" style="font-weight: bold; vertical-align: middle;
                    text-align: center; border: 2px solid #000000; background-color: #d1d1d1;">
                    No</td>
                <td rowspan="2" style="font-weight: bold; vertical-align: middle;
                    text-align: center; border: 2px solid #000000; background-color: #d1d1d1;">
                    ID</td>
                <td rowspan="2" style="font-weight: bold; vertical-align: middle;
                    text-align: center; border: 2px solid #000000; background-color: #d1d1d1;">
                    NIM</td>
                <td rowspan="2" style="font-weight: bold; vertical-align: middle;
                    text-align: center; border: 2px solid #000000; background-color: #d1d1d1;">
                    Nama</td>
                <td rowspan="2" style="font-weight: bold; vertical-align: middle;
                    text-align: center; border: 2px solid #000000; background-color: #d1d1d1;">
                    Email Mahasiswa</td>
                <td rowspan="2" style="font-weight: bold; vertical-align: middle;
                    text-align: center; border: 2px solid #000000; background-color: #d1d1d1;">
                    Angkatan
                </td>
                <td rowspan="2" style="font-weight: bold; vertical-align: middle;
                    text-align: center; border: 2px solid #000000; background-color: #d1d1d1;">
                    Program Studi
                </td>
                <td rowspan="2" style="font-weight: bold; vertical-align: middle;
                    text-align: center; border: 2px solid #000000; background-color: #d1d1d1;">
                    Rombongan Belajar
                </td>
                <td rowspan="2" style="font-weight: bold; vertical-align: middle;
                    text-align: center; border: 2px solid #000000; background-color: #d1d1d1;">
                    Jalur Beasiswa
                </td>
                <td rowspan="2" style="font-weight: bold; vertical-align: middle;
                    text-align: center; border: 2px solid #000000; background-color: #d1d1d1;">
                    No. HP/WA
                </td>
                <td rowspan="2" style="font-weight: bold; vertical-align: middle;
                    text-align: center; border: 2px solid #000000; background-color: #d1d1d1;">
                    Alamat Domisili Saat ini
                </td>
                <td rowspan="2" style="font-weight: bold; vertical-align: middle;
                    text-align: center; border: 2px solid #000000; background-color: #d1d1d1;">
                    No NIK
                </td>
                <td rowspan="2" style="font-weight: bold; vertical-align: middle;
                    text-align: center; border: 2px solid #000000; background-color: #d1d1d1;">
                    No KK
                </td>
                <td rowspan="2" style="font-weight: bold; vertical-align: middle;
                    text-align: center; border: 2px solid #000000; background-color: #d1d1d1;">
                    NIK Kepala Keluarga
                </td>
                <td rowspan="2" style="font-weight: bold; vertical-align: middle;
                    text-align: center; border: 2px solid #000000; background-color: #d1d1d1;">
                    Nama Kepala Keluarga Sesuai KK
                </td>
                <td rowspan="2" style="font-weight: bold; vertical-align: middle;
    text-align: center; border: 2px solid #000000; background-color: #d1d1d1;">
                    Provinsi
                </td>
                <td rowspan="2" style="font-weight: bold; vertical-align: middle;
        text-align: center; border: 2px solid #000000; background-color: #d1d1d1;">
                    Kabupaten
                </td>
                <td rowspan="2" style="font-weight: bold; vertical-align: middle;
                text-align: center; border: 2px solid #000000; background-color: #d1d1d1;">
                    Kecamatan
                </td>
                <td rowspan="2" style="font-weight: bold; vertical-align: middle;
            text-align: center; border: 2px solid #000000; background-color: #d1d1d1;">
                    Kelurahan
                </td>
                <td rowspan="2" style="font-weight: bold; vertical-align: middle;
text-align: center; border: 2px solid #000000; background-color: #d1d1d1;">
                    Kode POS
                </td>
                <td colspan="8" style="font-weight: bold; vertical-align: middle;
text-align: center; border: 2px solid #000000; background-color: #d1d1d1;">
                    Presentase Beastudi
                </td>
                <td colspan="8" style="font-weight: bold; vertical-align: middle;
text-align: center; border: 2px solid #000000; background-color: #d1d1d1;">
                    Status Beastudi
                </td>
            </tr>
            <tr>
                @foreach(range(1,8) as $value)
                <td style="font-weight: bold; vertical-align: middle; text-align: center; border: 2px solid #000000; background-color: #d1d1d1;">
                    {{ $value }}
                </td>
                @endforeach

                @foreach(range(1,8) as $value)
                <td style="font-weight: bold; vertical-align: middle; text-align: center; border: 2px solid #000000; background-color: #d1d1d1;">
                    {{ $value }}
                </td>
                @endforeach
            </tr>
            @foreach($mahasiswas as $mahasiswa)
            <tr>
                <td style="text-align: center; border: 2px solid #000000;">
                    {{ $loop->iteration }}.
                </td>
                <td style="text-align: center; border: 2px solid #000000;">
                    {{ $mahasiswa->mhs_id }}
                </td>
                <td style="text-align: center; border: 2px solid #000000;">
                    {{ $mahasiswa->nim }}
                </td>
                <td style="text-align: center; border: 2px solid #000000;">
                    {{ $mahasiswa->nama }}
                </td>
                <td style="text-align: center; border: 2px solid #000000;">
                    {{ $mahasiswa->email }}
                </td>
                <td style="text-align: center; border: 2px solid #000000;">
                    {{ $mahasiswa->tahun_masuk }}
                </td>
                <td style="text-align: center; border: 2px solid #000000;">
                    {{ $mahasiswa->program_studi }}
                </td>
                <td style="text-align: center; border: 2px solid #000000;">
                    {{ $mahasiswa->rombel }}
                </td>
                <td style="text-align: center; border: 2px solid #000000;">
                    {{ $mahasiswa->jalur_beastudi }}
                </td>
                <td style="text-align: center; border: 2px solid #000000;">
                    {{ $mahasiswa->nomor_hp }}
                </td>
                <td style="text-align: center; border: 2px solid #000000;">
                    {{ $mahasiswa->alamat }}
                </td>
                <td style="text-align: center; border: 2px solid #000000;">
                    {{ $mahasiswa->no_ktp }}
                </td>
                <td style="text-align: center; border: 2px solid #000000;">
                    {{ $mahasiswa->no_kk }}
                </td>
                <td style="text-align: center; border: 2px solid #000000;">
                    {{ $mahasiswa->no_ktp_kepala_keluarga }}
                </td>
                <td style="text-align: center; border: 2px solid #000000;">
                    {{ $mahasiswa->nama_kepala_keluarga }}
                </td>
                <td style="text-align: center; border: 2px solid #000000;">
                    {{ strtoupper($mahasiswa->provinsi) }}
                </td>
                <td style="text-align: center; border: 2px solid #000000;">
                    {{ strtoupper($mahasiswa->kota) }}
                </td>
                <td style="text-align: center; border: 2px solid #000000;">
                    {{ strtoupper($mahasiswa->kecamatan) }}
                </td>
                <td style="text-align: center; border: 2px solid #000000;">
                    {{ strtoupper($mahasiswa->kelurahan) }}
                </td>
                <td style="text-align: center; border: 2px solid #000000;">
                    {{ $mahasiswa->kode_pos }}
                </td>

                @foreach(range(1,8) as $value)
                    <td style="text-align: center; border: 2px solid #000000;">
                        {{ "" }}
                    </td>
                @endforeach

                @foreach(range(1,8) as $value)
                    @php
                        $monitoring = $mahasiswa->monitorings()
                            ->where('periode_id', $periode_id)
                            ->where('semester', $value)
                            ->first();
                    @endphp
                    <td style="text-align: center; border: 2px solid #000000;">
                        {{ $monitoring ? ucfirst($monitoring->status_beastudi) : '' }}
                    </td>
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
