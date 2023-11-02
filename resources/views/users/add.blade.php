@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h5 class="card-header">Tambah User</h5>
                <div class="card-body">
                    <form method="POST" action="{{ route('addUser.perform') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" placeholder="Nama"
                                aria-describedby="Nama" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="Email"
                                aria-describedby="Email" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Kata Sandi</label>
                            <div class="password-input-container">
                                <input type="password" class="form-control" id="password" placeholder="Kata Sandi"
                                    aria-describedby="Password" required>
                                <span class="password-toggle" onclick="togglePasswordVisibility()"><i id="password-icon"
                                        class="fas fa-eye-slash"></i></span>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary w-100 my-4 mb-2">Tambahkan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        var passwordInput = document.getElementById('password');
        var passwordIcon = document.getElementById('password-icon');

        function togglePasswordVisibility() {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordIcon.classList.remove('fa-eye-slash');
                passwordIcon.classList.add('fa-eye');
            } else {
                passwordInput.type = 'password';
                passwordIcon.classList.remove('fa-eye');
                passwordIcon.classList.add('fa-eye-slash');
            }
        }
    </script>
@endpush
