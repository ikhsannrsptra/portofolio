@extends('admin.layouts.admin')

@section('title', ($experience->exists ? 'Edit Pengalaman Kerja' : 'Tambah Pengalaman Kerja') . ' - Admin CMS')
@section('page-title', $experience->exists ? 'Edit Pengalaman: ' . $experience->role : 'Tambah Pengalaman Kerja Baru')

@section('content')

  <div class="admin-card" style="max-width: 800px;">
    @if($errors->any())
      <div style="background: rgba(239, 68, 68, 0.15); border: 1px solid #ef4444; color: #ef4444; padding: 14px 20px; border-radius: var(--radius-md); margin-bottom: 24px;">
        <ul style="margin-left: 20px;">
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ $experience->exists ? route('admin.experience.update', $experience->id) : route('admin.experience.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      @if($experience->exists)
        @method('PUT')
      @endif

      <div class="form-group" style="margin-bottom: 20px;">
        <label for="period">Periode Tahun / Waktu Kerja</label>
        <input type="text" name="period" id="period" class="form-control" value="{{ old('period', $experience->period) }}" required placeholder="Contoh: 2024 – Sekarang atau 2022 – 2024">
      </div>

      <div class="form-group" style="margin-bottom: 20px;">
        <label for="role">Posisi / Jabatan Pekerjaan</label>
        <input type="text" name="role" id="role" class="form-control" value="{{ old('role', $experience->role) }}" required placeholder="Contoh: Senior Lead Full-Stack Engineer">
      </div>

      <div class="form-group" style="margin-bottom: 20px;">
        <label for="company">Nama Perusahaan / Instansi / Client</label>
        <input type="text" name="company" id="company" class="form-control" value="{{ old('company', $experience->company) }}" required placeholder="Contoh: TechNova Solutions Inc.">
      </div>

      <!-- File Upload for Experience Logo -->
      <div class="form-group" style="margin-bottom: 24px;">
        <label for="logo"><i class="fas fa-building" style="color: var(--accent-primary); margin-right: 6px;"></i>Upload Logo Perusahaan / Instansi / Organisasi (Opsional)</label>
        @if($experience->logo)
          <div style="margin-bottom: 12px; display: flex; align-items: center; gap: 14px;">
            <img src="{{ asset($experience->logo) }}" alt="Logo Saat Ini" style="width: 60px; height: 60px; object-fit: contain; background: rgba(255,255,255,0.05); padding: 6px; border-radius: 8px; border: 1px solid var(--border-glow);">
            <span style="color: var(--text-muted); font-size: 0.85rem;">Logo saat ini</span>
          </div>
        @endif
        <input type="file" name="logo" id="logo" class="form-control" accept="image/*">
        <p style="color: var(--text-muted); font-size: 0.8rem; margin-top: 6px;">Format gambar yang didukung: PNG, JPG, SVG, WebP, GIF.</p>
      </div>

      <!-- File Upload for Experience Activity Photo / Certificate -->
      <div class="form-group" style="margin-bottom: 24px;">
        <label for="image"><i class="fas fa-camera" style="color: var(--accent-cyan); margin-right: 6px;"></i>Foto Dokumentasi Kegiatan / Sertifikat / Bukti Magang (Opsional)</label>
        @if($experience->image)
          <div style="margin-bottom: 12px; display: flex; align-items: center; gap: 14px;">
            <img src="{{ asset($experience->image) }}" alt="Foto Dokumentasi Saat Ini" style="width: 100px; height: 65px; object-fit: cover; border-radius: 8px; border: 1px solid var(--border-glow);">
            <span style="color: var(--text-muted); font-size: 0.85rem;">Foto dokumentasi saat ini</span>
          </div>
        @endif
        <input type="file" name="image" id="image" class="form-control" accept="image/*">
        <p style="color: var(--text-muted); font-size: 0.8rem; margin-top: 6px;">Foto ini akan muncul sebagai card lampiran (LinkedIn-style) di dalam timeline pengalaman.</p>
      </div>

      <div class="form-group" style="margin-bottom: 20px;">
        <label for="attachment_title"><i class="fas fa-award" style="color: var(--accent-emerald); margin-right: 6px;"></i>Judul Sertifikat / Nama Dokumentasi Lampiran (Opsional)</label>
        <input type="text" name="attachment_title" id="attachment_title" class="form-control" value="{{ old('attachment_title', $experience->attachment_title) }}" placeholder="Contoh: Sertifikat Penghargaan – Staff Teraktif RISTEK">
        <p style="color: var(--text-muted); font-size: 0.8rem; margin-top: 6px;">Judul yang tampil di card lampiran sertifikat/foto (misal: Sertifikat Penghargaan, Panitia SI FEST, dll).</p>
      </div>

      <div class="form-group" style="margin-bottom: 20px;">
        <label for="color">Warna Aksen Badge (Opsional)</label>
        <select name="color" id="color" class="form-control" style="background: #0f172a; color: #fff;">
          <option value="var(--accent-purple)" {{ old('color', $experience->color) == 'var(--accent-purple)' ? 'selected' : '' }}>Ungu (Purple Accent)</option>
          <option value="var(--accent-emerald)" {{ old('color', $experience->color) == 'var(--accent-emerald)' ? 'selected' : '' }}>Hijau (Emerald Accent)</option>
          <option value="var(--accent-cyan)" {{ old('color', $experience->color) == 'var(--accent-cyan)' ? 'selected' : '' }}>Biru Cyan (Cyan Accent)</option>
          <option value="var(--accent-primary)" {{ old('color', $experience->color) == 'var(--accent-primary)' ? 'selected' : '' }}>Indigo (Primary Accent)</option>
          <option value="#ec4899" {{ old('color', $experience->color) == '#ec4899' ? 'selected' : '' }}>Pink Accent</option>
          <option value="#f59e0b" {{ old('color', $experience->color) == '#f59e0b' ? 'selected' : '' }}>Amber / Gold Accent</option>
        </select>
      </div>

      <div class="form-group" style="margin-bottom: 24px;">
        <label for="description">Deskripsi Ringkas Pekerjaan & Tanggung Jawab</label>
        <textarea name="description" id="description" class="form-control" rows="4" required placeholder="Tuliskan detail tanggung jawab, teknologi yang digunakan, atau pencapaian utama...">{{ old('description', $experience->description) }}</textarea>
      </div>

      <div style="display: flex; gap: 14px;">
        <button type="submit" class="btn btn-primary">
          <i class="fas fa-save"></i> {{ $experience->exists ? 'Simpan Perubahan' : 'Tambah Pengalaman' }}
        </button>
        <a href="{{ route('admin.experience.index') }}" class="btn btn-outline">Batal</a>
      </div>
    </form>
  </div>

@endsection
