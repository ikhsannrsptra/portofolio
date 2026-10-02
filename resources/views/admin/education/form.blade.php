@extends('admin.layouts.admin')

@section('title', ($education->exists ? 'Edit Pendidikan' : 'Tambah Pendidikan') . ' - Admin CMS')
@section('page-title', $education->exists ? 'Edit Pendidikan: ' . $education->title : 'Tambah Riwayat Pendidikan Baru')

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

    <form action="{{ $education->exists ? route('admin.education.update', $education->id) : route('admin.education.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      @if($education->exists)
        @method('PUT')
      @endif

      <div class="form-group" style="margin-bottom: 20px;">
        <label for="level">Tingkat Pendidikan</label>
        <select name="level" id="level" class="form-control" required style="background: #0f172a; color: #fff;">
          <option value="Kuliah" {{ old('level', $education->level) == 'Kuliah' ? 'selected' : '' }}>Kuliah / Perguruan Tinggi</option>
          <option value="SMK" {{ old('level', $education->level) == 'SMK' ? 'selected' : '' }}>SMK (Sekolah Menengah Kejuruan)</option>
          <option value="SMP" {{ old('level', $education->level) == 'SMP' ? 'selected' : '' }}>SMP (Sekolah Menengah Pertama)</option>
        </select>
      </div>

      <div class="form-group" style="margin-bottom: 20px;">
        <label for="period">Periode Tahun</label>
        <input type="text" name="period" id="period" class="form-control" value="{{ old('period', $education->period) }}" required placeholder="Contoh: 2020 - 2024">
      </div>

      <div class="form-group" style="margin-bottom: 20px;">
        <label for="title">Gelar / Jurusan / Tingkat</label>
        <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $education->title) }}" required placeholder="Contoh: S1 Teknik Informatika">
      </div>

      <div class="form-group" style="margin-bottom: 20px;">
        <label for="institution">Nama Sekolah / Universitas</label>
        <input type="text" name="institution" id="institution" class="form-control" value="{{ old('institution', $education->institution) }}" required placeholder="Contoh: Universitas Teknologi Indonesia">
      </div>

      <!-- File Upload for School Logo -->
      <div class="form-group" style="margin-bottom: 24px;">
        <label for="logo">Upload Logo Sekolah / Universitas (Opsional)</label>
        @if($education->logo)
          <div style="margin-bottom: 12px; display: flex; align-items: center; gap: 14px;">
            <img src="{{ asset($education->logo) }}" alt="Logo Saat Ini" style="width: 60px; height: 60px; object-fit: contain; background: rgba(255,255,255,0.05); padding: 6px; border-radius: 8px; border: 1px solid var(--border-glow);">
            <span style="color: var(--text-muted); font-size: 0.85rem;">Logo saat ini</span>
          </div>
        @endif
        <input type="file" name="logo" id="logo" class="form-control" accept="image/*">
        <p style="color: var(--text-muted); font-size: 0.8rem; margin-top: 6px;">Format gambar yang didukung: PNG, JPG, SVG, WebP.</p>
      </div>

      <div class="form-group" style="margin-bottom: 24px;">
        <label for="description">Deskripsi Ringkas & Prestasi</label>
        <textarea name="description" id="description" class="form-control" required placeholder="Tuliskan catatan prestasi atau fokus bidang ilmu...">{{ old('description', $education->description) }}</textarea>
      </div>

      <div style="display: flex; gap: 14px;">
        <button type="submit" class="btn btn-primary">
          <i class="fas fa-save"></i> {{ $education->exists ? 'Simpan Perubahan' : 'Tambah Pendidikan' }}
        </button>
        <a href="{{ route('admin.education.index') }}" class="btn btn-outline">Batal</a>
      </div>
    </form>
  </div>

@endsection
