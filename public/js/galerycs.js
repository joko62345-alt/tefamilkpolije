const galleries = document.querySelectorAll('.kegiatan-gallery, .artikel-gallery, .testimoni-gallery, .frame');

galleries.forEach(gallery => {
    let isDown = false;
    let startX;
    let scrollLeft;

    gallery.addEventListener('mousedown', (e) => {
        isDown = true;
        gallery.style.cursor = 'grabbing';
        startX = e.pageX - gallery.offsetLeft;
        scrollLeft = gallery.scrollLeft;
    });

    gallery.addEventListener('mouseleave', () => {
        isDown = false;
        gallery.style.cursor = 'grab';
    });

    gallery.addEventListener('mouseup', () => {
        isDown = false;
        gallery.style.cursor = 'grab';
    });

    gallery.addEventListener('mousemove', (e) => {
        if (!isDown) return;
        e.preventDefault();
        const x = e.pageX - gallery.offsetLeft;
        const walk = (x - startX) * 2;
        gallery.scrollLeft = scrollLeft - walk;
    });
});


// SLIDE BY ARROW BUTTON
function slideGallery(gallery, direction) {
    const scrollAmount = 600;
    const currentScroll = gallery.scrollLeft;

    gallery.scrollTo({
        left: direction === 'right'
            ? currentScroll + scrollAmount
            : currentScroll - scrollAmount,
        behavior: 'smooth'
    });
}

function setupArrow(arrowElement, gallery, direction) {
    if (!arrowElement || !gallery) return;

    arrowElement.style.cursor = 'pointer';
    arrowElement.style.transition = 'transform 0.3s ease';

    arrowElement.addEventListener('click', () => {
        slideGallery(gallery, direction);
    });

    arrowElement.addEventListener('mouseenter', () => {
        arrowElement.style.transform = 'scale(1.1)';
    });

    arrowElement.addEventListener('mouseleave', () => {
        arrowElement.style.transform = 'scale(1)';
    });
}

function initArrows() {

    // --- KEGIATAN ---
    const kegiatanGallery = document.querySelector('.kegiatan-gallery');
    const kegiatanNavLeft = document.querySelector('.kegiatan-nav .left');
    const kegiatanNavRight = document.querySelector('.kegiatan-nav .right');

    setupArrow(kegiatanNavRight, kegiatanGallery, 'right');
    setupArrow(kegiatanNavLeft, kegiatanGallery, 'left');

    // --- ARTIKEL TEFA ---
    const artikelGallery = document.querySelector('.artikel-gallery');
    const artikelNavLeft = document.querySelector('.artikel-nav .left');
    const artikelNavRight = document.querySelector('.artikel-nav .right');

    setupArrow(artikelNavRight, artikelGallery, 'right');
    setupArrow(artikelNavLeft, artikelGallery, 'left');

     // --- TESTIMONI TEFA ---
    const testimoniGallery = document.querySelector('.testimoni-gallery');
    const testimoniNavLeft = document.querySelector('.testimoni-nav .left');
    const testimoniNavRight = document.querySelector('.testimoni-nav .right');

    setupArrow(testimoniNavRight, testimoniGallery, 'right');
    setupArrow(testimoniNavLeft, testimoniGallery, 'left');
    console.log("Testimoni Gallery:", document.querySelector('.testimoni-gallery'));


}

{
document.addEventListener('DOMContentLoaded', () => {
    initArrows();
    console.log("Arrow navigation READY!");
});

}

// "Lihat Lainnya" button functionality
function setupViewMoreButtons() {
  const viewMoreButtons = document.querySelectorAll('.view-more-btn');

  viewMoreButtons.forEach(button => {
    button.style.cursor = 'pointer';
    button.style.transition = 'all 0.3s ease';
    
    button.addEventListener('click', (e) => {
      const section = button.closest('.section');
      const sectionTitle = section.querySelector('.section-title').textContent;
      
      alert(`Menampilkan lebih banyak ${sectionTitle}...`);
    });

    button.addEventListener('mouseenter', () => {
      button.style.transform = 'scale(1.05)';
      button.style.boxShadow = '0 4px 8px rgba(0,0,0,0.2)';
    });

    button.addEventListener('mouseleave', () => {
      button.style.transform = 'scale(1)';
      button.style.boxShadow = 'none';
    });
  });
}

// Navigation menu active state
function setupNavigation() {
  const navLinks = document.querySelectorAll('.nav-link');

  navLinks.forEach(link => {
    link.style.cursor = 'pointer';
    
    link.addEventListener('click', (e) => {
      e.preventDefault();
      navLinks.forEach(l => l.classList.remove('active'));
      link.classList.add('active');
    });

    link.addEventListener('mouseenter', () => {
      if (!link.classList.contains('active')) {
        link.style.opacity = '0.7';
      }
    });

    link.addEventListener('mouseleave', () => {
      link.style.opacity = '1';
    });
  });
}

// "Lihat lebih banyak" functionality for testimonials
document.addEventListener("DOMContentLoaded", function () {
    const limit = 40;

    document.querySelectorAll(".testimonial-text").forEach((p) => {
        let fullText = p.textContent.replace(/\s+/g, " ").trim();

        if (fullText.length <= limit) {
            p.textContent = fullText;
            return;
        }

        let shortText = fullText.substring(0, limit) + "...";

        p.dataset.full = fullText;
        p.dataset.short = shortText;

        // Set tampilan awal
        p.innerHTML = `${shortText}<span class="read-more-btn"> lihat lebih banyak</span>`;

        // FUNCTION untuk re-bind tombol setiap kali innerHTML berubah
        function bindButton() {
            const btn = p.querySelector(".read-more-btn");

            btn.addEventListener("click", (e) => {
                e.stopPropagation();

                const expanded = p.classList.contains("expanded");

                if (expanded) {
                    // Tutup
                    p.innerHTML = `${p.dataset.short}<span class="read-more-btn"> lihat lebih banyak</span>`;
                    p.classList.remove("expanded");
                } else {
                    // Buka
                    p.innerHTML = `${p.dataset.full}<span class="read-more-btn"> sembunyikan</span>`;
                    p.classList.add("expanded");
                }

                // Bind ulang tombol setelah isi berubah
                bindButton();
            });
        }

        // Bind awal
        bindButton();
    });
});


// Footer social media links
function setupSocialLinks() {
  const socialItems = document.querySelectorAll('.social-item');

  socialItems.forEach(item => {
    item.style.cursor = 'pointer';
    item.style.transition = 'all 0.3s ease';
    
    const socialText = item.querySelector('.social-text');
    const icon = item.querySelector('.social-icon');
    
    item.addEventListener('click', () => {
      const socialMedia = socialText.textContent.trim();
      alert(`Membuka ${socialMedia}...`);
    });

    item.addEventListener('mouseenter', () => {
      if (socialText) {
        socialText.style.color = '#e7a74e';
      }
      if (icon) {
        icon.style.transform = 'scale(1.15)';
      }
    });

    item.addEventListener('mouseleave', () => {
      if (socialText) {
        socialText.style.color = '';
      }
      if (icon) {
        icon.style.transform = 'scale(1)';
      }
    });
  });
}

// Footer menu links
function setupFooterMenu() {
  const footerLinks = document.querySelectorAll('.footer-link');

  footerLinks.forEach(link => {
    link.style.cursor = 'pointer';
    link.style.transition = 'color 0.3s ease';
    
    link.addEventListener('click', (e) => {
      e.preventDefault();
      const menuItem = link.textContent.trim();
      alert(`Navigasi ke ${menuItem}...`);
    });

    link.addEventListener('mouseenter', () => {
      link.style.color = '#e7a74e';
    });

    link.addEventListener('mouseleave', () => {
      link.style.color = '';
    });
  });
}

// Image hover effects for galleries
function setupGalleryImages() {
  const galleryImages = document.querySelectorAll('.gallery-item');

  galleryImages.forEach(img => {
    img.style.cursor = 'pointer';
    img.style.transition = 'transform 0.3s ease, box-shadow 0.3s ease';
    
    img.addEventListener('mouseenter', () => {
      img.style.transform = 'scale(1.05)';
      img.style.boxShadow = '0px 8px 20px rgba(0, 0, 0, 0.3)';
    });

    img.addEventListener('mouseleave', () => {
      img.style.transform = 'scale(1)';
      img.style.boxShadow = 'none';
    });

    img.addEventListener('click', () => {
      window.open(img.src, '_blank');
    });
  });
}

// Testimonial card hover effects
function setupTestimonialCards() {
  const testimonialCards = document.querySelectorAll('.testimonial-card');

  testimonialCards.forEach(card => {
    card.style.transition = 'transform 0.3s ease, box-shadow 0.3s ease';
    
    card.addEventListener('mouseenter', () => {
      card.style.transform = 'translateY(-10px)';
      card.style.boxShadow = '0px 8px 25px rgba(0, 0, 0, 0.5)';
    });

    card.addEventListener('mouseleave', () => {
      card.style.transform = 'translateY(0)';
      card.style.boxShadow = '0px 4px 15px rgba(0, 0, 0, 0.25)';
    });
  });
}

// Add cursor style to scrollable galleries
function setupGalleryCursor() {
  galleries.forEach(gallery => {
    gallery.style.cursor = 'grab';
  });
}

// Initialize all functions when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
  setupNavigationArrows();
  setupViewMoreButtons();
  setupNavigation();
  setupTestimonialReadMore();
  setupSocialLinks();
  setupFooterMenu();
  setupGalleryImages();
  setupTestimonialCards();
  setupGalleryCursor();
  
  console.log('JavaScript loaded successfully!');
});

// If script is loaded after DOM, run immediately
if (document.readyState === 'loading') {
  // DOM is still loading
  document.addEventListener('DOMContentLoaded', () => {
    console.log('DOM loaded - initializing...');
  });
} else {
  // DOM is already loaded
  setupNavigationArrows();
  setupViewMoreButtons();
  setupNavigation();
  setupTestimonialReadMore();
  setupSocialLinks();
  setupFooterMenu();
  setupGalleryImages();
  setupTestimonialCards();
  setupGalleryCursor();
  
  console.log('JavaScript loaded successfully!');
}

document.addEventListener("DOMContentLoaded", function() {
    const limit = 120; // batas karakter, bisa diganti misal 150 / 200

    document.querySelectorAll(".testimonial-text").forEach((p, index) => {
        const fullText = p.innerText.trim();

        // Jika teks pendek → tidak perlu "lihat lebih banyak"
        if (fullText.length <= limit) return;

        const shortText = fullText.substring(0, limit) + "...";

        // Simpan data asli
        p.setAttribute("data-full", fullText);
        p.innerText = shortText;

        // Tambahkan tombol otomatis
        const btn = document.createElement("span");
        btn.className = "read-more-btn";
        btn.innerText = " lihat lebih banyak";
        btn.onclick = () => toggleText(p, btn);
        p.after(btn);
    });
});

