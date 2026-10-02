<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Portofolio Profesional - Full-Stack Laravel & UI/UX Specialist')</title>
  <meta name="description" content="Portofolio modern, interaktif dan responsif berbasis PHP Laravel.">
  
  <!-- Google Fonts, FontAwesome & Devicon -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicons/devicon@v2.15.1/devicon.min.css">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

  <!-- Interactive Canvas Particles Background -->
  <canvas id="particles-canvas"></canvas>

  <!-- Ambient Light Blobs -->
  <div class="ambient-glow glow-1"></div>
  <div class="ambient-glow glow-2"></div>
  <div class="ambient-glow glow-3"></div>

  <!-- Custom Glowing Cursor -->
  <div class="custom-cursor" id="custom-cursor"></div>
  <div class="cursor-follower" id="cursor-follower"></div>

  <!-- Toast Notification Container -->
  <div class="toast-container" id="toast-container"></div>

  <!-- Header Navigation -->
  <header class="header">
    <nav class="navbar">
      <a href="#hero" class="nav-logo">
        <span class="logo-dot"></span>
        <span>IKHSAN</span>
      </a>

      <ul class="nav-links" id="nav-links">
        <li><a href="#hero" class="nav-link active">Beranda</a></li>
        <li><a href="#about" class="nav-link">Tentang Saya</a></li>
        <li><a href="#education" class="nav-link">Pendidikan</a></li>
        <li><a href="#experience" class="nav-link">Pengalaman</a></li>
        <li><a href="#certificates" class="nav-link">Sertifikat</a></li>
        <li><a href="#projects" class="nav-link">Proyek</a></li>
        <li><a href="#skills" class="nav-link">Keahlian</a></li>
        <li><a href="#contact" class="nav-link">Kontak</a></li>
      </ul>

      <div class="nav-actions">
        <button class="sound-toggle-btn" id="sound-toggle" title="Toggle Efek Suara">
          <i class="fas fa-volume-up"></i>
        </button>
        <button class="theme-toggle-btn" id="theme-toggle" title="Toggle Tema Mode">
          <i class="fas fa-moon"></i>
        </button>
        <button class="mobile-toggle" id="mobile-toggle" aria-label="Menu Mobile">
          <span></span>
          <span></span>
          <span></span>
        </button>
      </div>
    </nav>
  </header>

  <!-- Main View Content -->
  <main>
    @yield('content')
  </main>

  <!-- Footer -->
  <footer class="footer">
    <div class="container footer-content">
      <a href="#hero" class="back-to-top" title="Kembali ke Atas">
        <i class="fas fa-chevron-up"></i>
      </a>
      <p>&copy; 2026 Ikhsan Nur Saputra. All Rights Reserved.</p>
    </div>
  </footer>

  <!-- Custom Scripts -->
  <script src="{{ asset('js/particles.js') }}"></script>
  <script src="{{ asset('js/tilt.js') }}"></script>
  <script src="{{ asset('js/main.js') }}"></script>

  @stack('scripts')
</body>
</html>
