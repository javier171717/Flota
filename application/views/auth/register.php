<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FlotaPro</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px 0;
        }
        
        .register-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            overflow: hidden;
            width: 100%;
            max-width: 500px;
        }
        
        .register-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-align: center;
            padding: 30px 20px;
        }
        
        .register-header h3 {
            margin: 0;
            font-size: 24px;
        }
        
        .register-header p {
            margin: 10px 0 0 0;
            opacity: 0.9;
        }
        
        .register-body {
            padding: 40px 30px;
        }
        
        .form-floating {
            margin-bottom: 20px;
        }
        
        .btn-register {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 50px;
            padding: 12px 30px;
            font-weight: 600;
            width: 100%;
            margin-bottom: 20px;
        }
        
        .btn-register:hover {
            background: linear-gradient(135deg, #5a6fd8 0%, #6a4190 100%);
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }
        
        .login-link {
            text-align: center;
            color: #666;
        }
        
        .login-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }
        
        .alert {
            border-radius: 10px;
            border: none;
        }
        
        .alert-danger {
            background: #fee;
            color: #c33;
        }
        
        .alert-success {
            background: #efe;
            color: #363;
        }
        
        .form-select {
            padding-top: 1.625rem;
            padding-bottom: 0.625rem;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-header">
            <h3><i class="fas fa-user-plus me-2"></i>Registro de Usuario</h3>
            <p>Crea tu cuenta para acceder al sistema</p>
        </div>
        
        <div class="register-body">
            <?php if($this->session->flashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <?php echo $this->session->flashdata('error'); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>
            
            <?php if($this->session->flashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    <?php echo $this->session->flashdata('success'); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>
            
            <?php echo form_open('auth/register'); ?>
                <div class="form-floating">
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre completo" required>
                    <label for="nombre"><i class="fas fa-user me-2"></i>Nombre completo</label>
                    <?php echo form_error('nombre', '<small class="text-danger">', '</small>'); ?>
                </div>
                
                <div class="form-floating">
                    <input type="email" class="form-control" id="email" name="email" placeholder="nombre@ejemplo.com" required>
                    <label for="email"><i class="fas fa-envelope me-2"></i>Email</label>
                    <?php echo form_error('email', '<small class="text-danger">', '</small>'); ?>
                </div>
                
                <div class="form-floating">
                    <select class="form-select" id="rol" name="rol" required>
                        <option value="">Seleccionar rol</option>
                        <option value="operador">Operador</option>
                        <option value="conductor">Conductor</option>
                        <option value="admin">Administrador</option>
                    </select>
                    <label for="rol"><i class="fas fa-user-tag me-2"></i>Rol</label>
                    <?php echo form_error('rol', '<small class="text-danger">', '</small>'); ?>
                </div>
                
                <div class="form-floating">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required>
                    <label for="password"><i class="fas fa-lock me-2"></i>Contraseña</label>
                    <?php echo form_error('password', '<small class="text-danger">', '</small>'); ?>
                </div>
                
                <div class="form-floating">
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirmar contraseña" required>
                    <label for="confirm_password"><i class="fas fa-lock me-2"></i>Confirmar contraseña</label>
                    <?php echo form_error('confirm_password', '<small class="text-danger">', '</small>'); ?>
                </div>
                
                <button type="submit" class="btn btn-primary btn-register">
                    <i class="fas fa-user-plus me-2"></i>Crear Cuenta
                </button>
            <?php echo form_close(); ?>
            
            <div class="login-link">
                ¿Ya tienes cuenta? 
                <a href="<?php echo base_url('auth'); ?>">Inicia sesión aquí</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
