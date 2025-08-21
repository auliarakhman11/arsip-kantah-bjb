<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Data Peminjaman</title>

    <style>
        table {
  border: 1px solid #ccc;
  border-collapse: collapse;
  margin: 0;
  padding: 0;
  width: 100%;
  table-layout: fixed;
}

table caption {
  font-size: 1.5em;
  margin: .5em 0 .75em;
}

table tr {
  background-color: #f8f8f8;
  border: 1px solid #ddd;
  /* padding: .35em; */
}

table th,
table td {
  padding: .625em;
  text-align: center;
}

table th {
  font-size: 11px;
  letter-spacing: .1em;
  text-transform: uppercase;
}

@media screen and (max-width: 600px) {
  table {
    border: 0;
  }

  table caption {
    font-size: 1.3em;
  }
  
  table thead {
    border: none;
    clip: rect(0 0 0 0);
    height: 1px;
    margin: -1px;
    overflow: hidden;
    padding: 0;
    position: absolute;
    width: 1px;
  }
  
  table tr {
    border-bottom: 3px solid #ddd;
    display: block;
    margin-bottom: .625em;
  }
  
  table td {
    border-bottom: 1px solid #ddd;
    display: block;
    font-size: 9px;
    text-align: right;
  }
  
  table td::before {
    /*
    * aria-label has no advantage, it won't be read inside a table
    content: attr(aria-label);
    */
    content: attr(data-label);
    float: left;
    font-weight: bold;
    text-transform: uppercase;
  }
  
  table td:last-child {
    border-bottom: 0;
  }
}

/* general styling */
body {
  font-family: "Open Sans", sans-serif;
  line-height: 1.25;
}
    </style>
</head>
<body>
    <table width="100%">
        <caption>{{ $periode }}</caption>
        <thead>
          <tr>
            <th width="5%">#</th>
            <th>Kecamatan</th>
            <th>Kelurahan</th>
            <th>No Berkas</th>
            <th>Tipe Hak</th>
            <th>No Hak</th>
            <th>Jenis</th>
            <th>Pelayanan</th>
            <th>Keterangan</th>
            <th>Waktu</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody style="font-size: 9px;">
            @php
                $i=1;
            @endphp
            @foreach ($peminjaman as $d)
            <tr>
                <td>{{ $i++; }}</td>
                <td>{{ $d->kecamatan->nm_kecamatan }}</td>
                <td>{{ $d->kelurahan->nm_kelurahan }}</td>
                <td>{{ $d->no_berkas }}</td>
                <td>{{ $d->hak->nm_hak }}</td>
                <td>{{ $d->no_hak }}</td>
                <td>{{ $d->jenis_arsip }}</td>
                <td>{{ $d->pelayanan->nm_pelayanan }}</td>
                <td>{{ $d->keterangan }}</td>
                <td>{{ date("d-M-Y H:i", strtotime($d->updated_at)) }}</td>
                <td>{{ ucwords($d->jenis_history) }}</td>
            </tr>
            @endforeach          
        </tbody>
      </table>
</body>
</html>