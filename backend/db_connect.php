<<<<<<< HEAD
<?php
// Database configuration for Hostinger
$host = "localhost"; // Hostinger's MySQL host
$dbname = "u123456789_your_db_name"; // Replace with your Hostinger database name
$username = "u123456789_your_username"; // Replace with your Hostinger database username
$password = "your_password"; // Replace with your Hostinger database password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
=======
<?php
// Database configuration for Hostinger
$host = "localhost"; // Hostinger's MySQL host
$dbname = "u123456789_your_db_name"; // Replace with your Hostinger database name
$username = "u123456789_your_username"; // Replace with your Hostinger database username
$password = "your_password"; // Replace with your Hostinger database password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
>>>>>>> 9667ecf (Updated components, added new files)
?> 