fetch("navbar.html")
        .then(response => response.text())
        .then(data => {
            document.getElementById("navbar").innerHTML = data;

            // Setelah navbar dimuat, jalankan highlight menu aktif
            const currentPage = location.pathname.split("/").pop();

            document.querySelectorAll(".nav-link").forEach(link => {
                const linkPage = link.getAttribute("href");

                if (linkPage === currentPage) {
                    link.classList.add("active");
                }
            });
        });

window.addEventListener("scroll", function () {
    const navbar = document.querySelector(".custom-navbar");

    if (window.scrollY > 10) {
        navbar.classList.add("scrolled");
    } else {
        navbar.classList.remove("scrolled");
    }
});