<?php
// Archivo temporal para corregir la base de datos
// Ejecutar desde el navegador: http://localhost/Flota/fix_db.php

// Conectar a la base de datos
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'flota_db';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "<h2>Corrigiendo base de datos...</h2>";
    
    // 1. Actualizar emails vacíos a NULL
    $stmt = $pdo->prepare("UPDATE conductores SET email = NULL WHERE email = '' OR email = ' '");
    $stmt->execute();
    $affected = $stmt->rowCount();
    echo "<p>✅ Emails vacíos convertidos a NULL: $affected registros</p>";
    
    // 2. Verificar si hay emails duplicados
    $stmt = $pdo->prepare("SELECT email, COUNT(*) as cantidad FROM conductores WHERE email IS NOT NULL GROUP BY email HAVING COUNT(*) > 1");
    $stmt->execute();
    $duplicates = $stmt->fetchAll();
    
    if (count($duplicates) > 0) {
        echo "<p>⚠️ Se encontraron emails duplicados:</p>";
        foreach ($duplicates as $dup) {
            echo "<p>- Email: {$dup['email']} (Cantidad: {$dup['cantidad']})</p>";
        }
        
        // 3. Corregir emails duplicados
        $stmt = $pdo->prepare("
            UPDATE conductores c1 
            JOIN (
                SELECT email, MIN(id) as min_id 
                FROM conductores 
                WHERE email IS NOT NULL 
                GROUP BY email 
                HAVING COUNT(*) > 1
            ) c2 ON c1.email = c2.email AND c1.id != c2.min_id
            SET c1.email = NULL
        ");
        $stmt->execute();
        $affected = $stmt->rowCount();
        echo "<p>✅ Emails duplicados corregidos: $affected registros</p>";
    } else {
        echo "<p>✅ No se encontraron emails duplicados</p>";
    }
    
    // 4. Verificar el estado final
    $stmt = $pdo->prepare("SELECT COUNT(*) as total FROM conductores");
    $stmt->execute();
    $total = $stmt->fetch()['total'];
    
    $stmt = $pdo->prepare("SELECT COUNT(*) as con_email FROM conductores WHERE email IS NOT NULL");
    $stmt->execute();
    $conEmail = $stmt->fetch()['con_email'];
    
    $stmt = $pdo->prepare("SELECT COUNT(*) as sin_email FROM conductores WHERE email IS NULL");
    $stmt->execute();
    $sinEmail = $stmt->fetch()['sin_email'];
    
    echo "<h3>Estado final de la base de datos:</h3>";
    echo "<p>📊 Total de conductores: $total</p>";
    echo "<p>📧 Con email: $conEmail</p>";
    echo "<p>❌ Sin email: $sinEmail</p>";
    
    echo "<p><strong>✅ Base de datos corregida exitosamente!</strong></p>";
    echo "<p><a href='flota/conductores'>Volver a conductores</a></p>";
    
} catch(PDOException $e) {
    echo "<h2>❌ Error en la base de datos:</h2>";
    echo "<p>" . $e->getMessage() . "</p>";
}
?>
