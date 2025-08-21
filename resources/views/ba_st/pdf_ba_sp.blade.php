<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita Acara</title>
    <link rel="stylesheet" href="{{ asset('css') }}/bootstrap.min.css">

    <style>
        
    .hurufT {
        font-family: 'Times New Roman';
        font-size: 13px;
    }

.font_footer {
font-family: 'Freestyle Script';
}
    </style>
</head>
<body>

    @php
    $tu = [];
    $arsip = [];
    $arsip2 = [];
    $sp = [];
    $sp2 = [];
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

                        if($d->id == 6){
                            $sp  = [
                                'id' => $d->id,
                                'nm_pejabat' => $d->nm_pejabat,
                                'nip' => $d->nip,
                                'jabatan' => $d->jabatan,
                                'golongan' => $d->golongan
                            ];
                        }

                        if($d->id == 7){
                            $sp2  = [
                                'id' => $d->id,
                                'nm_pejabat' => $d->nm_pejabat,
                                'nip' => $d->nip,
                                'jabatan' => $d->jabatan,
                                'golongan' => $d->golongan
                            ];
                        }
        }
    @endphp

<div class="container-fluid dt-page">
    <img class="float-left" width="130px" style="margin-right: -90px; float: left;" src="{{asset('img')}}/Logo_BPN-KemenATR.png">    
    <div id="dt-header">       

            <p style="font-size: 20px; font-family: 'Times New Roman';"  class="text-center">
                <b>KEMENTERIAN AGRARIA DAN TATA RUANG/ <br>
                    BADAN PERTANAHAN NASIONAL <br>
                    KANTOR PERTANAHAN KABUPATEN BANJAR <br>
                    PROVINSI KALIMANTAN SELATAN
                </b>
            </p>
            <p class="text-center" style="font-family: 'Arial Narrow'; font-size: 13px; margin-top: -10px;">
                Jalan Menteri Empat No.04 Sungai Paring Martapura 70613 No. Telp. (0511) 4721294-4721010
            </p>
        <center>
            <hr style="border: 1px solid; margin-top: -5px;">
        </center>
    </div>
    <div class="dt-body" style="width: 80%; margin-left: 70px;">
        <center>
            <p class="mt-4 hurufT" style="margin-top: -5px; "><u><b>BERITA ACARA PEMERIKSAAN WARKAH GAMBAR SITUASI / SURAT UKUR</b></u><br>
                <b>Nomor: {{ $dt_ba->no_ba_su }}</b>
            </p>
        </center>
       

        <div class="row justify-content-center" style="">
            <div class="col-8">
                <p class="mt-4 hurufT" style="">Pada hari ini <b>{{ $tgl }}</b> Kami yang bertanda tangan dibawah ini :</p>
            </div>
            <div class="col-8">
                <table width="70%" class="hurufT" style="margin-left: 80px; margin-top: -5px;">
                    
                    <tr>
                        <td>Nama</td>
                        <td>: {{ $arsip['nm_pejabat'] }}</td>
                    </tr>
                    <tr>
                        <td>NIP</td>
                        <td>: {{ $arsip['nip'] }}</td>
                    </tr>
                    <tr>
                        <td>Jabatan</td>
                        <td>: {{ $arsip['jabatan'] }}</td>
                    </tr>
                    <br>
                    <tr>
                        <td>Nama</td>
                        <td>: {{ $arsip2['nm_pejabat'] }}</td>
                    </tr>
                    <tr>
                        <td>NRP</td>
                        <td>: {{ $arsip2['nip'] }}</td>
                    </tr>
                    <tr>
                        <td>Jabatan</td>
                        <td>: {{ $arsip2['jabatan'] }}</td>
                    </tr>
                </table>

            </div>

            <div class="col-9 mt-3">
                <p class="hurufT" style="text-align: justify;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Telah melakukan pencarian secara intensif dan cermat pada bundel Gambar Situasi / Surat Ukur 
                   <b>Nomor: {{ $dt_ba->no_su }} Desa / Kelurahan {{ $dt_ba->kelurahan }} Kecamatan {{ $dt_ba->kecamatan }} Kabupaten Banjar </b> serta warkah teknik Gambar Situasi / Surat Ukur tersebut untuk permohonan {{ $dt_ba->permohonan }} 
                   @if ($dari && $sampai)
                   dari tanggal {{ $dari }} sampai dengan {{ $sampai }}
                   @endif
                    namun sampai saat ini belum ditemukan.
                </p>
            </div>
            
        </div>

        {{-- <center><p class="hurufT"><b>YANG MELAKUKAN PENCARIAN</b></p></center> --}}

        <table width="55%" style="float: left;" class="hurufT">
            <tr>
                <td width="5%"></td>
                <td colspan="2" width="70%">Mengetahui <br>
                    {{ $sp2['jabatan'] }} <br>
                    Seksi Survei dan Pemetaan</td>
                <td></td>
            </tr>
            <br>
            <tr>
                <td width="5%"></td>
                <td width="70%"><u>{{ $sp2['nm_pejabat'] }}</u> <br> NIP. {{ $sp2['nip'] }}</td>
                <td>:.............</td>
                <td></td>
            </tr>
        </table>

        <table width="45%" style="float:right;" class="hurufT">
            <tr>
                <td></td>
                <td><u>{{ $arsip['nm_pejabat'] }}</u></td>
                <td>: ................</td>
            </tr>
            <tr>
                <td></td>
                <td>NIP. {{ $arsip['nip'] }}</td>
                <td></td>
            </tr>
            <br>
            <tr>
                <td ></td>
                <td><u>{{ $arsip2['nm_pejabat'] }}</u></td>
                <td>: ................</td>
            </tr>
            <tr>
                <td></td>
                <td>NRP. {{ $arsip2['nip'] }}</td>
                <td></td>
            </tr>
            <br>
            <tr>
                <td></td>
                <td colspan="2" ></td>
                <td></td>
            </tr>
            <br>
            <tr>
                <td></td>
                <td ></td>
                <td></td>
                <td></td>
            </tr>
            <br>
            <br>
        </table>

        
    </div>
    

</div>

<div class="" style="margin-left: 400px; margin-top: 10px;">
<center>
    <p class="hurufT"><b>
        A.n. Kepala Kantor Pertanahan Kabupaten Banjar <br>
        {{ $sp['jabatan'] }}
    </b></p>
</center>

<center>
    <p class="hurufT" style=" margin-top: 70px;"><b><u>{{ $sp['nm_pejabat'] }}</u> <br> NIP. {{ $sp['nip'] }}</b></p>
</center></div>


    
<center><img class="float-left" style="margin-top:180px;" width="150px" src="{{asset('img')}}/footer.png"></center>

</body>
</html>