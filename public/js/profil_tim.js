// ===================================
// FILE JAVASCRIPT UNTUK TIM TEFA MILK
// ===================================

// ===================================
// 1. SMOOTH SCROLL ANIMATION
//    Untuk navigasi yang smooth
// ===================================
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth'
            });
        }
    });
});

// ===================================
// 2. INTERSECTION OBSERVER
//    Untuk animasi fade-in saat scroll
// ===================================
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
        }
    });
}, observerOptions);

// Terapkan observer ke member cards
document.querySelectorAll('.member-card').forEach(card => {
    card.style.opacity = '0';
    card.style.transform = 'translateY(20px)';
    card.style.transition = 'all 0.6s ease';
    observer.observe(card);
});

// ===================================
// 3. HOVER EFFECT UNTUK MEMBER CARDS
//    Enhanced hover interaction
// ===================================
document.querySelectorAll('.member-card').forEach(card => {
    card.addEventListener('mouseenter', function () {
        this.style.transform = 'translateY(-10px) scale(1.02)';
    });

    card.addEventListener('mouseleave', function () {
        this.style.transform = 'translateY(0) scale(1)';
    });
});

// ===================================
// 4. NAVBAR SCROLL EFFECT
//    Navbar berubah saat di-scroll
// ===================================
window.addEventListener('scroll', function () {
    const navbar = document.querySelector('.navbar');
    if (window.scrollY > 50) {
        navbar.style.boxShadow = '0 5px 15px rgba(0,0,0,0.2)';
    } else {
        navbar.style.boxShadow = '0 2px 5px rgba(0,0,0,0.1)';
    }
});

// ===================================
// 5. LAZY LOADING IMAGES
//    Memuat gambar secara lazy
// ===================================
if ('IntersectionObserver' in window) {
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.classList.add('loaded');
                observer.unobserve(img);
            }
        });
    });

    document.querySelectorAll('.member-image img, .team-image img').forEach(img => {
        imageObserver.observe(img);
    });
}

// ===================================
// 6. CONSOLE LOG (untuk testing)
// ===================================
console.log('Script Tim TEFA MILK loaded successfully!');
console.log('Total member cards: ' + document.querySelectorAll('.member-card').length);
