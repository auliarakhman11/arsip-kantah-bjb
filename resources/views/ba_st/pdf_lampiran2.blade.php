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

    @php
    $tu = [];
    $arsip = [];
    $arsip2 = [];
    $php = [];
    $php2 = [];
        foreach($penandatangan as $d){
            if($d->id == 1){
                            $tu  = [
                                'id' => $d->id,
                                'nm_pejabat' => $d->nm_pejabat,
                                'nip' => $d->nip,
                                'jabatan' => $d->jabatan,
                                'golongan' => $d->golongan
                            ];
                        }

                        if($d->id == 2){
                            $arsip  = [
                                'id' => $d->id,
                                'nm_pejabat' => $d->nm_pejabat,
                                'nip' => $d->nip,
                                'jabatan' => $d->jabatan,
                                'golongan' => $d->golongan
                            ];
                        }

                        if($d->id == 3){
                            $arsip2  = [
                                'id' => $d->id,
                                'nm_pejabat' => $d->nm_pejabat,
                                'nip' => $d->nip,
                                'jabatan' => $d->jabatan,
                                'golongan' => $d->golongan
                            ];
                        }

                        if($d->id == 4){
                            $php  = [
                                'id' => $d->id,
                                'nm_pejabat' => $d->nm_pejabat,
                                'nip' => $d->nip,
                                'jabatan' => $d->jabatan,
                                'golongan' => $d->golongan
                            ];
                        }

                        if($d->id == 5){
                            $php2  = [
                                'id' => $d->id,
                                'nm_pejabat' => $d->nm_pejabat,
                                'nip' => $d->nip,
                                'jabatan' => $d->jabatan,
                                'golongan' => $d->golongan
                            ];
                        }
        }
    @endphp


    <table width="100%">

        <tbody>
            <tr>
                <td width="10%">Data Yuridis dan Pengesahan</td>
                <td width="40%">D.I 202 (Berita Acara Pengesahan Pengumuman)</td>
                <td width="15%">Pasal 87<br>Perkaban No 3/97</td>
                <td width="7%"></td>
                <td width="8%"></td>
                <td width="20%"></td>
            </tr>

            <tr>
                <td>Pembukuan Hak</td>
                <td>D.I 205 (Buku Tanah)</td>
                <td>Pasal 90<br>Perkaban No 3/97</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td>Penerbitan sertipikat</td>
                <td>D.I 206 (Sertipikat Hak Atas Tanah)</td>
                <td>Pasal 92<br>Perkaban No 3/97</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td rowspan="5">Daftar daftar Lainnya</td>
                <td>D.I 311 (Daftar Peta Dasar Pendaftaran)</td>
                <td>Pasal 179<br>Perkaban No 3/97</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td>D.I 312 (Daftar Hak Milik, Hak Guna Bangunan, Hak Pakai, Tanah Wakaf)</td>
                <td>Pasal 180<br>Perkaban No 3/97</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td>D.I 301 (Daftar Permohonan Pekerjaan Pendaftaran Tanah)</td>
                <td>Pasal 181<br>Perkaban No 3/97</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td>D.I 208 (Daftar Penyelesaian Pekerjaan Pendaftaran Tanah)</td>
                <td>Pasal 182<br>Perkaban No 3/97</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td>D.I 301A (Daftar Penyerahan Hasil Pekerjaan)(untuk Pendaftaran tanah secara sporadik)</td>
                <td>Pasal 183<br>Perkaban No 3/97</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            
        </tbody>
    </table>

    <p>PARAF TIM PENILAIAN</p>
    @php
        $no_i = 1;
    @endphp
    <table style="border: none;">
        @if ($jenis_ba == 'php')
        <tr>
            <td width="30%" style="border: none;">{{ $no_i++ }}. {{ $php2['nm_pejabat'] }}<br></td>
            <td style="border: none;">(................)<br></td>
        </tr>
        <tr style="color: white">
            <td style="border: none;">a</td>
            <td style="border: none;">a</td>
        </tr>
        @endif
       
        <tr>
            <td width="30%" style="border: none;">{{ $no_i++ }}. {{ $arsip['nm_pejabat'] }}<br></td>
            <td style="border: none;">(................)<br></td>
        </tr>
        <tr style="color: white">
            <td style="border: none;">a</td>
            <td style="border: none;">a</td>
        </tr>
        <tr>
            <td style="border: none;">{{ $no_i++ }}. {{ $arsip2['nm_pejabat'] }}<br></td>
            <td style="border: none;">(................)<br></td>
        </tr>
    </table>
    
</div>



<center><img class="float-left" style="margin-top:150px;" width="150px" src="{{asset('img')}}/footer.png"></center>


</body>
</html>