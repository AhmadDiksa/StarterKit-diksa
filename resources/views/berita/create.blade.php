@extends('adminlte::page')

@section('title', 'Tulis Berita Baru')

@section('content_header')
    <h1 class="m-0 text-dark">Tulis Berita Baru</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Formulir Berita</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">

                        {{-- Judul Berita --}}
                        <div class="form-group">
                            <label for="title">Judul Berita</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="Masukkan judul berita" value="{{ old('title') }}" required>
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- Kategori Berita --}}
                        <div class="form-group">
                            <label for="category_id">Kategori</label>
                            <select class="form-control @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- Isi Berita --}}
                        <div class="form-group">
                            <label for="content">Isi Berita</label>
                            {{-- Untuk pengalaman menulis yang lebih baik, Anda bisa mengintegrasikan editor WYSIWYG seperti TinyMCE atau Summernote di sini --}}
                            <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="10" placeholder="Tulis isi berita di sini..." required>{{ old('content') }}</textarea>
                            @error('content')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- Unggah Gambar --}}
                        <div class="form-group">
                            <label for="image">Gambar Unggulan (Opsional)</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input @error('image') is-invalid @enderror" id="image" name="image">
                                    <label class="custom-file-label" for="image">Pilih file...</label>
                                </div>
                            </div>
                            @error('image')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan sebagai Draft</button>
                        <a href="{{ route('berita.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
@stop

@push('js')
<script>
    // Script untuk menampilkan nama file pada input file custom bootstrap
    $('.custom-file-input').on('change', function(event) {
        var inputFile = event.target;
        var fileName = inputFile.files[0].name;
        $(inputFile).next('.custom-file-label').html(fileName);
    });
</script>
@endpush