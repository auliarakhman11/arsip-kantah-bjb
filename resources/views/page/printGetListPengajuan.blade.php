<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $pengajuan ? $pengajuan[0]->no_tiket : '' }}</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <div class="col-6">
                <h4>No Tiket : {{ $pengajuan ? $pengajuan[0]->no_tiket : '' }}</h4>
            </div>
            <div class="col-12">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>Tanggal</th>
                            <th>No Berkas</th>
                            <th>Kecamatan</th>
                            <th>Kelurahan</th>
                            <th>Pelayanan</th>
                            <th>Tipe Hak</th>
                            <th>No Hak</th>
                            <th>Jenis Arsip</th>
                            <th>Keterangan</th>
                            <th>User</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pengajuan as $p)
                            <tr>
                                <td>{{ date('d/m/Y') }}</td>
                                <td>{{ $p->no_berkas }}</td>
                                <td>{{ $p->kecamatan->nm_kecamatan }}</td>
                                <td>{{ $p->kelurahan->nm_kelurahan }}</td>
                                <td>{{ $p->pelayanan->nm_pelayanan }}</td>
                                <td>{{ $p->hak->nm_hak }}</td>
                                <td>{{ $p->no_hak }}</td>
                                <td>{{ $p->jenis_arsip }}</td>
                                <td>{{ $p->keterangan }}</td>
                                <td>{{ $p->user->name }}</td>
                                <td></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>



            </div>
        </div>
    </div>


</body>

</html>
