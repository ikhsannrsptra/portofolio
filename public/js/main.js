/* ==========================================================================
   MAIN APPLICATION LOGIC & INTERACTION CONTROLLER
   ========================================================================== */

document.addEventListener('DOMContentLoaded', () => {
  // --- 1. Custom Interactive Cursor ---
  const cursorDot = document.getElementById('custom-cursor');
  const cursorFollower = document.getElementById('cursor-follower');

  if (cursorDot && cursorFollower && window.innerWidth >= 1024) {
    let mouseX = 0, mouseY = 0;
    let followerX = 0, followerY = 0;

    window.addEventListener('mousemove', (e) => {
      mouseX = e.clientX;
      mouseY = e.clientY;

      cursorDot.style.left = `${mouseX}px`;
      cursorDot.style.top = `${mouseY}px`;
    });

    function animateFollower() {
      followerX += (mouseX - followerX) * 0.15;
      followerY += (mouseY - followerY) * 0.15;

      cursorFollower.style.left = `${followerX}px`;
      cursorFollower.style.top = `${followerY}px`;

      requestAnimationFrame(animateFollower);
    }
    animateFollower();

    // Hover effect on interactive elements
    const hoverElements = document.querySelectorAll('a, button, .project-card, .cert-card, .filter-btn, .tab-btn');
    hoverElements.forEach((el) => {
      el.addEventListener('mouseenter', () => document.body.classList.add('cursor-hover'));
      el.addEventListener('mouseleave', () => document.body.classList.remove('cursor-hover'));
    });
  }

  // --- 2. Typewriter Effect ---
  const typedTextElement = document.getElementById('typed-text');
  if (typedTextElement) {
    let phrases = [
      'Network Engineer',
      'Full-Stack Developer',
      'UI/UX Specialist',
      'Software Engineer'
    ];
    if (typedTextElement.dataset.roles) {
      try {
        const parsed = JSON.parse(typedTextElement.dataset.roles);
        if (Array.isArray(parsed) && parsed.length > 0) {
          phrases = parsed;
        }
      } catch (e) {}
    }
    let phraseIndex = 0;
    let charIndex = 0;
    let isDeleting = false;
    let typeSpeed = 100;

    function type() {
      const currentPhrase = phrases[phraseIndex];

      if (isDeleting) {
        typedTextElement.textContent = currentPhrase.substring(0, charIndex - 1);
        charIndex--;
        typeSpeed = 50;
      } else {
        typedTextElement.textContent = currentPhrase.substring(0, charIndex + 1);
        charIndex++;
        typeSpeed = 100;
      }

      if (!isDeleting && charIndex === currentPhrase.length) {
        isDeleting = true;
        typeSpeed = 1800; // Pause at end
      } else if (isDeleting && charIndex === 0) {
        isDeleting = false;
        phraseIndex = (phraseIndex + 1) % phrases.length;
        typeSpeed = 400; // Pause before new phrase
      }

      setTimeout(type, typeSpeed);
    }

    type();
  }

  // --- 3. Web Audio API Sound Synthesizer ---
  let soundEnabled = true;
  const soundToggleBtn = document.getElementById('sound-toggle');

  function playUiClickSound(freq = 600, duration = 0.05) {
    if (!soundEnabled) return;
    try {
      const AudioCtx = window.AudioContext || window.webkitAudioContext;
      if (!AudioCtx) return;
      const ctx = new AudioCtx();
      const osc = ctx.createOscillator();
      const gain = ctx.createGain();

      osc.type = 'sine';
      osc.frequency.setValueAtTime(freq, ctx.currentTime);
      osc.frequency.exponentialRampToValueAtTime(freq / 2, ctx.currentTime + duration);

      gain.gain.setValueAtTime(0.08, ctx.currentTime);
      gain.gain.exponentialRampToValueAtTime(0.001, ctx.currentTime + duration);

      osc.connect(gain);
      gain.connect(ctx.destination);

      osc.start();
      osc.stop(ctx.currentTime + duration);
    } catch (e) {
      // Audio context might be restricted before user interaction
    }
  }

  if (soundToggleBtn) {
    soundToggleBtn.addEventListener('click', () => {
      soundEnabled = !soundEnabled;
      soundToggleBtn.innerHTML = soundEnabled ? '<i class="fas fa-volume-up"></i>' : '<i class="fas fa-volume-mute"></i>';
      showToast(soundEnabled ? 'Suara UI diaktifkan' : 'Suara UI dinonaktifkan');
    });
  }

  // Global click sound on buttons
  document.querySelectorAll('.btn, .nav-link, .filter-btn, .tab-btn').forEach((btn) => {
    btn.addEventListener('click', () => playUiClickSound(750, 0.06));
  });

  // --- 4. Theme Switcher (Dark / Light) ---
  const themeToggleBtn = document.getElementById('theme-toggle');
  const savedTheme = localStorage.getItem('theme') || 'dark';

  if (savedTheme === 'light') {
    document.documentElement.setAttribute('data-theme', 'light');
    if (themeToggleBtn) themeToggleBtn.innerHTML = '<i class="fas fa-sun"></i>';
  }

  if (themeToggleBtn) {
    themeToggleBtn.addEventListener('click', () => {
      const currentTheme = document.documentElement.getAttribute('data-theme');
      const newTheme = currentTheme === 'light' ? 'dark' : 'light';

      document.documentElement.setAttribute('data-theme', newTheme);
      localStorage.setItem('theme', newTheme);
      themeToggleBtn.innerHTML = newTheme === 'light' ? '<i class="fas fa-sun"></i>' : '<i class="fas fa-moon"></i>';
      playUiClickSound(900, 0.08);
      showToast(`Tema diganti ke mode ${newTheme.toUpperCase()}`);
    });
  }

  // --- 5. Mobile Navigation Drawer ---
  const mobileToggle = document.getElementById('mobile-toggle');
  const navLinks = document.getElementById('nav-links');

  if (mobileToggle && navLinks) {
    mobileToggle.addEventListener('click', () => {
      navLinks.classList.toggle('active');
    });

    document.querySelectorAll('.nav-link').forEach((link) => {
      link.addEventListener('click', () => navLinks.classList.remove('active'));
    });
  }

  // --- 6. About Tabs ---
  const tabBtns = document.querySelectorAll('.tab-btn');
  const tabPanes = document.querySelectorAll('.tab-pane');

  tabBtns.forEach((btn) => {
    btn.addEventListener('click', () => {
      const target = btn.dataset.tab;

      tabBtns.forEach((b) => b.classList.remove('active'));
      tabPanes.forEach((p) => p.classList.remove('active'));

      btn.classList.add('active');
      const activePane = document.getElementById(target);
      if (activePane) activePane.classList.add('active');
    });
  });

  // --- 7. Skill Bar Progress Animation on Scroll ---
  const skillBars = document.querySelectorAll('.skill-progress');
  const skillObserver = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          const progress = entry.target.dataset.progress;
          entry.target.style.width = `${progress}%`;
          skillObserver.unobserve(entry.target);
        }
      });
    },
    { threshold: 0.2 }
  );

  skillBars.forEach((bar) => skillObserver.observe(bar));

  // --- 8. Project Category Filtering ---
  const filterBtns = document.querySelectorAll('.filter-btn');
  const projectCards = document.querySelectorAll('.project-card');

  filterBtns.forEach((btn) => {
    btn.addEventListener('click', () => {
      filterBtns.forEach((b) => b.classList.remove('active'));
      btn.classList.add('active');

      const filter = btn.dataset.filter;

      projectCards.forEach((card) => {
        const category = card.dataset.category;
        if (filter === 'all' || category === filter) {
          card.style.display = 'block';
          setTimeout(() => {
            card.style.opacity = '1';
            card.style.transform = 'scale(1)';
          }, 50);
        } else {
          card.style.opacity = '0';
          card.style.transform = 'scale(0.9)';
          setTimeout(() => {
            card.style.display = 'none';
          }, 300);
        }
      });
    });
  });

  // --- 9. Modal Lightbox Viewer (Certificates & Projects) ---
  const modalOverlay = document.getElementById('modal-overlay');
  const modalImg = document.getElementById('modal-img');
  const modalTitle = document.getElementById('modal-title');
  const modalDesc = document.getElementById('modal-desc');
  const modalClose = document.getElementById('modal-close');

  function openModal(imgSrc, title, desc) {
    if (!modalOverlay) return;
    if (modalImg) modalImg.src = imgSrc;
    if (modalTitle) modalTitle.textContent = title;
    if (modalDesc) modalDesc.textContent = desc;

    modalOverlay.classList.add('active');
    playUiClickSound(800, 0.08);
  }

  function closeModal() {
    if (!modalOverlay) return;
    modalOverlay.classList.remove('active');
    playUiClickSound(400, 0.05);
  }

  document.querySelectorAll('.cert-card').forEach((card) => {
    let mouseDownX = 0;
    card.addEventListener('mousedown', (e) => { mouseDownX = e.clientX; });
    card.addEventListener('click', (e) => {
      if (Math.abs(e.clientX - mouseDownX) > 8) return; // was a drag, not a click
      const img = card.querySelector('.cert-img').src;
      const title = card.querySelector('h3').textContent;
      const desc = card.querySelector('p').textContent;
      openModal(img, title, desc);
    });
  });

  document.querySelectorAll('.view-project-btn').forEach((btn) => {
    btn.addEventListener('click', (e) => {
      e.stopPropagation();
      const card = btn.closest('.project-card');
      const img = card.querySelector('img').src;
      const title = card.querySelector('.project-title').textContent;
      const desc = card.querySelector('.project-desc').textContent;
      openModal(img, title, desc);
    });
  });

  document.querySelectorAll('.exp-attachment-card').forEach((card) => {
    card.addEventListener('click', (e) => {
      e.stopPropagation();
      const img = card.getAttribute('data-img');
      const title = card.getAttribute('data-title');
      const desc = card.getAttribute('data-desc');
      if (img) {
        openModal(img, title, desc);
      }
    });
  });

  if (modalClose) modalClose.addEventListener('click', closeModal);
  if (modalOverlay) {
    modalOverlay.addEventListener('click', (e) => {
      if (e.target === modalOverlay) closeModal();
    });
  }

  // --- 10. Contact Form Handling & Toast Alert ---
  const contactForm = document.getElementById('contact-form');
  if (contactForm) {
    contactForm.addEventListener('submit', (e) => {
      e.preventDefault();

      const name = document.getElementById('form-name').value;
      const email = document.getElementById('form-email').value;
      const message = document.getElementById('form-message').value;

      if (!name || !email || !message) {
        showToast('Mohon isi semua kolom pesan!');
        return;
      }

      playUiClickSound(1000, 0.12);
      showToast('Pesan berhasil dikirim! Terima kasih.');
      contactForm.reset();
    });
  }

  // Toast Function
  function showToast(message) {
    const container = document.getElementById('toast-container');
    if (!container) return;

    const toast = document.createElement('div');
    toast.className = 'toast';
    toast.innerHTML = `<i class="fas fa-check-circle" style="color:#10b981;"></i> <span>${message}</span>`;

    container.appendChild(toast);

    setTimeout(() => {
      toast.remove();
    }, 4000);
  }

  // Active Link Highlight on Scroll
  const sections = document.querySelectorAll('section');
  window.addEventListener('scroll', () => {
    let current = '';
    sections.forEach((section) => {
      const sectionTop = section.offsetTop - 150;
      if (window.scrollY >= sectionTop) {
        current = section.getAttribute('id');
      }
    });

    document.querySelectorAll('.nav-link').forEach((link) => {
      link.classList.remove('active');
      if (link.getAttribute('href') === `#${current}`) {
        link.classList.add('active');
      }
    });
  });

  // --- Certificates Carousel ---
  const carousel   = document.getElementById('certsCarousel');
  const prevBtn    = document.getElementById('certPrev');
  const nextBtn    = document.getElementById('certNext');
  const dots       = document.querySelectorAll('.carousel-dot');

  if (carousel && prevBtn && nextBtn) {
    const CARD_GAP  = 24;

    function getCardWidth() {
      const first = carousel.querySelector('.cert-card');
      return first ? first.offsetWidth + CARD_GAP : 384;
    }

    function updateDots() {
      const scrollLeft = carousel.scrollLeft;
      const cardW      = getCardWidth();
      const index      = Math.round(scrollLeft / cardW);
      dots.forEach((dot, i) => dot.classList.toggle('active', i === index));
    }

    function updateArrows() {
      prevBtn.disabled = carousel.scrollLeft <= 2;
      nextBtn.disabled = carousel.scrollLeft >= carousel.scrollWidth - carousel.clientWidth - 2;
    }

    prevBtn.addEventListener('click', () => {
      carousel.scrollBy({ left: -getCardWidth(), behavior: 'smooth' });
    });

    nextBtn.addEventListener('click', () => {
      carousel.scrollBy({ left: getCardWidth(), behavior: 'smooth' });
    });

    dots.forEach((dot, i) => {
      dot.addEventListener('click', () => {
        carousel.scrollTo({ left: i * getCardWidth(), behavior: 'smooth' });
      });
    });

    carousel.addEventListener('scroll', () => {
      updateDots();
      updateArrows();
    });

    // Initial state
    updateArrows();
    updateDots();

    // Mouse drag (desktop)
    let isDragging = false, startX = 0, startScroll = 0;

    carousel.addEventListener('mousedown', (e) => {
      isDragging  = true;
      startX      = e.pageX;
      startScroll = carousel.scrollLeft;
      carousel.style.cursor = 'grabbing';
    });

    document.addEventListener('mouseup', () => {
      if (isDragging) {
        isDragging = false;
        carousel.style.cursor = '';
      }
    });

    document.addEventListener('mousemove', (e) => {
      if (!isDragging) return;
      e.preventDefault();
      const delta = startX - e.pageX;
      carousel.scrollLeft = startScroll + delta;
    });

    // Touch swipe (mobile)
    let touchStartX = 0;
    carousel.addEventListener('touchstart', (e) => {
      touchStartX = e.touches[0].clientX;
    }, { passive: true });

    carousel.addEventListener('touchend', (e) => {
      const diff = touchStartX - e.changedTouches[0].clientX;
      if (Math.abs(diff) > 50) {
        carousel.scrollBy({ left: diff > 0 ? getCardWidth() : -getCardWidth(), behavior: 'smooth' });
      }
    }, { passive: true });
  }
});
