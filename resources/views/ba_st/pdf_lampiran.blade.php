<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lampiran</title>
    {{-- <link rel="stylesheet" href="{{ asset('css') }}/bootstrap.min.css"> --}}

    <style>
        
    .hurufT {
        font-family: 'Times New Roman';
        font-size: 13px;
    }
    
    table, td, th {
    border: 1px solid;
    }

    table {
    width: 100%;
    border-collapse: collapse;
    }
    </style>

</head>
<body>

{{-- <div class="header">
    <p>Lampiran I Berita Acara Penelitian Daftar Isian, Buku Tanah Dan Warkah Setipikat Hak {{ $dt_ba->peminjaman[0]->hak->kode_hak }} No.{{ $dt_ba->peminjaman[0]->no_hak }}/{{ $dt_ba->peminjaman[0]->kelurahan->nm_kelurahan }} Atas Nama {{ $dt_ba->nm_pemilik }}</p>
    <table width="100%" style="border: none;">
        <tbody>
            <tr>
                <td style="border: none;" width="10%">Nomor</td>
                <td style="border: none;">: {{ $dt_ba->no_ba_bt }}</td>
            </tr>
            <tr>
                <td style="border: none;" width="10%">Tanggal</td>
                <td style="border: none;">: {{ $tgl }}</td>
            </tr>
        </tbody>
    </table>
</div> --}}


<div class="content">
    <h4>3. TABEL HASIL PENELITIAN DAFTAR ISIAN</h4>
    <p>I. Berdasarkan Peraturan No 10 Tahun 1961 tentang Pendaftaran Tanah</p>
    <table width="100%">
        <thead>
            <tr>
                <th width="10%">Daftar Isian</th>
                <th width="10%">Dasar Hukum</th>
                <th width="80%">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Daftar Tanah/ Buku Desa</td>
                <td rowspan="3">Pasal 7<br>PP 10/61</td>
                <td rowspan="3">Dalam Registrasi Buku Desa {{ $dt_ba->peminjaman[0]->kelurahan->nm_kelurahan }} yang memuat Nomor Hak, Nomor Surat Keputusan, Nomor Gambar Situasi, Penerima Hak, Riwayat Tanah, Keterangan, berkaitan Sertifikat Hak {{ $dt_ba->peminjaman[0]->hak->kode_hak }} Nomor : {{ $dt_ba->peminjaman[0]->no_hak }} Desa/Kelurahan {{ $dt_ba->peminjaman[0]->kelurahan->nm_kelurahan }} @if ($dt_ba->nm_pemilik)Atas Nama {{ $dt_ba->nm_pemilik }} @endif  tidak tercatat dalam buku desa {{ $dt_ba->peminjaman[0]->kelurahan->nm_kelurahan }} yang memuat Nomor Hak, Nomor Surat Keputusan, Nomor Gambar Situasi, Penerima Hak, Riwayat Tanah, Keterangan, berkaitan Sertifikat Hak {{ $dt_ba->peminjaman[0]->hak->kode_hak }} Nomor : {{ $dt_ba->peminjaman[0]->no_hak }} Desa/Kelurahan {{ $dt_ba->peminjaman[0]->kelurahan->nm_kelurahan }}</td>
            </tr>
            <tr>
                <td>Daftar Buku Tanah</td>
            </tr>
            <tr>
                <td>Daftar Surat Ukur</td>
            </tr>
        </tbody>
    </table>

    <p>II. Berdasarkan Peraturan Mentri Negara Agraria/ Kepala BPN No 3 Tahun 1997 Tentang Ketentuan Pelaksanaan Peraturan Pemerintah Nomor 24 Tahun 1997 Tentang Pendaftaran Tanah</p>
    <table width="100%">
        <thead>
            <tr>
                <th width="10%">TAHAPAN</th>
                <th width="40%">DAFTAR ISIAN</th>
                <th width="15%">DASAR HUKUM</th>
                <th width="7%">ADA</th>
                <th width="8%">TIDAK<br>ADA</th>
                <th width="20%">KETERANGAN</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td rowspan="2">Pengukuran</td>
                <td>D.I 107A (Gambar Ukur)</td>
                <td>Pasal 30 Ayat (1)<br>Perkaban No 3/97</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>D.I 302 (daftar Permohonan Pekerjaan Pengukuran)</td>
                <td>Pasal 30 Ayat (5)<br>Perkaban No 3/97</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td rowspan="2">Pengumpulan dan Penelitian Data Yuridis Bidang Tanah</td>
                <td>D.I 201 (Risalah Penelitian Yuridis dan Penetapan Batas)</td>
                <td rowspan="2">Pasal 82<br>Perkaban No 3/97</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>D.I 201C (daftar data yuridis dan Data Fisik Bidang Tanah)</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Pengumpulan Data Fisik dan</td>
                <td>D.I 201B (Pengumuman Data Fisik dan Data Yuridis)</td>
                <td>Pasal 86<br>Perkaban No 3/97</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>
</div>



<center><img class="float-left" style="margin-top:100px;" width="150px" src="{{asset('img')}}/footer.png"></center>


</body>
</html>