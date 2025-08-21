<table class="table table-sm text-center">
    <thead>
        <tr>
            <th>#</th>
            <th>Status</th>
            <th>Pelayanan</th>
            <th>Seksi</th>
            <th>Waktu</th>
            <th>User</th>
        </tr>
    </thead>
    <tbody>
        @php
            $i=1;
        @endphp
        @foreach ($history as $d)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $d->status }}</td>
                <td>{{ $d->pelayanan->nm_pelayanan }}</td>
                <td>{{ $d->seksi->nm_seksi }}</td>
                <td>{{ date("d-M-Y H:i", strtotime($d->created_at)) }}</td>
                <td>{{ $d->user->name }}</td>
            </tr>
        @endforeach
    </tbody>
</table>