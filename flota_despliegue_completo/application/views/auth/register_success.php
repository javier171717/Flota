<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Exitoso - FlotaPro</title>
    
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
        
        .success-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            overflow: hidden;
            width: 100%;
            max-width: 500px;
            text-align: center;
        }
        
        .success-header {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
            text-align: center;
            padding: 40px 20px;
        }
        
        .success-header i {
            font-size: 4rem;
            margin-bottom: 20px;
        }
        
        .success-header h3 {
            margin: 0;
            font-size: 28px;
            font-weight: 600;
        }
        
        .success-header p {
            margin: 15px 0 0 0;
            opacity: 0.9;
            font-size: 16px;
        }
        
        .success-body {
            padding: 40px 30px;
        }
        
        .success-message {
            background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
            border: 1px solid #c3e6cb;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 30px;
            color: #155724;
        }
        
        .success-message i {
            font-size: 2rem;
            color: #28a745;
            margin-bottom: 15px;
        }
        
        .btn-login {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 50px;
            padding: 15px 40px;
            font-weight: 600;
            font-size: 18px;
            color: white;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
            margin-bottom: 20px;
        }
        
        .btn-login:hover {
            background: linear-gradient(135deg, #5a6fd8 0%, #6a4190 100%);
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
            color: white;
            text-decoration: none;
        }
        
        .auto-redirect {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-top: 20px;
        }
        
        .countdown {
            font-size: 1.2rem;
            font-weight: 600;
            color: #667eea;
        }
        
        .manual-link {
            margin-top: 15px;
            color: #6c757d;
        }
        
        .manual-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }
        
        .manual-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="success-container">
        <div class="success-header">
            <i class="fas fa-check-circle"></i>
            <h3>¡Registro Exitoso!</h3>
            <p>Tu cuenta ha sido creada correctamente</p>
        </div>
        
        <div class="success-body">
            <div class="success-message">
                <i class="fas fa-user-check"></i>
                <h4>¡Bienvenido a FlotaPro!</h4>
                <p>Tu usuario ha sido registrado exitosamente en el sistema. Ya puedes acceder con tu nueva cuenta.</p>
            </div>
            
            <a href="<?php echo base_url('auth'); ?>" class="btn btn-login">
                <i class="fas fa-sign-in-alt me-2"></i>Iniciar Sesión
            </a>
            
            <div class="auto-redirect">
                <p class="countdown">Redirección automática en <span id="countdown">5</span> segundos</p>
                <div class="manual-link">
                    Si no eres redirigido automáticamente, 
                    <a href="<?php echo base_url('auth'); ?>">haz clic aquí</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Contador regresivo para redirección automática
        let countdown = 5;
        const countdownElement = document.getElementById('countdown');
        
        const timer = setInterval(function() {
            countdown--;
            countdownElement.textContent = countdown;
            
            if (countdown <= 0) {
                clearInterval(timer);
                window.location.href = '<?php echo base_url('auth'); ?>';
            }
        }, 1000);
        
        // Redirección automática después de 5 segundos
        setTimeout(function() {
            window.location.href = '<?php echo base_url('auth'); ?>';
        }, 5000);
    </script>
</body>
</html>
