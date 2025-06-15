<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
         $user = auth()->user();
        if ($user->hasRole('Wartawan')) {
            // Wartawan hanya lihat berita miliknya
            $beritas = Berita::where('user_id', $user->id)->latest()->paginate(10);
        } else {
            // Admin dan Editor lihat semua berita
            $beritas = Berita::with('author', 'category')->latest()->paginate(10);
        }
        return view('berita.index', compact('beritas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = Category::all();
        return view('berita.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
        'title' => 'required|string|max:255',
        'category_id' => 'required|exists:categories,id',
        'content' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('berita_images', 'public');
        }

        Berita::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . time(),
            'category_id' => $request->category_id,
            'content' => $request->content,
            'image' => $path,
            'user_id' => Auth::id(), // Pengirim sesuai user login
            'status' => 'draft',     // Status default adalah draft
        ]);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil dibuat dan menunggu approval.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Berita $berita)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Berita $berita)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Berita $berita)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Berita $berita)
    {
        //
    }

    public function approve(Berita $berita)
    {
        $berita->update(['status' => 'published', 'published_at' => now()]);
        return redirect()->route('berita.index')->with('success', 'Berita berhasil di-publish.');
    }

    public function reject(Berita $berita)
    {
        $berita->update(['status' => 'rejected']);
        return redirect()->route('berita.index')->with('success', 'Berita berhasil ditolak.');
    }
}
