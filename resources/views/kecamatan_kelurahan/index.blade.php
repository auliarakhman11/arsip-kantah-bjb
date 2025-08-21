@extends('template.master')
@section('content')
      <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4 class="m-0">Data Kecamatan & Kelurahan</h4>
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

            <div class="col-12 col-md-6">
                <div class="card">
                  {{-- @if (session('success'))
                  <div class="alert alert-success">
                      {{ session('success') }}
                  </div>
                  @endif --}}
                    <div class="card-header">
                        <h5 class="float-left">Data Kecamatan</h5>
                        <button type="button" id="btn-add-kecamatan" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#modal-add-kecamatan">
                            <i class="fas fa-plus-circle"></i> 
                            Tambah Kecamatan
                          </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm" id="table_kecamatan">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Kecamatan</th>
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

            <div class="col-12 col-md-6">
                <div class="card">
                  {{-- @if (session('success'))
                  <div class="alert alert-success">
                      {{ session('success') }}
                  </div>
                  @endif --}}
                    <div class="card-header">
                        <h5 class="float-left">Data Kelurahan</h5>
                        <button type="button" id="btn-add-kelurahan" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#modal-add-kelurahan">
                            <i class="fas fa-plus-circle"></i> 
                            Tambah Kelurahan
                          </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm" id="table_kelurahan">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Kecamatan</th>
                                        <th>Kelurahan</th>
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
  <form id="form-add-kecamatan">
    <div class="modal fade" id="modal-add-kecamatan" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Kecamatan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Nama Kecamatan</label>
                            <input type="text" class="form-control" name="nm_kecamatan" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="btn-input-kecamatan">Tambah</button>
            </div>
        </div>
        </div>
    </div>
    </form>

    <form id="form-edit-kecamatan">
        <div class="modal fade" id="modal-edit-kecamatan" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                <h5 class="modal-title" id="exampleModalLabel">Edit Kecamatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" name="id" id="id_kecamatan_e">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Nama Kecamatan</label>
                                <input type="text" class="form-control" id="nm_kecamatan_e" name="nm_kecamatan" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="btn-edit-kecamatan">Tambah</button>
                </div>
            </div>
            </div>
        </div>
        </form>

        <!-- Modal add kelurahan -->
  <form id="form-add-kelurahan">
    <div class="modal fade" id="modal-add-kelurahan" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Kelurahan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <label>Kecamatan</label>
                        <select name="kecamatan_id" class="form-control select2bs4" id="dt_kecamatan" required>
                            <option value="" >-Pilih Kecamatan-</option>
                            @foreach ($kecamatan as $o)
                            <option value="{{ $o->id }}" >{{ $o->nm_kecamatan }}</option> 
                            @endforeach
                          </select>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Nama Kelurahan</label>
                            <input type="text" class="form-control" name="nm_kelurahan" id="nm_kelurahan" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="btn-input-kelurahan">Tambah</button>
            </div>
        </div>
        </div>
    </div>
    </form>

    <form id="form-edit-kelurahan">
        <div class="modal fade" id="modal-edit-kelurahan" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Kelurahan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="id_kelurahan_e">
                    <div class="row">
                        <div class="col-12">
                            <label>Kecamatan</label>
                            <select name="kecamatan_id" id="kecamatan_id_e" class="form-control select2bs4" required>
                                <option value="" >-Pilih Kecamatan-</option>
                                @foreach ($kecamatan as $o)
                                <option value="{{ $o->id }}" >{{ $o->nm_kecamatan }}</option> 
                                @endforeach
                              </select>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Nama Kelurahan</label>
                                <input type="text" class="form-control" id="nm_kelurahan_e" name="nm_kelurahan" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="btn-edit-kelurahan">Edit</button>
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

//kecamatan
function getListKecamatan(){
    $.get('get-list-kecamatan', function (data) {        
                $('#dt_kecamatan').html(data);
            });
}

    $('#table_kecamatan').DataTable({
                processing: true,
                serverSide: true, //aktifkan server-side 
                ajax: {
                    url: "{{ route('getDataKecamatan') }}",
                    type: 'GET'
                },
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },          
                    {
                        data: 'nm_kecamatan',
                        name: 'nm_kecamatan'
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

            $(document).on('submit', '#form-add-kecamatan', function(event) {
                event.preventDefault();
                    $('#btn-input-kecamatan').attr('disabled',true);
                    $('#btn-input-kecamatan').html('Loading..');
                    $.ajax({
                        url:"{{ route('addKecamatan') }}",
                        method: 'POST',
                        data: new FormData(this),
                        contentType: false,
                        processData: false,
                        success: function(data) {

                            if(data){
                                $('#form-add-kecamatan').trigger("reset"); //form reset
                                $('#modal-add-kecamatan').modal('hide'); //modal hide
                                $("#btn-input-kecamatan").removeAttr("disabled");
                                $('#btn-input-kecamatan').html('Tambah'); //tombol simpan

                                var oTable = $('#table_kecamatan').dataTable(); //inialisasi datatable
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
                                title: 'Nama kecamatan sudah ada'
                                });
                                $('#btn-input-kecamatan').html('Tambah');
                                $("#btn-input-kecamatan").removeAttr("disabled");
                            }
                                                        
                        },
                        error: function (data) { //jika error tampilkan error pada console
                                    alert('Error:', data);
                                    $('#btn-input-kecamatan').html('Tambah');
                                    $("#btn-input-kecamatan").removeAttr("disabled");
                                }
                    });

                });

        $(document).on('click', '.edit_kecamatan', function() {
            var id = $(this).data('id');
            
            $.get('get-kecamatan/' + id, function (data) {
                //set value masing-masing id berdasarkan data yg diperoleh dari ajax get request diatas               
                $('#id_kecamatan_e').val(data.id);
                $('#nm_kecamatan_e').val(data.nm_kecamatan);
            });
        });

        $(document).on('submit', '#form-edit-kecamatan', function(event) {
        event.preventDefault();
            $('#btn-edit-kecamatan').attr('disabled',true);
            $('#btn-edit-kecamatan').html('Loading..');
            $.ajax({
                url:"{{ route('editKecamatan') }}",
                method: 'POST',
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(data) {
                    
                    $('#form-edit-kecamatan').trigger("reset"); //form reset
                    $('#modal-edit-kecamatan').modal('hide'); //modal hide
                    $("#btn-edit-kecamatan").removeAttr("disabled");
                    $('#btn-edit-kecamatan').html('Edit'); //tombol simpan

                    var oTable = $('#table_kecamatan').dataTable(); //inialisasi datatable
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
                            $('#btn-edit-kecamatan').html('Edit');
                            $("#btn-edit-kecamatan").removeAttr("disabled");
                        }
            });

        });

    //end kecamatan

    //kelurahan
    $('#table_kelurahan').DataTable({
                processing: true,
                serverSide: true, //aktifkan server-side 
                ajax: {
                    url: "{{ route('getDataKelurahan') }}",
                    type: 'GET'
                },
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },          
                    {
                        data: 'kecamatan.nm_kecamatan',
                        name: 'nm_kecamatan'
                    },
                    {
                        data: 'nm_kelurahan',
                        name: 'nm_kelurahan'
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

            $(document).on('submit', '#form-add-kelurahan', function(event) {
                event.preventDefault();
                    $('#btn-input-kelurahan').attr('disabled',true);
                    $('#btn-input-kelurahan').html('Loading..');
                    $.ajax({
                        url:"{{ route('addKelurahan') }}",
                        method: 'POST',
                        data: new FormData(this),
                        contentType: false,
                        processData: false,
                        success: function(data) {

                            if(data){
                                $('#nm_kelurahan').val(""); //form reset
                                $('#modal-add-kelurahan').modal('hide'); //modal hide
                                $("#btn-input-kelurahan").removeAttr("disabled");
                                $('#btn-input-kelurahan').html('Tambah'); //tombol simpan

                                var oTable = $('#table_kelurahan').dataTable(); //inialisasi datatable
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
                                title: 'Data kelurahan sudah ada'
                                });
                                $('#btn-input-kelurahan').html('Tambah');
                                $("#btn-input-kelurahan").removeAttr("disabled");
                            }   
                            
                        },
                        error: function (data) { //jika error tampilkan error pada console
                                    console.log('Error:', data);
                                    $('#btn-input-kelurahan').html('Tambah');
                                    $("#btn-input-kelurahan").removeAttr("disabled");
                                }
                    });

                });

        $(document).on('click', '.edit_kelurahan', function() {
            var id = $(this).data('id');
            
            $.get('get-kelurahan/' + id, function (data) {
                //set value masing-masing id berdasarkan data yg diperoleh dari ajax get request diatas               
                $('#id_kelurahan_e').val(data.id);
                // $('#kecamatan_id_e').val(data.kecamatan_id);

                $('#kecamatan_id_e').val(data.kecamatan_id);
                $('#kecamatan_id_e').select2({theme: 'bootstrap4', tags: true,}).trigger('change');
                
                $('#nm_kelurahan_e').val(data.nm_kelurahan);
            });
        });

        $(document).on('submit', '#form-edit-kelurahan', function(event) {
        event.preventDefault();
            $('#btn-edit-kelurahan').attr('disabled',true);
            $('#btn-edit-kelurahan').html('Loading..');
            $.ajax({
                url:"{{ route('editKelurahan') }}",
                method: 'POST',
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(data) {
                    
                    $('#form-edit-kelurahan').trigger("reset"); //form reset
                    $('#modal-edit-kelurahan').modal('hide'); //modal hide
                    $("#btn-edit-kelurahan").removeAttr("disabled");
                    $('#btn-edit-kelurahan').html('Edit'); //tombol simpan

                    var oTable = $('#table_kelurahan').dataTable(); //inialisasi datatable
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
                            $('#btn-edit-kelurahan').html('Edit');
                            $("#btn-edit-kelurahan").removeAttr("disabled");
                        }
            });

        });
    
  });

</script>
@endsection
@endsection  
  
