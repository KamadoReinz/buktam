@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="d-flex justify-content-between align-items-center" style="margin-right: 20px">
            <h5 class="card-header">List User</h5>
            <a href="" class="btn btn-success">Tambah User</a>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr class="text-center">
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Izin</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($list as $row)
                        <tr>
                            <td class="text-center">{{ $row->nama }}</td>
                            <td class="text-center">{{ $row->email }}</td>
                            <td class="text-center">
                                @php
                                    if ($row->role == 1) {
                                        echo 'Admin';
                                    } elseif ($row->role == 2) {
                                        echo 'Petugas';
                                    }
                                @endphp
                            </td>
                            <td class="text-center">
                                <a href="" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                                <button type="button" onclick="deleteUser('{{ route('users.delete', $row->id) }}')"
                                    class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@push('js')
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/sweetalert2/dist/sweetalert2.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function deleteUser(action) {
            Swal.fire({
                title: 'Hapus User?',
                text: "Apakah Anda yakin akan menghapus user ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Iya',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Berhasil!',
                        'User Berhasil Dihapus.',
                        'success'
                    )
                    window.location.href = action
                }
            })
        }
    </script>
@endpush
