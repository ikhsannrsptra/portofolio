@extends('admin.layouts.admin')

@section('title', 'Kelola Teks Role Typewriter - Admin CMS')
@section('page-title', 'Kelola Teks Tipe Pekerjaan ("Seorang ...")')

@section('content')

  <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px;">
    
    <!-- Add Role Form -->
    <div class="admin-card">
      <h3 style="margin-bottom: 20px;">Tambah Teks Role Baru</h3>
      
      @if($errors->any())
        <div style="background: rgba(239, 68, 68, 0.15); border: 1px solid #ef4444; color: #ef4444; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; font-size: 0.88rem;">
          {{ $errors->first() }}
        </div>
      @endif

      <form action="{{ route('admin.roles.store') }}" method="POST">
        @csrf
        <div class="form-group" style="margin-bottom: 20px;">
          <label for="name">Nama Role Profesi</label>
          <input type="text" name="name" id="name" class="form-control" placeholder="Contoh: Network Engineer" required>
          <p style="color: var(--text-muted); font-size: 0.8rem; margin-top: 6px;">
            Teks ini akan muncul secara otomatis dalam animasi ketik pada bagian hero beranda: "Halo, Saya ... Seorang [Role Profesi]".
          </p>
        </div>

        <button type="submit" class="btn btn-primary" style="width: 100%;">
          <i class="fas fa-plus"></i> Tambah Role Profesi
        </button>
      </form>
    </div>

    <!-- Roles List -->
    <div class="admin-card">
      <h3 style="margin-bottom: 20px;">Daftar Role Aktif Saat Ini</h3>
      
      <div class="table-responsive">
        <table class="admin-table">
          <thead>
            <tr>
              <th>#</th>
              <th>Nama Role Profesi</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse($roles as $index => $role)
              <tr>
                <td>{{ $index + 1 }}</td>
                <td>
                  <strong style="color: var(--accent-cyan);">{{ $role->name }}</strong>
                </td>
                <td>
                  <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus role ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline" style="padding: 6px 12px; font-size: 0.8rem; color: #ef4444; border-color: rgba(239, 68, 68, 0.4);">
                      <i class="fas fa-trash"></i> Hapus
                    </button>
                  </form>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="3" style="text-align: center; color: var(--text-muted);">Belum ada teks role khusus.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

  </div>

@endsection
