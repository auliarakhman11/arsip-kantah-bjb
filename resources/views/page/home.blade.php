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

        .blink2 {
            background-color: yellow;
        }

        .th-atas {
            top: 10px;
            /* Don't forget this, required for the stickiness */
        }
    </style>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-md-3 col-12">
                        <h4 class="m-0">List Peminjaman</h4>
                        <button id="peringatan" type="button" class="btn btn-info" hidden>audio</button>
                        <button id="peringatan_urgent" type="button" class="btn btn-info" hidden>audio</button>
                        <audio src="" class="speech" hidden></audio>
                        <input type="hidden" id="count" value="{{ $count }}">
                        <input type="hidden" id="urgent" value="{{ $urgent }}">
                        <input type="hidden" id="terima" value="{{ $terima }}">
                        <input type="hidden" id="seksi_id_cek" value="{{ Auth::user()->seksi_id }}">
                        <input type="hidden" id="last_seksi" value="{{ $last_seksi }}">
                    </div><!-- /.col -->
                    <div class="col-md-9 col-12" id="form_dashboard">

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
                                <a class="nav-link active" id="pengajuan-tab" data-toggle="tab" href="#pengajuan"
                                    role="tab" aria-controls="pengajuan" aria-selected="true">Pengajuan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="nav_dikirim" data-toggle="tab" href="#dikirim" role="tab"
                                    aria-controls="dikirim" aria-selected="false">Dikirim</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="nav_peminjaman" data-toggle="tab" href="#peminjaman" role="tab"
                                    aria-controls="peminjaman" aria-selected="false">Peminjaman</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="nav_forward" data-toggle="tab" href="#forward" role="tab"
                                    aria-controls="forward" aria-selected="false">Forward</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="nav_pengembalian" data-toggle="tab" href="#pengembalian"
                                    role="tab" aria-controls="pengembalian" aria-selected="false">Pengembalian</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="nav_selesai" data-toggle="tab" href="#selesai" role="tab"
                                    aria-controls="selesai" aria-selected="false">Selesai</a>
                            </li>
                        </ul>

                        <div class="tab-content" id="myTabContent">
                            {{-- pengajuan --}}
                            <div class="tab-pane fade show active" id="pengajuan" role="tabpanel"
                                aria-labelledby="pengajuan-tab">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <h4 class="float-left">List Pengajuan</h4>
                                            </div>
                                            <div class="col-md-6 col-12 ">
                                                <div class="row">
                                                    <div class="col-md-2">

                                                    </div>
                                                    {{-- <div class="col-md-2">
                                @if (Auth::id() == 1 || Auth::id() == 4)
                                <button class="btn btn-sm btn-success" id="btn_selamat_datang"><i class="fas fa-volume-up"></i></button>
                                @endif
                              </div> --}}
                                                    <div class="col-md-4 col-7 ">
                                                        <input type="text" class="form-control form-control-sm"
                                                            id="search_pengajuan" placeholder="Search..">
                                                    </div>
                                                    <div class="col-md-4 col-5">
                                                        <a class="btn btn-sm btn-secondary float-right" target="_blank"
                                                            href="{{ route('printAllPengajuan') }}"><i
                                                                class="fas fa-print"></i> Print Semua</a>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                    <div class="card-body table-responsive" id="table_pengajuan">

                                    </div>
                                </div>
                            </div>
                            {{-- end pengajuan --}}

                            {{-- dikirim --}}
                            <div class="tab-pane fade" id="dikirim" role="tabpanel" aria-labelledby="dikirim-tab">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Dikirim</h4>
                                    </div>
                                    <div class="card-body">

                                        <div class="table-responsive">
                                            <table class="table table-sm" width="100%" id="dikirim_table"
                                                style="font-size: 13px;">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        {{-- <th width="0.1%"></th> --}}
                                                        <th>No Berkas</th>
                                                        <th>Seksi</th>
                                                        <th>Kecamatan</th>
                                                        <th>Kelurahan</th>
                                                        <th>Pelayanan</th>
                                                        <th>Tipe Hak</th>
                                                        <th>No Hak</th>
                                                        <th>Jenis Arsip</th>
                                                        <th>Keterangan</th>
                                                        <th>Waktu</th>
                                                        <th>Status</th>
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
                            {{-- end dikirim --}}

                            {{-- peminjaman --}}
                            <div class="tab-pane fade" id="peminjaman" role="tabpanel" aria-labelledby="peminjaman-tab">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Peminjaman</h4>
                                    </div>
                                    <div class="card-body">

                                        <div class="table-responsive">
                                            <table class="table table-sm" width="100%" id="peminjaman_table"
                                                style="font-size: 13px;">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        {{-- <th width="0.1%"></th> --}}
                                                        <th>No Berkas</th>
                                                        <th>Seksi</th>
                                                        <th>Kecamatan</th>
                                                        <th>Kelurahan</th>
                                                        <th>Pelayanan</th>
                                                        <th>Tipe Hak</th>
                                                        <th>No Hak</th>
                                                        <th>Jenis Arsip</th>
                                                        <th>Keterangan</th>
                                                        <th>Waktu</th>
                                                        <th>Status</th>
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
                            {{-- end peminjaman --}}

                            {{-- forward --}}
                            <div class="tab-pane fade" id="forward" role="tabpanel" aria-labelledby="forward-tab">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Forward</h4>
                                    </div>
                                    <div class="card-body">

                                        <div class="table-responsive">
                                            <table class="table table-sm" width="100%" id="forward_table"
                                                style="font-size: 13px;">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        {{-- <th width="0.1%"></th> --}}
                                                        <th>No Berkas</th>
                                                        <th>Seksi</th>
                                                        <th>Kecamatan</th>
                                                        <th>Kelurahan</th>
                                                        <th>Pelayanan</th>
                                                        <th>Tipe Hak</th>
                                                        <th>No Hak</th>
                                                        <th>Jenis Arsip</th>
                                                        <th>Keterangan</th>
                                                        <th>Waktu</th>
                                                        <th>Status</th>
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
                            {{-- end forward --}}

                            {{-- pengembalian --}}
                            <div class="tab-pane fade" id="pengembalian" role="tabpanel"
                                aria-labelledby="pengembalian-tab">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Pengembalian</h4>
                                    </div>
                                    <div class="card-body">

                                        <div class="table-responsive">
                                            <table class="table table-sm" width="100%" id="pengembalian_table"
                                                style="font-size: 13px;">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        {{-- <th width="0.1%"></th> --}}
                                                        <th>No Berkas</th>
                                                        <th>Seksi</th>
                                                        <th>Kecamatan</th>
                                                        <th>Kelurahan</th>
                                                        <th>Pelayanan</th>
                                                        <th>Tipe Hak</th>
                                                        <th>No Hak</th>
                                                        <th>Jenis Arsip</th>
                                                        <th>Keterangan</th>
                                                        <th>Waktu</th>
                                                        <th>Status</th>
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
                            {{-- end pengembalian --}}

                            {{-- selesai --}}
                            <div class="tab-pane fade" id="selesai" role="tabpanel" aria-labelledby="selesai-tab">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="float-left">Selesai</h4>
                                        <button class="btn btn-primary btn-sm float-right" data-toggle="modal"
                                            data-target="#modal-excel"><i class="fas fa-file-excel"></i> Export</button>
                                    </div>
                                    <div class="card-body">

                                        <div class="table-responsive">
                                            <table class="table table-sm" width="100%" id="selesai_table"
                                                style="font-size: 13px;">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        {{-- <th width="0.1%"></th> --}}
                                                        <th>No Berkas</th>
                                                        <th>Seksi</th>
                                                        <th>Kecamatan</th>
                                                        <th>Kelurahan</th>
                                                        <th>Pelayanan</th>
                                                        <th>Tipe Hak</th>
                                                        <th>No Hak</th>
                                                        <th>Jenis Arsip</th>
                                                        <th>Keterangan</th>
                                                        <th>History</th>
                                                        <th>Waktu Peminjaman</th>
                                                        <th>Waktu Selesai</th>
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

    @if (Auth::user()->seksi_id == 1 || Auth::user()->seksi_id == 4)
        <div class="modal fade" id="modal_pengembalian" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title" id="exampleModalLabel">Terima Pengembalian</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h4>Apakah anda yakin telah menerima arsip?</h4>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                        <form id="form-tidak-pengembalian" class="d-inline-block">
                            <input type="hidden" name="id_peminjaman" class="id_peminjaman">
                            <button type="submit" class="btn btn-warning" id="btn-tidak-pengembalian">Tidak</button>
                        </form>

                        <form id="form-pengembalian" class="d-inline-block">
                            <input type="hidden" name="id_peminjaman" class="id_peminjaman">
                            <button type="submit" class="btn btn-primary" id="btn-pengembalian">Terima</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <form action="{{ route('exportSelesaiExcel') }}" method="post">
        @csrf

        <div class="modal fade" id="modal-excel" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title" id="exampleModalLabel">Export Excel</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="row">

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Dari</label>
                                    <input type="date" class="form-control" name="tgl1" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Sampai</label>
                                    <input type="date" class="form-control" name="tgl2" required>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                        <button type="submit" class="btn btn-primary">Export</button>

                    </div>
                </div>
            </div>
        </div>

    </form>



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

    <div class="modal fade" id="modal_batal_pengajuan" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title" id="exampleModalLabel">Batalkan Pengajuan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4>Apakah anda yakin ingin membatalkan pengajuan?</h4>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                    <form id="form-batal-pengajuan" class="d-inline-block">
                        <input type="hidden" name="id_peminjaman" id="id_peminjaman_batal">
                        <button type="submit" class="btn btn-primary" id="btn-batal-pengajuan">Batalkan</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('printGetListPengajuan') }}" method="get">
        <div class="modal fade" id="modal_get_list" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title" id="exampleModalLabel">List Pengajuan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="table_get_list">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="btn-batal-pengajuan">Print</button>


                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="modal fade" id="modal_detail_dashboard" role="dialog" aria-labelledby="modal_detail_dashboard"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title" id="modal_detail_dashboard">Detail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="table_detail_dashboard">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>


                </div>
            </div>
        </div>
    </div>



@section('script')
    <script>
        <?php if(session('success')): ?>
        Swal.fire({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            icon: 'success',
            title: '<?= session('success') ?>'
        });
        <?php endif; ?>

        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });

        $(document).ready(function() {

            $(document).on('click', '.btn_history', function() {
                var id_peminjaman = $(this).attr('id_peminjaman');
                $.get('get-history/' + id_peminjaman, function(data) {
                    $('#table_history').html(data);
                });
            });

            function getDashboardGlobal() {
                $.get('get-dashboard-global', function(data) {
                    $('#form_dashboard').html(data);
                });
            }

            getDashboardGlobal();

            function get_list_pengajuan() {
                $.get('get-list-pengajuan', function(data) {
                    $('#table_pengajuan').html(data);
                });
            }

            get_list_pengajuan();

            $('#peminjaman_table').DataTable({
                processing: true,
                serverSide: true, //aktifkan server-side 
                ajax: {
                    url: "{{ route('getListPeminjaman') }}",
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
                        data: 'no_berkas',
                        name: 'no_berkas'
                    },
                    {
                        data: 'seksi.nm_seksi',
                        name: 'seksi.nm_seksi'
                    },
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

            function getListPeminjaman() {
                var oTable = $('#peminjaman_table').dataTable(); //inialisasi datatable
                oTable.fnDraw(false); //reset datatable
            }

            $(document).on('click', '#nav_peminjaman', function() {
                getListPeminjaman();
            });

            //dikirim

            $('#dikirim_table').DataTable({
                processing: true,
                serverSide: true, //aktifkan server-side 
                ajax: {
                    url: "{{ route('getListDikirim') }}",
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
                        data: 'no_berkas',
                        name: 'no_berkas'
                    },
                    {
                        data: 'seksi.nm_seksi',
                        name: 'seksi.nm_seksi'
                    },
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

            function getListDikirim() {
                var oTable = $('#dikirim_table').dataTable(); //inialisasi datatable
                oTable.fnDraw(false); //reset datatable
            }

            $(document).on('click', '#nav_dikirim', function() {
                getListDikirim();
            });

            //enddikirm

            //forward

            $('#forward_table').DataTable({
                processing: true,
                serverSide: true, //aktifkan server-side 
                ajax: {
                    url: "{{ route('getListForward') }}",
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
                        data: 'no_berkas',
                        name: 'no_berkas'
                    },
                    {
                        data: 'seksi.nm_seksi',
                        name: 'seksi.nm_seksi'
                    },
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

            function getListForward() {
                var oTable = $('#forward_table').dataTable(); //inialisasi datatable
                oTable.fnDraw(false); //reset datatable
            }

            $(document).on('click', '#nav_forward', function() {
                getListForward();
            });

            //endforwart

            //pengembalian

            $('#pengembalian_table').DataTable({
                processing: true,
                serverSide: true, //aktifkan server-side 
                ajax: {
                    url: "{{ route('getListPengembalian') }}",
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
                        data: 'no_berkas',
                        name: 'no_berkas'
                    },
                    {
                        data: 'seksi.nm_seksi',
                        name: 'seksi.nm_seksi'
                    },
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

            function getListPengembalian() {
                var oTable = $('#pengembalian_table').dataTable(); //inialisasi datatable
                oTable.fnDraw(false); //reset datatable
            }

            $(document).on('click', '#nav_pengembalian', function() {
                getListPengembalian();
            });

            //endpengembalian

            $('#selesai_table').DataTable({
                processing: true,
                serverSide: true, //aktifkan server-side 
                ajax: {
                    url: "{{ route('getListSelesai') }}",
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
                        data: 'no_berkas',
                        name: 'no_berkas'
                    },
                    {
                        data: 'seksi.nm_seksi',
                        name: 'seksi.nm_seksi'
                    },
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
                        data: 'history',
                        name: 'history'
                    },
                    {
                        data: 'waktu_kirim',
                        name: 'dt_history.waktu_kirim'
                    },
                    {
                        data: 'waktu',
                        name: 'dt_keterangan.waktu'
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

            function getListSelesai() {
                var aTable = $('#selesai_table').dataTable(); //inialisasi datatable
                aTable.fnDraw(false); //reset datatable
            }

            $(document).on('click', '#nav_selesai', function() {
                getListSelesai();
            });


            $(document).on('click', '.terima_kembali', function() {
                var id_peminjaman = $(this).attr('id_peminjaman');
                $('.id_peminjaman').val(id_peminjaman);
            });

            $(document).on('submit', '#form-pengembalian', function(event) {
                event.preventDefault();
                $('#btn-pengembalian').attr('disabled', true);
                $('#btn-pengembalian').html('Loading..');

                $('#btn-tidak-pengembalian').attr('disabled', true);
                $('#btn-tidak-pengembalian').html('Loading..');
                $.ajax({
                    url: "{{ route('terimaPengembalian') }}",
                    method: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $('#modal_pengembalian').modal('hide'); //modal hide
                        $("#btn-pengembalian").removeAttr("disabled");
                        $('#btn-pengembalian').html('Terima'); //tombol

                        $("#btn-tidak-pengembalian").removeAttr("disabled");
                        $('#btn-tidak-pengembalian').html('Tidak'); //tombol
                        getListPengembalian();
                        getDashboardGlobal();
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            icon: 'success',
                            title: 'Berkas diterima'
                        });

                    }
                });

            });

            $(document).on('submit', '#form-tidak-pengembalian', function(event) {
                event.preventDefault();
                $('#btn-pengembalian').attr('disabled', true);
                $('#btn-pengembalian').html('Loading..');

                $('#btn-tidak-pengembalian').attr('disabled', true);
                $('#btn-tidak-pengembalian').html('Loading..');
                $.ajax({
                    url: "{{ route('tidakPengembalian') }}",
                    method: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $('#modal_pengembalian').modal('hide'); //modal hide
                        $("#btn-pengembalian").removeAttr("disabled");
                        $('#btn-pengembalian').html('Terima'); //tombol

                        $("#btn-tidak-pengembalian").removeAttr("disabled");
                        $('#btn-tidak-pengembalian').html('Tidak'); //tombol
                        getListPengembalian();
                        getDashboardGlobal();
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            icon: 'success',
                            title: 'Berkas diterima'
                        });

                    }
                });

            });
            var seksi_id_cek = $('#seksi_id_cek').val();
            if (seksi_id_cek == 4) {
                setInterval(function() {
                    $.get('get-count', function(data) {
                        var count = $('#count').val();
                        var urgent = $('#urgent').val();

                        var terima = $('#terima').val();

                        if (terima != data.terima) {
                            $('#terima').val(data.terima);
                            if (terima < data.terima) {
                                getListPeminjaman();
                                let audio = new Audio(
                                    "{{ asset('audio') }}/airport announcement.mp3");
                                audio.play();

                                setTimeout(() => {
                                    let sound = new SpeechSynthesisUtterance();
                                    sound.lang = 'id-ID';
                                    sound.text = "Arsip diterima oleh " + data.last_terima;
                                    sound.volume = 1;
                                    sound.rate = 0.7;
                                    window.speechSynthesis.speak(sound);
                                }, 3000);

                            }

                        }

                        if (count != data.count) {
                            get_list_pengajuan();
                            getDashboardGlobal();
                            $('#count').val(data.count);
                            $('#last_seksi').val(data.last_seksi);
                            if (count < data.count) {
                                if (urgent < data.urgent) {
                                    $('#urgent').val(data.urgent);
                                    $("#peringatan_urgent").trigger("click");
                                } else {
                                    $("#peringatan").trigger("click");
                                }
                            }
                        } else if (count == data.count && urgent < data.urgent) {
                            get_list_pengajuan();
                            $('#urgent').val(data.urgent);
                            $("#peringatan_urgent").trigger("click");
                        } else if (urgent > data.urgent) {
                            get_list_pengajuan();
                            $('#urgent').val(data.urgent);
                        }

                    });
                }, 5000);
            }


            $(document).on('change', '.checkbox_urgent', function() {
                if ($(this).is(':checked')) {
                    $.get('edit-urgent/' + $(this).val(), function(data) {
                        get_list_pengajuan();
                    });
                } else {
                    $.get('batal-urgent/' + $(this).val(), function(data) {
                        get_list_pengajuan();
                    });
                }
            });

            $(document).on('click', '#peringatan', function() {
                var last_seksi = $('#last_seksi').val();
                setTimeout(() => {
                    let audio = new Audio("{{ asset('audio') }}/airport announcement.mp3");
                    audio.play();
                }, 500);

                setTimeout(() => {
                    let sound = new SpeechSynthesisUtterance();
                    sound.lang = 'id-ID';
                    sound.text = "Ada pengajuan baru dari seksi " + last_seksi;
                    sound.volume = 1;
                    sound.rate = 0.7;
                    window.speechSynthesis.speak(sound);
                }, 3000);


            });

            $(document).on('click', '#peringatan_urgent', function() {
                setTimeout(() => {
                    let audio = new Audio("{{ asset('audio') }}/airport announcement.mp3");
                    audio.play();
                }, 500);

                setTimeout(() => {
                    let sound = new SpeechSynthesisUtterance();
                    sound.lang = 'id-ID';
                    sound.text = "Perhatian";
                    sound.volume = 1;
                    sound.rate = 0.7;
                    window.speechSynthesis.speak(sound);
                }, 3000);

                setTimeout(() => {
                    let sound2 = new SpeechSynthesisUtterance();
                    sound2.lang = 'id-ID';
                    sound2.text = "ada pengajuan mendesak";
                    sound2.volume = 1;
                    sound2.rate = 0.7;
                    window.speechSynthesis.speak(sound2);
                }, 3300);

                setTimeout(() => {
                    let sound2 = new SpeechSynthesisUtterance();
                    sound2.lang = 'id-ID';
                    sound2.text = "Harap segera dilakukan pencarian";
                    sound2.volume = 1;
                    sound2.rate = 0.7;
                    window.speechSynthesis.speak(sound2);
                }, 3600);

                setTimeout(() => {
                    let sound2 = new SpeechSynthesisUtterance();
                    sound2.lang = 'id-ID';
                    sound2.text = "Terimakasih";
                    sound2.volume = 1;
                    sound2.rate = 0.7;
                    window.speechSynthesis.speak(sound2);
                }, 3900);
            });

            $(document).on('keyup', '#search_pengajuan', function() {
                var value = $(this).val().toLowerCase();
                $(".thead_pengajuan tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
                $(".tbody_pengajuan tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });

            $(document).on('click', '#btn_selamat_datang', function() {
                setTimeout(() => {
                    let audio = new Audio("{{ asset('audio') }}/selamat_datang.mp3");
                    audio.play();
                }, 500);

            });

            $(document).on('click', '.btn_batal_pengajuan', function() {
                var id_peminjaman = $(this).attr('id_peminjaman');
                $('#id_peminjaman_batal').val(id_peminjaman);

            });

            $(document).on('submit', '#form-batal-pengajuan', function(event) {
                event.preventDefault();

                $('#btn-batal-pengajuan').attr('disabled', true);
                $('#btn-batal-pengajuan').html('Loading..');


                $.ajax({
                    url: "{{ route('batalPengajuan') }}",
                    method: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(data) {

                        $('#modal_batal_pengajuan').modal('hide'); //modal hide
                        $("#btn-batal-pengajuan").removeAttr("disabled");
                        $('#btn-batal-pengajuan').html('Batalkan'); //tombol
                        get_list_pengajuan();
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            icon: 'success',
                            title: 'Berkas diterima'
                        });

                    }
                });

            });


            $(document).on('click', '.btn_get_list', function() {
                var no_tiket = $(this).attr('no_tiket');

                $('#table_get_list').html(
                    'Loading... <div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div>'
                );

                $.ajax({
                    url: "{{ route('getListPengajuanTable') }}",
                    method: "GET",
                    data: {
                        no_tiket: no_tiket
                    },
                    success: function(data) {
                        $('#table_get_list').html(data);

                    }

                });

            });

            $(document).on('click', '.detail_dashboard', function() {
                var jenis_history = $(this).attr('jenis_history');

                $('#table_detail_dashboard').html(
                    'Loading... <div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div>'
                );

                $.ajax({
                    url: "{{ route('getDetailDashboardGlobal') }}",
                    method: "GET",
                    data: {
                        jenis_history: jenis_history
                    },
                    success: function(data) {
                        $('#table_detail_dashboard').html(data);

                    }

                });

            });


        });
    </script>
@endsection
@endsection
