<?php

require_once 'config/database.php';
require_once 'Clinic/Doctor.php';
require_once 'Clinic/Contact.php';
require_once 'Clinic/Appointment.php';

use Clini_system_mousa\Clinic_system\Clinic\Doctor;
use Clini_system_mousa\Clinic_system\Clinic\Contact;
use Clini_system_mousa\Clinic_system\Clinic\Appointment;

try {
    $pdo = new PDO("mysql:host=localhost;dbname=clinic_system", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "<h1>Database Connected Successfully</h1><hr>";
} catch (PDOException $e) {
    die("Database Connection Failed: " . $e->getMessage());
}

echo "<style>
    body { font-family: Arial, sans-serif; margin: 20px; direction: rtl; }
    .success { color: green; background: #e8f5e8; padding: 10px; margin: 5px 0; border-radius: 5px; }
    .error { color: red; background: #ffe8e8; padding: 10px; margin: 5px 0; border-radius: 5px; }
    .info { color: blue; background: #e8f0ff; padding: 10px; margin: 5px 0; border-radius: 5px; }
    .section { border: 2px solid #ddd; margin: 20px 0; padding: 15px; border-radius: 10px; }
    h2 { color: #333; border-bottom: 2px solid #4CAF50; padding-bottom: 10px; }
    h3 { color: #666; }
</style>";

echo "<div class='section'>";
echo "<h2>Doctor Functions Test</h2>";

echo "<h3>1. Test create_doctor</h3>";
try {
    $doctor = Doctor::create_doctor($pdo, "Dr. Ahmed Mohamed", "ahmed@clinic.com", "01234567890", "Cardiology");
    if ($doctor) {
        echo "<div class='success'>Doctor created successfully - ID: " . $doctor->getId() . "</div>";
        $test_doctor_id = $doctor->getId();
    } else {
        echo "<div class='error'>Failed to create doctor</div>";
    }
} catch (Exception $e) {
    echo "<div class='error'>Error creating doctor: " . $e->getMessage() . "</div>";
}

echo "<h3>2. Test get_info_doctros</h3>";
try {
    $doctors = Doctor::get_info_doctros($pdo);
    echo "<div class='success'>Retrieved " . count($doctors) . " doctors</div>";
    foreach ($doctors as $doc) {
        echo "<div class='info'>" . $doc->getName() . " - " . $doc->getMajor() . "</div>";
    }
} catch (Exception $e) {
    echo "<div class='error'>Error retrieving doctors: " . $e->getMessage() . "</div>";
}

echo "<h3>3. Test get_doctor_by_id</h3>";
if (isset($test_doctor_id)) {
    try {
        $doctor = Doctor::get_doctor_by_id($pdo, $test_doctor_id);
        if ($doctor) {
            echo "<div class='success'>Doctor found: " . $doctor->getName() . "</div>";
        } else {
            echo "<div class='error'>Doctor not found</div>";
        }
    } catch (Exception $e) {
        echo "<div class='error'>Error finding doctor: " . $e->getMessage() . "</div>";
    }
}

echo "<h3>4. Test get_doctors_by_major</h3>";
try {
    $doctors = Doctor::get_doctors_by_major($pdo, "Cardiology");
    echo "<div class='success'>Found " . count($doctors) . " cardiologists</div>";
} catch (Exception $e) {
    echo "<div class='error'>Error finding cardiologists: " . $e->getMessage() . "</div>";
}

echo "<h3>5. Test get_all_majors</h3>";
try {
    $majors = Doctor::get_all_majors($pdo);
    echo "<div class='success'>Found " . count($majors) . " specialties</div>";
    echo "<div class='info'>Specialties: " . implode(", ", $majors) . "</div>";
} catch (Exception $e) {
    echo "<div class='error'>Error getting specialties: " . $e->getMessage() . "</div>";
}

echo "<h3>6. Test get_doctor_by_name</h3>";
try {
    $doctor = Doctor::get_doctor_by_name($pdo, "Dr. Ahmed Mohamed");
    if ($doctor) {
        echo "<div class='success'>Doctor found: " . $doctor->getName() . "</div>";
    } else {
        echo "<div class='error'>Doctor not found</div>";
    }
} catch (Exception $e) {
    echo "<div class='error'>Error finding doctor: " . $e->getMessage() . "</div>";
}

echo "<h3>7. Test get_all_doctor_by_name</h3>";
try {
    $names = Doctor::get_all_doctor_by_name($pdo);
    if ($names) {
        echo "<div class='success'>Retrieved " . count($names) . " doctor names</div>";
        echo "<div class='info'>Names: " . implode(", ", $names) . "</div>";
    }
} catch (Exception $e) {
    echo "<div class='error'>Error getting doctor names: " . $e->getMessage() . "</div>";
}

echo "<h3>8. Test get_doctor_by_email</h3>";
try {
    $doctor = Doctor::get_doctor_by_email($pdo, "ahmed@clinic.com");
    if ($doctor) {
        echo "<div class='success'>Doctor found: " . $doctor->getName() . "</div>";
    } else {
        echo "<div class='error'>Doctor not found</div>";
    }
} catch (Exception $e) {
    echo "<div class='error'>Error finding doctor: " . $e->getMessage() . "</div>";
}

echo "<h3>9. Test update_doctor</h3>";
if (isset($test_doctor_id)) {
    try {
        $updated_doctor = Doctor::update_doctor($pdo, $test_doctor_id, "Dr. Ahmed Mohamed Updated", "ahmed_updated@clinic.com", "01234567891", "Cardiovascular");
        if ($updated_doctor) {
            echo "<div class='success'>Doctor updated successfully</div>";
        } else {
            echo "<div class='error'>Failed to update doctor</div>";
        }
    } catch (Exception $e) {
        echo "<div class='error'>Error updating doctor: " . $e->getMessage() . "</div>";
    }
}

echo "<h3>10. Test delete_doctor</h3>";
if (isset($test_doctor_id)) {
    try {
        $deleted = Doctor::delete_doctor($pdo, $test_doctor_id);
        if ($deleted) {
            echo "<div class='success'>Doctor deleted successfully</div>";
        } else {
            echo "<div class='error'>Failed to delete doctor</div>";
        }
    } catch (Exception $e) {
        echo "<div class='error'>Error deleting doctor: " . $e->getMessage() . "</div>";
    }
}

echo "</div>";

echo "<div class='section'>";
echo "<h2>Contact Functions Test</h2>";

echo "<h3>1. Test create_contact</h3>";
try {
    $contact = Contact::create_contact($pdo, "Mohamed Ali", "mohamed@test.com", "01111111111", "General Inquiry", "I want to know working hours");
    if ($contact) {
        echo "<div class='success'>Contact created successfully</div>";
        $test_contact_id = $contact->getId();
    } else {
        echo "<div class='error'>Failed to create contact</div>";
    }
} catch (Exception $e) {
    echo "<div class='error'>Error creating contact: " . $e->getMessage() . "</div>";
}

echo "<h3>2. Test update_contact</h3>";
if (isset($test_contact_id)) {
    try {
        $updated_contact = Contact::update_contact($pdo, $test_contact_id, "Mohamed Ali Updated", "mohamed_updated@test.com", "01111111112", "Updated Inquiry", "Updated message");
        if ($updated_contact) {
            echo "<div class='success'>Contact updated successfully</div>";
        } else {
            echo "<div class='error'>Failed to update contact</div>";
        }
    } catch (Exception $e) {
        echo "<div class='error'>Error updating contact: " . $e->getMessage() . "</div>";
    }
}

echo "<h3>3. Test delete_contact</h3>";
if (isset($test_contact_id)) {
    try {
        $deleted = Contact::delete_contact($pdo, $test_contact_id);
        if ($deleted) {
            echo "<div class='success'>Contact deleted successfully</div>";
        } else {
            echo "<div class='error'>Failed to delete contact</div>";
        }
    } catch (Exception $e) {
        echo "<div class='error'>Error deleting contact: " . $e->getMessage() . "</div>";
    }
}

echo "</div>";

echo "<div class='section'>";
echo "<h2>Appointment Functions Test</h2>";

echo "<h3>1. Test create_appointment</h3>";
try {
    $appointment = Appointment::create_appointment($pdo, "Sara Ahmed", "sara@test.com", "01222222222");
    if ($appointment) {
        echo "<div class='success'>Appointment created successfully</div>";
        $test_appointment_id = $appointment->getId();
    } else {
        echo "<div class='error'>Failed to create appointment</div>";
    }
} catch (Exception $e) {
    echo "<div class='error'>Error creating appointment: " . $e->getMessage() . "</div>";
}

echo "<h3>2. Test get_info_appointment</h3>";
try {
    $appointments = Appointment::get_info_appointment($pdo);
    echo "<div class='success'>Retrieved " . count($appointments) . " appointments</div>";
} catch (Exception $e) {
    echo "<div class='error'>Error retrieving appointments: " . $e->getMessage() . "</div>";
}

echo "<h3>3. Test update_appointment</h3>";
if (isset($test_appointment_id)) {
    try {
        $updated_appointment = Appointment::update_appointment($pdo, $test_appointment_id, "Sara Ahmed Updated", "sara_updated@test.com", "01222222223");
        if ($updated_appointment) {
            echo "<div class='success'>Appointment updated successfully</div>";
        } else {
            echo "<div class='error'>Failed to update appointment</div>";
        }
    } catch (Exception $e) {
        echo "<div class='error'>Error updating appointment: " . $e->getMessage() . "</div>";
    }
}

echo "<h3>4. Test delete_appointment</h3>";
if (isset($test_appointment_id)) {
    try {
        $deleted = Appointment::delete_appointment($pdo, $test_appointment_id);
        if ($deleted) {
            echo "<div class='success'>Appointment deleted successfully</div>";
        } else {
            echo "<div class='error'>Failed to delete appointment</div>";
        }
    } catch (Exception $e) {
        echo "<div class='error'>Error deleting appointment: " . $e->getMessage() . "</div>";
    }
}

echo "</div>";

echo "<div class='section'>";
echo "<h2>Test Summary</h2>";
echo "<div class='info'>";
echo "<h3>Functions Tested:</h3>";
echo "<strong>Doctor Class:</strong><br>";
echo "• create_doctor<br>";
echo "• get_info_doctros<br>";
echo "• get_doctor_by_id<br>";
echo "• get_doctors_by_major<br>";
echo "• get_all_majors<br>";
echo "• get_doctor_by_name<br>";
echo "• get_all_doctor_by_name<br>";
echo "• get_doctor_by_email<br>";
echo "• update_doctor<br>";
echo "• delete_doctor<br><br>";

echo "<strong>Contact Class:</strong><br>";
echo "• create_contact<br>";
echo "• update_contact<br>";
echo "• delete_contact<br><br>";

echo "<strong>Appointment Class:</strong><br>";
echo "• create_appointment<br>";
echo "• get_info_appointment<br>";
echo "• update_appointment<br>";
echo "• delete_appointment<br>";
echo "</div>";
echo "</div>";

echo "<h2 style='text-align: center; color: green;'>Test Completed Successfully!</h2>";

?>
