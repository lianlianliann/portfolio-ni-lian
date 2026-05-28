<?php
// Database configuration
$host = 'localhost';
$dbname = 'portfolio_ni_lian';
$username = 'root'; 
$password = '';     

try {
    // Create the PDO connection (the bridge)
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    
    // Set PDO error mode to exception so we can easily spot bugs
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Connected successfully to the warehouse!"; 
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    die(); 
}
?>