@extends('admin.layouts.admin')

@section('title', ($certificate->exists ? 'Edit Sertifikat' : 'Tambah Sertifikat') . ' - Admin CMS')
@section('page-title', $certificate->exists ? 'Edit Sertifikat: ' . $certificate->title : 'Tambah Sertifikat Baru')

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

    <form action="{{ $certificate->exists ? route('admin.certificates.update', $certificate->id) : route('admin.certificates.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      @if($certificate->exists)
        @method('PUT')
      @endif

      <div class="form-group" style="margin-bottom: 20px;">
        <label for="title">Judul Sertifikat / Penghargaan</label>
        <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $certificate->title) }}" required placeholder="Contoh: Full-Stack Web Development Expert">
      </div>

      <div class="form-group" style="margin-bottom: 20px;">
        <label for="issuer">Penerbit Sertifikat / Penyelenggara</label>
        <input type="text" name="issuer" id="issuer" class="form-control" value="{{ old('issuer', $certificate->issuer) }}" required placeholder="Contoh: International Tech Academy">
      </div>

      <div class="form-group" style="margin-bottom: 20px;">
        <label for="issued_year">Tahun Perolehan (Opsional)</label>
        <input type="text" name="issued_year" id="issued_year" class="form-control" value="{{ old('issued_year', $certificate->issued_year) }}" placeholder="Contoh: 2024">
      </div>

      <!-- File Upload for Certificate Photo -->
      <div class="form-group" style="margin-bottom: 24px;">
        <label for="image">Upload Foto Sertifikat {{ $certificate->exists ? '(Biarkan kosong jika tidak diganti)' : '*' }}</label>
        @if($certificate->image)
          <div style="margin-bottom: 12px;">
            <img src="{{ asset($certificate->image) }}" alt="Preview Saat Ini" style="width: 140px; height: 90px; object-fit: cover; border-radius: 8px; border: 1px solid var(--border-glow);">
          </div>
        @endif
        <input type="file" name="image" id="image" class="form-control" accept="image/*" {{ $certificate->exists ? '' : 'required' }}>
      </div>

      <div style="display: flex; gap: 14px;">
        <button type="submit" class="btn btn-primary">
          <i class="fas fa-save"></i> {{ $certificate->exists ? 'Simpan Perubahan' : 'Tambah Sertifikat' }}
        </button>
        <a href="{{ route('admin.certificates.index') }}" class="btn btn-outline">Batal</a>
      </div>
    </form>
  </div>

@endsection
