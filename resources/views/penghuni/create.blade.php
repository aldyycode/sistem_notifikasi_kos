<h2>Tambah Penghuni</h2>

<form action="{{ route('penghuni.store') }}" method="POST">
    @csrf

    Nama: <input type="text" name="nama_penghuni"><br>
    Nomor Kamar: <input type="text" name="nomor_kamar"><br>
    No WA: <input type="text" name="no_wa"><br>
    Status:
    <select name="status_hunian">
        <option value="aktif">Aktif</option>
        <option value="nonaktif">Nonaktif</option>
    </select><br>

    <button type="submit">Simpan</button>
</form>
