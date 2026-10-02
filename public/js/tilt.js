/* ==========================================================================
   3D CARD TILT INTERACTIVE EFFECT
   Adds dynamic 3D perspective rotation on hover for Project Cards & Skill Cards
   ========================================================================== */

(function () {
  function applyTilt(elements) {
    elements.forEach((card) => {
      card.addEventListener('mousemove', (e) => {
        const rect = card.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;

        const centerX = rect.width / 2;
        const centerY = rect.height / 2;

        const rotateX = ((y - centerY) / centerY) * -10;
        const rotateY = ((x - centerX) / centerX) * 10;

        card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale3d(1.02, 1.02, 1.02)`;
        card.style.transition = 'transform 0.1s ease-out';
      });

      card.addEventListener('mouseleave', () => {
        card.style.transform = 'perspective(1000px) rotateX(0deg) rotateY(0deg) scale3d(1, 1, 1)';
        card.style.transition = 'transform 0.5s cubic-bezier(0.16, 1, 0.3, 1)';
      });
    });
  }

  window.initTiltEffect = function () {
    const tiltCards = document.querySelectorAll('.tilt-card, .project-card, .cert-card');
    applyTilt(tiltCards);
  };

  document.addEventListener('DOMContentLoaded', window.initTiltEffect);
})();
