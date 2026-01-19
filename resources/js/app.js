import "./bootstrap";
import Alpine from "alpinejs";

// 1. Import SweetAlert2
import Swal from "sweetalert2";

window.Alpine = Alpine;
window.Swal = Swal; // Jadikan global agar bisa dipanggil di mana saja

Alpine.start();
document.addEventListener("DOMContentLoaded", function () {
    // Event Delegation (Lebih aman jika ada elemen dinamis)
    document.body.addEventListener("submit", function (e) {
        const target = e.target;

        // Cek apakah elemen yang di-submit adalah form dengan class 'delete-form'
        if (target && target.classList.contains("delete-form")) {
            e.preventDefault(); // Stop submit native

            Swal.fire({
                title: "Yakin hapus data ini?",
                text: "Data yang dihapus tidak bisa dikembalikan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#4f46e5", // Warna Indigo (sesuai tema)
                cancelButtonColor: "#ef4444", // Warna Merah
                confirmButtonText: "Ya, Hapus!",
                cancelButtonText: "Batal",
                background: "#1f2937", // Dark Mode background (Opsional, sesuaikan selera)
                color: "#fff", // Text color
            }).then((result) => {
                if (result.isConfirmed) {
                    target.submit(); // Lanjutkan submit manual jika user klik Yes
                }
            });
        }
    });
});
