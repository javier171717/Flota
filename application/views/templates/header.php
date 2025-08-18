<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?> - FlotaPro</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
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
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block sidebar collapse">
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
                                <small class="text-muted">
                                    <?php echo ucfirst($this->session->userdata('rol')); ?>
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
                        <?php if(isset($permissions) && $permissions->can_access('buses')): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (strpos(current_url(), 'flota/buses') !== false) ? 'active' : ''; ?>" href="<?php echo base_url('flota/buses'); ?>">
                                <i class="fas fa-bus me-2"></i>Buses
                            </a>
                        </li>
                        <?php endif; ?>
                        
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
                    <h1 class="h2"><?php echo $title; ?></h1>
                </div>
