@extends('public.layouts.app')

@section('title', 'Beranda - Berita Terbaru')

@section('content')
    {{-- Hero Section --}}
    <div class="hero-section position-relative">
        <div class="hero-overlay"></div>
        <div class="container position-relative">
            <div class="row hero-content align-items-center">
                <div class="col-lg-6 text-white">
                    <h1 class="display-4 fw-bold mb-3">Portal Berita Terpercaya</h1>
                    <p class="lead mb-4 opacity-90">Temukan berita terkini dan terpercaya dari berbagai kategori. Update informasi terbaru setiap hari.</p>
                    <div class="d-flex gap-3">
                        <a href="#latest-news" class="btn btn-primary btn-lg px-4">
                            <i class="fas fa-newspaper me-2"></i>Berita Terbaru
                        </a>
                        <a href="#categories" class="btn btn-light btn-lg px-4">
                            <i class="fas fa-th-large me-2"></i>Kategori
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    <div class="hero-image-wrapper">
                        <img src="{{ asset('images/hero-news.png') }}" 
                             alt="Hero Image" 
                             class="img-fluid rounded-4 shadow-lg"
                             onerror="this.onerror=null; this.src='https://via.placeholder.com/600x400?text=News+Portal'">
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Latest News Section --}}
    <div class="container" id="latest-news">
        <div class="section-header text-center mb-5">
            <h2 class="fw-bold">Berita Terbaru</h2>
            <div class="divider mx-auto my-3"></div>
        </div>

        <div class="row g-4">
            @forelse ($beritas as $berita)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 news-card hover-shadow transition">
                        <a href="{{ route('berita.show.public', $berita->slug) }}" class="text-decoration-none text-dark">
                            <div class="position-relative">
                                @if ($berita->image)
                                    <img src="{{ asset('storage/' . $berita->image) }}" class="card-img-top" alt="{{ $berita->title }}" style="height: 220px; object-fit: cover;">
                                @else
                                    <img src="https://via.placeholder.com/400x250.png?text=Berita" class="card-img-top" alt="{{ $berita->title }}" style="height: 220px; object-fit: cover;">
                                @endif
                                <div class="position-absolute top-0 end-0 m-3">
                                    <span class="badge bg-primary rounded-pill px-3 py-2">{{ $berita->category->name }}</span>
                                </div>
                            </div>
                            <div class="card-body p-4">
                                <h5 class="card-title fw-bold mb-3">{{ Str::limit($berita->title, 50) }}</h5>
                                <p class="card-text text-muted mb-3">{{ Str::limit(strip_tags($berita->content), 100) }}</p>
                                <div class="d-flex align-items-center text-muted">
                                    <div class="d-flex align-items-center me-3">
                                        <i class="fas fa-user-circle me-2"></i>
                                        <small>{{ $berita->author->name }}</small>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-clock me-2"></i>
                                        <small>{{ optional($berita->published_at)->diffForHumans() }}</small>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-warning text-center p-4 rounded-3">
                        <i class="fas fa-newspaper fa-2x mb-3"></i>
                        <p class="mb-0">Saat ini belum ada berita yang dipublikasikan. Silakan kembali lagi nanti.</p>
                    </div>
                </div>
            @endforelse
        </div>

        {{-- Pagination with improved styling --}}
        <div class="d-flex justify-content-center mt-5">
            {{ $beritas->links() }}
        </div>
    </div>

    <style>
        .text-gradient {
            background: linear-gradient(45deg, #2196F3, #3F51B5);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .divider {
            width: 60px;
            height: 3px;
            background: linear-gradient(45deg, #2196F3, #3F51B5);
        }
        .news-card {
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        .news-card:hover {
            transform: translateY(-5px);
        }
        .hover-shadow:hover {
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .transition {
            transition: all 0.3s ease;
        }
        .hero-section {
            background: linear-gradient(135deg, #1a237e 0%, #0d47a1 100%);
            position: relative;
            overflow: hidden;
            margin-top: -1.5rem;
            margin-bottom: 3rem;
            aspect-ratio: 21/9;
            width: 100%;
        }
        .hero-content {
            height: 100%;
            padding: 4rem 0;
        }
        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.05' fill-rule='evenodd'/%3E%3C/svg%3E");
        }
        .hero-image-wrapper {
            position: relative;
            z-index: 1;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .hero-image-wrapper img {
            width: 100%;
            height: auto;
            max-height: 400px;
            object-fit: contain;
            transform: perspective(1000px) rotateY(-5deg);
            transition: transform 0.5s ease;
            filter: drop-shadow(0 10px 20px rgba(0,0,0,0.2));
        }
        .hero-image-wrapper:hover img {
            transform: perspective(1000px) rotateY(0deg);
        }
        @media (max-width: 991.98px) {
            .hero-section {
                aspect-ratio: 4/3;
            }
            .hero-content {
                text-align: center;
                padding: 3rem 0;
            }
            .hero-section .btn {
                margin: 0.5rem;
            }
            .hero-section h1 {
                font-size: 2.5rem;
            }
        }
    </style>
@endsection