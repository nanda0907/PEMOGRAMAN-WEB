document.addEventListener("DOMContentLoaded", function () {

    // =========================
    // PENCARIAN DATA RUTINITAS
    // =========================

    const searchInput = document.getElementById("searchInput");

    if (searchInput) {
        searchInput.addEventListener("keyup", function () {

            const keyword = searchInput.value.toLowerCase();
            const rows = document.querySelectorAll("#rutinitasTable tbody tr");

            rows.forEach(function (row) {

                const text = row.textContent.toLowerCase();

                if (text.includes(keyword)) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }

            });
        });
    }


    // =========================
    // VALIDASI FORM RUTINITAS
    // =========================

    const form = document.getElementById("formRutinitas");

    if (form) {
        form.addEventListener("submit", function (event) {

            const produk = document.getElementById("produk").value.trim();
            const kategori = document.getElementById("kategori").value;
            const waktu = document.getElementById("waktu").value;
            const urutan = document.getElementById("urutan").value;

            if (produk === "") {
                alert("Nama produk harus diisi.");
                event.preventDefault();
                return;
            }

            if (kategori === "") {
                alert("Kategori harus dipilih.");
                event.preventDefault();
                return;
            }

            if (waktu === "") {
                alert("Waktu pemakaian harus dipilih.");
                event.preventDefault();
                return;
            }

            if (urutan < 1) {
                alert("Urutan pemakaian harus lebih dari 0.");
                event.preventDefault();
                return;
            }

        });
    }

});