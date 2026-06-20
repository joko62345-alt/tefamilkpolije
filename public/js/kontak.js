
// Rating Stars Functionality
document.addEventListener('DOMContentLoaded', function() {
  const stars = document.querySelectorAll('.rating-stars .star');
  const ratingValue = document.getElementById('ratingValue');
  
  stars.forEach(star => {
    star.addEventListener('click', function() {
      const rating = this.getAttribute('data-rating');
      ratingValue.value = rating;
      
      // Update star colors
      stars.forEach(s => {
        const starRating = s.getAttribute('data-rating');
        if (starRating <= rating) {
          s.classList.add('active');
        } else {
          s.classList.remove('active');
        }
      });
    });
    
    // Hover effect
    star.addEventListener('mouseenter', function() {
      const rating = this.getAttribute('data-rating');
      stars.forEach(s => {
        const starRating = s.getAttribute('data-rating');
        if (starRating <= rating) {
          s.style.color = '#FFD700';
        }
      });
    });
  });
  
  // Reset on mouse leave
  document.querySelector('.rating-stars').addEventListener('mouseleave', function() {
    const currentRating = ratingValue.value;
    stars.forEach(s => {
      const starRating = s.getAttribute('data-rating');
      if (starRating <= currentRating) {
        s.style.color = '#FFD700';
      } else {
        s.style.color = '#ddd';
      }
    });
  });
});



// SCRIPT KIRIM WA

document.getElementById("sendWA").addEventListener("click", function () {

    const nama = document.getElementById("nama").value.trim();
    const email = document.getElementById("email").value.trim();
    const ulasan = document.getElementById("ulasan").value.trim();
    const ratingStars = document.getElementById("ratingValue").value;

    const nomorWa = "6287729664976";

    // ====== VALIDASI EMAIL ======
    const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

    if (!emailPattern.test(email)) {
        alert("Email tidak valid! Mohon masukkan email yang benar.");
        return;
    }

    // VALIDASI FORM LAIN
    if (!nama || !email || !ulasan || ratingStars == 0) {
        alert("Mohon lengkapi semua data dan beri rating terlebih dahulu.");
        return;
    }

    const pesan =
`Halo, ada ulasan baru!

Nama: ${nama}
Email: ${email}
Rating: ${ratingStars}/5

Ulasan:
${ulasan}`;

    window.open(`https://wa.me/${nomorWa}?text=${encodeURIComponent(pesan)}`, "_blank");

    // Reset form setelah kirim
    document.getElementById("contactForm").reset();
    document.getElementById('ratingValue').value = '0';
    document.querySelectorAll('.rating-stars .star').forEach(s => {
        s.classList.remove('active');
        s.style.color = '#ddd';
    });

});


// Smooth scroll
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener('click', function(e) {
    e.preventDefault();
    const target = document.querySelector(this.getAttribute('href'));
    if (target) {
      target.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
  });
});

// Navbar scroll effect
window.addEventListener('scroll', function() {
  const navbar = document.querySelector('.navbar');
  if (window.scrollY > 50) {
    navbar.style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.15)';
  } else {
    navbar.style.boxShadow = '0 2px 4px rgba(0, 0, 0, 0.1)';
  }
});

// Input animations
const inputs = document.querySelectorAll('.custom-input, .custom-textarea');
inputs.forEach(input => {
  input.addEventListener('focus', function() {
    this.style.transform = 'scale(1.01)';
  });
  
  input.addEventListener('blur', function() {
    this.style.transform = 'scale(1)';
  });
});
