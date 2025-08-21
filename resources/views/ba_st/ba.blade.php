@extends('template.master')
@section('content')
      <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4 class="m-0">Berita Acara</h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
            {{-- <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v2</li>
            </ol> --}}
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
                <div class="card">
                  {{-- @if (session('success'))
                  <div class="alert alert-success">
                      {{ session('success') }}
                  </div>
                  @endif --}}
                    <div class="card-header">
                        <h5 class="float-left">List Berita Acara</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm" id="table_ba" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <!--<th width="0.1%"></th>-->
                                        <th>Seksi</th>
                                        <th>Kecamatan</th>
                                        <th>Kelurahan</th>
                                        <th>Pelayanan</th>
                                        <th>No Berkas</th>
                                        <th>Tipe Hak</th>
                                        <th>No Hak</th>
                                        <th>User</th>
                                        <th>Waktu</th>                                        
                                        <th>Print</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


        </div>
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Modal -->

  <form id="form_ba_bt" method="POST">
      @csrf
    <div class="modal fade" id="modal_ba_bt" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
            <h5 class="modal-title" id="exampleModalLabel">Print Berita Acara Buku Tanah</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <input type="hidden" name="no_hak" id="no_hak">
                    <input type="hidden" name="kelurahan_id" id="kelurahan_id">
                    <input type="hidden" name="kecamatan_id" id="kecamatan_id">
                    <input type="hidden" name="hak_id" id="hak_id">
                    <input type="hidden" name="no_tiket" id="no_tiket">
                    <input type="hidden" name="seksi_id" id="seksi_id">
                    <input type="hidden" name="ba_id" id="ba_id">

                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Kecamatan</label>
                            <input type="text" class="form-control" id="kecamatan_bt" name="kecamatan" required>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Kelurahan</label>
                            <input type="text" class="form-control" id="kelurahan_bt" name="kelurahan" required>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label for="">No urut BA</label>
                            <input type="text" class="form-control" id="no_urut_ba_bt" name="no_urut_ba_bt" required>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Nama Pemilik</label>
                            <input type="text" class="form-control" id="nm_pemilik_bt" name="nm_pemilik" required>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Luas</label>
                            <input type="text" class="form-control" id="luas_bt" name="luas" required>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="btn_print_bt">Print</button>
            </div>
        </div>
        </div>
    </div>
    </form>

    <form id="form_ba_su" method="POST">
        @csrf
      <div class="modal fade" id="modal_ba_su" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header bg-primary">
              <h5 class="modal-title" id="exampleModalLabel">Print Berita Acara Surat Ukur</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
              </div>
              <div class="modal-body">
                  <div class="row">
                      <input type="hidden" name="no_hak" id="no_hak_su">
                      <input type="hidden" name="kelurahan_id" id="kelurahan_id_su">
                      <input type="hidden" name="kecamatan_id" id="kecamatan_id_su">
                      <input type="hidden" name="hak_id" id="hak_id_su">
                      <input type="hidden" name="no_tiket" id="no_tiket_su">
                      <input type="hidden" name="seksi_id" id="seksi_id_su">
                      <input type="hidden" name="ba_id" id="ba_id_su">
  
                      <div class="col-12">
                          <div class="form-group">
                              <label for="">Kecamatan</label>
                              <input type="text" class="form-control" id="kecamatan_su" name="kecamatan" required>
                          </div>
                      </div>
  
                      <div class="col-12">
                          <div class="form-group">
                              <label for="">Kelurahan</label>
                              <input type="text" class="form-control" id="kelurahan_su" name="kelurahan" required>
                          </div>
                      </div>
  
                      <div class="col-12">
                          <div class="form-group">
                              <label for="">No SU/Tahun</label>
                              <input type="text" class="form-control" id="no_su" name="no_su" required>
                          </div>
                      </div>
  
                      <div class="col-12">
                          <div class="form-group">
                              <label for="">Permohonan</label>
                              <input type="text" class="form-control" id="permohonan" name="permohonan" required>
                          </div>
                      </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Dari</label>
                            <input type="date" class="form-control" id="dari" name="dari" required>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Sampai</label>
                            <input type="date" class="form-control" id="sampai" name="sampai" required>
                        </div>
                    </div>
  
                  </div>
              </div>
              <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" id="btn_print_su">Print</button>
              </div>
          </div>
          </div>
      </div>
      </form>

@section('script')
<script>

$(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });

  $(document).ready(function() {

    $('#table_ba').DataTable({
                processing: true,
                serverSide: true, //aktifkan server-side
                "language": 
                {          
                "processing": '<div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div>',
                },
                ajax: {
                    url: "{{ route('getBa') }}",
                    type: 'GET'
                },
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },   
                    // {
                    //     data: 'search',
                    //     name: 'search'
                    // },          
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
                        data: 'user.name',
                        name: 'user.name'
                    },
                    {
                        data: 'waktu',
                        name: 'waktu'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ],
                order: [],
                columnDefs: [ 
                {
                "targets": 0,
                "orderable": false
                },
                { "searchable": false, "targets": 0 }
               ],
            });

    
        $(document).on('click', '.btn_ba_bt', function() {
            var no_hak = $(this).attr('no_hak');
            var hak_id = $(this).attr('hak_id');
            var kecamatan_id = $(this).attr('kecamatan_id');
            var kecamatan = $(this).attr('kecamatan');
            var kelurahan_id = $(this).attr('kelurahan_id');
            var kelurahan = $(this).attr('kelurahan');
            var no_tiket = $(this).attr('no_tiket');
            var seksi_id = $(this).attr('seksi_id');
            var ba_id = $(this).attr('ba_id');

            if(ba_id){               
                $("#form_ba_bt").attr('action', "{{ route('editPdfBaBt') }}");
                $.get('get-dt-ba?id='+ba_id, function (data) { 
                    $('#no_hak').val(no_hak);
                    $('#hak_id').val(hak_id);
                    $('#kecamatan_id').val(kecamatan_id);
                    $('#kecamatan_bt').val(data.kecamatan);
                    $('#kelurahan_id').val(kelurahan_id);
                    $('#kelurahan_bt').val(data.kelurahan);
                    $('#no_tiket').val(no_tiket);
                    $('#nm_pemilik_bt').val(data.nm_pemilik);
                    $('#luas_bt').val(data.luas);
                    $('#seksi_id').val(seksi_id);
                    $('#ba_id').val(data.id);
                    $('#no_urut_ba_bt').val(data.no_urut_ba_bt);
                });
            }else{
                $("#form_ba_bt").attr('action', "{{ route('addPdfBaBt') }}");
                    $('#no_hak').val(no_hak);
                    $('#hak_id').val(hak_id);
                    $('#kecamatan_id').val(kecamatan_id);
                    $('#kecamatan_bt').val(kecamatan);
                    $('#kelurahan_id').val(kelurahan_id);
                    $('#kelurahan_bt').val(kelurahan);
                    $('#no_tiket').val(no_tiket);
                    $('#nm_pemilik_bt').val('');
                    $('#luas_bt').val('');
                    $('#seksi_id').val(seksi_id);
                    $('#ba_id').val('');
                    $('#no_urut_ba_bt').val('');
            }
            
        });

        $(document).on('click', '.btn_ba_su', function() {
            var no_hak = $(this).attr('no_hak');
            var hak_id = $(this).attr('hak_id');
            var kecamatan_id = $(this).attr('kecamatan_id');
            var kecamatan = $(this).attr('kecamatan');
            var kelurahan_id = $(this).attr('kelurahan_id');
            var kelurahan = $(this).attr('kelurahan');
            var no_tiket = $(this).attr('no_tiket');
            var seksi_id = $(this).attr('seksi_id');
            var ba_id = $(this).attr('ba_id');

            if(ba_id){               
                $("#form_ba_su").attr('action', "{{ route('editPdfBaSu') }}");
                $.get('get-dt-ba?id='+ba_id, function (data) { 
                    $('#no_hak_su').val(no_hak);
                    $('#hak_id_su').val(hak_id);
                    $('#kecamatan_id_su').val(kecamatan_id);
                    $('#kecamatan_su').val(data.kecamatan);
                    $('#kelurahan_id_su').val(kelurahan_id);
                    $('#kelurahan_su').val(data.kelurahan);
                    $('#no_tiket_su').val(no_tiket);
                    $('#no_su').val(data.no_su);
                    $('#dari').val(data.dari);
                    $('#sampai').val(data.sampai);
                    $('#permohonan').val(data.permohonan);
                    $('#seksi_id_su').val(seksi_id);
                    $('#ba_id_su').val(data.id);
                });
            }else{
                $("#form_ba_su").attr('action', "{{ route('addPdfBaSu') }}");
                    $('#no_hak_su').val(no_hak);
                    $('#hak_id_su').val(hak_id);
                    $('#kecamatan_id_su').val(kecamatan_id);
                    $('#kecamatan_su').val(kecamatan);
                    $('#kelurahan_id_su').val(kelurahan_id);
                    $('#kelurahan_su').val(kelurahan);
                    $('#no_tiket_su').val(no_tiket);
                    $('#no_su').val('');
                    $('#dari').val('');
                    $('#sampai').val('');
                    $('#permohonan').val('');
                    $('#seksi_id_su').val(seksi_id);
                    $('#ba_id_su').val('');
            }
            
        });

        // $(document).on('submit', '#form_ba_bt', function(event) {
        //             $('#btn_print_bt').attr('disabled',true);
        //             $('#btn_print_bt').html('Loading..');
        //         });

        // $(document).on('submit', '#form_ba_su', function(event) {
        //     $('#btn_print_su').attr('disabled',true);
        //     $('#btn_print_su').html('Loading..');
        // });
    
    
  });

</script>
@endsection
@endsection  
  
