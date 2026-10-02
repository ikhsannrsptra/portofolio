@extends('admin.layouts.admin')

@section('title', 'Kelola Pengalaman Kerja - Admin CMS')
@section('page-title', 'Kelola Pengalaman Kerja & Karir')

@section('content')

  <div class="admin-card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
      <h3>Riwayat Pengalaman Kerja & Karir</h3>
      <a href="{{ route('admin.experience.create') }}" class="btn btn-primary btn-sm">
        <i class="fas fa-plus"></i> Tambah Pengalaman Kerja
      </a>
    </div>

    <div class="table-responsive">
      <table class="admin-table">
        <thead>
          <tr>
            <th>Logo</th>
            <th>Periode</th>
            <th>Posisi / Role</th>
            <th>Perusahaan / Tempat Kerja</th>
            <th>Foto Dokumentasi</th>
            <th>Warna Badge</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($experiences as $exp)
            <tr>
              <td>
                @if($exp->logo)
                  <img src="{{ asset($exp->logo) }}" alt="" style="width: 44px; height: 44px; object-fit: contain; background: rgba(255,255,255,0.05); padding: 4px; border-radius: 8px; border: 1px solid var(--border-glass);">
                @else
                  <div style="width: 44px; height: 44px; background: rgba(99,102,241,0.1); border-radius: 8px; display: flex; align-items: center; justify-content: center; color: var(--accent-primary);">
                    <i class="fas fa-briefcase"></i>
                  </div>
                @endif
              </td>
              <td>
                <span class="badge" style="border: 1px solid {{ $exp->color }}; color: {{ $exp->color }}; background: rgba(255, 255, 255, 0.05);">
                  {{ $exp->period }}
                </span>
              </td>
              <td><strong>{{ $exp->role }}</strong></td>
              <td><span style="color: var(--text-muted);">{{ $exp->company }}</span></td>
              <td>
                @if($exp->image)
                  <img src="{{ asset($exp->image) }}" alt="" style="width: 50px; height: 35px; object-fit: cover; border-radius: 6px; border: 1px solid var(--accent-cyan);">
                @else
                  <span style="color: var(--text-muted); font-size: 0.8rem; italic;">(Tidak Ada)</span>
                @endif
              </td>
              <td>
                <div style="display: flex; align-items: center; gap: 8px;">
                  <span style="display: inline-block; width: 16px; height: 16px; border-radius: 50%; background: {{ $exp->color }}; border: 1px solid #fff;"></span>
                  <code style="font-size: 0.8rem; color: var(--text-muted);">{{ $exp->color }}</code>
                </div>
              </td>
              <td>
                <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                  <a href="{{ route('admin.experience.attachments', $exp->id) }}" class="btn btn-sm btn-outline" style="padding: 6px 12px; font-size: 0.8rem; border-color: var(--accent-cyan); color: var(--accent-cyan);">
                    <i class="fas fa-images"></i> Lampiran ({{ $exp->attachments->count() }})
                  </a>
                  <a href="{{ route('admin.experience.edit', $exp->id) }}" class="btn btn-sm btn-outline" style="padding: 6px 12px; font-size: 0.8rem;">
                    <i class="fas fa-edit"></i> Edit
                  </a>
                  <form action="{{ route('admin.experience.destroy', $exp->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pengalaman kerja ini?');">
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
            <tr><td colspan="7">Belum ada data pengalaman kerja.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

@endsection
