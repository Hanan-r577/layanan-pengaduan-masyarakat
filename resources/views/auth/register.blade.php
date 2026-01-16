<x-guest-layout>
    <h4 class="text-center mb-3">Registrasi Akun</h4>
    <p class="text-center text-muted mb-4">
        Silakan isi data untuk membuat akun
    </p>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Nama -->
        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text"
                   name="nama"
                   class="form-control"
                   value="{{ old('nama') }}"
                   required autofocus>
            @error('nama')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email"
                   name="email"
                   class="form-control"
                   value="{{ old('email') }}"
                   required>
            @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- No Telepon -->
        <div class="mb-3">
            <label class="form-label">No. Telepon</label>
            <input type="text"
                   name="telp"
                   class="form-control"
                   value="{{ old('telp') }}"
                   required>
            @error('telp')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password"
                   name="password"
                   class="form-control"
                   required>
            @error('password')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Konfirmasi Password -->
        <div class="mb-4">
            <label class="form-label">Konfirmasi Password</label>
            <input type="password"
                   name="password_confirmation"
                   class="form-control"
                   required>
        </div>

        <button type="submit" class="btn btn-primary w-100">
            Daftar
        </button>
    </form>

    <div class="text-center mt-3">
        <small>
            Sudah punya akun?
            <a href="{{ route('login') }}">Login di sini</a>
        </small>
    </div>
</x-guest-layout>
