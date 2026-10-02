@extends('admin.layouts.admin')

@section('title', 'Kelola Proyek - Admin CMS')
@section('page-title', 'Daftar & Kelola Proyek Portofolio')

@section('content')

  <div class="admin-card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
      <h3>Semua Proyek</h3>
      <a href="{{ route('admin.projects.create') }}" class="btn btn-primary btn-sm">
        <i class="fas fa-plus"></i> Tambah Proyek Baru
      </a>
    </div>

    <div class="table-responsive">
      <table class="admin-table">
        <thead>
          <tr>
            <th>Foto Pratinjau</th>
            <th>Judul Proyek</th>
            <th>Kategori</th>
            <th>Teknologi / Tags</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($projects as $p)
            <tr>
              <td>
                <img src="{{ asset($p->image) }}" alt="" style="width: 70px; height: 48px; object-fit: cover; border-radius: 6px;">
              </td>
              <td>
                <strong>{{ $p->title }}</strong>
                <p style="color: var(--text-muted); font-size: 0.82rem; margin-top: 4px;">{{ Str::limit($p->description, 60) }}</p>
              </td>
              <td>
                <span class="badge" style="background: rgba(99, 102, 241, 0.15); color: var(--accent-primary); border: 1px solid var(--border-glow);">
                  {{ strtoupper($p->category) }}
                </span>
              </td>
              <td>
                <span style="font-size: 0.85rem; color: var(--text-muted);">{{ $p->tags }}</span>
              </td>
              <td>
                <div style="display: flex; gap: 8px;">
                  <a href="{{ route('admin.projects.edit', $p->id) }}" class="btn btn-sm btn-outline" style="padding: 6px 12px; font-size: 0.8rem;">
                    <i class="fas fa-edit"></i> Edit
                  </a>
                  <form action="{{ route('admin.projects.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus proyek ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline" style="padding: 6px 12px; font-size: 0.8rem; color: #ef4444; border-color: rgba(239, 68, 68, 0.4);">
                      <i class="fas fa-trash"></i> Hapus
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr><td colspan="5">Belum ada proyek yang ditambahkan.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

@endsection
