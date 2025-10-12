<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../../Clinic/Doctor.php";
require_once __DIR__ . "/../../Clinic/database.php";

use Clini_system_mousa\Clinic_system\Clinic\Doctor;

$pdo = Conn::connection($config);
$message = '';
$messageType = '';

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create-doctor'])){

    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $major = trim($_POST['major'] ?? '');
    
    // Validate required fields
    if (empty($name) || empty($email) || empty($phone) || empty($major)) {
        $message = 'All fields are required.';
        $messageType = 'danger';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = 'Please enter a valid email address.';
        $messageType = 'danger';
    } else {
        // Handle image upload
        $imageName = '';
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/../../views/assets/images/majors/';
            
            // Create directory if it doesn't exist
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            
            $fileExtension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
            
            if (in_array($fileExtension, $allowedExtensions)) {
                // Use major name as image name (sanitized)
                $sanitizedMajor = preg_replace('/[^a-zA-Z0-9_-]/', '_', strtolower($major));
                $imageName = $sanitizedMajor . '.' . $fileExtension;
                $uploadPath = $uploadDir . $imageName;
                
                if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {
                    // Image uploaded successfully
                } else {
                    $message = 'Failed to upload image.';
                    $messageType = 'danger';
                }
            } else {
                $message = 'Invalid image format. Please upload JPG, JPEG, PNG, or GIF.';
                $messageType = 'danger';
            }
        } else {
            // Use default image name based on major
            $sanitizedMajor = preg_replace('/[^a-zA-Z0-9_-]/', '_', strtolower($major));
            $imageName = $sanitizedMajor . '.jpg'; // Default to .jpg
        }
        
        // Create doctor if no errors
        if (empty($message)) {
            try {
                $doctor = Doctor::create_doctor($pdo, $name, $email, $phone, $major, $imageName);
                if ($doctor) {
                    $message = 'Doctor created successfully!';
                    $messageType = 'success';
                    // Clear form data
                    $_POST = [];
                } else {
                    $message = 'Failed to create doctor. Please try again.';
                    $messageType = 'danger';
                }
            } catch (PDOException $ex) {
                $message = 'Database error: ' . $ex->getMessage();
                $messageType = 'danger';
            }
        }
    }
}
?>