@extends('layouts.app')

@section('content')

<!-- @if(session('error'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Toastify({
            text: "{{ session('error') }}",
            duration: 5000,
            close: true,
            gravity: "top",
            position: "center",
            backgroundColor: "linear-gradient(to bottom right, #ff0000, #ff4500)",
        }).showToast();
    });
</script>
@endif -->

<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-lg-5 col-12">
            <div id="auth-left">
                <h1 class="auth-title">{{ __('Log in.') }}</h1>
                <p class="auth-subtitle mb-5">Log in with your data</p>

                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="form-group position-relative has-icon-left mb-3">
                        <input id="username" type="text"
                            class="form-control form-control-xl @error('username') is-invalid @enderror" name="username"
                            value="{{ old('username') }}" required autocomplete="username" autofocus
                            placeholder="Username">
                        <div class="form-control-icon">
                            <i class="bi bi-person"></i>
                        </div>
                    </div>
                    @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <div class="form-group position-relative has-icon-left mb-3">
                        <input id="password" type="password"
                            class="form-control form-control-xl @error('password') is-invalid @enderror" name="password"
                            required autocomplete="current-password" placeholder="Password">
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                    </div>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <div class="form-check form-check-lg d-flex align-items-end">
                        <input class="form-check-input me-2" type="checkbox" name="remember" id="remember"
                            {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label text-gray-600" for="remember">
                            {{ __('Keep me logged in') }}
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-4">
                        {{ __('Login') }}
                    </button>
                </form>
                @if (Route::has('password.request'))
                <div class="text-center mt-5 text-lg">
                    <p>
                        <a class="" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    </p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection