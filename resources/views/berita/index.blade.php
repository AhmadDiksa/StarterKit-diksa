@extends('layouts.berita')

@section('content')
@forelse ($beritas as $item)
    <div class="news-card">
        <div class="news-header">
            <h3 class="news-title">{{ $item->title }}</h3>
            <span class="status-badge status-{{ $item->status }}">
                {{ ucfirst($item->status) }}
            </span>
        </div>
        
        <p class="news-excerpt">
            {{ Str::limit(strip_tags($item->content), 150, '...') }}
        </p>
        
        @if($item->status == 'draft')
            @role('Editor|Admin')
                <div class="action-buttons">
                    <form action="{{ route('berita.approve', $item) }}" method="POST" class="inline-form">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-approve">
                            <i class="fas fa-check"></i>
                            Approve
                        </button>
                    </form>
                    
                    <form action="{{ route('berita.reject', $item) }}" method="POST" class="inline-form">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-reject">
                            <i class="fas fa-times"></i>
                            Reject
                        </button>
                    </form>
                </div>
            @endrole
        @endif
    </div>
@empty
    <div class="empty-state">
        <div class="empty-icon">
            <i class="fas fa-newspaper"></i>
        </div>
        <h4>Belum ada berita</h4>
        <p>Tidak ada berita untuk ditampilkan saat ini.</p>
    </div>
@endforelse
@endsection

<style>
.news-card {
    background: #ffffff;
    border-radius: 12px;
    padding: 24px;
    margin-bottom: 20px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    border: 1px solid #e5e7eb;
    transition: all 0.3s ease;
}

.news-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
}

.news-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 16px;
    gap: 16px;
}

.news-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: #1f2937;
    margin: 0;
    line-height: 1.4;
    flex: 1;
}

.status-badge {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    white-space: nowrap;
}

.status-draft {
    background-color: #fef3c7;
    color: #92400e;
    border: 1px solid #fbbf24;
}

.status-published {
    background-color: #d1fae5;
    color: #065f46;
    border: 1px solid #10b981;
}

.status-rejected {
    background-color: #fee2e2;
    color: #991b1b;
    border: 1px solid #ef4444;
}

.news-excerpt {
    color: #6b7280;
    line-height: 1.6;
    margin-bottom: 20px;
    font-size: 0.95rem;
}

.action-buttons {
    display: flex;
    gap: 12px;
    padding-top: 16px;
    border-top: 1px solid #f3f4f6;
}

.inline-form {
    display: inline-block;
}

.btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 16px;
    border: none;
    border-radius: 8px;
    font-size: 0.875rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s ease;
    text-decoration: none;
}

.btn:hover {
    transform: translateY(-1px);
}

.btn-approve {
    background-color: #10b981;
    color: white;
}

.btn-approve:hover {
    background-color: #059669;
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
}

.btn-reject {
    background-color: #ef4444;
    color: white;
}

.btn-reject:hover {
    background-color: #dc2626;
    box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
}

.empty-state {
    text-align: center;
    padding: 60px 20px;
    background: #ffffff;
    border-radius: 12px;
    border: 2px dashed #d1d5db;
}

.empty-icon {
    font-size: 3rem;
    color: #d1d5db;
    margin-bottom: 16px;
}

.empty-state h4 {
    color: #374151;
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 8px;
}

.empty-state p {
    color: #6b7280;
    font-size: 0.95rem;
}

/* Responsive Design */
@media (max-width: 768px) {
    .news-card {
        padding: 20px;
        margin-bottom: 16px;
    }
    
    .news-header {
        flex-direction: column;
        gap: 12px;
    }
    
    .news-title {
        font-size: 1.1rem;
    }
    
    .action-buttons {
        flex-direction: column;
        gap: 8px;
    }
    
    .btn {
        justify-content: center;
        width: 100%;
    }
}
</style>
