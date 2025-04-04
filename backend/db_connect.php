<?php
// Database configuration for Hostinger
$host = "localhost"; // Hostinger's MySQL host
$dbname = "u925942308_infinoid_db"; // Replace with your Hostinger database name
$username = "u925942308_infinoid"; // Replace with your Hostinger database username
$password = "infinoid@123"; // Replace with your Hostinger database password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?> 
