            </main>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Activar navegación activa
        document.addEventListener('DOMContentLoaded', function() {
            const currentPath = window.location.pathname;
            const navLinks = document.querySelectorAll('.nav-link');
            
            navLinks.forEach(link => {
                if (link.getAttribute('href') === currentPath || 
                    (currentPath.includes('flota') && link.getAttribute('href').includes('flota'))) {
                    link.classList.add('active');
                }
            });
            
            // Mejorar experiencia móvil
            if (window.innerWidth <= 768) {
                // Ajustar altura del contenido para móviles
                const mainContent = document.querySelector('.main-content');
                if (mainContent) {
                    mainContent.style.minHeight = 'calc(100vh - 60px)';
                }
                
                // Optimizar tablas para móviles
                const tables = document.querySelectorAll('table');
                tables.forEach(table => {
                    if (!table.classList.contains('table-responsive')) {
                        table.classList.add('table-responsive');
                    }
                });
                
                // Optimizar formularios para móviles
                const forms = document.querySelectorAll('form');
                forms.forEach(form => {
                    const inputs = form.querySelectorAll('input, select, textarea');
                    inputs.forEach(input => {
                        input.style.fontSize = '16px'; // Evita zoom en iOS
                    });
                });
            }
            
            // Detectar cambios de orientación en móviles
            window.addEventListener('orientationchange', function() {
                setTimeout(function() {
                    if (window.innerWidth <= 768) {
                        const sidebar = document.getElementById('sidebar');
                        if (sidebar) {
                            sidebar.classList.remove('show');
                        }
                    }
                }, 100);
            });
        });
    </script>
</body>
</html>
