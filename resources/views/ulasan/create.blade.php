<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beri Ulasan - Kos Kami</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 min-h-screen flex items-center justify-center p-4 antialiased">

<div class="w-full max-w-md">

    <!-- Card -->
    <div class="bg-white p-6 sm:p-8 rounded-2xl shadow-sm border border-slate-100">
        
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-12 h-12 bg-indigo-50 rounded-full mb-4">
                <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
            </div>
            <h2 class="text-2xl font-bold text-slate-900">Form Ulasan</h2>
            <p class="text-sm text-slate-500 mt-2">Bagikan pengalaman Anda selama tinggal di kos kami.</p>
        </div>

        @if($sudahReview)
            <!-- Alert Sudah Review -->
            <div class="bg-amber-50 border border-amber-200 p-4 rounded-xl text-center">
                <svg class="w-8 h-8 text-amber-500 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <h4 class="text-sm font-semibold text-amber-800">Ulasan Sudah Diterima</h4>
                <p class="text-xs text-amber-700 mt-1">Anda sudah memberikan ulasan untuk periode pembayaran ini. Terima kasih!</p>
            </div>
        @else

            <!-- Form -->
            <form action="{{ route('ulasan.store') }}" method="POST">
                @csrf
                <input type="hidden" name="id_pembayaran" value="{{ $pembayaran->id_pembayaran }}">
                <input type="hidden" name="id_penghuni" value="{{ $pembayaran->id_penghuni }}">

                <!-- Info Penghuni -->
                <div class="mb-6 p-4 bg-slate-50 rounded-xl border border-slate-100 flex items-center gap-4">
                    <div class="w-10 h-10 rounded-full bg-indigo-100 text-indigo-700 font-bold flex items-center justify-center">
                        {{ strtoupper(substr($pembayaran->penghuni->nama_penghuni, 0, 1)) }}
                    </div>
                    <div>
                        <p class="text-xs font-medium text-slate-500 mb-0.5">Penghuni / Kamar</p>
                        <p class="text-sm font-semibold text-slate-900">
                            {{ $pembayaran->penghuni->nama_penghuni }} <span class="text-slate-300 mx-1">|</span> {{ $pembayaran->penghuni->kamar?->nomor_kamar ?? '-' }}
                        </p>
                    </div>
                </div>

                <!-- Input Rating -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-slate-700 mb-2 text-center">Berapa bintang untuk kos kami?</label>
                    <div class="flex justify-center gap-1.5" id="rating-container">
                        <!-- Looping 1 sampai 5 dari kiri ke kanan -->
                        @for($i = 1; $i <= 5; $i++)
                            <input type="radio" name="nilai_rating" value="{{ $i }}" id="star{{ $i }}" class="hidden peer" required>
                            <label for="star{{ $i }}" data-index="{{ $i }}" class="star-label cursor-pointer text-slate-300 hover:text-amber-400 transition-colors">
                                <svg class="w-10 h-10 drop-shadow-sm" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            </label>
                        @endfor
                    </div>
                </div>

                <!-- Input Ulasan -->
                <div class="mb-8">
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Tulis Ulasan Anda</label>
                    <textarea 
                        name="isi_ulasan" 
                        class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors bg-slate-50 focus:bg-white resize-y"
                        rows="4" 
                        placeholder="Apa yang Anda suka? Apa yang perlu ditingkatkan?"
                        required></textarea>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full inline-flex items-center justify-center px-6 py-3 border border-transparent shadow-sm text-sm font-medium rounded-xl text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                    Kirim Ulasan
                </button>
                
            </form>

        @endif

    </div>
    
    <!-- Footer / Branding -->
    <p class="text-center text-xs text-slate-400 mt-6">&copy; {{ date('Y') }} Sistem Manajemen Kos</p>

</div>

<!-- Script Rating Interaktif -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const labels = document.querySelectorAll('.star-label');
        const container = document.getElementById('rating-container');

        // Fungsi untuk mewarnai bintang
        const highlightStars = (rating) => {
            labels.forEach(label => {
                const index = parseInt(label.getAttribute('data-index'));
                if (index <= rating) {
                    label.classList.remove('text-slate-300');
                    label.classList.add('text-amber-400');
                } else {
                    label.classList.remove('text-amber-400');
                    label.classList.add('text-slate-300');
                }
            });
        };

        // Efek Hover
        labels.forEach(label => {
            label.addEventListener('mouseenter', function() {
                const index = parseInt(this.getAttribute('data-index'));
                highlightStars(index);
            });
        });

        // Kembalikan ke rating yang dipilih jika kursor keluar area bintang
        container.addEventListener('mouseleave', function() {
            const checkedInput = document.querySelector('input[name="nilai_rating"]:checked');
            if (checkedInput) {
                highlightStars(parseInt(checkedInput.value));
            } else {
                highlightStars(0); // Reset semua jika belum ada yang dipilih
            }
        });

        // Simpan pilihan saat di-klik
        labels.forEach(label => {
            label.addEventListener('click', function() {
                const index = parseInt(this.getAttribute('data-index'));
                // Radio button akan otomatis terpilih karena dibungkus label 'for'
                highlightStars(index);
            });
        });
    });
</script>

</body>
</html>