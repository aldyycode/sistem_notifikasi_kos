<h2>Tambah Pembayaran</h2>

<form action="{{ route('pembayaran.store') }}" method="POST">
    @csrf

    Penghuni:
    <select name="id_penghuni">
        @foreach($penghunis as $p)
            <option value="{{ $p->id_penghuni }}">
                {{ $p->nama_penghuni }}
            </option>
        @endforeach
    </select>
    <br>

    Jumlah Bayar:
    <input type="number" name="jumlah_bayar">
    <br>

    Jatuh Tempo:
    <input type="date" name="jatuh_tempo">
    <br>

    <button type="submit">Simpan</button>
</form>
