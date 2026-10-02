@extends('admin.layouts.admin')

@section('title', ($project->exists ? 'Edit Proyek' : 'Tambah Proyek') . ' - Admin CMS')
@section('page-title', $project->exists ? 'Edit Proyek: ' . $project->title : 'Tambah Proyek Baru')

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

    <form action="{{ $project->exists ? route('admin.projects.update', $project->id) : route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      @if($project->exists)
        @method('PUT')
      @endif

      <div class="form-group" style="margin-bottom: 20px;">
        <label for="title">Judul Proyek</label>
        <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $project->title) }}" required placeholder="Contoh: E-Commerce Storefront">
      </div>

      <div class="form-group" style="margin-bottom: 20px;">
        <label for="category">Kategori Proyek</label>
        <select name="category" id="category" class="form-control" required style="background: #0f172a; color: #fff;">
          <option value="web" {{ old('category', $project->category) == 'web' ? 'selected' : '' }}>Web Application</option>
          <option value="copywriting" {{ old('category', $project->category) == 'copywriting' ? 'selected' : '' }}>Copywriting</option>
        </select>
      </div>

      <div class="form-group" style="margin-bottom: 20px;">
        <label for="description">Deskripsi Singkat Proyek</label>
        <textarea name="description" id="description" class="form-control" required placeholder="Tuliskan gambaran umum proyek...">{{ old('description', $project->description) }}</textarea>
      </div>

      <div class="form-group" style="margin-bottom: 20px;">
        <label for="tags">Teknologi / Tags (Pisahkan dengan koma)</label>
        <input type="text" name="tags" id="tags" class="form-control" value="{{ old('tags', $project->tags) }}" placeholder="Contoh: Laravel, React.js, Tailwind CSS">
      </div>

      <div class="form-group" style="margin-bottom: 20px;">
        <label for="github_url">Tautan GitHub Repository (Opsional)</label>
        <input type="url" name="github_url" id="github_url" class="form-control" value="{{ old('github_url', $project->github_url) }}" placeholder="https://github.com/username/project">
      </div>

      <!-- File Upload for Project Photo -->
      <div class="form-group" style="margin-bottom: 24px;">
        <label for="image">Upload Foto Pratinjau Proyek {{ $project->exists ? '(Biarkan kosong jika tidak diganti)' : '*' }}</label>
        @if($project->image)
          <div style="margin-bottom: 12px;">
            <img src="{{ asset($project->image) }}" alt="Preview Saat Ini" style="width: 140px; height: 90px; object-fit: cover; border-radius: 8px; border: 1px solid var(--border-glow);">
          </div>
        @endif
        <input type="file" name="image" id="image" class="form-control" accept="image/*" {{ $project->exists ? '' : 'required' }}>
      </div>

      <div style="display: flex; gap: 14px;">
        <button type="submit" class="btn btn-primary">
          <i class="fas fa-save"></i> {{ $project->exists ? 'Simpan Perubahan' : 'Tambah Proyek' }}
        </button>
        <a href="{{ route('admin.projects.index') }}" class="btn btn-outline">Batal</a>
      </div>
    </form>
  </div>

@endsection
