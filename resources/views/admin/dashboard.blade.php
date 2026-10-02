@extends('admin.layouts.admin')

@section('title', 'Dashboard - Admin CMS')
@section('page-title', 'Ikhtisar Dashboard')

@section('content')

  <!-- Stats Grid -->
  <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px; margin-bottom: 30px;">
    <div class="admin-card" style="margin-bottom: 0;">
      <p style="color: var(--text-muted); font-size: 0.85rem; text-transform: uppercase;">Total Proyek</p>
      <h2 style="font-size: 2.2rem; color: var(--accent-primary); margin-top: 6px;">{{ $stats['projects'] }}</h2>
    </div>

    <div class="admin-card" style="margin-bottom: 0;">
      <p style="color: var(--text-muted); font-size: 0.85rem; text-transform: uppercase;">Total Sertifikat</p>
      <h2 style="font-size: 2.2rem; color: var(--accent-cyan); margin-top: 6px;">{{ $stats['certificates'] }}</h2>
    </div>

    <div class="admin-card" style="margin-bottom: 0;">
      <p style="color: var(--text-muted); font-size: 0.85rem; text-transform: uppercase;">Riwayat Pendidikan</p>
      <h2 style="font-size: 2.2rem; color: var(--accent-emerald); margin-top: 6px;">{{ $stats['education'] }}</h2>
    </div>

    <div class="admin-card" style="margin-bottom: 0;">
      <p style="color: var(--text-muted); font-size: 0.85rem; text-transform: uppercase;">Pengalaman Kerja</p>
      <h2 style="font-size: 2.2rem; color: var(--accent-purple); margin-top: 6px;">{{ $stats['experience'] }}</h2>
    </div>

    <div class="admin-card" style="margin-bottom: 0;">
      <p style="color: var(--text-muted); font-size: 0.85rem; text-transform: uppercase;">Matriks Keahlian</p>
      <h2 style="font-size: 2.2rem; color: var(--accent-pink, #ec4899); margin-top: 6px;">{{ $stats['skills'] }}</h2>
    </div>

    <div class="admin-card" style="margin-bottom: 0; position: relative;">
      <p style="color: var(--text-muted); font-size: 0.85rem; text-transform: uppercase;">Pesan Masuk</p>
      <h2 style="font-size: 2.2rem; color: #f59e0b; margin-top: 6px;">{{ $stats['messages'] }}</h2>
      @if($stats['unread_messages'] > 0)
        <span style="position:absolute;top:16px;right:16px;background:#ef4444;color:#fff;border-radius:12px;padding:2px 8px;font-size:0.75rem;">{{ $stats['unread_messages'] }} baru</span>
      @endif
    </div>
  </div>

  <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px;">
    <!-- Latest Projects -->
    <div class="admin-card">
      <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h3>Proyek Terbaru</h3>
        <a href="{{ route('admin.projects.create') }}" class="btn btn-sm btn-primary">+ Tambah Proyek</a>
      </div>
      <div class="table-responsive">
        <table class="admin-table">
          <thead>
            <tr>
              <th>Gambar</th>
              <th>Judul</th>
              <th>Kategori</th>
            </tr>
          </thead>
          <tbody>
            @forelse($latestProjects as $project)
              <tr>
                <td>
                  <img src="{{ asset($project->image) }}" alt="" style="width: 44px; height: 32px; object-fit: cover; border-radius: 4px;">
                </td>
                <td><strong>{{ $project->title }}</strong></td>
                <td><span class="badge" style="background: rgba(99,102,241,0.2); color: var(--accent-primary);">{{ strtoupper($project->category) }}</span></td>
              </tr>
            @empty
              <tr><td colspan="3">Belum ada proyek.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

    <!-- Latest Certificates -->
    <div class="admin-card">
      <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h3>Sertifikat Terbaru</h3>
        <a href="{{ route('admin.certificates.create') }}" class="btn btn-sm btn-primary">+ Tambah Sertifikat</a>
      </div>
      <div class="table-responsive">
        <table class="admin-table">
          <thead>
            <tr>
              <th>Gambar</th>
              <th>Nama Sertifikat</th>
              <th>Penerbit</th>
            </tr>
          </thead>
          <tbody>
            @forelse($latestCerts as $cert)
              <tr>
                <td>
                  <img src="{{ asset($cert->image) }}" alt="" style="width: 44px; height: 32px; object-fit: cover; border-radius: 4px;">
                </td>
                <td><strong>{{ $cert->title }}</strong></td>
                <td><span style="color: var(--text-muted); font-size: 0.85rem;">{{ $cert->issuer }}</span></td>
              </tr>
            @empty
              <tr><td colspan="3">Belum ada sertifikat.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>

@endsection
