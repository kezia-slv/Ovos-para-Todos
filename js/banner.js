// Variáveis globais
let currentSlide = 0;
const slides = document.querySelectorAll('.slide');
const totalSlides = slides.length;
const sliderWrapper = document.getElementById('sliderWrapper');
const controlsContainer = document.getElementById('sliderControls');
let autoSlideInterval;

// Criar dots de controle
function createDots() {
    for (let i = 0; i < totalSlides; i++) {
        const dot = document.createElement('div');
        dot.classList.add('slider-dot');
        if (i === 0) dot.classList.add('active');
        dot.addEventListener('click', () => goToSlide(i));
        controlsContainer.appendChild(dot);
    }
}

// Ir para slide específico
function goToSlide(index) {
    currentSlide = index;
    updateSlider();
}

// Mudar slide
function changeSlide(direction) {
    currentSlide += direction;
    
    if (currentSlide < 0) {
        currentSlide = totalSlides - 1;
    } else if (currentSlide >= totalSlides) {
        currentSlide = 0;
    }
    
    updateSlider();
}

// Atualizar slider
function updateSlider() {
    const offset = -currentSlide * 100;
    sliderWrapper.style.transform = `translateX(${offset}%)`;
    
    // Atualizar dots
    const dots = document.querySelectorAll('.slider-dot');
    dots.forEach((dot, index) => {
        dot.classList.toggle('active', index === currentSlide);
    });

    // Resetar animação do conteúdo
    slides.forEach((slide, index) => {
        const content = slide.querySelector('.slide-content');
        if (index === currentSlide) {
            content.style.animation = 'none';
            setTimeout(() => {
                content.style.animation = 'slideInLeft 0.8s ease-out';
            }, 10);
        }
    });
}

// Auto slide
function startAutoSlide() {
    autoSlideInterval = setInterval(() => {
        changeSlide(1);
    }, 5000);
}

function stopAutoSlide() {
    clearInterval(autoSlideInterval);
}

// Pausar ao passar o mouse
sliderWrapper.addEventListener('mouseenter', stopAutoSlide);
sliderWrapper.addEventListener('mouseleave', startAutoSlide);

// Suporte a touch/swipe
let touchStartX = 0;
let touchEndX = 0;

sliderWrapper.addEventListener('touchstart', (e) => {
    touchStartX = e.changedTouches[0].screenX;
    stopAutoSlide();
});

sliderWrapper.addEventListener('touchend', (e) => {
    touchEndX = e.changedTouches[0].screenX;
    handleSwipe();
    startAutoSlide();
});

function handleSwipe() {
    if (touchEndX < touchStartX - 50) {
        changeSlide(1);
    }
    if (touchEndX > touchStartX + 50) {
        changeSlide(-1);
    }
}

// Inicializar quando o DOM estiver pronto
document.addEventListener('DOMContentLoaded', () => {
    createDots();
    startAutoSlide();
});