@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Selamat datang, {{ Auth::user()->name }} | Pengguna</h1>
    <p>Ini adalah dashboard pengguna.</p>
</div>
@endsection
