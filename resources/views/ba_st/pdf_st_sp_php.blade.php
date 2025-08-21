<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Tugas</title>
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
    <div class="dt-body">
        <center>
            <p class="mt-4 hurufT" style="margin-top: -5px;"><u><b>SURAT TUGAS</b></u><br>
                <b>NO : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $dt_st->peminjaman[0]->no_st_php }}</b>
            </p>
            
        </center>
        <div class="container">
            @if ($dt_st->peminjaman[0]->seksi_id == 6)
            <p class="hurufT" style="margin-left: 50px; margin-top: -5px;">{{ $dt_st->peminjaman[0]->keterangan }} Berdasarkan {{ $dt_st->peminjaman[0]->pelayanan->nm_pelayanan }} no {{ $dt_st->peminjaman[0]->no_berkas ? $dt_st->peminjaman[0]->no_berkas : '-' }} dengan ini Kepala kantor menugaskan kepada :</p>
            @else
            <p class="hurufT" style="margin-left: 50px; margin-top: -5px;">Berdasarkan permohonan {{ $dt_st->peminjaman[0]->pelayanan->nm_pelayanan }} no {{ $dt_st->peminjaman[0]->no_berkas ? $dt_st->peminjaman[0]->no_berkas : '-' }} dengan ini Kepala kantor menugaskan kepada :</p>
            @endif
            
        </div>
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
                <td></td>
                <td>Dengan Tugas</td>
                <td>: Melaksanakan Tugas Untuk Mencari Buku Tanah</td>
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
                <td></td>
                <td>Dengan Tugas</td>
                <td>: Melaksanakan Tugas Untuk Mencari Buku Tanah</td>
            </tr>

            <tr>
                <td>3.</td>
                <td>Nama</td>
                <td>: {{ $arsip2['nm_pejabat'] }}</td>
            </tr>
            <tr>
                <td></td>
                <td>NIP</td>
                <td>:</td>
            </tr>
            <tr>
                <td></td>
                <td>Golongan</td>
                <td>:</td>
            </tr>
            <tr>
                <td></td>
                <td>Jabatan</td>
                <td>: {{ $arsip2['jabatan'] }}</td>
            </tr>
            <tr>
                <td></td>
                <td>Dengan Tugas</td>
                <td>: Melaksanakan Tugas Untuk Mencari Buku Tanah</td>
            </tr>
        </table>

        <p class="hurufT" style="margin-left: 50px; margin-bottom: -5px; ">Buku Tanah yang dicari :</p>
        <table class="hurufT" style="margin-left: 60px;">
            <tr>
                <td width="10%;">1.</td>
                <td width="39%;">Hak</td>
                <td>: <b>{{ strtoupper($dt_st->hak->kode_hak) }} NOMOR {{ $dt_st->no_hak }}</b></td>
            </tr>
            <tr>
                <td width="10%;">2.</td>
                <td width="39%;">Desa/Kelurahan</td>
                <td>: <b>{{ strtoupper($dt_st->kelurahan->nm_kelurahan) }}</b></td>
            </tr>
            <tr>
                <td width="10%;">3.</td>
                <td width="39%;">Kecamatan</td>
                <td>: <b>{{ strtoupper($dt_st->kecamatan->nm_kecamatan) }}</b></td>
            </tr>
            <tr>
                <td width="10%;">4.</td>
                <td width="39%;">Atas Nama</td>
                <td>: <b>{{ strtoupper($dt_st->nm_pemilik) }}</b></td>
            </tr>
        </table>
        <br>
        <p class="hurufT mt-4" style="margin-left: 50px; margin-bottom: -5px; ">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Demikian Surat Tugas ini dibuat untuk dilaksanakan dengan penuh tanggung jawab dan dipergunakan sebagaimana mestinya.</p>

        <div style="float: right; margin-right: 20px;">
            <table width="100%" class="hurufT" >
                <tr>
                    <td width="40%">Dikeluarkan di</td>
                    <td>: Martapura</td>
                </tr>
                <tr>
                    <td width="40%">Pada Tanggal</td>
                    <td>: {{ $tgl }}</td>
                </tr>
            </table>
            <hr style="border: 1px solid; margin-top: -1px;">
            <p class="hurufT" style=" margin-top: -13px;"><b>A.n. Kepala Kantor Pertanahan Kabupaten Banjar</b><br><b>{{ $php['jabatan'] }}</b></p>

            <p class="hurufT" style=" float: left; margin-top: 70px;"><b><u>{{ $php['nm_pejabat'] }}</u></b> <br>
                <b>NIP. {{ $php['nip'] }}</b></p>
        </div>

    </div>

</div>
    @if ($dt_st->peminjaman[0]->seksi_id == 6)
    <center><img class="float-left" style="margin-top:120px;" width="150px" src="{{asset('img')}}/footer.png"></center>
    @else
    <center><img class="float-left" style="margin-top:150px;" width="150px" src="{{asset('img')}}/footer.png"></center>
    @endif


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
    <div class="dt-body">
        <center>
            <p class="mt-4 hurufT" style="margin-top: -5px;"><u><b>SURAT TUGAS</b></u><br>
                <b>NO : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $dt_st->peminjaman[0]->no_st_sp }}</b>
            </p>
        </center>
        <div class="container">
            @if ($dt_st->peminjaman[0]->seksi_id == 6)
            <p class="hurufT" style="margin-left: 50px; margin-top: -5px;">{{ $dt_st->peminjaman[0]->keterangan }} Berdasarkan {{ $dt_st->peminjaman[0]->pelayanan->nm_pelayanan }} no {{ $dt_st->peminjaman[0]->no_berkas ? $dt_st->peminjaman[0]->no_berkas : '-' }} dengan ini Kepala kantor menugaskan kepada :</p>
            @else
            <p class="hurufT" style="margin-left: 50px; margin-top: -5px;">Berdasarkan permohonan {{ $dt_st->peminjaman[0]->pelayanan->nm_pelayanan }} no {{ $dt_st->peminjaman[0]->no_berkas ? $dt_st->peminjaman[0]->no_berkas : '-' }} dengan ini Kepala kantor menugaskan kepada :</p>
            @endif
        </div>
        <table width="70%" class="hurufT" style="margin-left: 80px; margin-top: -5px;">


            <tr>
                <td>1.</td>
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
                <td></td>
                <td>Dengan Tugas</td>
                <td>: Melaksanakan Tugas Untuk Mencari Buku Tanah</td>
            </tr>

            <tr>
                <td>2.</td>
                <td>Nama</td>
                <td>: {{ $arsip2['nm_pejabat'] }}</td>
            </tr>
            <tr>
                <td></td>
                <td>NIP</td>
                <td>:</td>
            </tr>
            <tr>
                <td></td>
                <td>Golongan</td>
                <td>:</td>
            </tr>
            <tr>
                <td></td>
                <td>Jabatan</td>
                <td>: {{ $arsip2['jabatan'] }}</td>
            </tr>
            <tr>
                <td></td>
                <td>Dengan Tugas</td>
                <td>: Melaksanakan Tugas Untuk Mencari Surat Ukur</td>
            </tr>
        </table>

        <p class="hurufT" style="margin-left: 50px; margin-bottom: -5px; ">Surat Ukur yang dicari :</p>
        <table class="hurufT" style="margin-left: 60px;">
            <tr>
                <td width="10%;">1.</td>
                <td width="39%;">Hak</td>
                <td>: <b>{{ strtoupper($dt_st->hak->kode_hak) }} NOMOR {{ $dt_st->no_hak }}</b></td>
            </tr>
            <tr>
                <td width="10%;">2.</td>
                <td width="39%;">Desa/Kelurahan</td>
                <td>: <b>{{ strtoupper($dt_st->kelurahan->nm_kelurahan) }}</b></td>
            </tr>
            <tr>
                <td width="10%;">3.</td>
                <td width="39%;">Kecamatan</td>
                <td>: <b>{{ strtoupper($dt_st->kecamatan->nm_kecamatan) }}</b></td>
            </tr>
            <tr>
                <td width="10%;">4.</td>
                <td width="39%;">Atas Nama</td>
                <td>: <b>{{ strtoupper($dt_st->nm_pemilik) }}</b></td>
            </tr>
        </table>
<br>
        <p class="hurufT mt-4" style="margin-left: 50px; margin-bottom: -5px; ">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Demikian Surat Tugas ini dibuat untuk dilaksanakan dengan penuh tanggung jawab dan dipergunakan sebagaimana mestinya.</p>

        <div style="float: right; margin-right: 20px;">
            <table width="100%" class="hurufT" >
                <tr>
                    <td width="40%">Dikeluarkan di</td>
                    <td>: Martapura</td>
                </tr>
                <tr>
                    <td width="40%">Pada Tanggal</td>
                    <td>: {{ $tgl }}</td>
                </tr>
            </table>
            <hr style="border: 1px solid; margin-top: -1px;">
            <p class="hurufT" style=" margin-top: -13px;"><b>A.n. Kepala Kantor Pertanahan Kabupaten Banjar</b><br><b>{{ $sp['jabatan'] }}</b></p>

            <p class="hurufT" style=" float: left; margin-top: 70px;"><b><u>{{ $sp['nm_pejabat'] }}</u></b> <br>
                <b>NIP. {{ $sp['nip'] }}</b></p>
        </div>

    </div>

</div>
    
@if ($dt_st->peminjaman[0]->seksi_id == 6)
    <center><img class="float-left" style="margin-top:120px;" width="150px" src="{{asset('img')}}/footer.png"></center>
    @else
    <center><img class="float-left" style="margin-top:150px;" width="150px" src="{{asset('img')}}/footer.png"></center>
    @endif

</body>
</html>