<h2>Daftar Pembayaran</h2>

<a href="{{ route('pembayaran.create') }}">Tambah Pembayaran</a>

<table border="1">
    <tr>
        <th>Nama Penghuni</th>
        <th>Jumlah</th>
        <th>Jatuh Tempo</th>
        <th>Status</th>
    </tr>

    @foreach($pembayarans as $p)
    <tr>
        <td>{{ $p->penghuni->nama_penghuni }}</td>
        <td>{{ $p->jumlah_bayar }}</td>
        <td>{{ $p->jatuh_tempo }}</td>
        <td>{{ $p->status_bayar }}</td>
    </tr>
    @endforeach
</table>
