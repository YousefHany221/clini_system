<?php
require_once 'Clinic/database.php';
require_once 'Clinic/Doctor.php';
require_once 'config/database.php';

use Clini_system_mousa\Clinic_system\Clinic\Doctor;

// إنشاء اتصال بقاعدة البيانات
$pdo = Conn::connection($config);

echo "<h1>اختبار مبسط لـ Doctor Functions</h1>\n";

// غير هذا الرقم لاختبار function مختلفة
$testNumber = 1;

switch ($testNumber) {
    case 1:
        echo "<h2>اختبار get_info_doctros()</h2>\n";
        $doctors = Doctor::get_info_doctros($pdo);
        echo "<pre>";
        print_r($doctors);
        echo "</pre>";
        break;
        
    case 2:
        echo "<h2>اختبار get_all_majors()</h2>\n";
        $majors = Doctor::get_all_majors($pdo);
        echo "<pre>";
        print_r($majors);
        echo "</pre>";
        break;
        
    case 3:
        echo "<h2>اختبار get_all_doctor_by_name()</h2>\n";
        $names = Doctor::get_all_doctor_by_name($pdo);
        echo "<pre>";
        print_r($names);
        echo "</pre>";
        break;
        
    case 4:
        echo "<h2>اختبار get_doctor_by_id()</h2>\n";
        $doctor = Doctor::get_doctor_by_id($pdo, 1);
        echo "<pre>";
        print_r($doctor);
        echo "</pre>";
        break;
        
    case 5:
        echo "<h2>اختبار get_doctors_by_major()</h2>\n";
        // ضع اسم التخصص هنا
        $doctors = Doctor::get_doctors_by_major($pdo, "طب عام");
        echo "<pre>";
        print_r($doctors);
        echo "</pre>";
        break;
        
    case 6:
        echo "<h2>اختبار get_doctor_by_name()</h2>\n";
        // ضع اسم الطبيب هنا
        $doctor = Doctor::get_doctor_by_name($pdo, "د. أحمد");
        echo "<pre>";
        print_r($doctor);
        echo "</pre>";
        break;
        
    case 7:
        echo "<h2>اختبار get_doctor_by_email()</h2>\n";
        // ضع الإيميل هنا
        $doctor = Doctor::get_doctor_by_email($pdo, "doctor@example.com");
        echo "<pre>";
        print_r($doctor);
        echo "</pre>";
        break;
        
    case 8:
        echo "<h2>اختبار create_doctor()</h2>\n";
        $newDoctor = Doctor::create_doctor($pdo, "د. تجربة", "test@example.com", "01111111111", "طب عام");
        echo "<pre>";
        print_r($newDoctor);
        echo "</pre>";
        break;
        
    default:
        echo "<p>غير رقم الاختبار في المتغير \$testNumber</p>";
}
?>
