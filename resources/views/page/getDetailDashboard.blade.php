<table class="table table-sm">
    <thead>
        <tr>
            <th>#</th>
            <th>Jenis Arsip</th>
            <th>Jumlah</th>
        </tr>
    </thead>
    <tbody>
        @php
            $i = 1;
            $tot = 0;
        @endphp
        @foreach ($dashboard as $d)
            @php
                $tot += $d->jml;
            @endphp
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $d->jenis_arsip }}</td>
                <td>{{ $d->jml }}</td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="2" class="text-center"><b>Total</b></td>
            <td><b>{{ $tot }}</b></td>
        </tr>
    </tfoot>
</table>
