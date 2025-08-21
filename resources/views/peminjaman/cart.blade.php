@if ($count != 0)
<div class="container-fluid">    
    <button type="button" class=" float-right mb-2 ml-2 btn btn-sm btn-danger" id="drop_cart"><i class="fas fa-trash"></i> Hapus Semua</button>
    <form action="" id="lanjut_peminjaman">
        <button type="submit" class=" float-right ml-2 mb-2 btn btn-sm btn-primary" id="btn_lanjut_peminjaman"><i class="fas fa-arrow-alt-circle-right"></i> Lanjut</button>
        <div class="form-group float-right mt-1">
            <div class="custom-control custom-switch custom-switch-off-light custom-switch-on-warning">
                <input type="checkbox" class="custom-control-input" name="urgent" id="urget" value="1">
                <label class="custom-control-label" for="urget">Urgent</label>
            </div>
        </div>
    </form>
    
    <table class="table table-sm">
        <thead class="text-center">
            <tr>
                <th>#</th>
                <th>Tanggal</th>
                <th>Kecamatan</th>
                <th>Kelurahan</th>
                <th>No Berkas</th>
                <th>Tipe Hak</th>
                <th>No Hak</th>
                <th>Jenis</th>
                <th>Pelayanan</th>
                <th>Keterangan</th>
                <th>Lokasi/Tersedia</th>
            </tr>
        </thead>
        <tbody class="text-center">
            <?php 
            $i=1; 
            $tgl = date('d-m-Y');
            ?>
            @foreach ($cart as $c)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ date("d-M-Y", strtotime($tgl)) }}</td>
                    <td>{{ $c->options->kecamatan }}</td>
                    <td>{{ $c->options->kelurahan }}</td>
                    <td>{{ $c->options->no_berkas }}</td>
                    <td>{{ $c->options->hak }}</td>
                    <td>{{ $c->name }}</td>
                    <td>{{ $c->options->jenis_arsip }}</td>
                    <td>{{ $c->options->pelayanan }}</td>
                    <td>{{ $c->options->keterangan }}</td>
                    <td>
                        @if ($c->options->tersedia)
                        {{ $c->options->lokasi }} <i class="text-success fas fa-check-circle"></i>
                        @else
                            {{ $c->options->lokasi }} <i class="text-danger fas fa-times-circle"></i>                        
                        @endif
                        <button class="btn btn-xs btn-warning btn-delete-cart" rowId="{{ $c->rowId }}" type="button"><i class="text-light fas fa-trash"></i></button>
                    </td>
                    
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif

