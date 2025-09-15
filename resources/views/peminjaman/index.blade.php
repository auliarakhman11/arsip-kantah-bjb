@extends('template.master')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-2">
                        <h4 class="m-0">Peminjaman</h4>
                        <input type="hidden" id="count_kirim" value="{{ $count_kirim }}">
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
                                <a class="nav-link active" id="tambah_peminjaman-tab" data-toggle="tab"
                                    href="#tambah_peminjaman" role="tab" aria-controls="tambah_peminjaman"
                                    aria-selected="true">Tambah Peminjaman</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="get_pengajuan" data-toggle="tab" href="#pengajuan" role="tab"
                                    aria-controls="pengajuan" aria-selected="false">Pengajuan</a>
                            </li>


                        </ul>

                        <div class="tab-content" id="myTabContent">
                            {{-- tab tambah pengajuan --}}
                            <div class="tab-pane fade show active" id="tambah_peminjaman" role="tabpanel"
                                aria-labelledby="tambah_peminjaman-tab">

                                <div class="card">
                                    {{-- @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif --}}
                                    <div class="card-header">
                                        <h5 class="float-left">Peminjaman</h5>
                                    </div>
                                    <div class="card-body">
                                        <form id="form_peminjaman">
                                            <div class="row">

                                                <div class="col-6 mb-2">
                                                    <div class="row">
                                                        <div class="col-3">
                                                            <label for="" class="float-right">Kecamatan</label>
                                                        </div>
                                                        <div class="col-9">
                                                            <select name="kecamatan_id" id="kecamatan_id"
                                                                class="form-control select2bs4" required>
                                                                <option value="">Pilih Kecamatan..</option>
                                                                @foreach ($kecamatan as $k)
                                                                    <option
                                                                        value="{{ $k->id }}|{{ $k->nm_kecamatan }}">
                                                                        {{ $k->nm_kecamatan }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-6 mb-2">
                                                    <div class="row">
                                                        <div class="col-3">
                                                            <label class="float-right" for="">Kelurahan/Desa</label>
                                                        </div>
                                                        <div class="col-9">
                                                            <select name="kelurahan_id" id="kelurahan_id"
                                                                class="form-control select2bs4" required>
                                                                <option value="">Pilih Kelurahan/Desa..</option>

                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-6 mb-2">
                                                    <div class="row">
                                                        <div class="col-3">
                                                            <label class="float-right" for="">Pelayanan</label>
                                                        </div>
                                                        <div class="col-9">
                                                            <select name="pelayanan_id" class="form-control select2bs4"
                                                                required>
                                                                <option value="">Pilih pelayanan...</option>
                                                                @foreach ($pelayanan as $p)
                                                                    <option
                                                                        value="{{ $p->id }}|{{ $p->nm_pelayanan }}">
                                                                        {{ $p->nm_pelayanan }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-6 mb-2">
                                                    <div class="row">
                                                        <div class="col-3">
                                                            <label class="float-right" for="">No Berkas</label>
                                                        </div>
                                                        <div class="col-9">
                                                            <input type="text" class="form-control" name="no_berkas">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-6 mb-2">
                                                    <div class="row">
                                                        <div class="col-3">
                                                            <label class="float-right" for="">Tipe Hak</label>
                                                        </div>
                                                        <div class="col-9">
                                                            <select name="hak_id" class="form-control select2bs4" required>
                                                                <option value="">Pilih tipe Hak...</option>
                                                                @foreach ($hak as $k)
                                                                    <option value="{{ $k->id }}|{{ $k->nm_hak }}">
                                                                        {{ $k->nm_hak }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-6 mb-2">
                                                    <div class="row">
                                                        <div class="col-3">
                                                            <label class="float-right" for="">No Hak</label>
                                                        </div>
                                                        <div class="col-9">
                                                            <input type="text" class="form-control" name="no_hak"
                                                                required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-6 mb-2">
                                                    <div class="row">

                                                        <div class="col-2">
                                                            <input class="ml-2 mr-2" type="checkbox" name="jenis_arsip[]"
                                                                value="BT">
                                                            <label for="">BT</label>
                                                        </div>
                                                        <div class="col-2">
                                                            <input class="ml-2 mr-2" type="checkbox" name="jenis_arsip[]"
                                                                value="SU">
                                                            <label for="">SU</label>
                                                        </div>
                                                        <div class="col-2">
                                                            <input class="ml-2 mr-2" type="checkbox" name="jenis_arsip[]"
                                                                value="HT">
                                                            <label for="">HT</label>
                                                        </div>
                                                        <div class="col-4">
                                                            <input type="checkbox" class="ml-2 mr-2" name="jenis_arsip[]"
                                                                value="Warkah Pendaftaran">
                                                            <label for="" style="font-size: 12px;">Warkah
                                                                Pendaftaran</label>
                                                        </div>
                                                        <div class="col-4">
                                                            <input type="checkbox" class="ml-2 mr-2" name="jenis_arsip[]"
                                                                value="Warkah Pemecahan">
                                                            <label for="" style="font-size: 12px;">Warkah
                                                                Pemecahan</label>
                                                        </div>
                                                        <div class="col-4">
                                                            <input type="checkbox" class="ml-2 mr-2" name="jenis_arsip[]"
                                                                value="Warkah Pemisahan">
                                                            <label for="" style="font-size: 12px;">Warkah
                                                                Pemisahan</label>
                                                        </div>
                                                        <div class="col-4">
                                                            <input type="checkbox" class="ml-2 mr-2" name="jenis_arsip[]"
                                                                value="Warkah Penggabungan">
                                                            <label for="" style="font-size: 11px;">Warkah
                                                                Penggabungan</label>
                                                        </div>
                                                        <div class="col-4">
                                                            <input type="checkbox" class="ml-2 mr-2" name="jenis_arsip[]"
                                                                value="Warkah Perubahan Hak">
                                                            <label for="" style="font-size: 10px;">Warkah
                                                                Perubahan Hak</label>
                                                        </div>
                                                        <div class="col-4">
                                                            <input type="checkbox" class="ml-2 mr-2" name="jenis_arsip[]"
                                                                value="Warkah Peralihan Hak">
                                                            <label for="" style="font-size: 11px;">Warkah
                                                                Peralihan Hak</label>
                                                        </div>
                                                        <div class="col-4">
                                                            <input type="checkbox" class="ml-2 mr-2" name="jenis_arsip[]"
                                                                value="Warkah Hapus Hak">
                                                            <label for="" style="font-size: 11px;">Warkah Hapus
                                                                Hak</label>
                                                        </div>
                                                        <div class="col-5">
                                                            <input type="checkbox" class="ml-2 mr-2" name="jenis_arsip[]"
                                                                value="Warkah Sertipikat Pengganti">
                                                            <label for="" style="font-size: 12px;">Warkah
                                                                Sertipikat Pengganti</label>
                                                        </div>
                                                        <div class="col-3">
                                                            <input type="checkbox" class="ml-2 mr-2" name="jenis_arsip[]"
                                                                value="Warkah HT">
                                                            <label for="" style="font-size: 12px;">Warkah
                                                                HT</label>
                                                        </div>
                                                        <div class="col-4">
                                                            <input type="checkbox" class="ml-2 mr-2" name="jenis_arsip[]"
                                                                value="Warkah Penataan Batas">
                                                            <label for="" style="font-size: 10px;">Warkah Penataan
                                                                Batas</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-6 mb-2">
                                                    <div class="row">
                                                        <div class="col-3">
                                                            <label class="float-right" for="">Keterangan</label>
                                                        </div>
                                                        <div class="col-9">
                                                            <input type="text" class="form-control" name="keterangan">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-6 mb-2"></div>

                                                <div class="col-6 mb-2">
                                                    <button type="submit" id="cari_peminjaman"
                                                        class="btn btn-sm btn-primary float-right">
                                                        <i class="fas fa-search"></i>
                                                        Cari
                                                    </button>
                                                </div>

                                            </div>
                                        </form>
                                    </div>

                                    <div class="cart-body" id="table_cart">

                                    </div>
                                </div>

                            </div>
                            {{-- end tab tambah pengajuan --}}

                            {{-- pengajuan --}}
                            <div class="tab-pane fade" id="pengajuan" role="tabpanel" aria-labelledby="pengajuan-tab">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Pengajuan</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-sm" width="100%" id="pengajuan_table"
                                                style="font-size: 13px;">
                                                <thead class="text-center">
                                                    <tr>
                                                        <th>#</th>
                                                        {{-- <th witdh="0.1%"></th> --}}
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
                                                        <th>User</th>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- end pengajuan --}}

                        </div>

                    </div>

                </div>
            </div><!--/. container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <div class="modal fade" id="modal_cek_status_arsip" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title" id="exampleModalLabel">Status Arsip</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4 id="status_arsip"></h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="modal_terima_kirim" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title" id="exampleModalLabel">Terima Pengiriman</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4>Apakah anda yakin telah menerima kiriman?</h4>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                    <form id="form-tidak-kirim" class="d-inline-block">
                        <input type="hidden" name="id_peminjaman" class="id_peminjaman">
                        <button type="submit" value="Tidak" name="tombol" class="btn btn-warning"
                            id="btn-tidak-kirim">Tidak</button>
                    </form>

                    <form id="form-terima-kirim" class="d-inline-block">
                        <input type="hidden" name="id_peminjaman" class="id_peminjaman">
                        <button type="submit" value="Terima" name="tombol" class="btn btn-primary"
                            id="btn-terima-kirim">Terima</button>
                    </form>

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


            $('#pengajuan_table').DataTable({
                processing: true,
                serverSide: true, //aktifkan server-side 
                ajax: {
                    url: "{{ route('getPengajuan') }}",
                    type: 'GET'
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    // {
                    //   data: 'search',
                    //   name: 'search'
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
                        data: 'action',
                        name: 'action'
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

            function getCart() {
                $.get('get-cart', function(data) {
                    $('#table_cart').html(data);
                });
            }

            function getPengajuan() {
                var aTable = $('#pengajuan_table').dataTable(); //inialisasi datatable
                aTable.fnDraw(false); //reset datatable
            }

            getCart();

            $(document).on('click', '.cek_status_arsip', function() {
                var id_peminjaman = $(this).attr('id_peminjaman');
                $.get('cek-status-arsip/' + id_peminjaman, function(data) {
                    $('#status_arsip').html(data);
                });

            });

            //pengajuan
            $(document).on('click', '.terima_kirim', function() {
                var id_peminjaman = $(this).attr('id_peminjaman');
                $('.id_peminjaman').val(id_peminjaman);

            });

            $(document).on('click', '.batal_pengajuan', function() {
                var id_peminjaman = $(this).attr('id_peminjaman');
                $('#id_peminjaman_batal').val(id_peminjaman);

            });

            $(document).on('click', '#get_pengajuan', function() {
                getPengajuan();
            });

            $(document).on('submit', '#form-terima-kirim', function(event) {
                event.preventDefault();

                $('#btn-terima-kirim').attr('disabled', true);
                $('#btn-terima-kirim').html('Loading..');

                $('#btn-tidak-kirim').attr('disabled', true);
                $('#btn-tidak-kirim').html('Loading..');


                $.ajax({
                    url: "{{ route('terimaKirim') }}",
                    method: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $('#modal_terima_kirim').modal('hide'); //modal hide
                        $("#btn-terima-kirim").removeAttr("disabled");
                        $('#btn-terima-kirim').html('Terima'); //tombol
                        $("#btn-tidak-kirim").removeAttr("disabled");
                        $('#btn-tidak-kirim').html('Tidak'); //tombol
                        getPengajuan();
                        getDashboard();
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

            $(document).on('submit', '#form-tidak-kirim', function(event) {
                event.preventDefault();

                $('#btn-terima-kirim').attr('disabled', true);
                $('#btn-terima-kirim').html('Loading..');

                $('#btn-tidak-kirim').attr('disabled', true);
                $('#btn-tidak-kirim').html('Loading..');


                $.ajax({
                    url: "{{ route('tidakKirim') }}",
                    method: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $('#modal_terima_kirim').modal('hide'); //modal hide
                        $("#btn-terima-kirim").removeAttr("disabled");
                        $('#btn-terima-kirim').html('Terima'); //tombol
                        $("#btn-tidak-kirim").removeAttr("disabled");
                        $('#btn-tidak-kirim').html('Tidak'); //tombol
                        getPengajuan();
                        getDashboard();
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
                        getPengajuan();
                        getDashboard();
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
            //end pengajuan

            $(document).on('click', '#drop_cart', function() {
                if (confirm('Apakah anda yakin ingin menghapus semua?')) {
                    $('#drop_cart').attr('disabled', true);
                    $('#drop_cart').html('Loading..');
                    $.get('drop-cart', function(data) {
                        getCart();
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            icon: 'success',
                            title: 'Data berhasil dihapus'
                        });
                    });
                }
            });

            $(document).on('change', '#kecamatan_id', function() {
                var kecamatan_id = $(this).val();

                if (kecamatan_id) {
                    $.get('find-kelurahan/' + kecamatan_id, function(data) {
                        $('#kelurahan_id').html(data);
                    });
                } else {
                    $('#kelurahan_id').html('<option value="">Pilih Kelurahan/Desa..</option>');
                }


            });

            $(document).on('submit', '#form_peminjaman', function(event) {
                event.preventDefault();
                $('#cari_peminjaman').attr('disabled', true);
                $('#cari_peminjaman').html('Loading..');
                $.ajax({
                    url: "{{ route('cariPeminjaman') }}",
                    method: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        if (data) {
                            $("#cari_peminjaman").removeAttr("disabled");
                            $('#cari_peminjaman').html('<i class="fas fa-search"></i> Cari');
                            $('#form_peminjaman').trigger("reset");
                            // $('#kelurahan_id').html('<option value="">Pilih Kelurahan/Desa..</option>');
                            $('.select2bs4').val('');
                            $('.select2bs4').select2({
                                theme: 'bootstrap4',
                                tags: true,
                            }).trigger('change');
                            getCart();
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                icon: 'success',
                                title: 'Data berhasil diinput'
                            });
                        } else {
                            $("#cari_peminjaman").removeAttr("disabled");
                            $('#cari_peminjaman').html('<i class="fas fa-search"></i> Cari');
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                icon: 'error',
                                title: 'Jenis arsip belum dipilih'
                            });
                        }
                    },
                    error: function(data) { //jika error tampilkan error pada console
                        alert('Error:', data);
                        $('#cari_peminjaman').html('<i class="fas fa-search"></i> Cari');
                        $("#cari_peminjaman").removeAttr("disabled");
                    }
                });
            });

            $(document).on('submit', '#lanjut_peminjaman', function(event) {
                event.preventDefault();
                $('#btn_lanjut_peminjaman').attr('disabled', true);
                $('#btn_lanjut_peminjaman').html('Loading..');
                $.ajax({
                    url: "{{ route('lanjutPeminjaman') }}",
                    method: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        if (data) {
                            $("#btn_lanjut_peminjaman").removeAttr("disabled");
                            $('#btn_lanjut_peminjaman').html(
                                '<i class="fas fa-arrow-alt-circle-right"></i> Lanjut');
                            $('#lanjut_peminjaman').trigger("reset");
                            getCart();
                            getDashboard();
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                icon: 'success',
                                title: 'Data berhasil diinput'
                            });
                        } else {
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                icon: 'error',
                                title: 'List peminjaman kososng'
                            });

                            $('#btn_lanjut_peminjaman').html(
                                '<i class="fas fa-arrow-alt-circle-right"></i> Lanjut');
                            $("#btn_lanjut_peminjaman").removeAttr("disabled");
                        }

                    },
                    error: function(data) { //jika error tampilkan error pada console
                        alert('Error:', data);
                        console.log(data);
                        $('#btn_lanjut_peminjaman').html(
                            '<i class="fas fa-arrow-alt-circle-right"></i> Lanjut');
                        $("#btn_lanjut_peminjaman").removeAttr("disabled");
                    }
                });
            });

            function playAudio() {
                let audio = new Audio("{{ asset('audio') }}/airport announcement.mp3");
                audio.play();

                setTimeout(() => {
                    let sound = new SpeechSynthesisUtterance();
                    sound.lang = 'id-ID';
                    sound.text = "Arsip yang anda ajukan sudah ditemukan";
                    sound.volume = 1;
                    sound.rate = 0.7;
                    window.speechSynthesis.speak(sound);
                }, 3000);

                setTimeout(() => {
                    let sound = new SpeechSynthesisUtterance();
                    sound.lang = 'id-ID';
                    sound.text = "Silahkan ambil di seksi Arsip";
                    sound.volume = 1;
                    sound.rate = 0.7;
                    window.speechSynthesis.speak(sound);
                }, 3300);

                setTimeout(() => {
                    let sound = new SpeechSynthesisUtterance();
                    sound.lang = 'id-ID';
                    sound.text = "Terimakasih";
                    sound.volume = 1;
                    sound.rate = 0.7;
                    window.speechSynthesis.speak(sound);
                }, 3600);

            }


            setInterval(function() {
                $.get('get-count-peminjaman', function(data) {
                    var count_kirim = $('#count_kirim').val();

                    if (count_kirim != data.kirim) {
                        $('#count_kirim').val(data.kirim);

                        if (count_kirim < data.kirim) {

                            playAudio();
                            getPengajuan();

                        }

                    }


                });
            }, 5000); //diganti


            $(document).on('click', '.btn-delete-cart', function() {
                var id = $(this).attr('rowid');

                $.get('delete-cart/' + id, function(data) {
                    getCart();
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        icon: 'success',
                        title: 'Data berhasil dihapus'
                    });
                });

            });


            $(document).on('click', '.detail_dashboard', function() {
                var jenis_history = $(this).attr('jenis_history');

                $('#table_detail_dashboard').html(
                    'Loading... <div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div>'
                );

                $.ajax({
                    url: "{{ route('getDetailDashboard') }}",
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
