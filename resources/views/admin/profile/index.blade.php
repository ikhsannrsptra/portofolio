@extends('admin.layouts.admin')

@section('title', 'Kelola Profil & Avatar - Admin CMS')
@section('page-title', 'Pengaturan Profil & Foto Avatar')

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

    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <!-- Avatar Photo Section -->
      <div class="form-group" style="margin-bottom: 24px;">
        <label>Foto Profil Avatar</label>
        <div style="display: flex; align-items: center; gap: 20px; margin-top: 10px;">
          <img src="{{ asset($profile->avatar ?? 'assets/images/avatar.png') }}" alt="Avatar" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover; border: 3px solid var(--accent-primary); box-shadow: 0 0 20px rgba(99, 102, 241, 0.4);">
          <div>
            <input type="file" name="avatar" class="form-control" accept="image/*">
            <p style="color: var(--text-muted); font-size: 0.8rem; margin-top: 6px;">Pilih foto baru dari laptop/HP Anda untuk mengganti avatar profil.</p>
          </div>
        </div>
      </div>

      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
        <div class="form-group">
          <label for="name">Nama Lengkap / Panggilan</label>
          <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $profile->name) }}" required>
        </div>

        <div class="form-group">
          <label for="title">Judul Role Professional</label>
          <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $profile->title) }}" required>
        </div>
      </div>

      <div class="form-group" style="margin-bottom: 20px;">
        <label for="status">Status Ketersediaan Kerja</label>
        <input type="text" name="status" id="status" class="form-control" value="{{ old('status', $profile->status) }}" required placeholder="Contoh: Siap Menerima Project & Kolaborasi">
      </div>

      <div class="form-group" style="margin-bottom: 20px;">
        <label for="location">Lokasi Tempat Tinggal</label>
        <input type="text" name="location" id="location" class="form-control" value="{{ old('location', $profile->location) }}" placeholder="Contoh: Jakarta, Indonesia">
      </div>

      <div class="form-group" style="margin-bottom: 20px;">
        <label for="bio_short">Deskripsi Sub-Judul (Subtitle Deskripsi Diri)</label>
        <input type="text" name="bio_short" id="bio_short" class="form-control" value="{{ old('bio_short', $profile->bio_short) }}" placeholder="Contoh: Mengembangkan infrastruktur jaringan, aplikasi web berbasis PHP Laravel & React berkualitas tinggi.">
        <p style="color: var(--text-muted); font-size: 0.8rem; margin-top: 4px;">Tampil sebagai sub-judul di bawah tulisan 'Mengenal Lebih Dekat tentang Saya'.</p>
      </div>

      <div class="form-group" style="margin-bottom: 20px;">
        <label for="bio_full">Penjelasan Diri Lengkap (Card Deskripsi Diri)</label>
        <textarea name="bio_full" id="bio_full" class="form-control" rows="6" placeholder="Tuliskan cerita biografi, latar belakang akademis, keahlian, dan motivasi Anda di sini...">{{ old('bio_full', $profile->bio_full) }}</textarea>
        <p style="color: var(--text-muted); font-size: 0.8rem; margin-top: 4px;">Teks ini akan tampil di dalam 1 Card Penjelasan Diri pada halaman utama portfolio. Anda dapat memisahkan antar paragraf dengan enter.</p>
      </div>

      <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-bottom: 24px;">
        <div class="form-group">
          <label for="years_exp">Statistik Pengalaman</label>
          <input type="text" name="years_exp" id="years_exp" class="form-control" value="{{ old('years_exp', $profile->years_exp) }}" placeholder="5+">
        </div>

        <div class="form-group">
          <label for="projects_completed">Statistik Proyek</label>
          <input type="text" name="projects_completed" id="projects_completed" class="form-control" value="{{ old('projects_completed', $profile->projects_completed) }}" placeholder="35+">
        </div>

        <div class="form-group">
          <label for="certificates_count">Statistik Sertifikat</label>
          <input type="text" name="certificates_count" id="certificates_count" class="form-control" value="{{ old('certificates_count', $profile->certificates_count) }}" placeholder="12+">
        </div>
      </div>

      <!-- ======== INFORMASI KONTAK ======== -->
      <div style="border-top: 1px solid rgba(255,255,255,0.08); margin: 32px 0 24px; padding-top: 24px;">
        <h3 style="font-size: 1.05rem; color: var(--accent-primary); margin-bottom: 20px;">
          <i class="fas fa-address-card"></i> Informasi Kontak
        </h3>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
          <div class="form-group">
            <label for="email"><i class="fas fa-envelope" style="color: var(--accent-primary); margin-right: 6px;"></i>Email Kontak</label>
            <input type="email" name="email" id="email" class="form-control"
              value="{{ old('email', $profile->email) }}"
              placeholder="contoh@gmail.com">
          </div>

          <div class="form-group">
            <label for="phone"><i class="fab fa-whatsapp" style="color: var(--accent-emerald); margin-right: 6px;"></i>WhatsApp / No. HP</label>
            <input type="text" name="phone" id="phone" class="form-control"
              value="{{ old('phone', $profile->phone) }}"
              placeholder="+62 812-XXXX-XXXX">
          </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
          <div class="form-group">
            <label for="github_url"><i class="fab fa-github" style="margin-right: 6px;"></i>URL GitHub</label>
            <input type="text" name="github_url" id="github_url" class="form-control"
              value="{{ old('github_url', $profile->github_url) }}"
              placeholder="https://github.com/username">
          </div>

          <div class="form-group">
            <label for="linkedin_url"><i class="fab fa-linkedin" style="color: #0a66c2; margin-right: 6px;"></i>URL LinkedIn</label>
            <input type="text" name="linkedin_url" id="linkedin_url" class="form-control"
              value="{{ old('linkedin_url', $profile->linkedin_url) }}"
              placeholder="https://linkedin.com/in/username">
          </div>
        </div>

        <div class="form-group" style="margin-bottom: 0;">
          <label for="contact_intro"><i class="fas fa-comment-alt" style="color: var(--accent-cyan); margin-right: 6px;"></i>Teks Intro Kontak</label>
          <textarea name="contact_intro" id="contact_intro" class="form-control" rows="3"
            placeholder="Contoh: Saya siap merespons pesan Anda secepatnya. Mari diskusikan proyek impian Anda!">{{ old('contact_intro', $profile->contact_intro) }}</textarea>
          <p style="color: var(--text-muted); font-size: 0.8rem; margin-top: 6px;">Teks deskripsi kecil yang tampil di bawah judul "Informasi Kontak".</p>
        </div>
      </div>

      <button type="submit" class="btn btn-primary">
        <i class="fas fa-save"></i> Simpan Perubahan Profil
      </button>
    </form>
  </div>

@endsection
