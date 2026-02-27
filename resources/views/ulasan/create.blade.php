<h2>Kirim Ulasan</h2>

<form action="/ulasan/store" method="POST">
    @csrf

    Penghuni:
    <select name="id_penghuni">
        @foreach($penghunis as $p)
            <option value="{{ $p->id_penghuni }}">
                {{ $p->nama_penghuni }}
            </option>
        @endforeach
    </select>

    <br><br>

    Rating:
    <select name="nilai_rating">
        <option value="5">⭐⭐⭐⭐⭐ (5)</option>
        <option value="4">⭐⭐⭐⭐ (4)</option>
        <option value="3">⭐⭐⭐ (3)</option>
        <option value="2">⭐⭐ (2)</option>
        <option value="1">⭐ (1)</option>
    </select>

    <br><br>

    Ulasan:
    <br>
    <textarea name="isi_ulasan" rows="4" cols="40"></textarea>

    <br><br>

    <button type="submit">Kirim Ulasan</button>
</form>