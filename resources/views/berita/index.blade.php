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