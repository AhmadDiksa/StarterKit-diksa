@extends('admin.layouts.app')

@section('content')
<!-- Info boxes -->
<div class="row">
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Total Users</span>
                <span class="info-box-number">
                    {{ \App\Models\User::count() }}
                </span>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-newspaper"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Total Berita</span>
                <span class="info-box-number">
                    {{ \App\Models\Berita::count() }}
                </span>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-tags"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Total Kategori</span>
                <span class="info-box-number">
                    {{ \App\Models\Kategori::count() }}
                </span>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-eye"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Total Views</span>
                <span class="info-box-number">
                    {{ \App\Models\Berita::sum('views') }}
                </span>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <!-- Berita Terbaru -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-newspaper mr-1"></i>
                    Berita Terbaru
                </h3>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Kategori</th>
                                <th>Tanggal</th>
                                <th>Views</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(\App\Models\Berita::latest()->take(5)->get() as $berita)
                            <tr>
                                <td>{{ $berita->judul }}</td>
                                <td>{{ $berita->kategori->nama }}</td>
                                <td>{{ $berita->created_at->format('d M Y') }}</td>
                                <td>{{ $berita->views }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer clearfix">
                <a href="{{ route('berita.index') }}" class="btn btn-sm btn-info float-right">Lihat Semua Berita</a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <!-- User Terbaru -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-users mr-1"></i>
                    User Terbaru
                </h3>
            </div>
            <div class="card-body p-0">
                <ul class="users-list clearfix">
                    @foreach(\App\Models\User::latest()->take(5)->get() as $user)
                    <li>
                        <img src="{{ asset('vendor/adminlte/dist/img/user2-160x160.jpg') }}" alt="User Image">
                        <a class="users-list-name" href="#">{{ $user->name }}</a>
                        <span class="users-list-date">{{ $user->created_at->diffForHumans() }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="card-footer clearfix">
                <a href="{{ route('users.index') }}" class="btn btn-sm btn-info float-right">Lihat Semua User</a>
            </div>
        </div>
    </div>
</div>

<!-- Grafik Statistik -->
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-chart-bar mr-1"></i>
                    Statistik Berita per Kategori
                </h3>
            </div>
            <div class="card-body">
                <canvas id="kategoriChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-chart-line mr-1"></i>
                    Statistik Views Berita
                </h3>
            </div>
            <div class="card-body">
                <canvas id="viewsChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Data untuk grafik kategori
    var kategoriCtx = document.getElementById('kategoriChart').getContext('2d');
    var kategoriChart = new Chart(kategoriCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode(\App\Models\Kategori::pluck('nama')) !!},
            datasets: [{
                label: 'Jumlah Berita',
                data: {!! json_encode(\App\Models\Kategori::withCount('berita')->pluck('berita_count')) !!},
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Data untuk grafik views
    var viewsCtx = document.getElementById('viewsChart').getContext('2d');
    var viewsChart = new Chart(viewsCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode(\App\Models\Berita::latest()->take(7)->pluck('judul')) !!},
            datasets: [{
                label: 'Views',
                data: {!! json_encode(\App\Models\Berita::latest()->take(7)->pluck('views')) !!},
                fill: false,
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});
</script>
@endpush 