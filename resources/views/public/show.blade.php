@extends('public.layouts.app')

@section('title', $berita->title)

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <article>
                <!-- Judul Artikel -->
                <header class="mb-4">
                    <h1 class="fw-bolder mb-1">{{ $berita->title }}</h1>
                    <div class="text-muted fst-italic mb-2">
                        Dipublikasikan pada {{ $berita->published_at->format('d F Y') }} oleh {{ $berita->author->name }}
                    </div>
                    <a class="badge bg-secondary text-decoration-none link-light" href="#!">
                        {{ $berita->category->name }}
                    </a>
                </header>

                <!-- Gambar Utama -->
                <figure class="mb-4">
                    @if ($berita->image)
                        <img class="img-fluid rounded" src="{{ asset('storage/' . $berita->image) }}" alt="{{ $berita->title }}" />
                    @endif
                </figure>

                <!-- Konten Berita -->
                <section class="mb-5">
                    {{-- Gunakan {!! !!} jika konten Anda mengandung HTML (misal dari editor WYSIWYG).
                         Pastikan konten sudah di-sanitize di controller untuk keamanan! --}}
                    <div class="fs-5 mb-4">
                        {!! nl2br(e($berita->content)) !!}
                    </div>
                </section>
            </article>

            <a href="{{ route('home') }}" class="btn btn-outline-primary">← Kembali ke Beranda</a>
        </div>
    </div>
@endsection