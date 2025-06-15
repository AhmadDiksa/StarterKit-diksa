@forelse ($beritas as $item)
    <div class="berita-item mb-4 p-3 border rounded">
        <h3>{{ $item->title }}</h3>
        <p>{{ Str::limit(strip_tags($item->content), 150, '...') }}</p>
        <p>Status: <strong>{{ ucfirst($item->status) }}</strong></p>
        @if($item->status == 'draft')
            @role('Editor|Admin')
                <form action="{{ route('berita.approve', $item) }}" method="POST" class="d-inline">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-sm btn-success">Approve</button>
                </form>
                <form action="{{ route('berita.reject', $item) }}" method="POST" class="d-inline">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-sm btn-danger">Reject</button>
                </form>
            @endrole
        @endif
    </div>
@empty
    <p>Tidak ada berita untuk ditampilkan.</p>
@endforelse
=======
@forelse ($beritas as $item)
    <div class="berita-item mb-4 p-3 border rounded">
        <h3>{{ $item->title }}</h3>
        <p>{{ Str::limit(strip_tags($item->content), 150, '...') }}</p>
        <p>Status: <strong>{{ ucfirst($item->status) }}</strong></p>
        @if($item->status == 'draft')
            @role('Editor|Admin')
                <form action="{{ route('berita.approve', $item) }}" method="POST" class="d-inline">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-sm btn-success">Approve</button>
                </form>
                <form action="{{ route('berita.reject', $item) }}" method="POST" class="d-inline">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-sm btn-danger">Reject</button>
                </form>
            @endrole
        @endif
    </div>
@empty
    <p>Tidak ada berita untuk ditampilkan.</p>
@endforelse
