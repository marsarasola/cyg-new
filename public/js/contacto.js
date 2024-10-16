// Navegación fija al hacer scroll
const header = document.querySelector('.header');
const navbar = document.querySelector('.navbar');
const navbarBrand = document.querySelector('.navbar-brand img');
let lastScrollTop = 0;

window.addEventListener('scroll', () => {
    let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    if (scrollTop > lastScrollTop) {
        header.style.top = '-80px'; // Oculta la navbar
    } else {
        header.style.top = '0';
        if (scrollTop > 50) {
            navbar.style.padding = '0.3rem 2rem';
            navbarBrand.style.maxHeight = '50px';
        } else {
            navbar.style.padding = '0.5rem 2rem';
            navbarBrand.style.maxHeight = '60px';
        }
    }
    lastScrollTop = scrollTop;
});

// Navegación responsive
const navbarToggler = document.querySelector('.navbar-toggler');
const navbarCollapse = document.querySelector('.navbar-collapse');

navbarToggler.addEventListener('click', () => {
    navbarCollapse.classList.toggle('show');
});

const navLinks = document.querySelectorAll('.nav-link');
navLinks.forEach(link => {
    link.addEventListener('click', () => {
        navbarCollapse.classList.remove('show');
    });
});

// Botón "Volver arriba"
const scrollToTopButton = document.getElementById('scrollToTop');
scrollToTopButton.addEventListener('click', () => {
    window.scrollTo({
        top: 0,
        behavior: 'smooth' // Suave deslizamiento hacia arriba
    });
});