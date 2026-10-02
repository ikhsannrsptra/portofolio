@extends('admin.layouts.admin')

@section('title', 'Kelola Sertifikat - Admin CMS')
@section('page-title', 'Daftar & Kelola Sertifikat / Penghargaan')

@section('content')

  <div class="admin-card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
      <h3>Semua Sertifikat</h3>
      <a href="{{ route('admin.certificates.create') }}" class="btn btn-primary btn-sm">
        <i class="fas fa-plus"></i> Tambah Sertifikat Baru
      </a>
    </div>

    <div class="table-responsive">
      <table class="admin-table">
        <thead>
          <tr>
            <th>Foto Sertifikat</th>
            <th>Judul Sertifikat / Penghargaan</th>
            <th>Penerbit</th>
            <th>Tahun</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($certificates as $c)
            <tr>
              <td>
                <img src="{{ asset($c->image) }}" alt="" style="width: 70px; height: 48px; object-fit: cover; border-radius: 6px;">
              </td>
              <td>
                <strong>{{ $c->title }}</strong>
              </td>
              <td>
                <span style="color: var(--text-muted);">{{ $c->issuer }}</span>
              </td>
              <td>
                <span class="badge" style="background: rgba(6, 182, 212, 0.15); color: var(--accent-cyan);">{{ $c->issued_year ?? '-' }}</span>
              </td>
              <td>
                <div style="display: flex; gap: 8px;">
                  <a href="{{ route('admin.certificates.edit', $c->id) }}" class="btn btn-sm btn-outline" style="padding: 6px 12px; font-size: 0.8rem;">
                    <i class="fas fa-edit"></i> Edit
                  </a>
                  <form action="{{ route('admin.certificates.destroy', $c->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus sertifikat ini?');">
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
            <tr><td colspan="5">Belum ada sertifikat yang ditambahkan.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

@endsection
