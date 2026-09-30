// Data buku ditampilkan langsung oleh PHP dari PostgreSQL.
// File ini hanya menangani pencarian tabel.

document.addEventListener("DOMContentLoaded", function () {
    const input = document.getElementById("search-input");
    const table = document.querySelector(".table-responsive table");

    if (!input || !table) {
        return;
    }

    input.addEventListener("input", function () {
        const keyword = input.value.toLowerCase();
        const rows = table.querySelectorAll("tbody tr");

        rows.forEach(function (row) {
            const teks = row.textContent.toLowerCase();

            if (teks.includes(keyword)) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    });
});