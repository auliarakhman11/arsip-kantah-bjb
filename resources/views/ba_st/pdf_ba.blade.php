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
            <p class="mt-4 hurufT" style="margin-top: -5px; "><u><b>BERITA ACARA PEMERIKSAAN WARKAH/BUKU TANAH</b></u><br>
                <b>NO : {{ $dt_ba->no_ba_bt }}</b>
            </p>
        </center>
       

        <div class="row justify-content-center">
            <div class="col-8">
                <p class="mt-4 hurufT" style="">Pada hari ini <b>{{ $tgl }}</b> Kami yang bertanda tangan dibawah ini :</p>
            </div>
            <div class="col-8">
                <table width="70%" class="hurufT" style="margin-left: 80px; margin-top: -5px;">

                    <tr>
                        <td>1.</td>
                        <td>Nama</td>
                        <td>: {{ $php2['nm_pejabat'] }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>NIP</td>
                        <td>: {{ $php2['nip'] }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Golongan</td>
                        <td>: {{ $php2['golongan'] }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Jabatan Fungsional</td>
                        <td>: {{ $php2['jabatan'] }}</td>
                    </tr>

                    <tr>
                        <td>2.</td>
                        <td>Nama</td>
                        <td>: {{ $arsip['nm_pejabat'] }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>NIP</td>
                        <td>: {{ $arsip['nip'] }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Golongan</td>
                        <td>: {{ $arsip['golongan'] }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Jabatan</td>
                        <td>: {{ $arsip['jabatan'] }}</td>
                    </tr>

                    <tr>
                        <td>3.</td>
                        <td>Nama</td>
                        <td>: {{ $arsip2['nm_pejabat'] }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>NRP</td>
                        <td>: {{ $arsip2['nip'] }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Golongan</td>
                        <td>: {{ $arsip2['golongan'] }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Jabatan</td>
                        <td>: {{ $arsip2['jabatan'] }}</td>
                    </tr>
                </table>

            </div>

            <div class="col-9 mt-3">
                <p class="hurufT" style="text-align: justify;">&nbsp; Telah melakukan pencarian berulang-ulang secara intensif dan cermat atas Buku Tanah Sertipikat Hak
                   <b>{{ $dt_ba->peminjaman[0]->hak->kode_hak }}</b> Nomor : <b>{{ $dt_ba->peminjaman[0]->no_hak }}</b> seluas <b>{{ $dt_ba->luas }}</b> M<sup>2</sup> terakhir terdaftar atas nama pemegang hak <b>{{ $dt_ba->nm_pemilik }}</b> terletak di Desa/Kelurahan <b>{{ $dt_ba->peminjaman[0]->kelurahan->nm_kelurahan }}</b> Kecamatan <b>{{ $dt_ba->peminjaman[0]->kecamatan->nm_kecamatan }}</b>, Kabupaten <b>BANJAR</b>, dan
                    terhadap Buku Tanah dimaksud sampai saat ini tidak ditemukan. Namun berdasarkan data pada
                    Aplikasi komputerisasi kantor pertanahan (KKP) dan buku desa, Sertipikat hak <b>{{ $dt_ba->peminjaman[0]->hak->kode_hak }}</b> tersebut di atas
                    benar terdaftar dan tercatat pada Kantor Pertanahan Kabupaten Banjar.<br>
                    Demikian Berita Acara ini kami buat untuk dapat dipergunakan sebagaimana mestinya.
                </p>
            </div>
        </div>

        <center><p class="hurufT"><b>YANG MELAKUKAN PENCARIAN</b></p></center>

        <table width="55%" style="float: left;" class="hurufT">
            <tr>
                <td width="5%">1.</td>
                <td colspan="2" width="70%">Pejabat Fungsional
                    {{ $php2['jabatan'] }} 
                    Seksi Penetapan Hak dan Pendaftaran</td>
                <td></td>
            </tr>
            <br>
            <tr>
                <td width="5%"></td>
                <td width="70%">{{ $php2['nm_pejabat'] }} <br> NIP. {{ $php2['nip'] }}</td>
                <td>:.............</td>
                <td></td>
            </tr>
        </table>

        <table width="45%" style="float:right;" class="hurufT">
            <tr>
                <td>2.</td>
                <td>{{ $arsip['nm_pejabat'] }}</td>
                <td>: ................</td>
            </tr>
            <tr>
                <td></td>
                <td>NIP. {{ $arsip['nip'] }}</td>
                <td></td>
            </tr>
            <br>
            <tr>
                <td >3.</td>
                <td>{{ $arsip2['nm_pejabat'] }}</td>
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
            
        </table>

        
    </div>
    

</div>

<div class="" style="margin-left: 400px;">
<center>
    <p class="hurufT"><b>Mengetahui <br>
        A.n. Kepala Kantor Pertanahan Kabupaten Banjar <br>
        {{ $php['jabatan'] }}
    </b></p>
</center>

<center>
    <p class="hurufT" style=" margin-top: 70px;"><b><u>{{ $php['nm_pejabat'] }}</u> <br> NIP. {{ $php['nip'] }}</b></p>
</center></div>

<center><img class="float-left" style="margin-top:50px;" width="150px" src="{{asset('img')}}/footer.png"></center>


</body>
</html>