@extends('admin.layouts.admin')

@section('title', 'Kelola Lampiran & Sertifikat - ' . $experience->company)
@section('page-title', 'Lampiran & Sertifikat: ' . $experience->company)

@section('content')

  <div style="margin-bottom: 20px;">
    <a href="{{ route('admin.experience.index') }}" class="btn btn-outline btn-sm">
      <i class="fas fa-arrow-left"></i> Kembali ke Daftar Pengalaman
    </a>
  </div>

  <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px;">
    <!-- Form Upload Lampiran Baru -->
    <div class="admin-card">
      <h3 style="font-size: 1.15rem; color: var(--accent-primary); margin-bottom: 20px;">
        <i class="fas fa-plus-circle"></i> Tambah Lampiran / Sertifikat Baru
      </h3>

      @if($errors->any())
        <div style="background: rgba(239, 68, 68, 0.15); border: 1px solid #ef4444; color: #ef4444; padding: 14px 20px; border-radius: var(--radius-md); margin-bottom: 20px;">
          <ul style="margin-left: 20px;">
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('admin.experience.attachments.store', $experience->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group" style="margin-bottom: 18px;">
          <label for="title">Judul Sertifikat / Peran Panitia / Dokumentasi</label>
          <input type="text" name="title" id="title" class="form-control" required placeholder="Contoh: Sertifikat Penghargaan – Staff Teraktif RISTEK">
        </div>

        <div class="form-group" style="margin-bottom: 18px;">
          <label for="subtitle">Sub-Judul / Waktu (Opsional)</label>
          <input type="text" name="subtitle" id="subtitle" class="form-control" placeholder="Contoh: Nov 2025 · 1 mo atau Sertifikat Panitia">
        </div>

        <div class="form-group" style="margin-bottom: 18px;">
          <label for="image">Upload Foto Sertifikat / Kegiatan (Wajib)</label>
          <input type="file" name="image" id="image" class="form-control" accept="image/*" required>
        </div>

        <div class="form-group" style="margin-bottom: 24px;">
          <label for="description">Deskripsi Ringkas Lampiran (Opsional)</label>
          <textarea name="description" id="description" class="form-control" rows="3" placeholder="Contoh: Berperan sebagai Staff Competition dalam rangkaian kegiatan SI FEST 2025..."></textarea>
        </div>

        <button type="submit" class="btn btn-primary">
          <i class="fas fa-upload"></i> Upload & Simpan Lampiran
        </button>
      </form>
    </div>

    <!-- Daftar Lampiran Terpasang -->
    <div class="admin-card">
      <h3 style="font-size: 1.15rem; color: var(--accent-cyan); margin-bottom: 20px;">
        <i class="fas fa-images"></i> Daftar Lampiran Terpasang ({{ $experience->attachments->count() }})
      </h3>

      <div style="display: flex; flex-direction: column; gap: 16px;">
        @forelse($experience->attachments as $att)
          <div style="display: flex; gap: 16px; align-items: flex-start; background: rgba(15, 23, 42, 0.6); padding: 14px; border-radius: var(--radius-md); border: 1px solid var(--border-glass);">
            @if($att->image)
              <img src="{{ asset($att->image) }}" alt="{{ $att->title }}" style="width: 90px; height: 60px; object-fit: cover; border-radius: 8px; border: 1px solid var(--border-glow); flex-shrink: 0;">
            @endif
            <div style="flex: 1; min-width: 0;">
              <h4 style="font-size: 0.95rem; color: var(--text-main); margin-bottom: 4px;">{{ $att->title }}</h4>
              @if($att->subtitle)
                <span class="badge" style="background: rgba(6, 182, 212, 0.15); color: var(--accent-cyan); margin-bottom: 6px; display: inline-block;">{{ $att->subtitle }}</span>
              @endif
              @if($att->description)
                <p style="color: var(--text-muted); font-size: 0.82rem; margin-top: 4px; line-height: 1.4;">{{ Str::limit($att->description, 100) }}</p>
              @endif
            </div>
            <div>
              <form action="{{ route('admin.experience.attachments.destroy', $att->id) }}" method="POST" onsubmit="return confirm('Hapus lampiran ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-outline" style="color: #ef4444; border-color: rgba(239,68,68,0.4); padding: 6px 10px;">
                  <i class="fas fa-trash"></i>
                </button>
              </form>
            </div>
          </div>
        @empty
          <div style="text-align: center; padding: 30px; color: var(--text-muted);">
            <i class="fas fa-folder-open" style="font-size: 2rem; margin-bottom: 10px; display: block; opacity: 0.5;"></i>
            Belum ada sertifikat atau foto kegiatan yang di-upload untuk pengalaman ini.
          </div>
        @endforelse
      </div>
    </div>
  </div>

@endsection
