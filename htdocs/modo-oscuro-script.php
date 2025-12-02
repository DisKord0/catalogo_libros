<script>
/*
  modo-oscuro-script.php
  - Aplica el tema guardado inmediatamente
  - Mantiene toggle global (onclick existente)
  - Actualiza el icono del header cuando exista (observer)
*/
(function(){
  // Aplicar lo antes posible
  try {
    const saved = localStorage.getItem('theme');
    if (saved === 'dark') document.body.classList.add('dark-mode');
  } catch(e){ console.warn('No se pudo leer theme:', e); }

  // Actualiza icono si existe
  function actualizarIcono() {
    const icon = document.getElementById('theme-icon');
    if (icon) icon.textContent = document.body.classList.contains('dark-mode') ? '☀️' : '🌓';
  }
  actualizarIcono();

  // Observer para cuando header / nav se incluya después
  const observer = new MutationObserver((mutations, obs) => {
    if (document.getElementById('theme-icon')) {
      actualizarIcono();
      obs.disconnect();
    }
  });
  observer.observe(document.documentElement, { childList: true, subtree: true });

  // Función global usada por tu botón onclick
  window.toggleModoOscuro = function() {
    try {
      const body = document.body;
      const isDark = body.classList.toggle('dark-mode');
      localStorage.setItem('theme', isDark ? 'dark' : 'light');
      actualizarIcono();
    } catch(e) {
      console.error('toggleModoOscuro error', e);
    }
  };
})();
</script>
