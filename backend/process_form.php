<?php
require_once 'db_connect.php';
require_once 'send_email.php';

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set CORS headers
header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Accept");
header('Content-Type: application/json');

// Log the incoming request
error_log("Received request: " . file_get_contents("php://input"));

if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
    http_response_code(200);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Get form data
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $phone = $_POST['phone'] ?? '';
        $message = $_POST['message'] ?? '';
        $service = $_POST['service'] ?? '';

        // Validate required fields
        if (empty($name) || empty($email) || empty($message)) {
            throw new Exception('Required fields are missing');
        }

        // Insert into database
        $stmt = $pdo->prepare("INSERT INTO contact_form (name, email, phone, message, service, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
        $stmt->execute([$name, $email, $phone, $message, $service]);

        // Send email
        $to = "info@infinoid.com";
        $subject = "New Contact Form Submission from " . $name;
        $emailMessage = "
            <html>
            <head>
                <title>New Contact Form Submission</title>
            </head>
            <body>
                <h2>New Contact Form Submission</h2>
                <p><strong>Name:</strong> {$name}</p>
                <p><strong>Email:</strong> {$email}</p>
                <p><strong>Phone:</strong> {$phone}</p>
                <p><strong>Service:</strong> {$service}</p>
                <p><strong>Message:</strong> {$message}</p>
            </body>
            </html>
        ";

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: {$email}" . "\r\n";

        if (sendEmail($to, $subject, $emailMessage, $headers)) {
            echo json_encode(['success' => true, 'message' => 'Form submitted successfully']);
        } else {
            throw new Exception('Failed to send email');
        }

    } catch (Exception $e) {
        error_log("Error in process_form.php: " . $e->getMessage());
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
} else {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
}
?>
<?php
require_once 'db_connect.php';
require_once 'send_email.php';

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set CORS headers
header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Accept");
header('Content-Type: application/json');

// Log the incoming request
error_log("Received request: " . file_get_contents("php://input"));

if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
    http_response_code(200);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Get form data
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $phone = $_POST['phone'] ?? '';
        $message = $_POST['message'] ?? '';
        $service = $_POST['service'] ?? '';

        // Validate required fields
        if (empty($name) || empty($email) || empty($message)) {
            throw new Exception('Required fields are missing');
        }

        // Insert into database
        $stmt = $pdo->prepare("INSERT INTO contact_form (name, email, phone, message, service, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
        $stmt->execute([$name, $email, $phone, $message, $service]);

        // Send email
        $to = "info@infinoid.com";
        $subject = "New Contact Form Submission from " . $name;
        $emailMessage = "
            <html>
            <head>
                <title>New Contact Form Submission</title>
            </head>
            <body>
                <h2>New Contact Form Submission</h2>
                <p><strong>Name:</strong> {$name}</p>
                <p><strong>Email:</strong> {$email}</p>
                <p><strong>Phone:</strong> {$phone}</p>
                <p><strong>Service:</strong> {$service}</p>
                <p><strong>Message:</strong> {$message}</p>
            </body>
            </html>
        ";

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: {$email}" . "\r\n";

        if (sendEmail($to, $subject, $emailMessage, $headers)) {
            echo json_encode(['success' => true, 'message' => 'Form submitted successfully']);
        } else {
            throw new Exception('Failed to send email');
        }

    } catch (Exception $e) {
        error_log("Error in process_form.php: " . $e->getMessage());
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
} else {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
}
?>
