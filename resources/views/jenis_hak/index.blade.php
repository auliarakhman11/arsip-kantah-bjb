@extends('template.master')
@section('content')
      <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4 class="m-0">Data Jenis Hak</h4>
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

            <div class="col-8">
                <div class="card">
                  {{-- @if (session('success'))
                  <div class="alert alert-success">
                      {{ session('success') }}
                  </div>
                  @endif --}}
                    <div class="card-header">
                        <h5 class="float-left">Data Jenis Hak</h5>
                        <button type="button" id="btn-add-hak" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#modal-add-hak">
                            <i class="fas fa-plus-circle"></i> 
                            Tambah Jenis Hak
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm" id="table_hak">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Jenis Hak</th>
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
  <form id="form-add-hak">
    <div class="modal fade" id="modal-add-hak" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Jenis Hak</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Jenis Hak</label>
                            <input type="text" class="form-control" name="nm_hak" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="btn-input-hak">Tambah</button>
            </div>
        </div>
        </div>
    </div>
    </form>

    <form id="form-edit-hak">
        <div class="modal fade" id="modal-edit-hak" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                <h5 class="modal-title" id="exampleModalLabel">Edit Jenis Hak</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" name="id" id="id_hak_e">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Nama Jenis Hak</label>
                                <input type="text" class="form-control" id="nm_hak_e" name="nm_hak" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="btn-edit-hak">Edit</button>
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

//hak
    $('#table_hak').DataTable({
                processing: true,
                serverSide: true, //aktifkan server-side 
                ajax: {
                    url: "{{ route('getDataHak') }}",
                    type: 'GET'
                },
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },          
                    {
                        data: 'nm_hak',
                        name: 'nm_hak'
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

            $(document).on('submit', '#form-add-hak', function(event) {
                event.preventDefault();
                    $('#btn-input-hak').attr('disabled',true);
                    $('#btn-input-hak').html('Loading..');
                    $.ajax({
                        url:"{{ route('addHak') }}",
                        method: 'POST',
                        data: new FormData(this),
                        contentType: false,
                        processData: false,
                        success: function(data) {

                            if(data){
                                $('#form-add-hak').trigger("reset"); //form reset
                                $('#modal-add-hak').modal('hide'); //modal hide
                                $("#btn-input-hak").removeAttr("disabled");
                                $('#btn-input-hak').html('Tambah'); //tombol simpan

                                var oTable = $('#table_hak').dataTable(); //inialisasi datatable
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
                                title: 'Nama hak sudah ada'
                                });
                                $('#btn-input-hak').html('Tambah');
                                $("#btn-input-hak").removeAttr("disabled");
                            }
                                                        
                        },
                        error: function (data) { //jika error tampilkan error pada console
                                    alert('Error:', data);
                                    $('#btn-input-hak').html('Tambah');
                                    $("#btn-input-hak").removeAttr("disabled");
                                }
                    });

                });

        $(document).on('click', '.edit_hak', function() {
            var id = $(this).data('id');
            
            $.get('get-hak/' + id, function (data) {
                //set value masing-masing id berdasarkan data yg diperoleh dari ajax get request diatas               
                $('#id_hak_e').val(data.id);
                $('#nm_hak_e').val(data.nm_hak);
            });
        });

        $(document).on('submit', '#form-edit-hak', function(event) {
        event.preventDefault();
            $('#btn-edit-hak').attr('disabled',true);
            $('#btn-edit-hak').html('Loading..');
            $.ajax({
                url:"{{ route('editHak') }}",
                method: 'POST',
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(data) {
                    
                    $('#form-edit-hak').trigger("reset"); //form reset
                    $('#modal-edit-hak').modal('hide'); //modal hide
                    $("#btn-edit-hak").removeAttr("disabled");
                    $('#btn-edit-hak').html('Edit'); //tombol simpan

                    var oTable = $('#table_hak').dataTable(); //inialisasi datatable
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
                            $('#btn-edit-hak').html('Edit');
                            $("#btn-edit-hak").removeAttr("disabled");
                        }
            });

        });

    //end hak

    
    
  });

</script>
@endsection
@endsection  
  
