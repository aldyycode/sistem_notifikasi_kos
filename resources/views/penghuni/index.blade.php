<h2>Daftar Penghuni</h2>

<a href="{{ route('penghuni.create') }}">Tambah Penghuni</a>

<table border="1">
    <tr>
        <th>Nama</th>
        <th>Kamar</th>
        <th>No WA</th>
        <th>Status</th>
    </tr>

    @foreach($penghunis as $p)
    <tr>
        <td>{{ $p->nama_penghuni }}</td>
        <td>{{ $p->nomor_kamar }}</td>
        <td>{{ $p->no_wa }}</td>
        <td>{{ $p->status_hunian }}</td>
    </tr>
    @endforeach
</table>
