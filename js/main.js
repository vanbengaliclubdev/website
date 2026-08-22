document.addEventListener("DOMContentLoaded", () => {
  const preloader = document.getElementById("preloader");
  const nav = document.getElementById("mainNav");
  const backTop = document.getElementById("backToTop");
  const form = document.getElementById("contactForm");
  const toast = document.getElementById("formToast");

  window.addEventListener("load", () => {
    setTimeout(() => preloader.classList.add("loaded"), 350);
  });

  // Navbar shadow + active section state
  const sections = [...document.querySelectorAll("main section[id]")];
  const navLinks = [...document.querySelectorAll('.navbar-nav .nav-link[href^="#"]')];

  function updateScrollUI() {
    nav.classList.toggle("nav-scrolled", window.scrollY > 30);
    backTop.classList.toggle("show", window.scrollY > 500);

    const current = sections
      .filter(section => window.scrollY >= section.offsetTop - 150)
      .pop();

    if (current) {
      navLinks.forEach(link => {
        link.classList.toggle("active", link.getAttribute("href") === "#" + current.id);
      });
    }
  }

  window.addEventListener("scroll", updateScrollUI, { passive: true });
  updateScrollUI();

  // Reveal-on-scroll
  const revealItems = document.querySelectorAll(".reveal");
  const revealObserver = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add("visible");
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.12 });

  revealItems.forEach(item => revealObserver.observe(item));

  // Counters
  const counters = document.querySelectorAll(".counter");
  const counterObserver = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
      if (!entry.isIntersecting) return;
      const counter = entry.target;
      const target = Number(counter.dataset.target || 0);
      let value = 0;
      const step = Math.max(1, Math.ceil(target / 25));

      const tick = () => {
        value += step;
        if (value >= target) {
          counter.textContent = target;
          return;
        }
        counter.textContent = value;
        requestAnimationFrame(tick);
      };
      tick();
      observer.unobserve(counter);
    });
  }, { threshold: 0.7 });

  counters.forEach(counter => counterObserver.observe(counter));

  // Back to top
  backTop.addEventListener("click", () => window.scrollTo({ top: 0, behavior: "smooth" }));

  // Demo contact form
  form.addEventListener("submit", (e) => {
    e.preventDefault();
    toast.classList.add("show");
    form.reset();
    setTimeout(() => toast.classList.remove("show"), 4200);
  });

  // Subtle parallax for hero art
  const heroArt = document.querySelector(".hero-art");
  if (heroArt && !window.matchMedia("(prefers-reduced-motion: reduce)").matches) {
    window.addEventListener("mousemove", (e) => {
      const x = (e.clientX / window.innerWidth - 0.5) * 8;
      const y = (e.clientY / window.innerHeight - 0.5) * 8;
      heroArt.style.transform = `translate3d(${x}px, ${y}px, 0)`;
    }, { passive: true });
  }

  // Auto-scrolling board-member row
  const leadershipTrack = document.getElementById("leadershipCards");
  const reducedMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

  if (leadershipTrack && !reducedMotion) {
    let leadershipTimer;
    let restartTimer;

    const stopLeadershipScroll = () => {
      window.clearInterval(leadershipTimer);
      window.clearTimeout(restartTimer);
    };

    const advanceLeadershipScroll = () => {
      const firstCard = leadershipTrack.querySelector(".leadership-item");
      if (!firstCard) return;

      const gap = Number.parseFloat(getComputedStyle(leadershipTrack).gap) || 0;
      const step = firstCard.getBoundingClientRect().width + gap;
      const maxScroll = leadershipTrack.scrollWidth - leadershipTrack.clientWidth;
      const atEnd = leadershipTrack.scrollLeft >= maxScroll - 4;

      leadershipTrack.scrollTo({
        left: atEnd ? 0 : Math.min(leadershipTrack.scrollLeft + step, maxScroll),
        behavior: "smooth"
      });
    };

    const startLeadershipScroll = () => {
      stopLeadershipScroll();
      leadershipTimer = window.setInterval(advanceLeadershipScroll, 3000);
    };

    const restartLeadershipScroll = () => {
      stopLeadershipScroll();
      restartTimer = window.setTimeout(startLeadershipScroll, 3000);
    };

    leadershipTrack.addEventListener("mouseenter", stopLeadershipScroll);
    leadershipTrack.addEventListener("mouseleave", startLeadershipScroll);
    leadershipTrack.addEventListener("focusin", stopLeadershipScroll);
    leadershipTrack.addEventListener("focusout", (event) => {
      if (!leadershipTrack.contains(event.relatedTarget)) startLeadershipScroll();
    });
    leadershipTrack.addEventListener("pointerdown", stopLeadershipScroll);
    leadershipTrack.addEventListener("pointerup", restartLeadershipScroll);
    leadershipTrack.addEventListener("pointercancel", restartLeadershipScroll);

    document.addEventListener("visibilitychange", () => {
      if (document.hidden) stopLeadershipScroll();
      else startLeadershipScroll();
    });

    startLeadershipScroll();
  }
});

// =====================================================
// MOBILE OFFCANVAS MENU NAVIGATION FIX
// =====================================================

const mobileNav = document.getElementById("mobileNav");

if (mobileNav) {

    const mobileMenuLinks = mobileNav.querySelectorAll(
        '.mobile-links a[href^="#"], .mobile-cta a[href^="#"]'
    );

    mobileMenuLinks.forEach(link => {

        link.addEventListener("click", function (e) {

            const targetId = this.getAttribute("href");

            if (!targetId || targetId === "#") {
                return;
            }

            const targetSection = document.querySelector(targetId);

            if (!targetSection) {
                return;
            }

            // Stop Bootstrap's default anchor/dismiss behaviour
            e.preventDefault();

            // Get Bootstrap offcanvas instance
            const offcanvasInstance =
                bootstrap.Offcanvas.getInstance(mobileNav) ||
                new bootstrap.Offcanvas(mobileNav);

            // Close offcanvas first
            offcanvasInstance.hide();

            // Wait until offcanvas is completely closed
            mobileNav.addEventListener(
                "hidden.bs.offcanvas",
                function scrollToSection() {

                    mobileNav.removeEventListener(
                        "hidden.bs.offcanvas",
                        scrollToSection
                    );

                    const navbar = document.getElementById("mainNav");
                    const navbarHeight = navbar
                        ? navbar.offsetHeight
                        : 0;

                    const targetPosition =
                        targetSection.getBoundingClientRect().top +
                        window.pageYOffset -
                        navbarHeight;

                    window.scrollTo({
                        top: targetPosition,
                        behavior: "smooth"
                    });

                    // Update URL hash
                    history.pushState(null, "", targetId);

                },
                { once: true }
            );

        });

    });

}
