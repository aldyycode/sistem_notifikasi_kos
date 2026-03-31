<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Sistem Notifikasi Kos</title>

{{-- Tailwind --}}
<script src="https://cdn.tailwindcss.com"></script>

{{-- SweetAlert --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body class="bg-gradient-to-br min-h-screen">

<div class="flex h-screen overflow-hidden">

    {{-- SIDEBAR --}}
    @include('components.sidebar')

    {{-- MAIN CONTENT --}}
    <div class="flex-1 flex flex-col overflow-hidden">

        {{-- NAVBAR --}}
        <div class="p-6">
            @include('components.navbar')
        </div>

        {{-- PAGE CONTENT --}}
        <div class="flex-1 overflow-y-auto px-6 pb-6">
            @yield('content')
        </div>

    </div>

</div>

{{-- GLOBAL SWEETALERT --}}
<script>
function confirmDelete(event, form) {
    event.preventDefault();

    Swal.fire({
        title: 'Yakin hapus?',
        text: "Data tidak bisa dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal',
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
}
</script>

</body>
</html>