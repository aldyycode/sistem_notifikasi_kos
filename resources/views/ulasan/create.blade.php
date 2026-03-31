<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Ulasan</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body class="bg-gray-100">

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <!-- Card -->
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-4">

                    <h3 class="text-center fw-bold mb-3 text-dark">
                        ⭐ Form Ulasan
                    </h3>

                    <!-- Nama -->
                    <div class="mb-3">
                        <label class="form-label text-muted">Nama Penghuni</label>
                        <div class="fw-semibold text-lg">
                            {{ $pembayaran->penghuni->nama_penghuni }}
                        </div>
                    </div>

                    @if($sudahReview)
                        <div class="alert alert-danger text-center rounded-3">
                            ⚠️ Anda sudah pernah memberikan ulasan untuk pembayaran ini.
                        </div>
                    @else

                    <form action="{{ route('ulasan.store') }}" method="POST">
                        @csrf

                        <input type="hidden" name="id_pembayaran" value="{{ $pembayaran->id_pembayaran }}">
                        <input type="hidden" name="id_penghuni" value="{{ $pembayaran->id_penghuni }}">

                        <!-- Rating -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Rating</label>

                            <div class="flex gap-2 text-2xl cursor-pointer" id="rating-stars">
                                @for($i = 5; $i >= 1; $i--)
                                    <input type="radio" name="nilai_rating" value="{{ $i }}" id="star{{ $i }}" class="hidden" required>
                                    <label for="star{{ $i }}" class="star text-gray-300 hover:text-yellow-400 transition">
                                        ★
                                    </label>
                                @endfor
                            </div>
                        </div>

                        <!-- Ulasan -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Ulasan</label>
                            <textarea 
                                name="isi_ulasan" 
                                class="form-control rounded-3 shadow-sm focus:ring-2 focus:ring-blue-400"
                                rows="4" 
                                placeholder="Tulis pengalaman Anda..."
                                required></textarea>
                        </div>

                        <!-- Button -->
                        <div class="d-grid">
                            <button type="submit" 
                                class="btn btn-primary rounded-3 py-2 fw-semibold 
                                       hover:scale-105 transition duration-200 shadow">
                                🚀 Kirim Ulasan
                            </button>
                        </div>
<input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </form>

                    @endif

                </div>
            </div>

        </div>
    </div>
</div>

<!-- Script Rating -->
<script>
    const stars = document.querySelectorAll('.star');
    const radios = document.querySelectorAll('input[name="nilai_rating"]');

    stars.forEach((star, index) => {
        star.addEventListener('click', () => {
            radios[index].checked = true;

            stars.forEach((s, i) => {
                if (i <= index) {
                    s.classList.add('text-yellow-400');
                    s.classList.remove('text-gray-300');
                } else {
                    s.classList.add('text-gray-300');
                    s.classList.remove('text-yellow-400');
                }
            });
        });
    });
</script>

</body>
</html>