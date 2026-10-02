@extends('admin.layouts.admin')

@section('title', 'Kelola Pendidikan - Admin CMS')
@section('page-title', 'Kelola Riwayat Pendidikan (SMP, SMK, Kuliah)')

@section('content')

  <div class="admin-card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
      <h3>Riwayat Pendidikan</h3>
      <a href="{{ route('admin.education.create') }}" class="btn btn-primary btn-sm">
        <i class="fas fa-plus"></i> Tambah Riwayat Pendidikan
      </a>
    </div>

    <div class="table-responsive">
      <table class="admin-table">
        <thead>
          <tr>
            <th>Logo Sekolah</th>
            <th>Tingkat</th>
            <th>Periode</th>
            <th>Judul / Jurusan</th>
            <th>Instansi / Sekolah</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($educations as $e)
            <tr>
              <td>
                @if($e->logo)
                  <img src="{{ asset($e->logo) }}" alt="" style="width: 44px; height: 44px; object-fit: contain; background: rgba(255,255,255,0.05); padding: 4px; border-radius: 8px; border: 1px solid var(--border-glass);">
                @else
                  <div style="width: 44px; height: 44px; background: rgba(99,102,241,0.1); border-radius: 8px; display: flex; align-items: center; justify-content: center; color: var(--accent-primary);">
                    <i class="fas fa-graduation-cap"></i>
                  </div>
                @endif
              </td>
              <td>
                <span class="badge" style="background: rgba(99, 102, 241, 0.2); color: var(--accent-primary);">
                  {{ $e->level }}
                </span>
              </td>
              <td><strong>{{ $e->period }}</strong></td>
              <td>{{ $e->title }}</td>
              <td><span style="color: var(--text-muted);">{{ $e->institution }}</span></td>
              <td>
                <div style="display: flex; gap: 8px;">
                  <a href="{{ route('admin.education.edit', $e->id) }}" class="btn btn-sm btn-outline" style="padding: 6px 12px; font-size: 0.8rem;">
                    <i class="fas fa-edit"></i> Edit
                  </a>
                  <form action="{{ route('admin.education.destroy', $e->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus riwayat pendidikan ini?');">
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
            <tr><td colspan="6">Belum ada riwayat pendidikan.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

@endsection
