@extends('template.master')
@section('content')
      <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
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
                  @php
                      $tu = [];
                      $arsip = [];
                      $arsip2 = [];
                      $php = [];
                      $php2 = [];
                      $sp = [];
                      $sp2 = [];

                    foreach ($pejabat as $d) {
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
                    <div class="card-header">
                        <h5 class="float-left">Data Penandatangan</h5>
                        
                    </div>
                    <div class="card-body">
                    <form action="{{ route('editPenandatangan') }}" id="form_edit" method="post">
                        @csrf
                        @method('patch')
                        <div class="row">
                            <div class="col-4">
                                <h4 class="text-center">Kepala Sub Bagian TU</h4>
                                <div class="row">
                                    <input type="hidden" name="id[]" value="{{ $tu['id'] }}">
                                    <div class="col-3 mb-2"><label for="">Nama</label></div>
                                    <div class="col-9 mb-2"><input type="text" class="form-control form-control-sm" required name="nm_pejabat[]" value="{{ $tu['nm_pejabat'] }}"></div>

                                    <div class="col-3 mb-2"><label for="">NIP</label></div>
                                    <div class="col-9 mb-2"><input type="text" class="form-control form-control-sm" required name="nip[]" value="{{ $tu['nip'] }}"></div>

                                    <div class="col-3 mb-2"><label for="">Jabatan</label></div>
                                    <div class="col-9 mb-2"><input type="text" class="form-control form-control-sm" required name="jabatan[]" value="{{ $tu['jabatan'] }}"></div>

                                    <div class="col-3 mb-2"><label for="">Gologan</label></div>
                                    <div class="col-9 mb-2"><input type="text" class="form-control form-control-sm" name="golongan[]" value="{{ $tu['golongan'] }}"></div>
                                </div>

                                <hr>

                                <h4 class="text-center">Kerarsipan</h4>
                                <div class="row">
                                    <input type="hidden" name="id[]" value="{{ $arsip['id'] }}">
                                    <div class="col-3 mb-2"><label for="">Nama</label></div>
                                    <div class="col-9 mb-2"><input type="text" class="form-control form-control-sm" required name="nm_pejabat[]" value="{{ $arsip['nm_pejabat'] }}"></div>

                                    <div class="col-3 mb-2"><label for="">NIP</label></div>
                                    <div class="col-9 mb-2"><input type="text" class="form-control form-control-sm" required name="nip[]" value="{{ $arsip['nip'] }}"></div>

                                    <div class="col-3 mb-2"><label for="">Jabatan</label></div>
                                    <div class="col-9 mb-2"><input type="text" class="form-control form-control-sm" required name="jabatan[]" value="{{ $arsip['jabatan'] }}"></div>

                                    <div class="col-3 mb-2"><label for="">Golongan</label></div>
                                    <div class="col-9 mb-2"><input type="text" class="form-control form-control-sm" name="golongan[]" value="{{ $arsip['golongan'] }}"></div>

                                    <div class="col-12"><hr></div>

                                    <input type="hidden" name="id[]" value="{{ $arsip2['id'] }}">
                                    <div class="col-3 mb-2"><label for="">Nama</label></div>
                                    <div class="col-9 mb-2"><input type="text" class="form-control form-control-sm" required name="nm_pejabat[]" value="{{ $arsip2['nm_pejabat'] }}"></div>

                                    <div class="col-3 mb-2"><label for="">NIP</label></div>
                                    <div class="col-9 mb-2"><input type="text" class="form-control form-control-sm" name="nip[]" value="{{ $arsip2['nip'] }}"></div>

                                    <div class="col-3 mb-2"><label for="">Jabatan</label></div>
                                    <div class="col-9 mb-2"><input type="text" class="form-control form-control-sm" required name="jabatan[]" value="{{ $arsip2['jabatan'] }}"></div>

                                    <div class="col-3 mb-2"><label for="">Golongan</label></div>
                                    <div class="col-9 mb-2"><input type="text" class="form-control form-control-sm" name="golongan[]" value="{{ $arsip2['golongan'] }}"></div>
                                </div>                               

                            </div>

                            <div class="col-4">
                                <h4 class="text-center">PHP</h4>
                                <div class="row">
                                    <input type="hidden" name="id[]" value="{{ $php['id'] }}">
                                    <div class="col-3 mb-2"><label for="">Nama</label></div>
                                    <div class="col-9 mb-2"><input type="text" class="form-control form-control-sm" required name="nm_pejabat[]" value="{{ $php['nm_pejabat'] }}"></div>

                                    <div class="col-3 mb-2"><label for="">NIP</label></div>
                                    <div class="col-9 mb-2"><input type="text" class="form-control form-control-sm" required name="nip[]" value="{{ $php['nip'] }}"></div>

                                    <div class="col-3 mb-2"><label for="">Jabatan</label></div>
                                    <div class="col-9 mb-2"><input type="text" class="form-control form-control-sm" required name="jabatan[]" value="{{ $php['jabatan'] }}"></div>

                                    <div class="col-3 mb-2"><label for="">Golongan</label></div>
                                    <div class="col-9 mb-2"><input type="text" class="form-control form-control-sm" name="golongan[]" value="{{ $php['golongan'] }}"></div>

                                    <div class="col-12"><hr></div>

                                    <input type="hidden" name="id[]" value="{{ $php2['id'] }}">
                                    <div class="col-3 mb-2"><label for="">Nama</label></div>
                                    <div class="col-9 mb-2"><input type="text" class="form-control form-control-sm" required name="nm_pejabat[]" value="{{ $php2['nm_pejabat'] }}"></div>

                                    <div class="col-3 mb-2"><label for="">NIP</label></div>
                                    <div class="col-9 mb-2"><input type="text" class="form-control form-control-sm" required name="nip[]" value="{{ $php2['nip'] }}"></div>

                                    <div class="col-3 mb-2"><label for="">Jabatan</label></div>
                                    <div class="col-9 mb-2"><input type="text" class="form-control form-control-sm" required name="jabatan[]" value="{{ $php2['jabatan'] }}"></div>

                                    <div class="col-3 mb-2"><label for="">Golongan</label></div>
                                    <div class="col-9 mb-2"><input type="text" class="form-control form-control-sm" name="golongan[]" value="{{ $php2['golongan'] }}"></div>
                                </div>
                            </div>

                            <div class="col-4">
                                <h4 class="text-center">SP</h4>
                                <div class="row">
                                    <input type="hidden" name="id[]" value="{{ $sp['id'] }}">
                                    <div class="col-3 mb-2"><label for="">Nama</label></div>
                                    <div class="col-9 mb-2"><input type="text" class="form-control form-control-sm" required name="nm_pejabat[]" value="{{ $sp['nm_pejabat'] }}"></div>

                                    <div class="col-3 mb-2"><label for="">NIP</label></div>
                                    <div class="col-9 mb-2"><input type="text" class="form-control form-control-sm" required name="nip[]" value="{{ $sp['nip'] }}"></div>

                                    <div class="col-3 mb-2"><label for="">Jabatan</label></div>
                                    <div class="col-9 mb-2"><input type="text" class="form-control form-control-sm" required name="jabatan[]" value="{{ $sp['jabatan'] }}"></div>

                                    <div class="col-3 mb-2"><label for="">Golongan</label></div>
                                    <div class="col-9 mb-2"><input type="text" class="form-control form-control-sm" name="golongan[]" value="{{ $sp['golongan'] }}"></div>

                                    <div class="col-12"><hr></div>

                                    <input type="hidden" name="id[]" value="{{ $sp2['id'] }}">
                                    <div class="col-3 mb-2"><label for="">Nama</label></div>
                                    <div class="col-9 mb-2"><input type="text" class="form-control form-control-sm" required name="nm_pejabat[]" value="{{ $sp2['nm_pejabat'] }}"></div>

                                    <div class="col-3 mb-2"><label for="">NIP</label></div>
                                    <div class="col-9 mb-2"><input type="text" class="form-control form-control-sm" required name="nip[]" value="{{ $sp2['nip'] }}"></div>

                                    <div class="col-3 mb-2"><label for="">Jabatan</label></div>
                                    <div class="col-9 mb-2"><input type="text" class="form-control form-control-sm" required name="jabatan[]" value="{{ $sp2['jabatan'] }}"></div>

                                    <div class="col-3 mb-2"><label for="">Golongan</label></div>
                                    <div class="col-9 mb-2"><input type="text" class="form-control form-control-sm" required name="golongan[]" value="{{ $sp2['golongan'] }}"></div>

                                    <div class="col-12">
                                        <button type="submit" id="btn_edit" class="btn btn-sm btn-primary float-right">Simpan</button>
                                    </div>
                                </div>
                            </div>                            
                        </div>
                    </form>
                    </div>
                </div>
            </div>


        </div>
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

          

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

    <?php if(session('success')): ?>
    Swal.fire({
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 3000,
              icon: 'success',
              title: '<?= session('success'); ?>'
            });            
    <?php endif; ?> 
    
    $(document).on('submit', '#form_edit', function(event) {
                    $('#btn_edit').attr('disabled',true);
                    $('#btn_edit').html('Loading..');
                    

                });
    
  });

</script>
@endsection
@endsection  
  
