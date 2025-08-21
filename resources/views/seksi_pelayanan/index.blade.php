@extends('template.master')
@section('content')
      <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4 class="m-0">Data Seksi & Pelayanan</h4>
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

            <div class="col-6">
                <div class="card">
                  {{-- @if (session('success'))
                  <div class="alert alert-success">
                      {{ session('success') }}
                  </div>
                  @endif --}}
                    <div class="card-header">
                        <h5 class="float-left">Data Seksi</h5>
                        <button type="button" id="btn-add-seksi" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#modal-add-seksi">
                            <i class="fas fa-plus-circle"></i> 
                            Tambah Seksi
                          </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm" id="table_seksi">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Seksi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6">
                <div class="card">
                  {{-- @if (session('success'))
                  <div class="alert alert-success">
                      {{ session('success') }}
                  </div>
                  @endif --}}
                    <div class="card-header">
                        <h5 class="float-left">Data Pelayanan</h5>
                        <button type="button" id="btn-add-pelayanan" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#modal-add-pelayanan">
                            <i class="fas fa-plus-circle"></i> 
                            Tambah Pelayanan
                          </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm" id="table_pelayanan">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Seksi</th>
                                        <th>Pelayanan</th>
                                        <th>Aksi</th>
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
  <form id="form-add-seksi">
    <div class="modal fade" id="modal-add-seksi" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Seksi</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Nama Seksi</label>
                            <input type="text" class="form-control" name="nm_seksi" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="btn-input-seksi">Tambah</button>
            </div>
        </div>
        </div>
    </div>
    </form>

    <form id="form-edit-seksi">
        <div class="modal fade" id="modal-edit-seksi" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                <h5 class="modal-title" id="exampleModalLabel">Edit Seksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" name="id" id="id_seksi_e">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Nama Seksi</label>
                                <input type="text" class="form-control" id="nm_seksi_e" name="nm_seksi" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="btn-edit-seksi">Edit</button>
                </div>
            </div>
            </div>
        </div>
        </form>

        <!-- Modal add pelayanan -->
  <form id="form-add-pelayanan">
    <div class="modal fade" id="modal-add-pelayanan" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Pelayanan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <label>Seksi</label>
                        <select name="seksi_id" class="form-control select2bs4" required>
                            <option value="" >-Pilih Seksi-</option>
                            @foreach ($seksi as $o)
                            <option value="{{ $o->id }}" >{{ $o->nm_seksi }}</option> 
                            @endforeach
                          </select>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Nama Pelayanan</label>
                            <input type="text" class="form-control" name="nm_pelayanan" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="btn-input-pelayanan">Tambah</button>
            </div>
        </div>
        </div>
    </div>
    </form>

    <form id="form-edit-pelayanan">
        <div class="modal fade" id="modal-edit-pelayanan" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                <h5 class="modal-title" id="exampleModalLabel">Edit Pelayanan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="id_pelayanan_e">
                    <div class="row">
                        <div class="col-12">
                            <label>Seksi</label>
                            <select name="seksi_id" id="seksi_id_e" class="form-control select2bs4" required>
                                <option value="" >-Pilih Seksi-</option>
                                @foreach ($seksi as $o)
                                <option value="{{ $o->id }}" >{{ $o->nm_seksi }}</option> 
                                @endforeach
                              </select>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Nama Pelayanan</label>
                                <input type="text" class="form-control" id="nm_pelayanan_e" name="nm_pelayanan" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="btn-edit-pelayanan">Edit</button>
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

//seksi
    $('#table_seksi').DataTable({
                processing: true,
                serverSide: true, //aktifkan server-side 
                ajax: {
                    url: "{{ route('getDataSeksi') }}",
                    type: 'GET'
                },
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },          
                    {
                        data: 'nm_seksi',
                        name: 'nm_seksi'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    }
                ],
                order: [
                    [0, 'asc']
                ]
            });

            $(document).on('submit', '#form-add-seksi', function(event) {
                event.preventDefault();
                    $('#btn-input-seksi').attr('disabled',true);
                    $('#btn-input-seksi').html('Loading..');
                    $.ajax({
                        url:"{{ route('addSeksi') }}",
                        method: 'POST',
                        data: new FormData(this),
                        contentType: false,
                        processData: false,
                        success: function(data) {

                            if(data){
                                $('#form-add-seksi').trigger("reset"); //form reset
                                $('#modal-add-seksi').modal('hide'); //modal hide
                                $("#btn-input-seksi").removeAttr("disabled");
                                $('#btn-input-seksi').html('Tambah'); //tombol simpan

                                var oTable = $('#table_seksi').dataTable(); //inialisasi datatable
                                oTable.fnDraw(false); //reset datatable

                                Swal.fire({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                icon: 'success',
                                title: 'Data berhasil diinput'
                                });
                            }else{
                                Swal.fire({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                icon: 'error',
                                title: 'Nama seksi sudah ada'
                                });
                                $('#btn-input-seksi').html('Tambah');
                                $("#btn-input-seksi").removeAttr("disabled");
                            }
                                                        
                        },
                        error: function (data) { //jika error tampilkan error pada console
                                    alert('Error:', data);
                                    $('#btn-input-seksi').html('Tambah');
                                    $("#btn-input-seksi").removeAttr("disabled");
                                }
                    });

                });

        $(document).on('click', '.edit_seksi', function() {
            var id = $(this).data('id');
            
            $.get('get-seksi/' + id, function (data) {
                //set value masing-masing id berdasarkan data yg diperoleh dari ajax get request diatas               
                $('#id_seksi_e').val(data.id);
                $('#nm_seksi_e').val(data.nm_seksi);
            });
        });

        $(document).on('submit', '#form-edit-seksi', function(event) {
        event.preventDefault();
            $('#btn-edit-seksi').attr('disabled',true);
            $('#btn-edit-seksi').html('Loading..');
            $.ajax({
                url:"{{ route('editSeksi') }}",
                method: 'POST',
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(data) {
                    
                    $('#form-edit-seksi').trigger("reset"); //form reset
                    $('#modal-edit-seksi').modal('hide'); //modal hide
                    $("#btn-edit-seksi").removeAttr("disabled");
                    $('#btn-edit-seksi').html('Edit'); //tombol simpan

                    var oTable = $('#table_seksi').dataTable(); //inialisasi datatable
                    oTable.fnDraw(false); //reset datatable

                    Swal.fire({
                      toast: true,
                      position: 'top-end',
                      showConfirmButton: false,
                      timer: 3000,
                      icon: 'success',
                      title: 'Data berhasil diedit'
                    });

                    
                },
                error: function (data) { //jika error tampilkan error pada console
                            alert('Error:', data);
                            $('#btn-edit-seksi').html('Edit');
                            $("#btn-edit-seksi").removeAttr("disabled");
                        }
            });

        });

    //end seksi

    //pelayanan
    $('#table_pelayanan').DataTable({
                processing: true,
                serverSide: true, //aktifkan server-side 
                ajax: {
                    url: "{{ route('getDataPelayanan') }}",
                    type: 'GET'
                },
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },          
                    {
                        data: 'seksi.nm_seksi',
                        name: 'nm_seksi'
                    },
                    {
                        data: 'nm_pelayanan',
                        name: 'nm_pelayanan'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    }
                ],
                order: [
                    [0, 'asc']
                ]
            });

            $(document).on('submit', '#form-add-pelayanan', function(event) {
                event.preventDefault();
                    $('#btn-input-pelayanan').attr('disabled',true);
                    $('#btn-input-pelayanan').html('Loading..');
                    $.ajax({
                        url:"{{ route('addPelayanan') }}",
                        method: 'POST',
                        data: new FormData(this),
                        contentType: false,
                        processData: false,
                        success: function(data) {

                            if(data){
                                $('#form-add-pelayanan').trigger("reset"); //form reset
                                $('#modal-add-pelayanan').modal('hide'); //modal hide
                                $("#btn-input-pelayanan").removeAttr("disabled");
                                $('#btn-input-pelayanan').html('Tambah'); //tombol simpan

                                $('.select2bs4').select2({theme: 'bootstrap4', tags: true,}).trigger('change');

                                var oTable = $('#table_pelayanan').dataTable(); //inialisasi datatable
                                oTable.fnDraw(false); //reset datatable

                                Swal.fire({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                icon: 'success',
                                title: 'Data berhasil diinput'
                                });
                            }else{
                                Swal.fire({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                icon: 'error',
                                title: 'Data pelayanan sudah ada'
                                });
                                $('#btn-input-pelayanan').html('Tambah');
                                $("#btn-input-pelayanan").removeAttr("disabled");
                            }   
                            
                        },
                        error: function (data) { //jika error tampilkan error pada console
                                    console.log('Error:', data);
                                    $('#btn-input-pelayanan').html('Tambah');
                                    $("#btn-input-pelayanan").removeAttr("disabled");
                                }
                    });

                });

        $(document).on('click', '.edit_pelayanan', function() {
            var id = $(this).data('id');
            
            $.get('get-pelayanan/' + id, function (data) {
                //set value masing-masing id berdasarkan data yg diperoleh dari ajax get request diatas               
                $('#id_pelayanan_e').val(data.id);
                // $('#seksi_id_e').val(data.seksi_id);

                $('#seksi_id_e').val(data.seksi_id);
                $('#seksi_id_e').select2({theme: 'bootstrap4', tags: true,}).trigger('change');
                
                $('#nm_pelayanan_e').val(data.nm_pelayanan);
            });
        });

        $(document).on('submit', '#form-edit-pelayanan', function(event) {
        event.preventDefault();
            $('#btn-edit-pelayanan').attr('disabled',true);
            $('#btn-edit-pelayanan').html('Loading..');
            $.ajax({
                url:"{{ route('editPelayanan') }}",
                method: 'POST',
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(data) {
                    
                    $('#form-edit-pelayanan').trigger("reset"); //form reset
                    $('#modal-edit-pelayanan').modal('hide'); //modal hide
                    $("#btn-edit-pelayanan").removeAttr("disabled");
                    $('#btn-edit-pelayanan').html('Edit'); //tombol simpan

                    var oTable = $('#table_pelayanan').dataTable(); //inialisasi datatable
                    oTable.fnDraw(false); //reset datatable

                    Swal.fire({
                      toast: true,
                      position: 'top-end',
                      showConfirmButton: false,
                      timer: 3000,
                      icon: 'success',
                      title: 'Data berhasil diedit'
                    });

                    
                },
                error: function (data) { //jika error tampilkan error pada console
                            alert('Error:', data);
                            $('#btn-edit-pelayanan').html('Edit');
                            $("#btn-edit-pelayanan").removeAttr("disabled");
                        }
            });

        });
    
  });

</script>
@endsection
@endsection  
  
