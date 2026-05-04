{{-- ============================= --}}
{{-- resources/views/kamar/index.blade.php --}}
{{-- ============================= --}}

@extends('layouts.app')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">🏠 Master Kamar</h3>

        <a href="{{ route('kamar.create') }}" class="btn btn-primary shadow">
            + Tambah Kamar
        </a>
    </div>

    {{-- ALERT --}}
    @if(session('success'))
    <script>
        Swal.fire({
            icon:'success',
            title:'Berhasil!',
            text:'{{ session('success') }}',
            timer:2000,
            showConfirmButton:false
        });
    </script>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-hover align-middle">

                    <thead class="table-dark">
                        <tr>
                            <th>No Kamar</th>
                            <th>Tipe</th>
                            <th>Luas</th>
                            <th>Harga</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($kamars as $k)
                        <tr>

                            <td class="fw-semibold">
                                {{ $k->nomor_kamar }}
                            </td>

                            <td>{{ $k->tipe_kamar }}</td>

                            <td>{{ $k->luas_kamar }}</td>

                            <td class="text-success fw-semibold">
                                Rp {{ number_format($k->harga_sewa) }}
                            </td>

                            <td>
                                @if($k->status_kamar == 'kosong')
                                    <span class="badge bg-success">Kosong</span>
                                @elseif($k->status_kamar == 'terisi')
                                    <span class="badge bg-danger">Terisi</span>
                                @else
                                    <span class="badge bg-warning text-dark">Maintenance</span>
                                @endif
                            </td>

                            <td>

                                <a href="{{ route('kamar.edit',$k->id_kamar) }}"
                                   class="btn btn-warning btn-sm">
                                   ✏ Edit
                                </a>
                                <a href="{{ route('kamar.show',$k->id_kamar) }}"
                                   class="btn btn-info btn-sm">
                                   👁 Detail
                                </a>

                                <form action="{{ route('kamar.destroy',$k->id_kamar) }}"
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

<script>
function confirmDelete(e, form){
    e.preventDefault();

    Swal.fire({
        title:'Hapus Data?',
        text:'Data kamar akan dihapus permanen!',
        icon:'warning',
        showCancelButton:true,
        confirmButtonColor:'#dc3545',
        cancelButtonColor:'#6c757d',
        confirmButtonText:'Ya, Hapus',
        cancelButtonText:'Batal'
    }).then((result)=>{
        if(result.isConfirmed){
            form.submit();
        }
    });
}
</script>

@endsection