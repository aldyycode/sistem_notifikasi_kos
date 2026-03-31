@extends('layouts.app')

@section('content')

{{-- Bootstrap & SweetAlert --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">👤 Data Penghuni</h3>

        <a href="{{ route('penghuni.create') }}" class="btn btn-primary shadow">
            + Tambah Penghuni
        </a>
    </div>

    {{-- ALERT SUCCESS --}}
    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            timer: 2000,
            showConfirmButton: false
        });
    </script>
    @endif

    {{-- CARD TABLE --}}
    <div class="card shadow-sm border-0">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-hover align-middle">

                    <thead class="table-dark">
                        <tr>
                            <th>Nama</th>
                            <th>Kamar</th>
                            <th>No WhatsApp</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                    @foreach($penghunis as $p)

                    <tr>

                        <td class="fw-semibold">
                            {{ $p->nama_penghuni }}
                        </td>

                        <td>
                            <span class="badge bg-info text-dark">
                                {{ $p->nomor_kamar }}
                            </span>
                        </td>

                        <td>
                            <a href="https://wa.me/62{{ substr($p->no_wa,1) }}" 
                               target="_blank" 
                               class="text-success fw-semibold">
                                {{ $p->no_wa }}
                            </a>
                        </td>

                        <td>
                            @if($p->status_hunian == 'aktif')
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-secondary">Tidak Aktif</span>
                            @endif
                        </td>

                        <td>

                            {{-- tombol edit (optional) --}}
                            <a href="{{ route('penghuni.edit', $p->id_penghuni) }}" class="btn btn-warning btn-sm">
                                ✏ Edit
                            </a>

                     <form action="{{ route('penghuni.destroy', $p->id_penghuni) }}" 
      method="POST"
      style="display:inline;"
      onsubmit="return confirmDelete(event,this)">

    @csrf
    @method('DELETE')

    <button class="btn btn-danger btn-sm">
        🗑 Hapus
    </button>
</form>

                        </td>

                    </tr>

                    @endforeach

                    </tbody>

                </table>
            </div>

        </div>
    </div>

</div>

{{-- SWEETALERT DELETE --}}
<script>
function confirmDelete(e, form){
    e.preventDefault();

    Swal.fire({
        title: 'Hapus Data?',
        text: "Data penghuni akan dihapus permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#e74c3c',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
}
</script>

@endsection