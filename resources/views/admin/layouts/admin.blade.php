<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Admin CMS Panel - Portfolio')</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <style>
    body {
      display: flex;
      min-height: 100vh;
      background-color: #070913;
    }
    .admin-sidebar {
      width: 260px;
      background: rgba(15, 23, 42, 0.9);
      backdrop-filter: blur(20px);
      border-right: 1px solid var(--border-glass);
      padding: 30px 20px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      position: fixed;
      top: 0;
      bottom: 0;
      left: 0;
      z-index: 100;
    }
    .admin-brand {
      font-family: var(--font-heading);
      font-size: 1.3rem;
      font-weight: 800;
      color: var(--text-main);
      display: flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 40px;
    }
    .admin-nav {
      list-style: none;
      display: flex;
      flex-direction: column;
      gap: 8px;
    }
    .admin-nav-link {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 12px 18px;
      border-radius: var(--radius-md);
      color: var(--text-muted);
      text-decoration: none;
      font-weight: 500;
      font-size: 0.95rem;
      transition: var(--transition-fast);
    }
    .admin-nav-link:hover, .admin-nav-link.active {
      background: rgba(99, 102, 241, 0.15);
      color: var(--accent-primary);
      border: 1px solid var(--border-glow);
    }
    .admin-main {
      margin-left: 260px;
      flex: 1;
      padding: 40px;
      max-width: 1200px;
    }
    .admin-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 30px;
      padding-bottom: 20px;
      border-bottom: 1px solid var(--border-glass);
    }
    .admin-card {
      background: var(--bg-card);
      border: 1px solid var(--border-glass);
      border-radius: var(--radius-lg);
      padding: 28px;
      margin-bottom: 30px;
    }
    .table-responsive {
      overflow-x: auto;
    }
    .admin-table {
      width: 100%;
      border-collapse: collapse;
      text-align: left;
    }
    .admin-table th, .admin-table td {
      padding: 14px 18px;
      border-bottom: 1px solid var(--border-glass);
    }
    .admin-table th {
      color: var(--text-muted);
      font-weight: 600;
      font-size: 0.85rem;
      text-transform: uppercase;
    }
    .badge {
      padding: 4px 10px;
      border-radius: var(--radius-full);
      font-size: 0.75rem;
      font-weight: 600;
    }
    .alert-success {
      background: rgba(16, 185, 129, 0.15);
      border: 1px solid var(--accent-emerald);
      color: var(--accent-emerald);
      padding: 14px 20px;
      border-radius: var(--radius-md);
      margin-bottom: 24px;
    }
  </style>
</head>
<body>

  <!-- Sidebar -->
  <aside class="admin-sidebar">
    <div>
      <div class="admin-brand">
        <span class="logo-dot"></span>
        <span>ADMIN CMS</span>
      </div>

      <ul class="admin-nav">
        <li>
          <a href="{{ route('admin.dashboard') }}" class="admin-nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fas fa-chart-line"></i> Dashboard
          </a>
        </li>
        <li>
          <a href="{{ route('admin.projects.index') }}" class="admin-nav-link {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">
            <i class="fas fa-folder-open"></i> Kelola Proyek
          </a>
        </li>
        <li>
          <a href="{{ route('admin.certificates.index') }}" class="admin-nav-link {{ request()->routeIs('admin.certificates.*') ? 'active' : '' }}">
            <i class="fas fa-certificate"></i> Kelola Sertifikat
          </a>
        </li>
        <li>
          <a href="{{ route('admin.education.index') }}" class="admin-nav-link {{ request()->routeIs('admin.education.*') ? 'active' : '' }}">
            <i class="fas fa-graduation-cap"></i> Kelola Pendidikan
          </a>
        </li>
        <li>
          <a href="{{ route('admin.experience.index') }}" class="admin-nav-link {{ request()->routeIs('admin.experience.*') ? 'active' : '' }}">
            <i class="fas fa-briefcase"></i> Kelola Pengalaman
          </a>
        </li>
        <li>
          <a href="{{ route('admin.profile.index') }}" class="admin-nav-link {{ request()->routeIs('admin.profile.*') ? 'active' : '' }}">
            <i class="fas fa-user-cog"></i> Profil & Avatar
          </a>
        </li>
        <li>
          <a href="{{ route('admin.roles.index') }}" class="admin-nav-link {{ request()->routeIs('admin.roles.*') ? 'active' : '' }}">
            <i class="fas fa-user-tag"></i> Kelola Teks Role
          </a>
        </li>
        <li>
          <a href="{{ route('admin.badges.index') }}" class="admin-nav-link {{ request()->routeIs('admin.badges.*') ? 'active' : '' }}">
            <i class="fas fa-icons"></i> Kelola Logo Floating
          </a>
        </li>
        <li>
          <a href="{{ route('admin.skills.index') }}" class="admin-nav-link {{ request()->routeIs('admin.skills.*') ? 'active' : '' }}">
            <i class="fas fa-layer-group"></i> Kelola Skill & Teknologi
          </a>
        </li>
        <li>
          <a href="{{ route('admin.messages.index') }}" class="admin-nav-link {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}" style="display:flex;align-items:center;gap:8px;">
            <i class="fas fa-envelope"></i> Pesan Masuk
            @php $unreadCount = \App\Models\Message::where('is_read', false)->count(); @endphp
            @if($unreadCount > 0)
              <span style="background:#ef4444;color:#fff;border-radius:50%;min-width:18px;height:18px;font-size:0.7rem;display:inline-flex;align-items:center;justify-content:center;padding:0 4px;margin-left:auto;">{{ $unreadCount }}</span>
            @endif
          </a>
        </li>
        <li>
          <a href="{{ route('portfolio.index') }}" target="_blank" class="admin-nav-link">
            <i class="fas fa-external-link-alt"></i> Lihat Website
          </a>
        </li>
      </ul>
    </div>

    <div>
      <form action="{{ route('admin.logout') }}" method="POST">
        @csrf
        <button type="submit" class="admin-nav-link" style="width: 100%; border: none; background: none; cursor: pointer; color: #ef4444;">
          <i class="fas fa-sign-out-alt"></i> Logout
        </button>
      </form>
    </div>
  </aside>

  <!-- Main Content -->
  <main class="admin-main">
    <div class="admin-header">
      <div>
        <h1 style="font-size: 1.8rem;">@yield('page-title', 'Admin Dashboard')</h1>
        <p style="color: var(--text-muted); font-size: 0.9rem;">Selamat datang, {{ Auth::user()->name }}</p>
      </div>
    </div>

    @if(session('success'))
      <div class="alert-success">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
      </div>
    @endif

    @yield('content')
  </main>

</body>
</html>
