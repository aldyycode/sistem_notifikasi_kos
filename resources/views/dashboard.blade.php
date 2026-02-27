
<h1>Dashboard Sistem Notifikasi Kos</h1>

<h3>Ringkasan</h3>
<p>Total Belum Lunas: <b>{{ $chartData['pembayaran']['belum_lunas'] }}</b></p>
<p>Total Lunas: <b>{{ $chartData['pembayaran']['lunas'] }}</b></p>
<p>Total Notifikasi Terkirim: <b>{{ $chartData['notifikasi']['terkirim'] }}</b></p>
<p>Total Notifikasi Gagal: <b>{{ $chartData['notifikasi']['gagal'] }}</b></p>
<hr>

<h3>Notifikasi Terakhir</h3>

<table border="1" cellpadding="6" cellspacing="0">
    <thead>
        <tr>
            <th>Pesan</th>
            <th>Tanggal</th>
            <th>Status</th>
            <th>Jenis</th>
        </tr>
    </thead>
    <tbody>
    @forelse($notifikasiTerakhir ?? [] as $n)
        <tr>
            <td>{{ $n->isi_pesan }}</td>
            <td>{{ \Carbon\Carbon::parse($n->tanggal_kirim)->format('d M Y H:i') }}</td>
            <td>
                @if($n->status_kirim == 'terkirim')
                    <span style="color:green; font-weight:bold;">Terkirim</span>
                @else
                    <span style="color:red; font-weight:bold;">Gagal</span>
                @endif
            </td>
            <td>{{ $n->jenis_reminder ?? '-' }}</td>
        </tr>
    @empty
        <tr>
            <td colspan="4" align="center">Belum ada notifikasi</td>
        </tr>
    @endforelse
    </tbody>
</table>
<h3>Review Terbaru</h3>

<table border="1" cellpadding="6">
<tr>
    <th>Nama</th>
    <th>Rating</th>
    <th>Ulasan</th>
</tr>

@foreach($ulasans as $u)
<tr>
    <td>{{ $u->penghuni->nama_penghuni }}</td>
    <td>{{ str_repeat('⭐', $u->nilai_rating) }}</td>
    <td>{{ $u->isi_ulasan }}</td>
</tr>
@endforeach
</table>
<canvas id="ratingChart"></canvas>
<script>
    new Chart(document.getElementById('ratingChart'), {
    type: 'bar',
    data: {
        labels: Object.keys(chartData.rating),
        datasets: [{
            label: 'Jumlah Rating',
            data: Object.values(chartData.rating),
            backgroundColor: '#f39c12'
        }]
    }
});
</script>

<hr>
<h2>Grafik Statistik</h2>

<div style="width:600px; margin-bottom:30px;">
    <canvas id="pembayaranChart"></canvas>
</div>

<div style="width:600px; margin-bottom:30px;">
    <canvas id="notifikasiChart"></canvas>
</div>

<div style="width:600px;">
    <canvas id="reminderChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function() {

    const chartData = @json($chartData);

    // PIE PEMBAYARAN
    new Chart(document.getElementById('pembayaranChart'), {
        type: 'pie',
        data: {
            labels: ['Belum Lunas', 'Lunas'],
            datasets: [{
                data: [
                    chartData.pembayaran.belum_lunas,
                    chartData.pembayaran.lunas
                ],
                backgroundColor: ['#e74c3c','#2ecc71']
            }]
        }
    });

    // BAR NOTIFIKASI
    new Chart(document.getElementById('notifikasiChart'), {
        type: 'bar',
        data: {
            labels: ['Terkirim', 'Gagal'],
            datasets: [{
                label: 'Jumlah Notifikasi',
                data: [
                    chartData.notifikasi.terkirim,
                    chartData.notifikasi.gagal
                ],
                backgroundColor: ['#2ecc71','#e74c3c']
            }]
        }
    });

    // BAR REMINDER
    new Chart(document.getElementById('reminderChart'), {
        type: 'bar',
        data: {
            labels: Object.keys(chartData.reminder),
            datasets: [{
                label: 'Jumlah Reminder',
                data: Object.values(chartData.reminder),
                backgroundColor: '#3498db'
            }]
        }
    });

});
</script>