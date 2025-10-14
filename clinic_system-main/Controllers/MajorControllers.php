<?php

use Clini_system_mousa\Clinic_system\Clinic\Doctor;
require_once __DIR__ . "/../Clinic/Doctor.php";
require_once __DIR__ . "/../Clinic/Appointment.php";
require_once __DIR__ . "/../Clinic/Contact.php";
require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . "/../Clinic/database.php";

$db = \Database::get_instance($config);
$pdo = $db->get_connection();

// Get unique majors instead of all doctors
$majors = Doctor::get_all_majors($pdo);

?>