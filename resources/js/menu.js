document.addEventListener('DOMContentLoaded', () => {
  const hamburgerBtn = document.getElementById('hamburger-btn');
  const userMenuSide = document.getElementById('user-menu-side');
  const closeUserMenuBtn = document.getElementById('user-menu-close-btn');
  const userMenuLinks = userMenuSide
    ? userMenuSide.querySelectorAll('a, button[type="submit"]')
    : [];

  const toggleUserMenu = () => {
    if (!userMenuSide) return;

    userMenuSide.classList.toggle('open');
    document.body.classList.toggle('menu-open');
  };

  const closeUserMenu = () => {
    if (!userMenuSide) return;

    userMenuSide.classList.remove('open');
    document.body.classList.remove('menu-open');
  };

  hamburgerBtn?.addEventListener('click', toggleUserMenu);
  closeUserMenuBtn?.addEventListener('click', closeUserMenu);

  userMenuLinks.forEach((link) => {
    link.addEventListener('click', closeUserMenu);
  });
});

document.querySelectorAll('.link-to-page').forEach(item => {
    item.addEventListener('click', () => {
        window.location.href = item.dataset.href;
    });
});