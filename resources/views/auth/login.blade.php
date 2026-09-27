@extends('layouts.auth')

@section('title', 'Login')

@section('brand-title', 'Selamat Datang Kembali! 👋')
@section('brand-sub', 'Login ke dashboard FreshCart untuk mengelola minimarket Anda dengan mudah dan efisien.')

@section('heading', 'Login ke Akun')
@section('subheading', 'Masukkan email dan password Anda')

@section('content')

<form action="{{ route('login.post') }}" method="POST">
    @csrf

    {{-- Email --}}
    <div class="form-group">
        <label class="form-label" for="email">Email <span class="required">*</span></label>
        <div class="input-wrap">
            <i class="ti ti-mail input-icon"></i>
            <input type="email"
                   name="email"
                   id="email"
                   class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email') }}"
                   placeholder="nama@email.com"
                   autofocus
                   required />
        </div>
        @error('email')
            <span class="form-error">{{ $message }}</span>
        @enderror
    </div>

    {{-- Password --}}
    <div class="form-group">
        <label class="form-label" for="password">Password <span class="required">*</span></label>
        <div class="input-wrap">
            <i class="ti ti-lock input-icon"></i>
            <input type="password"
                   name="password"
                   id="password"
                   class="form-control @error('password') is-invalid @enderror"
                   placeholder="••••••••"
                   required />
            <i class="ti ti-eye toggle-password"
               data-target="password"
               title="Tampilkan/Sembunyikan password"></i>
        </div>
        @error('password')
            <span class="form-error">{{ $message }}</span>
        @enderror
    </div>

    {{-- Remember & Forgot --}}
    <div class="form-check">
        <label class="form-check-label" for="remember">
            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} />
            <span>Ingat saya</span>
        </label>
        <a href="#" class="link-primary">Lupa password?</a>
    </div>

    {{-- Submit --}}
    <button type="submit" class="btn btn-primary">
        <i class="ti ti-login"></i>
        Login
    </button>
</form>

<div class="auth-footer">
    Belum punya akun?
    <a href="{{ route('register') }}">Daftar sekarang</a>
</div>

@endsection
