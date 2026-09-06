document.addEventListener('DOMContentLoaded', () => {
    const sidebar = document.getElementById('admin-sidebar');
    const backdrop = document.getElementById('admin-sidebar-backdrop');
    const openBtn = document.getElementById('admin-menu-open');
    const closeBtn = document.getElementById('admin-menu-close');

    function openSidebar() {
        sidebar?.classList.add('open');
        backdrop?.classList.remove('hidden');
    }

    function closeSidebar() {
        sidebar?.classList.remove('open');
        backdrop?.classList.add('hidden');
    }

    openBtn?.addEventListener('click', openSidebar);
    closeBtn?.addEventListener('click', closeSidebar);
    backdrop?.addEventListener('click', closeSidebar);

    document.querySelectorAll('#admin-sidebar a[href*="#"]').forEach(link => {
        link.addEventListener('click', () => {
            if (window.innerWidth < 1024) closeSidebar();
        });
    });
});
