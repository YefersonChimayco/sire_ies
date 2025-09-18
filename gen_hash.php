<?php
// Contraseña en texto plano que quieres usar
$plain = "admin2025";  

// Generar hash seguro con BCRYPT
$hash = password_hash($plain, PASSWORD_BCRYPT);

// Mostrar resultados en pantalla
echo "<h2>Generador de Hash</h2>";
echo "Contraseña en texto plano: <b>$plain</b><br>";
echo "Hash generado:<br><textarea cols='80' rows='3'>$hash</textarea>";
?>
