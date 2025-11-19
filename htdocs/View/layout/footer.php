<footer>
        <p>&copy; 2025 Catálogo PHP MVC</p>
    </footer>
    
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const toggle = document.getElementById('theme-toggle');
            const body = document.body;

            // 1. Cargar la preferencia del usuario o del sistema
            const loadTheme = () => {
                const preferredTheme = localStorage.getItem('theme');
                if (preferredTheme === 'dark' || (!preferredTheme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                    body.classList.add('dark-mode');
                    toggle.textContent = '🌙';
                } else {
                    body.classList.remove('dark-mode');
                    toggle.textContent = '☀️';
                }
            };

            // 2. Manejar el clic del botón
            toggle.addEventListener('click', () => {
                body.classList.toggle('dark-mode');
                
                if (body.classList.contains('dark-mode')) {
                    localStorage.setItem('theme', 'dark');
                    toggle.textContent = '🌙';
                } else {
                    localStorage.setItem('theme', 'light');
                    toggle.textContent = '☀️';
                }
            });

            loadTheme();
        });
    </script>
</body>
</html>