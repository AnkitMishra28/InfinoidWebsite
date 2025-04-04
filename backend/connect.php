<?php
// Database configuration
$host = 'localhost';
$port = '3306';
$dbname = 'infinoid_db';
$username = 'root';
$password = ''; // Update this with your MySQL password

try {
    // Create connection
    $conn = new mysqli($host, $username, $password, $dbname);
    
    // Check connection
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }
    
    // Set charset to utf8mb4
    $conn->set_charset("utf8mb4");
    
    // Create database if not exists
    $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
    if ($conn->query($sql) === TRUE) {
        // Select the database
        $conn->select_db($dbname);
        
        // Create contacts table if not exists
        $sql = "CREATE TABLE IF NOT EXISTS contacts (
            id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            name VARCHAR(100) NOT NULL,
            email VARCHAR(100) NOT NULL,
            phone VARCHAR(20),
            service VARCHAR(100),
            message TEXT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
        
        if (!$conn->query($sql)) {
            throw new Exception("Error creating table: " . $conn->error);
        }
    }
    
} catch (Exception $e) {
    die("Database connection error: " . $e->getMessage());
}
?> 