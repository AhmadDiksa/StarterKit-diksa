
@extends('adminlte::page')

@section('title', 'Dashboard Wartawan')

@section('content_header')
    <h1>Dashboard Wartawan</h1>
@stop

@section('content')
    <p>Selamat datang, Wartawan! Anda sudah menulis <strong>{{ $myBeritaCount }}</strong> berita.</p>
    <a href="{{ route('berita.create') }}" class="btn btn-success">Tulis Berita Baru</a>
@stop