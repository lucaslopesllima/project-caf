import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    const theme = localStorage.getItem('theme') || 'light';
    document.documentElement.setAttribute('data-theme', theme);

    let logoLight = document.getElementById('logo-light');
    let logoDark = document.getElementById('logo-dark');

    if (logoLight && logoDark) {
        trocaLogo(theme, logoLight, logoDark);
    }
});

document.getElementById('theme').addEventListener('click', function () {
    let theme = localStorage.getItem('theme') || 'light';

    theme = theme === 'light' ? 'dark' : 'light';
    localStorage.setItem('theme', theme);
    document.documentElement.setAttribute('data-theme', theme);

    let logoLight = document.getElementById('logo-light');
    let logoDark = document.getElementById('logo-dark');

    if (logoLight && logoDark) {
        trocaLogo(theme, logoLight, logoDark);
    }
});

function trocaLogo(theme, logoLight, logoDark) {
    if (theme === 'dark') {
        logoLight.style.display = 'block';
        logoDark.style.display = 'none';
    } else {
        logoLight.style.display = 'none';
        logoDark.style.display = 'block';
    }
}


const sidebar = document.getElementById('sidebar');
const menuToggle = document.getElementById('menu-toggle');
const closeMenu = document.getElementById('close-toggle');

menuToggle.addEventListener('click', function(e) {
    e.stopPropagation();
    sidebar.classList.toggle('-translate-x-full');
});

closeMenu.addEventListener('click', function(e) {
    e.stopPropagation();
    sidebar.classList.add('-translate-x-full');
});

document.addEventListener('click', function(e) {
    if (!sidebar.contains(e.target) && !menuToggle.contains(e.target)) {
        sidebar.classList.add('-translate-x-full');
    }
});