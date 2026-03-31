<div class="d-flex flex-column vh-100 bg-dark text-white p-3" style="width: 250px;">

    <!-- Logo / Judul -->
    <h4 class="mb-4 fw-bold">🏠 Kos Admin</h4>

    <!-- Menu -->
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item mb-2">
            <a href="/dashboard" class="nav-link text-white">Dashboard</a>
        </li>
        <li class="mb-2">
            <a href="/penghuni" class="nav-link text-white">Penghuni</a>
        </li>
        <li class="mb-2">
            <a href="/pembayaran" class="nav-link text-white">Pembayaran</a>
        </li>
    </ul>

    <!-- 🔥 LOGOUT DI PALING BAWAH -->
    <div class="mt-auto">
        <hr class="text-secondary">

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button 
                class="btn btn-danger w-100 rounded-3 
                       hover:scale-105 transition duration-200">
                🔓 Logout
            </button>
        </form>
    </div>

</div>