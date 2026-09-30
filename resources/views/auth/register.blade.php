@extends('layouts.auth')

@section('title', 'Register')

@section('brand-title', 'Bergabung dengan FreshCart 🚀')
@section('brand-sub', 'Daftarkan akun Anda dan mulai kelola minimarket dengan sistem modern yang terintegrasi.')

@section('heading', 'Buat Akun Baru')
@section('subheading', 'Isi data diri Anda untuk mendaftar')

@section('content')

<form action="{{ route('register.post') }}" method="POST">
    @csrf

    {{-- Nama --}}
    <div class="form-group">
        <label class="form-label" for="name">Nama Lengkap <span class="required">*</span></label>
        <div class="input-wrap">
            <i class="ti ti-user input-icon"></i>
            <input type="text"
                   name="name"
                   id="name"
                   class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name') }}"
                   placeholder="Nama lengkap Anda"
                   autofocus
                   required />
        </div>
        @error('name')
            <span class="form-error">{{ $message }}</span>
        @enderror
    </div>

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
                   required />
        </div>
        @error('email')
            <span class="form-error">{{ $message }}</span>
        @enderror
    </div>



    <div class="form-group">
        <label class="form-label" for="password">Password <span class="required">*</span></label>
        <div class="input-wrap">
            <i class="ti ti-lock input-icon"></i>
            <input type="password"
                   name="password"
                   id="password"
                   class="form-control @error('password') is-invalid @enderror"
                   placeholder="Minimal 8 karakter"
                   required />
            <i class="ti ti-eye toggle-password"
               data-target="password"
               title="Tampilkan/Sembunyikan password"></i>
        </div>
        @error('password')
            <span class="form-error">{{ $message }}</span>
        @enderror
    </div>


    <div class="form-group">
        <label class="form-label" for="password_confirmation">Konfirmasi Password <span class="required">*</span></label>
        <div class="input-wrap">
            <i class="ti ti-lock-check input-icon"></i>
            <input type="password"
                   name="password_confirmation"
                   id="password_confirmation"
                   class="form-control"
                   placeholder="Ulangi password"
                   required />
            <i class="ti ti-eye toggle-password"
               data-target="password_confirmation"
               title="Tampilkan/Sembunyikan password"></i>
        </div>
    </div>

   
    <button type="submit" class="btn btn-primary" style="margin-top: 8px;">
        <i class="ti ti-user-plus"></i>
        Daftar Sekarang
    </button>
</form>

<div class="auth-footer">
    Sudah punya akun?
    <a href="{{ route('login') }}">Login di sini</a>
</div>

@endsection
