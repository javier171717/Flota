<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirigiendo...</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .redirect-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            max-width: 400px;
            width: 100%;
        }
        .success-icon {
            font-size: 4rem;
            color: #28a745;
            margin-bottom: 1rem;
        }
        .countdown {
            font-size: 2rem;
            font-weight: bold;
            color: #6f42c1;
            margin: 1rem 0;
        }
    </style>
</head>
<body>
    <div class="redirect-card">
        <div class="success-icon">
            <i class="fas fa-check-circle"></i>
        </div>
        <h3 class="text-success mb-3">¡Contraseña Actualizada!</h3>
        <p class="text-muted mb-4">
            Tu contraseña ha sido actualizada exitosamente. 
            Serás redirigido al login en <span class="countdown" id="countdown">5</span> segundos.
        </p>
        <div class="progress mb-3" style="height: 8px;">
            <div class="progress-bar bg-success" id="progressBar" role="progressbar" style="width: 100%"></div>
        </div>
        <a href="<?php echo base_url('auth'); ?>" class="btn btn-primary btn-lg">
            <i class="fas fa-sign-in-alt me-2"></i>Ir al Login
        </a>
    </div>

    <script>
        let countdown = 5;
        const countdownElement = document.getElementById('countdown');
        const progressBar = document.getElementById('progressBar');
        
        const timer = setInterval(() => {
            countdown--;
            countdownElement.textContent = countdown;
            progressBar.style.width = (countdown / 5 * 100) + '%';
            
            if (countdown <= 0) {
                clearInterval(timer);
                window.location.href = '<?php echo base_url('auth'); ?>';
            }
        }, 1000);
    </script>
</body>
</html>
