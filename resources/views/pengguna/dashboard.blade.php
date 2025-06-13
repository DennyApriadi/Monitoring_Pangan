@extends('layouts.app')

@section('content')
<div class="container mt-5 text-center">
    <h2>Dashboard Pengguna</h2>
    <p>Selamat datang, <strong>{{ Auth::user()->name }}</strong>! Anda login sebagai <span class="badge bg-info">Pengguna</span>.</p>
    <hr>
    {{-- Tambahkan link/menu pengguna di sini --}}
    <a href="{{ route('home') }}" class="btn btn-secondary">Kembali ke Beranda</a>
</div>
@endsection
