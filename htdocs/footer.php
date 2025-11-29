<footer>
    <p>© 2025 Biblioteca UTN</p>
</footer>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const html = document.documentElement;

    // Si ya estaba guardado en localStorage, activar modo dark
    if (localStorage.getItem("dark-mode") === "true") {
        html.classList.add("dark");
    }

    // Función global para el botón
    window.toggleModoOscuro = function () {
        html.classList.toggle("dark");
        localStorage.setItem("dark-mode", html.classList.contains("dark"));
    };
});
</script>
