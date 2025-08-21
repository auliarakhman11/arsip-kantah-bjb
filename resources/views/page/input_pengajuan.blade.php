@extends('template.master')
@section('content')
      <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row justify-content-center">
            
            <div class="col-12">
                <h4 class="mb-2 float-left">No Tiket : {{ $pengajuan->no_tiket }} | Seksi: {{ $pengajuan->seksi->nm_seksi }} ({{ $pengajuan->user->name }})</h4>
                   
                    <button type="button" id="btn-input-pengajuan" data-target="#modal_lanjut" data-toggle="modal" class="btn btn-sm btn-primary float-right mr-2" ><i class="fas fa-save"></i> Save</button>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th>No Berkas</th>  
                                    <th>Kecamatan</th>
                                    <th>Kelurahan</th>
                                    <th>Pelayanan</th>                                  
                                    <th>Tipe Hak</th>
                                    <th>No Hak</th>
                                    <th>Jenis Arsip</th>                                  
                                    <th>Keterangan</th>
                                    <th>#</th>
                                  </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengajuan->peminjaman as $p)
                                <tr>
                                    <td>{{ $p->no_berkas }}</td> 
                                    <td>{{ $p->kecamatan->nm_kecamatan }}</td>
                                    <td>{{ $p->kelurahan->nm_kelurahan }}</td>
                                    <td>{{ $p->pelayanan->nm_pelayanan }}</td> 
                                    <td>{{ $p->hak->nm_hak }}</td>
                                    <td>{{ $p->no_hak }}</td>
                                    <td>{{ $p->jenis_arsip }}</td> 
                                     <td>{{ $p->keterangan }} {{ $p->ba ? $p->ba->no_ba_bt && $p->jenis_arsip == 'BT' ? "(Foto Coppy)" : '' : '' }} {{ $p->ba ? $p->ba->no_ba_su && $p->jenis_arsip == 'SU' ? "(Foto Coppy)" : '' : '' }}</td>
                                    <td><input  type="checkbox" name="id_peminjaman" value="{{ $p->id }}" kecamatan="{{ $p->kecamatan->nm_kecamatan }}" kelurahan="{{ $p->kelurahan->nm_kelurahan }}" hak="{{ $p->hak->nm_hak }}" no_hak="{{ $p->no_hak }}" jenis_arsip="{{ $p->jenis_arsip }}"></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                            
            </div>
        
        </div>
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <form method="POST" action="{{ route('terimaPengajuan') }}" id="input_pengajuan">
    @csrf
  <div class="modal fade" id="modal_lanjut" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header bg-primary">
        <h5 class="modal-title" id="exampleModalLabel">Cek Berkas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="no_tiket" value="{{ $pengajuan->no_tiket }}">
          <div id="table_id"></div>
            <table class="table table-sm">
              <thead>
                <tr>
                  <th>Kecamatan</th>
                  <th>Kelurahan</th>
                  <th>Tipe Hak</th>
                  <th>No Hak</th>
                  <th>Keterangan</th>
                  <th>Jenis Warkah</th>
                </tr>
              </thead>
              <tbody id="tb_jenis_arsip">
                
              </tbody>

            </table>
            
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

          <button type="submit" class="btn btn-primary" id="btn-pengajuan">Lanjut</button>
        </div>
    </div>
    </div>
</div>
</form>

@section('script')
<script>
    <?php if(session('error')): ?>
    Swal.fire({
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 3000,
              icon: 'error',
              title: '<?= session('error'); ?>'
            });            
    <?php endif; ?>
  $(document).ready(function() {

    $(document).on('submit', '#input_pengajuan', function(event) {
                
                    $('#btn-pengajuan').attr('disabled',true);
                    $('#btn-pengajuan').html('Loading..');               
                });

                

    $(document).on('click', '#btn-input-pengajuan', function() {
      var html = '';
      var warkah = '';
      var input_id = '';
      $('input[name="id_peminjaman"]:checked').each(function() {
        var id = $(this).val();
        var kecamatan = $(this).attr('kecamatan');
        var kelurahan = $(this).attr('kelurahan');
        var hak = $(this).attr('hak');
        var no_hak = $(this).attr('no_hak');

        input_id += '<input type="hidden" name="id_peminjaman[]" value="'+id+'">';

        if($(this).attr('jenis_arsip') == 'Warkah'){
          warkah += '<tr><td>'+kecamatan+'</td><td>'+kelurahan+'</td><td>'+hak+'</td><td>'+no_hak+'</td><td><input type="text" class="form-control form-control-sm" name="keterangan2'+id+'"></td><td><label><input  type="checkbox" name="jenis_warkah'+id+'[]" value="208" > 208</label> <label><input  type="checkbox" name="jenis_warkah'+id+'[]" value="Pendaftaran Pertama" > Pendaftaran Pertama</label> <label><input  type="checkbox" name="jenis_warkah'+id+'[]" value="Roya" > Roya</label> <label><input  type="checkbox" name="jenis_warkah'+id+'[]" value="Balik Nama" > Balik Nama</label></td></tr>'
        }else{
          html += '<tr><td>'+kecamatan+'</td><td>'+kelurahan+'</td><td>'+hak+'</td><td>'+no_hak+'</td><td></td><td></td></tr>';
        }
        
		  });
      html += warkah;
      $('#table_id').html(input_id);
      $('#tb_jenis_arsip').html(html);

    });
    
  });
</script>
@endsection
@endsection  