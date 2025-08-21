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
                                        <th>Seksi</th>
                                        <th>Kecamatan</th>
                                        <th>Kelurahan</th>
                                        <th>No Berkas</th>
                                        <th>Tipe Hak</th>
                                        <th>No Hak</th>
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

  <form id="form_ba_st" method="POST">
      @csrf
    <div class="modal fade" id="modal_ba_st" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
            <h5 class="modal-title" id="exampleModalLabel">Data Berita Acara</h5>
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
                    <input type="hidden" name="id_ba_st" id="id_ba_st">

                    <input type="hidden" name="jenis_aksi" id="jenis_aksi">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Nama Pemilik</label>
                            <input type="text" class="form-control" id="nm_pemilik" name="nm_pemilik" required>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Luas</label>
                            <input type="number" class="form-control" id="luas" name="luas" required>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label for="">No Surat</label>
                            <input type="text" class="form-control" id="no_surat" name="no_surat" required>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="btn_print">Print</button>
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
                ajax: {
                    url: "{{ route('getBaPps') }}",
                    type: 'GET'
                },
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },          
                    {
                        data: 'seksi.nm_seksi',
                        name: 'seksi'
                    },
                    {
                        data: 'kecamatan.nm_kecamatan',
                        name: 'kecamatan'
                    },
                    {
                        data: 'kelurahan.nm_kelurahan',
                        name: 'kelurahan'
                    },
                    {
                        data: 'no_berkas',
                        name: 'no_berkas'
                    },
                    {
                        data: 'hak.nm_hak',
                        name: 'hak'
                    },
                    {
                        data: 'no_hak',
                        name: 'no_hak'
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
                order: [
                    [0, 'asc']
                ]
            });

    
        $(document).on('click', '.btn_ba_st', function() {
            var no_hak = $(this).attr('no_hak');
            var hak_id = $(this).attr('hak_id');
            var kecamatan_id = $(this).attr('kecamatan_id');
            var kelurahan_id = $(this).attr('kelurahan_id');
            var no_tiket = $(this).attr('no_tiket');
            var seksi_id = $(this).attr('seksi_id');

            var jenis_aksi = $(this).attr('jenis_aksi');
            
            $('#jenis_aksi').val(jenis_aksi);

            $.get('get-dt-peminjaman?no_hak=' + no_hak+'&hak_id='+hak_id+'&kecamatan_id='+kecamatan_id+'&kelurahan_id='+kelurahan_id+'&no_tiket='+no_tiket, function (data) {
                // console.log(data);
                if(data){
                    $('#no_hak').val(data.no_hak);
                    $('#hak_id').val(data.hak_id);
                    $('#kecamatan_id').val(data.kecamatan_id);
                    $('#kelurahan_id').val(data.kelurahan_id);
                    $('#no_tiket').val(no_tiket);
                    $('#nm_pemilik').val(data.nm_pemilik);
                    $('#luas').val(data.luas);
                    $('#no_surat').val(data.no_surat);
                    $('#seksi_id').val(seksi_id);
                    $('#id_ba_st').val(data.id);

                    $("#form_ba_st").attr('action', "{{ route('editPdfBa') }}");
                    

                }else{
                    $('#no_hak').val(no_hak);
                    $('#hak_id').val(hak_id);
                    $('#kecamatan_id').val(kecamatan_id);
                    $('#kelurahan_id').val(kelurahan_id);
                    $('#no_tiket').val(no_tiket);
                    $('#id_ba_st').val('');
                    $('#nm_pemilik').val('');
                    $('#luas').val('');
                    $('#no_surat').val('');
                    $('#seksi_id').val(seksi_id);
                    $('#id_ba_st').val('');

                    $("#form_ba_st").attr('action', "{{ route('addPdfBa') }}");
                    
                    
                }
                
            });
        });

        $(document).on('submit', '#form_ba_st', function(event) {
                    $('#btn_print').attr('disabled',true);
                    $('#btn_print').html('Loading..');
                });
    
    
  });

</script>
@endsection
@endsection  
  
