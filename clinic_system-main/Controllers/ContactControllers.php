
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once "./config/database.php";
require_once "./Clinic/Contact.php";
require_once "./Clinic/database.php";

use Clini_system_mousa\Clinic_system\Clinic\Contact;

// Create PDO connection
// $db = Database::get_instance($config);
// $pdo = $db->get_connection();
$pdo = Conn::connection($config);
$message = '';
$messageType = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['send_message'])) {
    $name = trim($_POST['name'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $messageText = trim($_POST['message'] ?? '');
    
    // Validate input
    if (empty($name) || empty($phone) || empty($email) || empty($subject) || empty($messageText)) {
        $message = 'All fields are required.';
        $messageType = 'danger';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = 'Please enter a valid email address.';
        $messageType = 'danger';
    } else {
        try {
            // Create contact message
            $contact = Contact::create_contact($pdo, $name, $email, $phone, $subject, $messageText);
            if ($contact) {
                $message = 'Message sent successfully! We will get back to you soon.';
                $messageType = 'success';
                // Clear form data
                $_POST = [];
            } else {
                $message = 'Failed to send message. Please try again.';
                $messageType = 'danger';
            }
        } catch (PDOException $ex) {
            $message = $ex->getMessage();
            $messageType = 'danger';
        }
    }
}
?>