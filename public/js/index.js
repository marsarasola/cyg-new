// Función para alternar detalles de los proyectos - fuera de DOMContentLoaded
function toggleDetails(id) {
    const details = document.getElementById(`details-${id}`);
    console.log(`Toggling details for ID: ${id}`);
    if (details.style.display === "none" || details.style.display === "") {
        details.style.display = "block"; // Muestra los detalles
    } else {
        details.style.display = "none"; // Oculta los detalles
    }
}

// Carrusel
const carousel = document.querySelector('.carousel-inner');
const items = carousel.querySelectorAll('.carousel-item');
const prevButton = document.querySelector('.carousel-control.prev');
const nextButton = document.querySelector('.carousel-control.next');
let currentIndex = 0;

function showSlide(index) {
    carousel.style.transform = `translateX(-${index * 100}%)`;
}

function nextSlide() {
    currentIndex = (currentIndex + 1) % items.length;
    showSlide(currentIndex);
}

function prevSlide() {
    currentIndex = (currentIndex - 1 + items.length) % items.length;
    showSlide(currentIndex);
}

prevButton.addEventListener('click', prevSlide);
nextButton.addEventListener('click', nextSlide);

// Auto-avance cada 5 segundos
setInterval(nextSlide, 5000);

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

// Smooth scroll para enlaces internos
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();

        const targetId = this.getAttribute('href').substring(1);
        const targetElement = document.getElementById(targetId);

        if (targetElement) {
            const headerOffset = 80; // Ajusta este valor según la altura de tu navbar
            const elementPosition = targetElement.getBoundingClientRect().top;
            const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

            window.scrollTo({
                top: offsetPosition,
                behavior: 'smooth'
            });
        }
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

function decodeHtmlEntities(text) {
    const textarea = document.createElement('textarea');
    textarea.innerHTML = text;
    return textarea.value;
}


function toggleDetailsFromData(element) {
    // Obtener los valores de los atributos data-*
    const id = element.getAttribute('data-id');
    const title = element.getAttribute('data-title');
    const description = element.getAttribute('data-description');
    const images = JSON.parse(element.getAttribute('data-images')); // Parsing del JSON

    // Llamar a la función original con los datos obtenidos
    toggleDetails(id, title, description, images);
}

function toggleDetails(id, title, description, images) {
    console.log("Project ID:", id);
    console.log("Title:", title);
    console.log("Description:", description);
    console.log("Images:", images);

    // Decodificar entidades HTML antes de asignarlas al modal
    const decodedTitle = decodeHtmlEntities(title);
    const decodedDescription = decodeHtmlEntities(description);

    // Asignar valores al modal
    document.getElementById('modalTitle').innerText = decodedTitle;
    document.getElementById('modalDescription').innerText = decodedDescription;

    // Obtener el contenedor de imágenes y limpiar contenido previo
    const modalImagesContainer = document.getElementById('modalImages');
    modalImagesContainer.innerHTML = ''; // Limpiar imágenes anteriores

    // Insertar imágenes en la cuadrícula
    images.forEach(img => {
        const imgElement = document.createElement('img');
        imgElement.src = `./public/assets/${img}`; // Ajustar la ruta de la imagen
        imgElement.alt = `Imagen de ${decodedTitle}`;
        imgElement.classList.add('grid-image'); // Añadir clase para estilos

        modalImagesContainer.appendChild(imgElement);
    });

    // Mostrar el modal
    document.getElementById('projectModal').style.display = 'flex';
}



// Cerrar el modal
function closeModal() {
    document.getElementById('projectModal').style.display = 'none';
}

// Cerrar el modal al hacer clic fuera del contenido
document.getElementById('projectModal').addEventListener('click', function (event) {
    if (event.target === this) {
        closeModal();
    }
});

function createProjectCard(title, image) {
    const card = document.createElement('div');
    card.classList.add('project-card');

    const imgElement = document.createElement('img');
    imgElement.classList.add('project-image');
    
    // Verificar si hay una imagen disponible
    if (image) {
        imgElement.src = `./public/assets/${image}`; // Cambia la ruta si es necesario
        imgElement.alt = `Imagen de ${title}`;
    } else {
        imgElement.style.display = 'none'; // Ocultar la imagen si no hay
        const titleElement = document.createElement('h2');
        titleElement.innerText = title;
        card.appendChild(titleElement);
    }

    card.appendChild(imgElement);
    
    const details = document.createElement('div');
    details.classList.add('project-details');
    details.innerText = title; // Mostrar título siempre
    
    card.appendChild(details);

    return card;
}
