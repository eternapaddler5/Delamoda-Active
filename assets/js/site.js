// Delamoda Active — site interactions
document.addEventListener('DOMContentLoaded', () => {
    const nav = document.getElementById('site-nav');
    const menuBtn = document.getElementById('mobile-menu-btn');
    const menuClose = document.getElementById('mobile-menu-close');
    const menu = document.getElementById('mobile-menu');
    const backdrop = document.getElementById('mobile-menu-backdrop');

    function openMenu() {
        menu?.classList.add('open');
        backdrop?.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeMenu() {
        menu?.classList.remove('open');
        backdrop?.classList.add('hidden');
        document.body.style.overflow = '';
    }

    menuBtn?.addEventListener('click', openMenu);
    menuClose?.addEventListener('click', closeMenu);
    backdrop?.addEventListener('click', closeMenu);

    document.querySelectorAll('#mobile-menu a').forEach(link => {
        link.addEventListener('click', closeMenu);
    });

    if (nav && nav.classList.contains('bg-transparent')) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 60) {
                nav.classList.add('scrolled', 'bg-zinc-950');
                nav.classList.remove('bg-transparent');
            } else {
                nav.classList.remove('scrolled', 'bg-zinc-950');
                nav.classList.add('bg-transparent');
            }
        });
    }

    const reveals = document.querySelectorAll('.reveal');
    if (reveals.length) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });

        reveals.forEach(el => observer.observe(el));
    }
});
