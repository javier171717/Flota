<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <title><?php echo $title; ?> - FlotaPro</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <style>
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 0.75rem 1rem;
            margin: 0.25rem 0;
            border-radius: 0.5rem;
            transition: all 0.3s;
        }
        .sidebar .nav-link:hover {
            color: white;
            background: rgba(255,255,255,0.1);
        }
        .sidebar .nav-link.active {
            background: rgba(255,255,255,0.2);
            color: white;
        }
        .main-content {
            background-color: #f8f9fa;
            min-height: 100vh;
        }
        .card {
            border: none;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            border-radius: 0.75rem;
        }
        .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 0.75rem 0.75rem 0 0 !important;
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
        }
                .btn-primary:hover {
            background: linear-gradient(135deg, #5a6fd8 0%, #6a4190 100%);
        }
        
        /* ===== ESTILOS ESPECÍFICOS PARA TICKETS ===== */
        /* Soluciona problemas de contraste y visibilidad */
        
        /* Forzar colores en badges */
        .badge {
            color: white !important;
            text-shadow: 0 1px 2px rgba(0,0,0,0.3);
        }
        
        .badge-primary,
        .badge-info {
            background: linear-gradient(45deg, #3498db, #2980b9) !important;
            color: white !important;
        }
        
        .badge-success {
            background: linear-gradient(45deg, #27ae60, #2ecc71) !important;
            color: white !important;
        }
        
        .badge-warning {
            background: linear-gradient(45deg, #f39c12, #e67e22) !important;
            color: #2c3e50 !important;
        }
        
        .badge-danger {
            background: linear-gradient(45deg, #e74c3c, #c0392b) !important;
            color: white !important;
        }
        
        .badge-secondary {
            background: linear-gradient(45deg, #95a5a6, #7f8c8d) !important;
            color: white !important;
        }
        
        /* Forzar colores en tablas */
        .table td,
        .table td * {
            color: #2c3e50 !important;
        }
        
        .table td small {
            color: #7f8c8d !important;
        }
        
        /* Forzar colores en texto general */
        .text-muted {
            color: #7f8c8d !important;
        }
        
        .text-success {
            color: #27ae60 !important;
        }
        
        .text-primary {
            color: #3498db !important;
        }
        
        .text-info {
            color: #3498db !important;
        }
        
        .text-warning {
            color: #f39c12 !important;
        }
        
        .text-danger {
            color: #e74c3c !important;
        }
        
        /* Estilos específicos para información del bus */
        .bus-info strong,
        .bus-info span {
            color: #2c3e50 !important;
        }
        
        .bus-info small {
            color: #7f8c8d !important;
        }
        
        /* Estilos para estado y asiento */
        .ticket-status,
        .ticket-seat {
            color: #2c3e50 !important;
        }
        
        /* Estilos para formularios */
        .form-control,
        .form-select {
            color: #2c3e50 !important;
        }
        
        .form-control::placeholder {
            color: #95a5a6 !important;
        }
        
        /* Estilos para alertas */
        .alert-info {
            color: #2c3e50 !important;
        }
        
        .alert-info strong {
            color: #2c3e50 !important;
        }
        
        /* Estilos para botones outline */
        .btn-outline-primary {
            color: #3498db !important;
            border-color: #3498db !important;
        }
        
        .btn-outline-success {
            color: #27ae60 !important;
            border-color: #27ae60 !important;
        }
        
        .btn-outline-danger {
            color: #e74c3c !important;
            border-color: #e74c3c !important;
        }
        
        .btn-outline-secondary {
            color: #95a5a6 !important;
            border-color: #95a5a6 !important;
        }
        
        /* ===== ESTILOS PARA EL ROL DEL USUARIO ===== */
        .user-info .text-danger {
            color: #ff6b6b !important;
            text-shadow: 0 1px 2px rgba(0,0,0,0.3);
            background: rgba(255, 107, 107, 0.1);
            padding: 2px 8px;
            border-radius: 12px;
            border: 1px solid rgba(255, 107, 107, 0.3);
        }
        
        .user-info .text-warning {
            color: #ffd93d !important;
            text-shadow: 0 1px 2px rgba(0,0,0,0.3);
            background: rgba(255, 217, 61, 0.1);
            padding: 2px 8px;
            border-radius: 12px;
            border: 1px solid rgba(255, 217, 61, 0.3);
        }
        
        .user-info .text-info {
            color: #4ecdc4 !important;
            text-shadow: 0 1px 2px rgba(0,0,0,0.3);
            background: rgba(78, 205, 196, 0.1);
            padding: 2px 8px;
            border-radius: 12px;
            border: 1px solid rgba(78, 205, 196, 0.3);
        }
        
        .user-info .text-success {
            color: #95e1d3 !important;
            text-shadow: 0 1px 2px rgba(0,0,0,0.3);
            background: rgba(149, 225, 211, 0.1);
            padding: 2px 8px;
            border-radius: 12px;
            border: 1px solid rgba(149, 225, 211, 0.3);
        }
        
        .user-info .text-light {
            color: #f8f9fa !important;
            text-shadow: 0 1px 2px rgba(0,0,0,0.3);
            background: rgba(248, 249, 250, 0.1);
            padding: 2px 8px;
            border-radius: 12px;
            border: 1px solid rgba(248, 249, 250, 0.3);
        }
        
        /* Hover effects para el rol */
        .user-info small:hover {
            transform: scale(1.05);
            transition: transform 0.2s ease-in-out;
        }
        
        /* ===== ESTILOS PARA TÍTULOS MEJORADOS ===== */
        .page-title-container {
            position: relative;
            width: 100%;
        }
        
        .page-title {
            font-size: 2.2rem !important;
            font-weight: 700 !important;
            color: #2c3e50 !important;
            margin-bottom: 0.5rem !important;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
        }
        
        .page-title i {
            font-size: 2.5rem;
            background: linear-gradient(135deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));
            animation: iconFloat 3s ease-in-out infinite;
        }
        
        @keyframes iconFloat {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-5px); }
        }
        
        .title-underline {
            height: 4px;
            border-radius: 2px;
            margin-top: 0.5rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
            transition: all 0.3s ease;
        }
        
        /* Estilos específicos por tipo de título */
        .title-buses i {
            background: linear-gradient(135deg, #3498db, #2980b9);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .title-routes i {
            background: linear-gradient(135deg, #e74c3c, #c0392b);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .title-trips i {
            background: linear-gradient(135deg, #f39c12, #e67e22);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .title-drivers i {
            background: linear-gradient(135deg, #9b59b6, #8e44ad);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .title-tickets i {
            background: linear-gradient(135deg, #27ae60, #2ecc71);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .title-profile i {
            background: linear-gradient(135deg, #34495e, #2c3e50);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .title-dashboard i {
            background: linear-gradient(135deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        /* Efectos hover para títulos */
        .page-title:hover {
            transform: translateY(-2px);
            text-shadow: 0 4px 8px rgba(0,0,0,0.15);
        }
        
        .page-title:hover + .title-underline {
            transform: scaleX(1.1);
            box-shadow: 0 4px 12px rgba(0,0,0,0.25);
        }
        
        /* Responsive para títulos */
        @media (max-width: 768px) {
            .page-title {
                font-size: 1.8rem !important;
                text-align: center;
                justify-content: center;
                flex-direction: column;
            }
            
            .page-title i {
                font-size: 2rem;
                margin-bottom: 0.5rem;
                margin-right: 0 !important;
            }
            
            .title-underline {
                margin: 0.5rem auto 0 auto;
                width: 80%;
            }
        }
        
        @media (max-width: 576px) {
            .page-title {
                font-size: 1.5rem !important;
            }
            
            .page-title i {
                font-size: 1.8rem;
            }
        }
        
        /* Estilos responsivos para móviles */
        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100vh;
                z-index: 1050;
                transition: left 0.3s ease;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            }
            
            .sidebar.show {
                left: 0;
            }
            
            .main-content {
                margin-left: 0;
                width: 100%;
                padding: 1rem;
                padding-top: 4rem;
            }
            
            .card {
                margin-bottom: 1rem;
                border-radius: 0.5rem;
            }
            
            .card-body {
                padding: 1rem;
            }
            
            .table-responsive {
                font-size: 0.875rem;
            }
            
            .btn {
                padding: 0.75rem 1rem;
                font-size: 0.875rem;
                margin-bottom: 0.5rem;
                width: 100%;
            }
            
            .modal-dialog {
                margin: 0.5rem;
                max-width: calc(100% - 1rem);
            }
            
            .h2 {
                font-size: 1.5rem;
                margin-top: 0;
                padding-top: 0.5rem;
            }
            
            .container-fluid {
                padding: 0;
            }
            
            .px-md-4 {
                padding-left: 0.5rem !important;
                padding-right: 0.5rem !important;
            }
            
            .border-bottom {
                margin-top: 1rem;
                padding-top: 1rem;
            }
            
            /* Centrar títulos de tarjetas en móviles */
            .card-header h5,
            .card-header h6,
            .card-header .h5,
            .card-header .h6 {
                text-align: center;
                margin-bottom: 0;
            }
            
            /* Centrar títulos de secciones */
            .card-title,
            .card-subtitle {
                text-align: center;
            }
        }
        
        /* Botón de menú móvil */
        .mobile-menu-toggle {
            display: none;
            position: fixed;
            top: 1rem;
            right: 1rem;
            z-index: 1060;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            padding: 0.75rem;
            border-radius: 0.5rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
        }
        
        @media (max-width: 768px) {
            .mobile-menu-toggle {
                display: block;
            }
        }
        
        /* Mejoras para pantallas pequeñas */
        @media (max-width: 576px) {
            .card {
                margin: 0.5rem;
            }
            
            .btn {
                font-size: 0.8rem;
                padding: 0.6rem 0.8rem;
            }
            
            .h2 {
                font-size: 1.25rem;
                text-align: center;
            }
            
            .mobile-menu-toggle {
                top: 0.5rem;
                right: 0.5rem;
                padding: 0.6rem;
            }
            
            .main-content {
                padding-top: 3.5rem;
            }
            
            /* Centrar todos los títulos en pantallas muy pequeñas */
            h1, h2, h3, h4, h5, h6,
            .h1, .h2, .h3, .h4, .h5, .h6 {
                text-align: center;
            }
            
            .card-header {
                text-align: center;
            }
        }
        
        /* Estilos para el header móvil */
        @media (max-width: 768px) {
            .d-flex.justify-content-between.flex-wrap.flex-md-nowrap.align-items-center.pt-3.pb-2.mb-3.border-bottom {
                flex-direction: column;
                align-items: center !important;
                text-align: center;
            }
            
            .h2 {
                margin-bottom: 0.5rem;
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <!-- Botón de menú móvil -->
    <button class="mobile-menu-toggle" id="mobileMenuToggle">
        <i class="fas fa-bars"></i>
    </button>
    
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block sidebar collapse" id="sidebar">
                <div class="position-sticky pt-3">
                    <div class="text-center mb-4">
                        <h4 class="text-white"><i class="fas fa-bus me-2"></i>FlotaPro</h4>
                        <?php if($this->session->userdata('logged_in')): ?>
                            <div class="user-info text-white">
                                <small>
                                    <i class="fas fa-user me-1"></i>
                                    <?php echo $this->session->userdata('nombre'); ?>
                                </small>
                                <br>
                                <?php 
                                $rol = $this->session->userdata('rol');
                                $rol_class = '';
                                switch($rol) {
                                    case 'admin':
                                        $rol_class = 'text-danger fw-bold'; // Rojo para admin
                                        break;
                                    case 'operador':
                                        $rol_class = 'text-warning fw-bold'; // Amarillo para operador
                                        break;
                                    case 'conductor':
                                        $rol_class = 'text-info fw-bold'; // Azul para conductor
                                        break;
                                    case 'pasajero':
                                        $rol_class = 'text-success fw-bold'; // Verde para pasajero
                                        break;
                                    default:
                                        $rol_class = 'text-light fw-bold'; // Blanco por defecto
                                }
                                ?>
                                <small class="<?php echo $rol_class; ?>">
                                    <?php echo ucfirst($rol); ?>
                                </small>
                            </div>
                        <?php endif; ?>
                    </div>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link <?php echo (strpos(current_url(), 'flota/index') !== false) ? 'active' : ''; ?>" href="<?php echo base_url('flota'); ?>">
                                <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (strpos(current_url(), 'flota/buses') !== false) ? 'active' : ''; ?>" href="<?php echo base_url('flota/buses'); ?>">
                                <i class="fas fa-bus me-2"></i>Buses
                            </a>
                        </li>
                        
                        <?php if(isset($permissions) && $permissions->can_access('conductores')): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (strpos(current_url(), 'flota/conductores') !== false) ? 'active' : ''; ?>" href="<?php echo base_url('flota/conductores'); ?>">
                                <i class="fas fa-user me-2"></i>Conductores
                            </a>
                        </li>
                        <?php endif; ?>
                        
                        <?php if(isset($permissions) && $permissions->can_access('rutas')): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (strpos(current_url(), 'flota/rutas') !== false) ? 'active' : ''; ?>" href="<?php echo base_url('flota/rutas'); ?>">
                                <i class="fas fa-route me-2"></i>Rutas
                            </a>
                        </li>
                        <?php endif; ?>
                        
                        <?php if(isset($permissions) && $permissions->can_access('viajes')): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (strpos(current_url(), 'flota/viajes') !== false) ? 'active' : ''; ?>" href="<?php echo base_url('flota/viajes'); ?>">
                                <i class="fas fa-calendar-alt me-2"></i>Viajes
                            </a>
                        </li>
                        <?php endif; ?>
                        
                        <?php if(isset($permissions) && $permissions->can_access('tickets')): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (strpos(current_url(), 'tickets') !== false) ? 'active' : ''; ?>" href="<?php echo base_url('tickets'); ?>">
                                <i class="fas fa-ticket-alt me-2"></i>Tickets
                            </a>
                        </li>
                        <?php endif; ?>
                        
                        <?php if($this->session->userdata('logged_in')): ?>
                            <hr class="text-white-50">
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo base_url('auth/profile'); ?>">
                                    <i class="fas fa-user-cog me-2"></i>Mi Perfil
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo base_url('auth/logout'); ?>">
                                    <i class="fas fa-sign-out-alt me-2"></i>Cerrar Sesión
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </nav>

            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <div class="page-title-container">
                        <?php 
                        // Determinar el icono y estilo según el título
                        $title_icon = '';
                        $title_class = '';
                        $title_color = '';
                        
                        if (strpos(strtolower($title), 'bus') !== false) {
                            $title_icon = 'fas fa-bus';
                            $title_class = 'title-buses';
                            $title_color = 'linear-gradient(135deg, #3498db, #2980b9)';
                        } elseif (strpos(strtolower($title), 'ruta') !== false) {
                            $title_icon = 'fas fa-route';
                            $title_class = 'title-routes';
                            $title_color = 'linear-gradient(135deg, #e74c3c, #c0392b)';
                        } elseif (strpos(strtolower($title), 'viaje') !== false) {
                            $title_icon = 'fas fa-calendar-alt';
                            $title_class = 'title-trips';
                            $title_color = 'linear-gradient(135deg, #f39c12, #e67e22)';
                        } elseif (strpos(strtolower($title), 'conductor') !== false) {
                            $title_icon = 'fas fa-user-tie';
                            $title_class = 'title-drivers';
                            $title_color = 'linear-gradient(135deg, #9b59b6, #8e44ad)';
                        } elseif (strpos(strtolower($title), 'ticket') !== false) {
                            $title_icon = 'fas fa-ticket-alt';
                            $title_class = 'title-tickets';
                            $title_color = 'linear-gradient(135deg, #27ae60, #2ecc71)';
                        } elseif (strpos(strtolower($title), 'perfil') !== false) {
                            $title_icon = 'fas fa-user-cog';
                            $title_class = 'title-profile';
                            $title_color = 'linear-gradient(135deg, #34495e, #2c3e50)';
                        } elseif (strpos(strtolower($title), 'dashboard') !== false) {
                            $title_icon = 'fas fa-tachometer-alt';
                            $title_class = 'title-dashboard';
                            $title_color = 'linear-gradient(135deg, #667eea, #764ba2)';
                        } else {
                            $title_icon = 'fas fa-file-alt';
                            $title_class = 'title-default';
                            $title_color = 'linear-gradient(135deg, #95a5a6, #7f8c8d)';
                        }
                        ?>
                        <h1 class="h2 page-title <?php echo $title_class; ?>">
                            <i class="<?php echo $title_icon; ?> me-3"></i>
                            <?php echo $title; ?>
                        </h1>
                        <div class="title-underline" style="background: <?php echo $title_color; ?>;"></div>
                    </div>
                </div>
                
                <!-- JavaScript para menú móvil -->
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const mobileMenuToggle = document.getElementById('mobileMenuToggle');
                        const sidebar = document.getElementById('sidebar');
                        
                        // Toggle del menú móvil
                        mobileMenuToggle.addEventListener('click', function() {
                            sidebar.classList.toggle('show');
                        });
                        
                        // Cerrar menú al hacer clic fuera
                        document.addEventListener('click', function(e) {
                            if (!sidebar.contains(e.target) && !mobileMenuToggle.contains(e.target)) {
                                sidebar.classList.remove('show');
                            }
                        });
                        
                        // Cerrar menú al hacer clic en un enlace
                        const sidebarLinks = sidebar.querySelectorAll('a');
                        sidebarLinks.forEach(link => {
                            link.addEventListener('click', function() {
                                if (window.innerWidth <= 768) {
                                    sidebar.classList.remove('show');
                                }
                            });
                        });
                        
                        // Detectar cambios de orientación
                        window.addEventListener('orientationchange', function() {
                            setTimeout(function() {
                                if (window.innerWidth <= 768) {
                                    sidebar.classList.remove('show');
                                }
                            }, 100);
                        });
                        
                        // Ajustar layout en móviles
                        function adjustMobileLayout() {
                            if (window.innerWidth <= 768) {
                                const title = document.querySelector('.h2');
                                if (title) {
                                    title.style.marginTop = '0';
                                    title.style.paddingTop = '0.5rem';
                                    title.style.textAlign = 'center';
                                }
                                
                                // Centrar títulos de tarjetas
                                const cardHeaders = document.querySelectorAll('.card-header h5, .card-header h6, .card-header .h5, .card-header .h6');
                                cardHeaders.forEach(header => {
                                    header.style.textAlign = 'center';
                                });
                                
                                // Centrar títulos de secciones
                                const cardTitles = document.querySelectorAll('.card-title, .card-subtitle');
                                cardTitles.forEach(title => {
                                    title.style.textAlign = 'center';
                                });
                            }
                        }
                        
                        // Ejecutar al cargar y al cambiar tamaño
                        adjustMobileLayout();
                        window.addEventListener('resize', adjustMobileLayout);
                    });
                </script>
