<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../../Clinic/Appointment.php";
require_once __DIR__ . "/../../Clinic/database.php";

use Clini_system_mousa\Clinic_system\Clinic\Appointment;

// Get database connection
$db = \Database::get_instance($config);
$pdo = $db->get_connection();

/**
 * Get all appointments
 * @return array
 */
function get_apoiment() {
    global $pdo;
    return Appointment::get_info_appointment($pdo);
}

$message = '';
$messageType = '';

// Handle delete appointment request
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $appointmentId = (int)$_GET['id'];
    
    try {
        $success = Appointment::delete_appointment($pdo, $appointmentId);
        
        if ($success) {
            $message = 'Appointment deleted successfully!';
            $messageType = 'success';
        } else {
            $message = 'Failed to delete appointment. Appointment may not exist.';
            $messageType = 'danger';
        }
    } catch (PDOException $ex) {
        $message = 'Database error: ' . $ex->getMessage();
        $messageType = 'danger';
    }
    
    // Redirect to avoid resubmission on page refresh
    header("Location: index.php?page=apoiments");
    exit();
}