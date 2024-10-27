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
                <td
                    style="font-weight: bold;
                    text-align: center; border: 2px solid #000000; background-color: #d1d1d1; width: 30px;;">
                    No</td>
                <td
                    style="font-weight: bold;
                    text-align: center; border: 2px solid #000000; background-color: #d1d1d1; width: 90px;">
                    ID</td>
                <td
                    style="font-weight: bold;
                    text-align: center; border: 2px solid #000000; background-color: #d1d1d1; width: 90px;">
                    NIM</td>
                <td
                    style="font-weight: bold;
                    text-align: center; border: 2px solid #000000; background-color: #d1d1d1; width: 90px;">
                    Nama</td>
                <td
                    style="font-weight: bold;
                    text-align: center; border: 2px solid #000000; background-color: #d1d1d1; width: 130px;">
                    Email Mahasiswa</td>
                <td
                    style="font-weight: bold;
                    text-align: center; border: 2px solid #000000; background-color: #d1d1d1; width: 100px;">
                    Password
                </td>
                <td
                    style="font-weight: bold;
                    text-align: center; border: 2px solid #000000; background-color: #d1d1d1; width: 100px;">
                    Angkatan
                </td>
                <td
                    style="font-weight: bold;
                    text-align: center; border: 2px solid #000000; background-color: #d1d1d1; width: 130px;">
                    Program Studi
                </td>
                <td
                    style="font-weight: bold;
                    text-align: center; border: 2px solid #000000; background-color: #d1d1d1; width: 130px;">
                    Rombongan Belajar
                </td>
                <td
                    style="font-weight: bold;
                    text-align: center; border: 2px solid #000000; background-color: #d1d1d1; width: 130px;">
                    Presentase
                    Beastudi
                </td>
                <td
                    style="font-weight: bold;
                    text-align: center; border: 2px solid #000000; background-color: #d1d1d1; width: 130px;">
                    Jalur Beasiswa
                </td>
                <td
                    style="font-weight: bold;
                    text-align: center; border: 2px solid #000000; background-color: #d1d1d1; width: 130px;">
                    No. HP/WA
                </td>
                <td
                    style="font-weight: bold;
                    text-align: center; border: 2px solid #000000; background-color: #d1d1d1; width: 130px;">
                    Alamat Domisili
                    Saat ini
                </td>
                <td
                    style="font-weight: bold;
                    text-align: center; border: 2px solid #000000; background-color: #d1d1d1; width: 130px;">
                    nonik
                </td>
                <td
                    style="font-weight: bold;
                    text-align: center; border: 2px solid #000000; background-color: #d1d1d1; width: 130px;">
                    nokk
                </td>
                <td
                    style="font-weight: bold;
                    text-align: center; border: 2px solid #000000; background-color: #d1d1d1; width: 130px;">
                    nik_kepala_keluarga
                </td>
                <td
                    style="font-weight: bold;
                    text-align: center; border: 2px solid #000000; background-color: #d1d1d1; width: 130px;">
                    nama_kepala_keluarga_sesuai_kk
                </td>

                <td
                    style="font-weight: bold;
                    text-align: center; border: 2px solid #000000; background-color: #d1d1d1; width: 130px;">
                    Status Evaluasi
                </td>
                <td
                    style="font-weight: bold;
    text-align: center; border: 2px solid #000000; background-color: #d1d1d1; width: 130px;">
                    provinsi
                </td>
                <td
                    style="font-weight: bold;
        text-align: center; border: 2px solid #000000; background-color: #d1d1d1; width: 130px;">
                    kabupaten
                </td>
                <td
                    style="font-weight: bold;
                text-align: center; border: 2px solid #000000; background-color: #d1d1d1; width: 130px;">
                    kecamatan
                </td>
                <td
                    style="font-weight: bold;
            text-align: center; border: 2px solid #000000; background-color: #d1d1d1; width: 130px;">
                    kelurahan
                </td>
                <td
                    style="font-weight: bold;
text-align: center; border: 2px solid #000000; background-color: #d1d1d1; width: 130px;">
                    kode_pos
                </td>
            </tr>
            @php $no = 1; @endphp
            @forelse($mahasiswas as $mahasiswa)
                <tr>
                    <td style="text-align: center; border: 2px solid #000000; width: 30px;">
                        {{ $no++ }}
                    </td>
                    <td style="text-align: center; border: 2px solid #000000; width: 90px;">
                      {{ $mahasiswa->mhs_id }}
                  </td>
                  <td style="text-align: center; border: 2px solid #000000; width: 90px;">
                    {{ $mahasiswa->nim }}
                </td>  
                  <td style="text-align: center; border: 2px solid #000000; width: 90px;">
                        {{ $mahasiswa->nama }}
                    </td>
                    <td style="text-align: center; border: 2px solid #000000; width: 90px;">
                        {{ $mahasiswa->email }}
                    </td>
                    <td style="text-align: center; border: 2px solid #000000; width: 90px;">
                        {{ $mahasiswa->password }}
                    </td>
                    <td style="text-align: center; border: 2px solid #000000; width: 130px;">
                        {{ $mahasiswa->tahun_masuk }}
                    </td>
                    <td style="text-align: center; border: 2px solid #000000; width: 130px;">
                        {{ $mahasiswa->program_studi }}
                    </td>
                    <td style="text-align: center; border: 2px solid #000000; width: 130px;">
                        {{ $mahasiswa->rombel }}
                    </td>
                    <td style="text-align: center; border: 2px solid #000000; width: 100px;">
                        {{ $mahasiswa->program_studi }}
                    </td>
                    <td style="text-align: center; border: 2px solid #000000; width: 130px;">
                        {{ $mahasiswa->jalur_beastudi }}
                    </td>
                    <td style="text-align: center; border: 2px solid #000000; width: 130px;">
                        {{ $mahasiswa->nomor_hp }}
                    </td>
                    <td style="text-align: center; border: 2px solid #000000; width: 100px;">
                        {{ $mahasiswa->alamat }}
                    </td>
                    <td style="text-align: center; border: 2px solid #000000; width: 100px;">
                        {{ $mahasiswa->no_ktp }}
                    </td>
                    <td style="text-align: center; border: 2px solid #000000; width: 100px;">
                        {{ $mahasiswa->no_kk }}
                    </td>
                    <td style="text-align: center; border: 2px solid #000000; width: 100px;">
                        {{ $mahasiswa->no_ktp_kepala_keluarga }}
                    </td>
                    <td style="text-align: center; border: 2px solid #000000; width: 100px;">
                        {{ $mahasiswa->nama_kepala_keluarga }}
                    </td>
                    <td style="text-align: center; border: 2px solid #000000; width: 100px;">
                        {{ $mahasiswa->status }}
                    </td>
                    <td style="text-align: center; border: 2px solid #000000; width: 130px;">
                        {{ $mahasiswa->provinsi }}
                    </td>
                    <td style="text-align: center; border: 2px solid #000000; width: 130px;">
                        {{ $mahasiswa->kota }}
                    </td>
                    <td style="text-align: center; border: 2px solid #000000; width: 130px;">
                        {{ $mahasiswa->kecamatan }}
                    </td>
                    <td style="text-align: center; border: 2px solid #000000; width: 130px;">
                        {{ $mahasiswa->kelurahan }}
                    </td>
                    <td style="text-align: center; border: 2px solid #000000; width: 130px;">
                        {{ $mahasiswa->kode_pos }}
                    </td>
                </tr>
            @empty
                <tr>
                    <th valign="center" style="border: 2px solid #ffffff;" colspan="9">Data transakasi tidak
                        ditemukan
                    </th>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>

</html>
