@extends('layouts.app')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="container-fluid">

    <h3 class="fw-bold mb-4">📊 Dashboard Sistem Kos</h3>

    {{-- RINGKASAN --}}
    <div class="row mb-4">

        <div class="col-md-3">
            <div class="card shadow-sm border-0 bg-danger text-white">
                <div class="card-body">
                    <h6>Belum Lunas</h6>
                    <h3>{{ $chartData['pembayaran']['belum_lunas'] }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 bg-success text-white">
                <div class="card-body">
                    <h6>Lunas</h6>
                    <h3>{{ $chartData['pembayaran']['lunas'] }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 bg-primary text-white">
                <div class="card-body">
                    <h6>Notifikasi Terkirim</h6>
                    <h3>{{ $chartData['notifikasi']['terkirim'] }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 bg-secondary text-white">
                <div class="card-body">
                    <h6>Notifikasi Gagal</h6>
                    <h3>{{ $chartData['notifikasi']['gagal'] }}</h3>
                </div>
            </div>
        </div>

    </div>

    {{-- CHART --}}
    <div class="row mb-4">

        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6>Pembayaran</h6>
                    <canvas id="pembayaranChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6>Notifikasi</h6>
                    <canvas id="notifikasiChart"></canvas>
                </div>
            </div>
        </div>

    </div>

    {{-- REMINDER + RATING --}}
    <div class="row mb-4">

        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6>Reminder</h6>
                    <canvas id="reminderChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6>Rating Penghuni</h6>
                    <canvas id="ratingChart"></canvas>
                </div>
            </div>
        </div>

    </div>

    {{-- NOTIFIKASI TERAKHIR --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h6 class="mb-3">📩 Notifikasi Terakhir</h6>

            <div class="table-responsive">
                <table class="table table-hover">

                    <thead class="table-dark">
                        <tr>
                            <th>Pesan</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Jenis</th>
                        </tr>
                    </thead>

                    <tbody>
                    @forelse($notifikasiTerakhir as $n)
                        <tr>
                            <td>{{ Str::limit($n->isi_pesan, 50) }}</td>
                            <td>{{ \Carbon\Carbon::parse($n->tanggal_kirim)->format('d M Y H:i') }}</td>
                            <td>
                                @if($n->status_kirim == 'terkirim')
                                    <span class="badge bg-success">Terkirim</span>
                                @else
                                    <span class="badge bg-danger">Gagal</span>
                                @endif
                            </td>
                            <td>{{ $n->jenis_reminder ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Belum ada notifikasi</td>
                        </tr>
                    @endforelse
                    </tbody>

                </table>
            </div>

        </div>
    </div>

    {{-- ULASAN --}}
    <div class="card shadow-sm">
        <div class="card-body">
            <h6 class="mb-3">⭐ Review Penghuni</h6>

            <div class="table-responsive">
                <table class="table table-bordered">

                    <thead class="table-dark">
                        <tr>
                            <th>Nama</th>
                            <th>Rating</th>
                            <th>Ulasan</th>
                        </tr>
                    </thead>

                    <tbody>

                    @foreach($ulasans as $u)
                    <tr>
                        <td>{{ $u->penghuni->nama_penghuni }}</td>
                        <td>{!! str_repeat('⭐', $u->nilai_rating) !!}</td>
                        <td>{{ $u->isi_ulasan }}</td>
                    </tr>
                    @endforeach

                    </tbody>

                </table>
            </div>

        </div>
    </div>

</div>

{{-- SCRIPT --}}
<script>
const chartData = {!! json_encode($chartData) !!};

// pembayaran
new Chart(document.getElementById('pembayaranChart'), {
    type: 'pie',
    data: {
        labels: ['Belum Lunas', 'Lunas'],
        datasets: [{
            data: [
                chartData.pembayaran.belum_lunas,
                chartData.pembayaran.lunas
            ]
        }]
    }
});

// notifikasi
new Chart(document.getElementById('notifikasiChart'), {
    type: 'bar',
    data: {
        labels: ['Terkirim', 'Gagal'],
        datasets: [{
            data: [
                chartData.notifikasi.terkirim,
                chartData.notifikasi.gagal
            ]
        }]
    }
});

// reminder
new Chart(document.getElementById('reminderChart'), {
    type: 'bar',
    data: {
        labels: Object.keys(chartData.reminder),
        datasets: [{
            data: Object.values(chartData.reminder)
        }]
    }
});

// rating
new Chart(document.getElementById('ratingChart'), {
    type: 'bar',
    data: {
        labels: Object.keys(chartData.rating),
        datasets: [{
            data: Object.values(chartData.rating)
        }]
    }
});
</script>

@endsection