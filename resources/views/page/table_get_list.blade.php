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
        @foreach ($pengajuan as $p)
            <tr>
                <td>{{ $p->no_berkas }}</td>
                <td>{{ $p->kecamatan->nm_kecamatan }}</td>
                <td>{{ $p->kelurahan->nm_kelurahan }}</td>
                <td>{{ $p->pelayanan->nm_pelayanan }}</td>
                <td>{{ $p->hak->nm_hak }}</td>
                <td>{{ $p->no_hak }}</td>
                <td>{{ $p->jenis_arsip }}</td>
                <td>{{ $p->keterangan }}
                    {{ $p->ba ? ($p->ba->no_ba_bt && $p->jenis_arsip == 'BT' ? '(Foto Coppy)' : '') : '' }}
                    {{ $p->ba ? ($p->ba->no_ba_su && $p->jenis_arsip == 'SU' ? '(Foto Coppy)' : '') : '' }}</td>
                <td><input type="checkbox" name="id_peminjaman[]" value="{{ $p->id }}">
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
