@extends('admin.layouts.admin')

@section('title', 'Kelola Teknologi & Keahlian - Admin CMS')
@section('page-title', 'Kelola Teknologi & Keahlian (Tech Logos)')

@section('content')

  <div style="display: grid; grid-template-columns: 360px 1fr; gap: 24px; align-items: start;">
    
    <!-- Form Tambah Teknologi -->
    <div class="admin-card">
      <h3 style="font-size: 1.1rem; margin-bottom: 20px; color: var(--accent-primary);">
        <i class="fas fa-plus-circle"></i> Tambah Teknologi Baru
      </h3>

      @if($errors->any())
        <div style="background: rgba(239, 68, 68, 0.15); border: 1px solid #ef4444; color: #ef4444; padding: 12px; border-radius: 8px; margin-bottom: 20px; font-size: 0.85rem;">
          <ul style="margin-left: 16px;">
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('admin.skills.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group" style="margin-bottom: 16px;">
          <label for="name">Nama Teknologi / Tools *</label>
          <input type="text" name="name" id="name" class="form-control" required placeholder="Contoh: Laravel, MikroTik, HTML5">
        </div>

        <div class="form-group" style="margin-bottom: 16px;">
          <label for="category">Kategori *</label>
          <input type="text" name="category" id="category" class="form-control" required placeholder="Contoh: Frontend, Backend, Networking, Database">
        </div>

        <div class="form-group" style="margin-bottom: 16px;">
          <label for="image">Upload Logo Gambar (Opsional)</label>
          <input type="file" name="image" id="image" class="form-control" accept="image/*">
          <p style="color: var(--text-muted); font-size: 0.78rem; margin-top: 4px;">Pilih file gambar logo dari HP/Laptop Anda (PNG/SVG/JPG).</p>
        </div>

        <div class="form-group" style="margin-bottom: 16px;">
          <label for="icon_class">Icon Class Devicon / FontAwesome (Opsional)</label>
          <input type="text" name="icon_class" id="icon_class" class="form-control" placeholder="Contoh: devicon-laravel-plain colored atau fas fa-network-wired">
          <p style="color: var(--text-muted); font-size: 0.78rem; margin-top: 4px;">Digunakan jika Anda tidak mengunggah file gambar logo.</p>
        </div>

        <div class="form-group" style="margin-bottom: 20px;">
          <label for="order">Urutan Tampil</label>
          <input type="number" name="order" id="order" class="form-control" placeholder="Otomatik (1, 2, 3...)">
        </div>

        <button type="submit" class="btn btn-primary" style="width: 100%;">
          <i class="fas fa-save"></i> Simpan Teknologi
        </button>
      </form>
    </div>

    <!-- Tabel Daftar Teknologi -->
    <div class="admin-card">
      <h3 style="font-size: 1.1rem; margin-bottom: 20px;">
        <i class="fas fa-layer-group"></i> Daftar Teknologi & Keahlian ({{ $skills->count() }})
      </h3>

      <div class="table-responsive">
        <table class="admin-table">
          <thead>
            <tr>
              <th>Urutan</th>
              <th>Logo / Icon</th>
              <th>Nama Teknologi</th>
              <th>Kategori</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse($skills as $skill)
              <tr>
                <td><strong>#{{ $skill->order }}</strong></td>
                <td>
                  <div style="width: 44px; height: 44px; background: rgba(255,255,255,0.05); border: 1px solid var(--border-glass); border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.8rem;">
                    @if($skill->image)
                      <img src="{{ asset($skill->image) }}" alt="{{ $skill->name }}" style="width: 30px; height: 30px; object-fit: contain;">
                    @elseif($skill->icon_class)
                      <i class="{{ $skill->icon_class }}"></i>
                    @else
                      <i class="fas fa-code" style="color: var(--accent-primary);"></i>
                    @endif
                  </div>
                </td>
                <td>
                  <strong>{{ $skill->name }}</strong>
                </td>
                <td>
                  <span class="badge" style="background: rgba(99, 102, 241, 0.15); color: var(--accent-primary); border: 1px solid var(--border-glow);">
                    {{ $skill->category }}
                  </span>
                </td>
                <td>
                  <div style="display: flex; gap: 8px;">
                    <button type="button" class="btn btn-sm btn-outline edit-skill-btn" 
                      data-id="{{ $skill->id }}"
                      data-name="{{ $skill->name }}"
                      data-category="{{ $skill->category }}"
                      data-icon_class="{{ $skill->icon_class }}"
                      data-order="{{ $skill->order }}"
                      data-action="{{ route('admin.skills.update', $skill->id) }}"
                      style="padding: 6px 12px; font-size: 0.8rem;">
                      <i class="fas fa-edit"></i> Edit
                    </button>
                    <form action="{{ route('admin.skills.destroy', $skill->id) }}" method="POST" onsubmit="return confirm('Hapus teknologi {{ $skill->name }}?');">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-sm btn-outline" style="padding: 6px 12px; font-size: 0.8rem; color: #ef4444; border-color: rgba(239, 68, 68, 0.4);">
                        <i class="fas fa-trash"></i>
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="5" style="text-align: center; color: var(--text-muted); padding: 24px;">Belum ada data teknologi.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

  </div>

  <!-- Modal Edit Teknologi -->
  <div id="edit-skill-modal" style="display: none; position: fixed; inset: 0; background: rgba(7, 9, 19, 0.85); backdrop-filter: blur(12px); z-index: 99999; align-items: center; justify-content: center; opacity: 1; pointer-events: auto;">
    <div class="admin-card" style="width: 90%; max-width: 500px; position: relative; margin: 0; border: 1px solid var(--border-glow); box-shadow: 0 10px 40px rgba(0,0,0,0.5);">
      <button type="button" id="close-modal-btn" style="position: absolute; top: 18px; right: 18px; background: rgba(255,255,255,0.05); border: 1px solid var(--border-glass); border-radius: 50%; width: 32px; height: 32px; color: #fff; font-size: 1rem; cursor: pointer; display: flex; align-items: center; justify-content: center;">
        <i class="fas fa-times"></i>
      </button>

      <h3 style="font-size: 1.15rem; margin-bottom: 20px; color: var(--accent-primary);">
        <i class="fas fa-edit"></i> Edit Teknologi & Keahlian
      </h3>

      <form id="edit-skill-form" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group" style="margin-bottom: 16px;">
          <label for="edit_name">Nama Teknologi *</label>
          <input type="text" name="name" id="edit_name" class="form-control" required>
        </div>

        <div class="form-group" style="margin-bottom: 16px;">
          <label for="edit_category">Kategori *</label>
          <input type="text" name="category" id="edit_category" class="form-control" required>
        </div>

        <div class="form-group" style="margin-bottom: 16px;">
          <label for="edit_image">Ganti Logo Gambar (Opsional)</label>
          <input type="file" name="image" id="edit_image" class="form-control" accept="image/*">
        </div>

        <div class="form-group" style="margin-bottom: 16px;">
          <label for="edit_icon_class">Icon Class (Devicon / FontAwesome)</label>
          <input type="text" name="icon_class" id="edit_icon_class" class="form-control">
        </div>

        <div class="form-group" style="margin-bottom: 20px;">
          <label for="edit_order">Urutan Tampil</label>
          <input type="number" name="order" id="edit_order" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary" style="width: 100%;">
          <i class="fas fa-save"></i> Perbarui Teknologi
        </button>
      </form>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const modal = document.getElementById('edit-skill-modal');
      const closeBtn = document.getElementById('close-modal-btn');
      const editForm = document.getElementById('edit-skill-form');

      document.querySelectorAll('.edit-skill-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
          e.preventDefault();
          const button = e.currentTarget;
          editForm.action = button.dataset.action;
          document.getElementById('edit_name').value = button.dataset.name || '';
          document.getElementById('edit_category').value = button.dataset.category || '';
          document.getElementById('edit_icon_class').value = button.dataset.icon_class || '';
          document.getElementById('edit_order').value = button.dataset.order || '';
          
          modal.style.display = 'flex';
        });
      });

      closeBtn.addEventListener('click', function() {
        modal.style.display = 'none';
      });

      modal.addEventListener('click', function(e) {
        if (e.target === modal) modal.style.display = 'none';
      });
    });
  </script>

@endsection
