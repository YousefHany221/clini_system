<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$success = $_SESSION['success'] ?? '';
unset($_SESSION['success']);

require_once "./config/database.php";
require_once "./Clinic/Doctor.php";
require_once "./Clinic/Appointment.php";
require_once "./Clinic/database.php";
require_once "./Clinic/Contact.php";
// Create PDO connection
// try {
//     $pdo = new PDO("mysql:host={$config['host']};dbname={$config['dbName']}", $config['user'], $config['password']);
//     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// } catch (PDOException $e) {
//     die("Connection failed: " . $e->getMessage());
// }
$db = Database::get_instance($config);
$pdo = $db->get_connection();

// Get doctors data
$doctors = \Clini_system_mousa\Clinic_system\Clinic\Doctor::get_info_doctros($pdo);
?>