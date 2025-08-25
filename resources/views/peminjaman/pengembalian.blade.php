@extends('template.master')
@section('content')
    <style>
        .blink {
            animation: blink 1s steps(1, end) infinite;
        }

        @keyframes blink {
            0% {
                background-color: red;
                color: white;
            }

            50% {
                background-color: orange;
            }

            100% {
                background-color: yellow;
            }
        }
    </style>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-2">
                        <h4 class="m-0">Pengembalian</h4>
                    </div><!-- /.col -->
                    <div class="col-10" id="form_dashboard">

                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-center">

                    <div class="col-12">

                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="get_peminjaman" data-toggle="tab" href="#peminjaman"
                                    role="tab" aria-controls="peminjaman" aria-selected="true">Peminjaman</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="nav_selesai" data-toggle="tab" href="#selesai" role="tab"
                                    aria-controls="selesai" aria-selected="false">Selesai</a>
                            </li>
                        </ul>

                        <div class="tab-content" id="myTabContent">


                            {{-- peminjaman --}}
                            <div class="tab-pane fade show active" id="peminjaman" role="tabpanel"
                                aria-labelledby="peminjaman-tab">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="float-left">Peminjaman</h4>
                                        <a href="#modal-print" data-toggle="modal"
                                            class="btn btn-sm btn-info float-right"><i class="fas fa-print"></i> Print</a>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-sm text-center" width="100%" id="table_peminjaman"
                                                style="font-size: 13px;">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        {{-- <th width="0.1%"></th> --}}
                                                        <th>Kecamatan</th>
                                                        <th>Kelurahan</th>
                                                        <th>No Berkas</th>
                                                        <th>Tipe Hak</th>
                                                        <th>No Hak</th>
                                                        <th>Jenis</th>
                                                        <th>Pelayanan</th>
                                                        <th>Keterangan</th>
                                                        <th>Waktu</th>
                                                        <th>Status</th>
                                                        <th>History</th>
                                                        <th>User</th>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            {{-- end peminjaman --}}

                            {{-- selesai --}}
                            <div class="tab-pane fade" id="selesai" role="tabpanel" aria-labelledby="selesai-tab">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Selesai</h4>
                                    </div>
                                    <div class="card-body">

                                        <div class="table-responsive">
                                            <table class="table table-sm" width="100%" id="selesai_table"
                                                style="font-size: 13px;">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        {{-- <th width="0.1%"></th> --}}
                                                        <th>Kecamatan</th>
                                                        <th>Kelurahan</th>
                                                        <th>Pelayanan</th>
                                                        <th>No Berkas</th>
                                                        <th>Tipe Hak</th>
                                                        <th>No Hak</th>
                                                        <th>Jenis Arsip</th>
                                                        <th>Keterangan</th>
                                                        <th>Waktu</th>
                                                        <th>History</th>
                                                        <th>User</th>
                                                    </tr>

                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            {{-- end selesai --}}

                        </div>

                    </div>

                </div>
            </div><!--/. container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <form action="{{ route('printDataPeminjaman') }}" method="get">
        <div class="modal fade" id="modal-print" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title" id="exampleModalLabel">Print</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <table>
                                <tr>
                                    <td><label for="">Tanggal</label></td>
                                    <td>:</td>
                                    <td> <input style="width: 350px;" class="form-control" type="input"
                                            value="{{ date('Y-m-d') }}" id="print"></td>
                                </tr>
                            </table>

                            <input class="form-control" type="date" value="" id="tgl1" name="tgl1" hidden>
                            <input class="form-control" type="date" value="" id="tgl2" name="tgl2" hidden>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info">Print</button>

                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="modal fade" id="modal_pengembalian" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title" id="exampleModalLabel">Pengembalian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4>Apakah anda yakin ingin mengembalikan?</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-8">
                            <form id="form-forward">
                                <div class="row">
                                    <div class="col-8">
                                        <input type="hidden" name="id_peminjaman" class="id_pengembalian">
                                        <select name="seksi_pelayanan" class="form-control form-control-sm"
                                            required>
                                            <option value="">-Pilih Seksi-</option>
                                            @foreach ($seksi as $d)
                                                <option value="{{ $d->id }}|{{ $d->seksi->id }}">
                                                    {{ $d->seksi->nm_seksi }}-{{ $d->nm_pelayanan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <button id="btn-forward" type="submit"
                                            class="btn btn-sm btn-warning float-left"><i class="fas fa-share-square"></i>
                                            Forward</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-4">
                            <form id="form-pengembalian">
                                <input type="hidden" name="id_peminjaman" class="id_pengembalian">
                                <button type="submit" class="btn btn-sm btn-primary float-right"
                                    id="btn-pengembalian">Kembalikan</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_terima_forward" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title" id="exampleModalLabel">Terima Forward</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4>Apakah anda yakin telah menerima bekas?</h4>
                </div>
                <div class="modal-footer">
                    <form id="form_tidak_forward" class="d-inline-block">
                        <input type="hidden" name="peminjaman_id" class="peminjaman_id">
                        <button type="submit" class="btn btn-warning" id="btn_tidak_forward">Tidak</button>
                    </form>

                    <form id="form_terima_forward" class="d-inline-block">
                        <input type="hidden" name="peminjaman_id" class="peminjaman_id">
                        <button type="submit" class="btn btn-primary" id="btn_terima_forward">Terima</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_history" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title" id="exampleModalLabel">History</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="table_history">

                </div>

            </div>
        </div>
    </div>

    <form id="upload_arsip">
        <div class="modal fade" id="modal_upload_arsip" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title" id="exampleModalLabel">Upload Arsip</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body row">
                        <div class="col-12">
                            <div id="message_error" style="display:none"></div>
                        </div>
                        <input type="hidden" name="peminjaman_id" id="peminjaman_id_upload_arsip">

                        <div class="col-12">
                            <div class="form-group">
                                <label>Nomor Perkara</label>
                                <input type="text" name="no_perkara" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label>File Arsip</label>
                                <input type="file" accept="application/pdf" name="file_name" class="form-control"
                                    required>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="btn_upload_arsip" class="btn btn-info">Upload</button>

                    </div>
                </div>
            </div>
        </div>
    </form>


@section('script')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });

        $(document).ready(function() {

            function getDashboard() {
                $.get('get-dashboard', function(data) {
                    $('#form_dashboard').html(data);
                });
            }

            getDashboard();

            function getPeminjaman() {
                var pTable = $('#table_peminjaman').dataTable(); //inialisasi datatable
                pTable.fnDraw(false); //reset datatable
            }

            $('#table_peminjaman').DataTable({
                processing: true,
                serverSide: true, //aktifkan server-side 
                ajax: {
                    url: "{{ route('getPeminjaman') }}",
                    type: 'GET'
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    // {
                    //     data: 'search',
                    //     name: 'search'
                    // },
                    {
                        data: 'kecamatan.nm_kecamatan',
                        name: 'kecamatan.nm_kecamatan'
                    },
                    {
                        data: 'kelurahan.nm_kelurahan',
                        name: 'kelurahan.nm_kelurahan'
                    },
                    {
                        data: 'no_berkas',
                        name: 'no_berkas'
                    },
                    {
                        data: 'hak.nm_hak',
                        name: 'hak.nm_hak'
                    },
                    {
                        data: 'no_hak',
                        name: 'no_hak'
                    },
                    {
                        data: 'jenis_arsip',
                        name: 'jenis_arsip'
                    },
                    {
                        data: 'pelayanan.nm_pelayanan',
                        name: 'pelayanan.nm_pelayanan'
                    },
                    {
                        data: 'ket',
                        name: 'dt_keterangan.ket'
                    },
                    {
                        data: 'waktu',
                        name: 'dt_keterangan.waktu'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'history',
                        name: 'history'
                    },
                    {
                        data: 'user.name',
                        name: 'user.name'
                    },
                ],
                order: [],
                columnDefs: [{
                        "targets": 0,
                        "orderable": false
                    },
                    {
                        "searchable": false,
                        "targets": 0
                    }
                ],
            });

            //peminjaman
            $(document).on('click', '#get_peminjaman', function() {
                getPeminjaman();
            });

            $(document).on('click', '.pengembalian', function() {
                var id_peminjaman = $(this).attr('id_peminjaman');
                $('.id_pengembalian').val(id_peminjaman);
            });

            $(document).on('submit', '#form-pengembalian', function(event) {
                event.preventDefault();
                $('#btn-pengembalian').attr('disabled', true);
                $('#btn-pengembalian').html('Loading..');
                $.ajax({
                    url: "{{ route('kembalikanBerkas') }}",
                    method: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $('#modal_pengembalian').modal('hide'); //modal hide
                        $("#btn-pengembalian").removeAttr("disabled");
                        $('#btn-pengembalian').html('Kembalikan'); //tombol
                        getPeminjaman();
                        getDashboard();
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            icon: 'success',
                            title: 'Berkas dikembalikan'
                        });

                    }
                });

            });
            //end peminjaman

            //forward
            $(document).on('submit', '#form-forward', function(event) {
                event.preventDefault();
                $('#btn-pengembalian').attr('disabled', true);
                $('#btn-pengembalian').html('Loading..');

                $('#btn-forward').attr('disabled', true);
                $('#btn-forward').html('Loading..');
                $.ajax({
                    url: "{{ route('kirimForward') }}",
                    method: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $('#modal_pengembalian').modal('hide'); //modal hide
                        $("#btn-pengembalian").removeAttr("disabled");
                        $('#btn-pengembalian').html('Kembalikan'); //tombol

                        $("#btn-forward").removeAttr("disabled");
                        $('#btn-forward').html(
                        '<i class="fas fa-share-square"></i> Forward'); //tombol
                        getPeminjaman();
                        getDashboard();
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            icon: 'success',
                            title: 'Berkas berhasil diforward'
                        });

                    }
                });

            });

            $(document).on('click', '.terima_forward', function() {
                var peminjaman_id = $(this).attr('peminjaman_id');
                $('.peminjaman_id').val(peminjaman_id);
            });

            $(document).on('submit', '#form_terima_forward', function(event) {
                event.preventDefault();
                $('#btn_terima_forward').attr('disabled', true);
                $('#btn_terima_forward').html('Loading..');

                $('#btn_tidak_forward').attr('disabled', true);
                $('#btn_tidak_forward').html('Loading..');
                $.ajax({
                    url: "{{ route('terimaForward') }}",
                    method: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $('#modal_terima_forward').modal('hide'); //modal hide
                        $("#btn_terima_forward").removeAttr("disabled");
                        $('#btn_terima_forward').html('Terima'); //tombol

                        $("#btn_tidak_forward").removeAttr("disabled");
                        $('#btn_tidak_forward').html('Tidak'); //tombol
                        getPeminjaman();
                        getDashboard();
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            icon: 'success',
                            title: 'Forward diterima'
                        });

                    }
                });

            });

            $(document).on('submit', '#form_tidak_forward', function(event) {
                event.preventDefault();
                $('#btn_terima_forward').attr('disabled', true);
                $('#btn_terima_forward').html('Loading..');

                $('#btn_tidak_forward').attr('disabled', true);
                $('#btn_tidak_forward').html('Loading..');
                $.ajax({
                    url: "{{ route('tidakForward') }}",
                    method: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $('#modal_terima_forward').modal('hide'); //modal hide
                        $("#btn_terima_forward").removeAttr("disabled");
                        $('#btn_terima_forward').html('Terima'); //tombol

                        $("#btn_tidak_forward").removeAttr("disabled");
                        $('#btn_tidak_forward').html('Tidak'); //tombol
                        getPeminjaman();
                        getDashboard();
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            icon: 'success',
                            title: 'Forward Ditolak'
                        });

                    }
                });

            });
            //endforward

            //selesai
            $('#selesai_table').DataTable({
                processing: true,
                serverSide: true, //aktifkan server-side 
                ajax: {
                    url: "{{ route('getSelesai') }}",
                    type: 'GET'
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    // {
                    //     data: 'search',
                    //     name: 'search'
                    // },
                    {
                        data: 'kecamatan.nm_kecamatan',
                        name: 'kecamatan.nm_kecamatan'
                    },
                    {
                        data: 'kelurahan.nm_kelurahan',
                        name: 'kelurahan.nm_kelurahan'
                    },
                    {
                        data: 'pelayanan.nm_pelayanan',
                        name: 'pelayanan.nm_pelayanan'
                    },
                    {
                        data: 'no_berkas',
                        name: 'no_berkas'
                    },
                    {
                        data: 'hak.nm_hak',
                        name: 'hak.nm_hak'
                    },
                    {
                        data: 'no_hak',
                        name: 'no_hak'
                    },
                    {
                        data: 'jenis_arsip',
                        name: 'jenis_arsip'
                    },
                    {
                        data: 'ket',
                        name: 'dt_keterangan.ket'
                    },
                    {
                        data: 'waktu',
                        name: 'dt_keterangan.waktu'
                    },
                    {
                        data: 'history',
                        name: 'history'
                    },
                    {
                        data: 'user.name',
                        name: 'user.name'
                    },
                ],
                order: [],
                columnDefs: [{
                        "targets": 0,
                        "orderable": false
                    },
                    {
                        "searchable": false,
                        "targets": 0
                    }
                ],
            });

            function getSelesai() {
                var aTable = $('#selesai_table').dataTable(); //inialisasi datatable
                aTable.fnDraw(false); //reset datatable
            }

            $(document).on('click', '#nav_selesai', function() {
                getSelesai();
            });

            $(document).on('click', '.btn_history', function() {
                var id_peminjaman = $(this).attr('id_peminjaman');
                $.get('get-history/' + id_peminjaman, function(data) {
                    $('#table_history').html(data);
                });
            });
            //end selesai

            $(document).on('click', '.upload_arsip', function() {
                var id_peminjaman = $(this).attr('id_peminjaman');
                $('#peminjaman_id_upload_arsip').val(id_peminjaman);


            });


            $(document).on('submit', '#upload_arsip', function(event) {
                event.preventDefault();
                $('#btn_upload_arsip').attr('disabled', true);
                $('#btn_upload_arsip').html(
                    'Loading <div class="ld"><div></div><div></div><div></div></div>');
                $.ajax({
                    url: "{{ route('uploadArsip') }}",
                    method: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(data) {


                        $("#btn_upload_arsip").removeAttr("disabled");
                        $('#btn_upload_arsip').html('Upload'); //tombol simpan

                        $('#modal_upload_arsip').modal('hide'); //modal hide

                        $('#upload_arsip').trigger("reset");


                        getPeminjaman();

                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            icon: 'success',
                            title: 'Data scan berhasil diupload'
                        });

                        window.location.href = "/watermark/" + data;


                    },
                    error: function(data) { //jika error tampilkan error pada console
                        console.log('Error:', data);

                        var dt_error = '<div class="alert alert-danger">';
                        jQuery.each(data.responseJSON.errors, function(key, message) {

                            dt_error += '<p>' + message + '</p>';
                            // $('.alert-danger').append('<p>'+message+'</p>');
                        });
                        dt_error += '</div>';
                        $('#message_error').html(dt_error);
                        $('#message_error').show();
                        $('#btn_upload_arsip').html('Upload');
                        $("#btn_upload_arsip").removeAttr("disabled");
                    }
                });

            });


            $(document).on('click', '.hapus_watermark', function() {
                if (confirm('Are you sure?')) {
                    var id_peminjaman = $(this).attr('id_peminjaman');
                    $.get('hapus-watermark/' + id_peminjaman, function(data) {

                        getPeminjaman();

                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            icon: 'success',
                            title: 'Data scan berhasil dihapus'
                        });

                    });
                }

            });



        });
    </script>
@endsection
@endsection
