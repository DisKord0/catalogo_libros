<header>
    <nav>
        <?php require "navegacion.php"; ?>
    </nav>
</header>

<script>
// Espera a que todo el DOM cargue
document.addEventListener('DOMContentLoaded', function() {

    // Aplica el modo oscuro si estaba guardado
    if (localStorage.getItem('modoOscuro') === 'true') {
        document.body.classList.add('dark');
    }

    // Función accesible globalmente
    window.toggleModoOscuro = function() {
        document.body.classList.toggle('dark');

        // Guardar preferencia
        if (document.body.classList.contains('dark')) {
            localStorage.setItem('modoOscuro', 'true');
        } else {
            localStorage.setItem('modoOscuro', 'false');
        }
    }
});
</script>
