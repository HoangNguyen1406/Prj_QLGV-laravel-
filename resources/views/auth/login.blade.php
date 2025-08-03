<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<style>
    body{
        width: 100vw;
        background-color: #15152A;
    }

</style>

<div class="container d-flex justify-content-center align-items-center" style="height: 100%; width:100%; background-color: #15152A;">
    <div class="card shadow-lg p-4" style="max-width: 400px; width: 100%; background-color: #26262E; color: #fff; border-radius: 12px; border: 1px solid #333;">
        <h3 class="mb-4 text-center" style="color: #8a6cff;">Đăng nhập</h3>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label text-light">Địa chỉ Email</label>
                <input type="email" class="form-control bg-dark text-white border-secondary @error('email') is-invalid @enderror"
                       id="email" name="email" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label text-light">Mật khẩu</label>
                <input type="password" class="form-control bg-dark text-white border-secondary @error('password') is-invalid @enderror"
                       id="password" name="password" required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label text-light" for="remember">Ghi nhớ đăng nhập</label>
            </div>

            <button type="submit" class="btn btn-primary w-100">Đăng nhập</button>
        </form>

        <div class="text-center mt-3">
            <a href="{{ route('password.request') }}" class="text-light">Quên mật khẩu?</a>
        </div>
    </div>
</div>