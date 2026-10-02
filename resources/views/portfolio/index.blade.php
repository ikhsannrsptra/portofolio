@extends('layouts.app')

@section('title', $profile['name'] . ' - Portofolio Laravel & UI/UX Specialist')

@section('content')

  <!-- Hero Section -->
  <section class="hero" id="hero">
    <div class="container hero-grid">
      <div class="hero-content">
        <div class="hero-badge">
          <span class="pulse-dot"></span>
          <span>{{ $profile['status'] }}</span>
        </div>

        <h1 class="hero-title">
          Halo, Saya <span class="text-gradient">{{ $profile['name'] }}</span><br>
          Seorang <span class="typed-text-wrapper" id="typed-text" data-roles="{{ json_encode($heroRoles) }}"></span>
        </h1>

        <p class="hero-description">
          {{ $profile['bio_short'] ?? 'Information Systems student at Universitas Sriwijaya with interests in System Analysis, Web Development, and Network Engineering. Passionate about creating reliable digital solutions through technology, analysis, and innovation.' }}
        </p>

        <div class="hero-cta">
          <a href="#projects" class="btn btn-primary">
            <span>Lihat Karya</span>
            <i class="fas fa-arrow-right"></i>
          </a>
          <a href="#certificates" class="btn btn-outline">
            <i class="fas fa-award"></i>
            <span>Sertifikat & Penghargaan</span>
          </a>
        </div>
      </div>

      <div class="hero-avatar-wrapper">
        <div class="avatar-ring">
          <img src="{{ $profile['avatar'] }}" alt="Foto Profil Developer" class="avatar-img">
        </div>
        <!-- Floating Tech Badges Dynamic -->
        @foreach($heroBadges as $index => $badge)
          <div class="tech-badge tb-{{ ($index % 6) + 1 }}">
            @if($badge->image)
              <img src="{{ asset($badge->image) }}" alt="{{ $badge->name }}" style="width: 20px; height: 20px; object-fit: contain;">
            @elseif($badge->icon_class)
              <i class="{{ $badge->icon_class }}" style="color: {{ $badge->icon_color }};"></i>
            @else
              <i class="fas fa-code" style="color: {{ $badge->icon_color }};"></i>
            @endif
            <span>{{ $badge->name }}</span>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- About Me Section (Deskripsi Diri - Single Card) -->
  <section class="about" id="about">
    <div class="container">
      <div class="text-center">
        <span class="section-tag">Deskripsi Diri</span>
        <h2 class="section-title">Mengenal Lebih Dekat tentang Saya</h2>
        <p class="section-subtitle mx-auto">
          {{ $profile['bio_short'] ?? 'Mengembangkan infrastruktur jaringan, aplikasi web berbasis PHP Laravel & React berkualitas tinggi.' }}
        </p>
      </div>

      <div class="about-single-container">
        <div class="glass-card about-single-card">
          @if(!empty($profile['bio_full']))
            <div class="bio-text-wrapper">
              {!! nl2br(e($profile['bio_full'])) !!}
            </div>
          @else
            <div class="bio-text-wrapper">
              <p>
                Hello! I am an active <strong>Informatics Engineering</strong> undergraduate at <strong>Universitas Sriwijaya</strong>, currently maintaining a <strong>3.97 GPA</strong>. As a proud <strong>GenBI Scholar</strong> awarded by Bank Indonesia, I am highly committed to being an agent of change who bridges technological advancement with community empowerment. My academic journey is driven by a deep fascination with how technology can solve real-world problems, sparking my strong interest in <strong>Artificial Intelligence, Machine Learning, and Web Development</strong>.
              </p>
              <p>
                Complementing my technical background, I strongly believe in the power of <strong>effective communication and visual storytelling</strong>. Through my active roles in organizational leadership, public relations, and copywriting, combined with a deep passion for photography and videography, I have learned how to bridge the gap between complex technical ideas and human-centric design. Whether I am developing a new software project or shaping a team's communication strategy, I bring an adaptable, highly motivated mindset and a genuine eagerness to continuously learn and grow.
              </p>
            </div>
          @endif
        </div>
      </div>
    </div>
  </section>

  <!-- Education History Timeline (SMP, SMK, Kuliah) -->
  <section class="education" id="education">
    <div class="container">
      <div class="text-center">
        <span class="section-tag">Riwayat Pendidikan</span>
        <h2 class="section-title">Jejak Langkah Perjalanan Akademis</h2>
        <p class="section-subtitle mx-auto">
          Pendidikan resmi dari tingkat sekolah menengah pertama hingga perguruan tinggi yang membentuk pondasi keahlian saya.
        </p>
      </div>

      <div class="timeline">
        @foreach($education as $edu)
          <div class="timeline-item">
            <div class="timeline-dot" style="border-color: {{ $edu['badge_color'] }};"></div>
            <div class="glass-card timeline-content">
              <div style="display: flex; align-items: center; gap: 18px; margin-bottom: 20px;">
                @if($edu['logo'])
                  <img src="{{ asset($edu['logo']) }}" alt="{{ $edu['institution'] }}" style="width: 76px; height: 76px; object-fit: contain; background: rgba(255, 255, 255, 0.12); padding: 8px; border-radius: 16px; border: 1.5px solid var(--border-glow); box-shadow: 0 8px 25px rgba(0,0,0,0.4); flex-shrink: 0;">
                @else
                  <div style="width: 68px; height: 68px; background: rgba(99,102,241,0.15); border-radius: 16px; display: flex; align-items: center; justify-content: center; color: var(--accent-primary); border: 1.5px solid var(--border-glow); flex-shrink: 0;">
                    <i class="fas fa-graduation-cap" style="font-size: 1.8rem;"></i>
                  </div>
                @endif
                <div>
                  <span class="edu-badge" style="border-color: {{ $edu['badge_color'] }}; color: {{ $edu['badge_color'] }}; margin-bottom: 6px;">
                    {{ $edu['period'] }}
                  </span>
                  <h4 style="margin-top: 4px; font-size: 1.15rem; color: var(--text-main); font-weight: 700;">{{ $edu['institution'] }}</h4>
                </div>
              </div>
              <h3>{{ $edu['title'] }}</h3>
              <p>{{ $edu['description'] }}</p>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- Experience Section -->
  <section class="experience" id="experience">
    <div class="container">
      <div class="text-center">
        <span class="section-tag">Pengalaman Kerja & Karir</span>
        <h2 class="section-title">Pengalaman Profesional</h2>
        <p class="section-subtitle mx-auto">
          Pengalaman berharga bekerja di berbagai perusahaan teknologi dan proyek skala besar.
        </p>
      </div>

      <div class="timeline">
        @foreach($experience as $exp)
          <div class="timeline-item">
            <div class="timeline-dot" style="border-color: {{ $exp['color'] }};"></div>
            <div class="glass-card timeline-content">
              <div style="display: flex; align-items: center; gap: 18px; margin-bottom: 20px;">
                @if(!empty($exp['logo']))
                  <img src="{{ asset($exp['logo']) }}" alt="{{ $exp['company'] }}" style="width: 76px; height: 76px; object-fit: contain; background: rgba(255, 255, 255, 0.12); padding: 8px; border-radius: 16px; border: 1.5px solid var(--border-glow); box-shadow: 0 8px 25px rgba(0,0,0,0.4); flex-shrink: 0;">
                @else
                  <div style="width: 68px; height: 68px; background: rgba(99,102,241,0.15); border-radius: 16px; display: flex; align-items: center; justify-content: center; color: var(--accent-primary); border: 1.5px solid var(--border-glow); flex-shrink: 0;">
                    <i class="fas fa-briefcase" style="font-size: 1.8rem;"></i>
                  </div>
                @endif
                <div>
                  <span class="edu-badge" style="border-color: {{ $exp['color'] }}; color: {{ $exp['color'] }}; margin-bottom: 6px;">
                    {{ $exp['period'] }}
                  </span>
                  <h4 style="margin-top: 4px; font-size: 1.15rem; color: var(--text-main); font-weight: 700;">{{ $exp['company'] }}</h4>
                </div>
              </div>

              <h3 style="font-size: 1.3rem; margin-bottom: 10px;">{{ $exp['role'] }}</h3>
              <p style="margin-bottom: 18px;">{{ $exp['description'] }}</p>

              {{-- Render Multiple Attachments / Sertifikat / Bukti Kegiatan (LinkedIn Sub-Timeline) --}}
              @if($exp->attachments->count() > 0)
                @php
                  $hasMultipleSubItems = $exp->attachments->count() > 1 || 
                    ($exp->attachments->count() === 1 && !empty($exp->attachments->first()->subtitle) && $exp->attachments->first()->title !== $exp['role']);
                @endphp

                @if($hasMultipleSubItems)
                  <div class="linkedin-sub-timeline">
                    @foreach($exp->attachments as $att)
                      <div class="linkedin-sub-item">
                        <div class="linkedin-sub-bullet"></div>
                        <div class="linkedin-sub-content">
                          <h4 class="linkedin-sub-title">{{ $att->title }}</h4>
                          @if(!empty($att->subtitle))
                            <span class="linkedin-sub-period">{{ $att->subtitle }}</span>
                          @endif
                          @if(!empty($att->description) && trim($att->description) !== trim($exp['description']))
                            <p class="linkedin-sub-desc">{{ $att->description }}</p>
                          @endif

                          @if(!empty($att->image))
                            <div class="exp-attachment-card"
                                 data-img="{{ asset($att->image) }}"
                                 data-title="{{ $att->title }}"
                                 data-desc="{{ $att->description ?: $exp['description'] }}">
                              <div class="exp-attachment-img-wrapper">
                                <img src="{{ asset($att->image) }}" alt="{{ $att->title }}" class="exp-attachment-img">
                                <div class="exp-attachment-zoom">
                                  <i class="fas fa-search-plus"></i>
                                </div>
                              </div>
                              <div class="exp-attachment-info">
                                <h5>{{ $att->title }}</h5>
                                <span class="exp-attachment-link"><i class="fas fa-expand"></i> Klik untuk memperbesar foto sertifikat</span>
                              </div>
                            </div>
                          @endif
                        </div>
                      </div>
                    @endforeach
                  </div>
                @else
                  {{-- Single Attachment preview card directly under description without extra duplicate sub-timeline header --}}
                  @foreach($exp->attachments as $att)
                    @if(!empty($att->image))
                      <div class="exp-attachment-card"
                           data-img="{{ asset($att->image) }}"
                           data-title="{{ $att->title }}"
                           data-desc="{{ $exp['description'] }}">
                        <div class="exp-attachment-img-wrapper">
                          <img src="{{ asset($att->image) }}" alt="{{ $att->title }}" class="exp-attachment-img">
                          <div class="exp-attachment-zoom">
                            <i class="fas fa-search-plus"></i>
                          </div>
                        </div>
                        <div class="exp-attachment-info">
                          <h5>{{ $att->title }}</h5>
                          @if(!empty($att->subtitle))
                            <span style="font-size: 0.8rem; color: var(--text-muted); display: block; margin-bottom: 4px;">{{ $att->subtitle }}</span>
                          @endif
                          <span class="exp-attachment-link"><i class="fas fa-expand"></i> Klik untuk memperbesar foto sertifikat</span>
                        </div>
                      </div>
                    @endif
                  @endforeach
                @endif
              @elseif(!empty($exp['image']))
                <!-- Fallback for single image -->
                <div class="exp-attachment-card"
                     data-img="{{ asset($exp['image']) }}"
                     data-title="{{ $exp['attachment_title'] ?: ($exp['role'] . ' — Sertifikat Magang') }}"
                     data-desc="{{ $exp['description'] }}">
                  <div class="exp-attachment-img-wrapper">
                    <img src="{{ asset($exp['image']) }}" alt="{{ $exp['attachment_title'] ?? $exp['role'] }}" class="exp-attachment-img">
                    <div class="exp-attachment-zoom">
                      <i class="fas fa-search-plus"></i>
                    </div>
                  </div>
                  <div class="exp-attachment-info">
                    <h5>{{ $exp['attachment_title'] ?: ($exp['role'] . ' — Sertifikat Magang') }}</h5>
                    <span class="exp-attachment-link"><i class="fas fa-expand"></i> Klik untuk memperbesar foto sertifikat</span>
                  </div>
                </div>
              @endif
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- Certificates & Awards Section -->
  <section class="certificates" id="certificates">
    <div class="container">
      <div class="text-center">
        <span class="section-tag">Sertifikat & Penghargaan</span>
        <h2 class="section-title">Bukti Kompetensi & Prestasi Resmi</h2>
        <p class="section-subtitle mx-auto">
          Klik pada kartu sertifikat di bawah ini untuk melihat detail dalam mode fullscreen lightbox.
        </p>
      </div>

      <!-- Certificates Carousel -->
      <div class="certs-carousel-wrapper">
        <button class="carousel-arrow carousel-prev" id="certPrev" aria-label="Previous">
          <i class="fas fa-chevron-left"></i>
        </button>

        <div class="certs-carousel" id="certsCarousel">
          @foreach($certificates as $index => $cert)
            <div class="glass-card cert-card" data-index="{{ $index }}">
              <div class="cert-img-wrapper">
                <img src="{{ $cert['image'] }}" alt="{{ $cert['title'] }}" class="cert-img">
                <div class="cert-overlay">
                  <span class="btn btn-sm btn-primary">
                    <i class="fas fa-search-plus"></i> View Certificate
                  </span>
                </div>
              </div>
              <div class="cert-info">
                <h3>{{ $cert['title'] }}</h3>
                <p>Penerbit: {{ $cert['issuer'] }}</p>
              </div>
            </div>
          @endforeach
        </div>

        <button class="carousel-arrow carousel-next" id="certNext" aria-label="Next">
          <i class="fas fa-chevron-right"></i>
        </button>
      </div>

      <!-- Dot Indicators -->
      <div class="carousel-dots" id="certDots">
        @foreach($certificates as $index => $cert)
          <button class="carousel-dot {{ $index === 0 ? 'active' : '' }}" data-index="{{ $index }}" aria-label="Slide {{ $index + 1 }}"></button>
        @endforeach
      </div>
    </div>
  </section>

  <!-- Projects Portfolio Section -->
  <section class="projects" id="projects">
    <div class="container">
      <div class="text-center">
        <span class="section-tag">Portofolio Proyek</span>
        <h2 class="section-title">Karya & Proyek Unggulan</h2>
        <p class="section-subtitle mx-auto">
          Daftar proyek terbaik yang dikerjakan dengan standar industri modern.
        </p>
      </div>

      <!-- Project Category Filters -->
      <div class="project-filters">
        <button class="filter-btn active" data-filter="all">Semua Proyek</button>
        <button class="filter-btn" data-filter="web">Web Application</button>
        <button class="filter-btn" data-filter="copywriting">Copywriting</button>
      </div>

      <div class="projects-grid">
        @foreach($projects as $project)
          <div class="project-card" data-category="{{ $project['category'] }}">
            <div class="glass-card project-card-inner">
              <div class="project-img-box">
                <img src="{{ $project['image'] }}" alt="{{ $project['title'] }}">
              </div>
              <div class="project-tags">
                @foreach($project['tags'] as $tag)
                  <span class="tag">{{ $tag }}</span>
                @endforeach
              </div>
              <h3 class="project-title">{{ $project['title'] }}</h3>
              <p class="project-desc">{{ $project['description'] }}</p>
              <div class="project-links">
                <button class="btn btn-sm btn-primary view-project-btn">
                  <i class="fas fa-eye"></i> Detail
                </button>
                <a href="{{ $project['github'] }}" class="btn btn-sm btn-outline" target="_blank">
                  <i class="fab fa-github"></i> Source
                </a>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- Skills Section -->
  <!-- Skills / Tech Logos Section -->
  <section class="skills" id="skills">
    <div class="container">
      <div class="text-center">
        <span class="section-tag">Keahlian & Teknologi</span>
        <h2 class="section-title">Teknologi yang Saya Kuasai</h2>
        <p class="section-subtitle mx-auto">
          Alat, framework, dan teknologi pilihan yang saya gunakan dalam mengembangkan proyek dan infrastruktur.
        </p>
      </div>

      <div class="tech-logos-grid">
        @foreach($skills as $skill)
          <div class="tech-logo-card glass-card">
            <div class="tech-logo-icon">
              @if($skill->image)
                <img src="{{ asset($skill->image) }}" alt="{{ $skill->name }}" style="width: 48px; height: 48px; object-fit: contain;">
              @elseif($skill->icon_class)
                <i class="{{ $skill->icon_class }}"></i>
              @else
                <i class="fas fa-code" style="color: var(--accent-primary);"></i>
              @endif
            </div>
            <h3 class="tech-logo-title">{{ $skill->name }}</h3>
            <span class="tech-logo-tag">{{ $skill->category }}</span>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- Contact Section -->
  <section class="contact" id="contact">
    <div class="container">
      <div class="text-center">
        <span class="section-tag">Hubungi Saya</span>
        <h2 class="section-title">Mari Berkolaborasi & Diskusi Proyek</h2>
        <p class="section-subtitle mx-auto">
          Punya ide menarik atau butuh bantuan pengembang profesional? Kirimkan pesan di bawah ini!
        </p>
      </div>

      <div class="contact-grid">
        <div class="glass-card contact-info-card">
          <h3>Informasi Kontak</h3>
          <p style="color: var(--text-muted); font-size: 0.95rem;">
            {{ $profile['contact_intro'] ?: 'Saya siap merespons pesan Anda secepatnya. Mari diskusikan proyek impian Anda!' }}
          </p>

          @if($profile['email'])
          <div class="contact-item">
            <div class="contact-icon">
              <i class="fas fa-envelope"></i>
            </div>
            <div class="contact-text">
              <h4>Email</h4>
              <p>{{ $profile['email'] }}</p>
            </div>
          </div>
          @endif

          @if($profile['phone'])
          <div class="contact-item">
            <div class="contact-icon" style="color: var(--accent-emerald); border-color: var(--accent-emerald);">
              <i class="fab fa-whatsapp"></i>
            </div>
            <div class="contact-text">
              <h4>WhatsApp / Phone</h4>
              <p>{{ $profile['phone'] }}</p>
            </div>
          </div>
          @endif

          @if($profile['location'])
          <div class="contact-item">
            <div class="contact-icon" style="color: var(--accent-cyan); border-color: var(--accent-cyan);">
              <i class="fas fa-map-marker-alt"></i>
            </div>
            <div class="contact-text">
              <h4>Lokasi</h4>
              <p>{{ $profile['location'] }}</p>
            </div>
          </div>
          @endif

          <div style="display: flex; gap: 14px; margin-top: 10px; flex-wrap: wrap;">
            @if($profile['github_url'])
            <a href="{{ $profile['github_url'] }}" target="_blank" class="btn btn-outline btn-sm" title="GitHub">
              <i class="fab fa-github"></i> GitHub
            </a>
            @endif
            @if($profile['linkedin_url'])
            <a href="{{ $profile['linkedin_url'] }}" target="_blank" class="btn btn-outline btn-sm" title="LinkedIn">
              <i class="fab fa-linkedin"></i> LinkedIn
            </a>
            @endif
          </div>
        </div>


        <!-- Interactive AJAX Contact Form -->
        <div class="glass-card">
          <form class="contact-form" id="contact-form" action="{{ route('portfolio.contact') }}" method="POST">
            @csrf
            <div class="form-group">
              <label for="form-name">Nama Lengkap</label>
              <input type="text" id="form-name" name="name" class="form-control" placeholder="Masukkan nama Anda..." required>
            </div>
            <div class="form-group">
              <label for="form-email">Alamat Email</label>
              <input type="email" id="form-email" name="email" class="form-control" placeholder="nama@email.com" required>
            </div>
            <div class="form-group">
              <label for="form-message">Pesan / Penawaran Proyek</label>
              <textarea id="form-message" name="message" class="form-control" placeholder="Tuliskan detail pesan atau proyek Anda..." required></textarea>
            </div>
            <button type="submit" class="btn btn-primary" style="width: 100%;">
              <span>Kirim Pesan</span>
              <i class="fas fa-paper-plane"></i>
            </button>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- Lightbox Modal for Certificate / Project Detail -->
  <div class="modal-overlay" id="modal-overlay">
    <div class="modal-content">
      <button class="modal-close" id="modal-close">&times;</button>
      <img src="" alt="Modal Detail" class="modal-img" id="modal-img">
      <h3 id="modal-title" style="font-size: 1.5rem; margin-bottom: 10px;"></h3>
      <p id="modal-desc" style="color: var(--text-muted); line-height: 1.7;"></p>
    </div>
  </div>

@endsection

@push('scripts')
<script>
  // Handle Contact Form submission via Laravel AJAX endpoint
  document.getElementById('contact-form').addEventListener('submit', function(e) {
    e.preventDefault();
    const form = this;
    const formData = new FormData(form);
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch(form.action, {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': csrfToken,
        'Accept': 'application/json'
      },
      body: formData
    })
    .then(response => response.json().then(data => ({ status: response.status, body: data })))
    .then(res => {
      if (res.status === 200 && res.body.status === 'success') {
        const container = document.getElementById('toast-container');
        if (container) {
          const toast = document.createElement('div');
          toast.className = 'toast';
          toast.innerHTML = `<i class="fas fa-check-circle" style="color:#10b981;"></i> <span>${res.body.message}</span>`;
          container.appendChild(toast);
          setTimeout(() => toast.remove(), 4000);
        }
        form.reset();
      } else {
        alert(res.body.message || 'Terjadi kesalahan saat mengiring pesan.');
      }
    })
    .catch(err => {
      console.error(err);
      alert('Gagal mengirim pesan.');
    });
  });
</script>
@endpush
