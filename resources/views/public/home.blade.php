
@extends('public.layouts.app')

@section('title', 'Beranda - Berita Terbaru')

@section('content')
    <div class="text-center mb-5">
        <h1 class="display-5 fw-bold">Selamat Datang di Portal Berita</h1>
        <p class="lead">Temukan berita terkini dan terpercaya dari berbagai kategori.</p>
    </div>

    <div class="row g-4">
        @forelse ($beritas as $berita)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm border-0 news-card">
                    <a href="{{ route('berita.show.public', $berita->slug) }}" class="text-decoration-none text-dark">
                        @if ($berita->image)
                            <img src="{{ asset('storage/' . $berita->image) }}" class="card-img-top" alt="{{ $berita->title }}" style="height: 200px; object-fit: cover;">
                        @else
                            {{-- Gambar placeholder jika tidak ada gambar --}}
                            <img src="https://via.placeholder.com/400x250.png?text=Berita" class="card-img-top" alt="{{ $berita->title }}" style="height: 200px; object-fit: cover;">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ Str::limit($berita->title, 50) }}</h5>
                            <p class="card-text text-muted">{{ Str::limit(strip_tags($berita->content), 100) }}</p>
                        </div>
                        <div class="card-footer bg-white border-top-0">
                            <small class="text-muted">
                                Kategori: <span class="badge bg-primary">{{ $berita->category->name }}</span> |
                                Oleh: {{ $berita->author->name }} |
                                {{ $berita->published_at->diffForHumans() }}
                            </small>
                        </div>
                    </a>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-warning text-center">
                    <p class="mb-0">Saat ini belum ada berita yang dipublikasikan. Silakan kembali lagi nanti.</p>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-5">
        {{ $beritas->links() }}
    </div>
@endsection