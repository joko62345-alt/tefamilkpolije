// Filter Produk
const filterButtons = document.querySelectorAll(".filter-btn");
const productCards = document.querySelectorAll(".product-card");

filterButtons.forEach(btn => {
    btn.addEventListener("click", () => {

        // aktifkan tombol
        filterButtons.forEach(b => b.classList.remove("active"));
        btn.classList.add("active");

        const filter = btn.dataset.filter;

        productCards.forEach(card => {
            const category = card.dataset.category;

            if (filter === "all" || filter === category) {
                card.style.display = "block";
            } else {
                card.style.display = "none";
            }
        });
    });
});
