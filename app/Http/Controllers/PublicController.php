<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Category;

class PublicController extends Controller
{
    // Menampilkan halaman utama dengan semua berita yang sudah publish
    public function index()
    {
        $beritas = Berita::where('status', 'published')
                        ->with('author', 'category')
                        ->latest('published_at')
                        ->paginate(10);

        return view('public.home', compact('beritas'));
    }

    // Menampilkan detail satu berita
    public function show($slug)
    {
        $berita = Berita::where('slug', $slug)
                       ->where('status', 'published')
                       ->firstOrFail();

        return view('public.show', compact('berita'));
    }

    // Menampilkan berita berdasarkan kategori
    public function category(Category $category)
    {
        $beritas = $category->beritas()
                            ->where('status', 'published')
                            ->latest('published_at')
                            ->paginate(10);

        return view('public.category', compact('beritas', 'category'));
    }
}