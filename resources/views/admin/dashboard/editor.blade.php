@extends('adminlte::page')

@section('title', 'Dashboard Editor')

@section('content_header')
    <h1>Dashboard Editor</h1>
@stop

@section('content')
    <p>Selamat datang, Editor! Anda memiliki <strong>{{ $pendingBeritaCount }}</strong> berita yang menunggu approval.</p>
    <a href="{{ route('berita.index') }}" class="btn btn-primary">Lihat Daftar Berita</a>
@stop