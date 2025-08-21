@if ($peminjaman)
<div class="container-fluid">    
    <table class="table table-sm">
        <thead class="text-center">
            <tr>
                <th>#</th>
                <th>Kecamatan</th>
                <th>Kelurahan</th>
                <th>No Berkas</th>
                <th>Tipe Hak</th>
                <th>No Hak</th>
                <th>Jenis</th>
                <th>Pelayanan</th>
                <th>Keterangan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody class="text-center">
            <?php $i=1; ?>
            @foreach ($peminjaman as $p)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $p->kecamatan->nm_kecamatan }}</td>
                    <td>{{ $p->kelurahan->nm_kelurahan }}</td>
                    <td>{{ $p->no_berkas }}</td>
                    <td>{{ $p->hak->nm_hak }}</td>
                    <td>{{ $p->no_hak }}</td>
                    <td>{{ $p->jenis_arsip }}</td>
                    <td>{{ $p->pelayanan->nm_pelayanan }}</td>
                    <td>{{ $p->keterangan }}</td>
                    <td>
                        @if ($p->jenis_history == 'peminjaman')
                            <a href="#modal_pengembalian" data-toggle="modal" class="pengembalian btn btn-xs btn-success" id_peminjaman="{{ $p->id }}"><i class="fas fa-check-square"></i> Peminjaman</a>
                        @else
                        Pengembalian
                        @endif
                        
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@else
<h4>Belum ada peminjaman</h4>
@endif

