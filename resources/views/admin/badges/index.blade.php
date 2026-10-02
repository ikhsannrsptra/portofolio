@extends('admin.layouts.admin')

@section('title', 'Kelola Logo Floating Avatar - Admin CMS')
@section('page-title', 'Kelola Logo Keahlian Mengapung di Sekitar Foto')

@section('content')

  <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px;">
    
    <!-- Add Badge Form -->
    <div class="admin-card">
      <h3 style="margin-bottom: 20px;">Tambah Logo Keahlian Baru</h3>
      
      @if($errors->any())
        <div style="background: rgba(239, 68, 68, 0.15); border: 1px solid #ef4444; color: #ef4444; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; font-size: 0.88rem;">
          {{ $errors->first() }}
        </div>
      @endif

      <form action="{{ route('admin.badges.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group" style="margin-bottom: 16px;">
          <label for="name">Nama Keahlian / Tool</label>
          <input type="text" name="name" id="name" class="form-control" placeholder="Contoh: MikroTik, Laravel, Cisco" required>
        </div>

        <div class="form-group" style="margin-bottom: 16px;">
          <label for="icon_class">Kelas Ikon FontAwesome (Opsional)</label>
          <input type="text" name="icon_class" id="icon_class" class="form-control" placeholder="Contoh: fab fa-laravel atau fas fa-network-wired">
          <p style="color: var(--text-muted); font-size: 0.8rem; margin-top: 4px;">Atau tinggalkan kosong jika mengunggah gambar logo di bawah.</p>
        </div>

        <div class="form-group" style="margin-bottom: 16px;">
          <label for="icon_color">Warna Ikon (Hex / CSS Color)</label>
          <input type="color" name="icon_color" id="icon_color" class="form-control" value="#6366f1" style="height: 42px; cursor: pointer;">
        </div>

        <div class="form-group" style="margin-bottom: 24px;">
          <label for="image">Atau Upload Gambar Logo Sendiri (Opsional)</label>
          <input type="file" name="image" id="image" class="form-control" accept="image/*">
        </div>

        <button type="submit" class="btn btn-primary" style="width: 100%;">
          <i class="fas fa-plus"></i> Tambah Logo Floating Baru
        </button>
      </form>
    </div>

    <!-- Badges List -->
    <div class="admin-card">
      <h3 style="margin-bottom: 20px;">Daftar Logo Keahlian Aktif</h3>
      
      <div class="table-responsive">
        <table class="admin-table">
          <thead>
            <tr>
              <th>Ikon / Logo</th>
              <th>Nama Keahlian</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse($badges as $badge)
              <tr>
                <td>
                  @if($badge->image)
                    <img src="{{ asset($badge->image) }}" alt="" style="width: 28px; height: 28px; object-fit: contain;">
                  @elseif($badge->icon_class)
                    <i class="{{ $badge->icon_class }}" style="font-size: 1.4rem; color: {{ $badge->icon_color }};"></i>
                  @else
                    <i class="fas fa-certificate" style="font-size: 1.4rem; color: var(--accent-primary);"></i>
                  @endif
                </td>
                <td>
                  <strong>{{ $badge->name }}</strong>
                </td>
                <td>
                  <form action="{{ route('admin.badges.destroy', $badge->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus logo keahlian ini?');">
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
                <td colspan="3" style="text-align: center; color: var(--text-muted);">Belum ada logo keahlian floating.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

  </div>

@endsection
