<table class="table table-sm" width="100%">
    <tbody class="bg-secondary">
        <tr>
            <th class="sticky-top th-atas">No Berkas</th>
            <th class="sticky-top th-atas">Kecamatan</th>
            <th class="sticky-top th-atas">Kelurahan</th>
            <th class="sticky-top th-atas">Pelayanan</th>
            <th class="sticky-top th-atas">Tipe Hak</th>
            <th class="sticky-top th-atas">No Hak</th>
            <th class="sticky-top th-atas">Jenis Arsip</th>
            <th class="sticky-top th-atas">Keterangan</th>
        </tr>
    </tbody>
    @foreach ($pengajuan as $d)
        <tbody data-toggle="collapse" data-target="#{{ $d->no_tiket }}"
            class=" {{ $d->urgent == 1 ? 'blink' : 'bg-info' }} clickable thead_pengajuan" aria-expanded="true">
            <tr>
                <th colspan="2">{{ $d->seksi->nm_seksi }} ({{ $d->user->name }})</th>
                <th colspan="2">{{ date('d-M-Y H:i', strtotime($d->created_at)) }}</th>
                <th>{{ $d->selisih }} Hari</th>
                <th>
                    @if (Auth::user()->seksi_id == 1)
                        <div class="custom-control custom-switch custom-switch-off-light custom-switch-on-warning">
                            <input type="checkbox" class="custom-control-input checkbox_urgent" name="urgent"
                                id="urgent{{ $d->no_tiket }}" value="{{ $d->no_tiket }}"
                                {{ $d->urgent == 1 ? 'checked' : '' }}>
                            <label class="custom-control-label" for="urgent{{ $d->no_tiket }}">Urgent</label>
                        </div>
                    @endif

                </th>
                <th>No Tiket : {{ $d->no_tiket }}
                    @php
                        $nohak = '';
                    @endphp
                    @foreach ($d->peminjaman as $p)
                        @php
                            $nohak .=
                                ' ' .
                                $p->no_hak .
                                ' ' .
                                $p->kecamatan->nm_kecamatan .
                                ' ' .
                                $p->kelurahan->nm_kelurahan .
                                ' ' .
                                $p->pelayanan->nm_pelayanan .
                                ' ' .
                                $p->hak->nm_hak .
                                ' ' .
                                $p->jenis_arsip .
                                ' ' .
                                $p->keterangan .
                                ' ' .
                                $p->no_berkas .
                                ' ' .
                                $d->seksi->nm_seksi .
                                ' ' .
                                $d->user->name .
                                ' ' .
                                date('d-M-Y H:i', strtotime($d->created_at));
                        @endphp
                    @endforeach

                    <small style="font-size: 0.1px;">&nbsp; {{ $nohak }}</small>
                </th>
                <th>
                    @if (Auth::user()->seksi_id == 1 || Auth::user()->seksi_id == 4)
                        <a href="{{ route('inputPengajuan', ['tiket' => $d->no_tiket]) }}"
                            class="btn btn-xs btn-secondary"><i class="fas fa-edit"></i></a>
                        <a class="btn btn-xs btn-secondary" target="_blank"
                            href="{{ route('printPengajuan', ['tiket' => $d->no_tiket]) }}"><i
                                class="fas fa-print"></i>
                            Print</a>
                    @endif

                </th>
            </tr>
        </tbody>
        <tbody id="{{ $d->no_tiket }}" class="collapse show text-center tbody_pengajuan">
            @foreach ($d->peminjaman as $p)
                <tr>
                    <td>{{ $p->no_berkas }}</td>
                    <td>{{ $p->kecamatan->nm_kecamatan }}</td>
                    <td>{{ $p->kelurahan->nm_kelurahan }}</td>
                    <td>{{ $p->pelayanan->nm_pelayanan }}</td>
                    <td>{{ $p->hak->nm_hak }}</td>
                    <td>{{ $p->no_hak }}</td>
                    <td>{{ $p->jenis_arsip }}
                        @if (Auth::user()->seksi_id == 1)
                            <button class="btn btn-xs btn-danger btn_batal_pengajuan"
                                id_peminjaman="{{ $p->id }}" data-target="#modal_batal_pengajuan"
                                data-toggle="modal">Batal</button>
                        @endif
                    </td>
                    <td>{{ $p->keterangan }} <small style="font-size: 0.1px;">{{ $nohak }}</small></td>
                </tr>
            @endforeach
        </tbody>
    @endforeach

</table>
