<?php
require_once 'Clinic/database.php';
require_once 'Clinic/Doctor.php';
require_once 'config/database.php';

use Clini_system_mousa\Clinic_system\Clinic\Doctor;

// إنشاء اتصال بقاعدة البيانات
$pdo = Conn::connection($config);

echo "<h1>اختبار functions كلاس Doctor</h1>\n";
echo "<hr>\n";

// اختبار 1: جلب جميع الأطباء
echo "<h2>1. اختبار get_info_doctros() - جلب جميع الأطباء:</h2>\n";
try {
    $doctors = Doctor::get_info_doctros($pdo);
    echo "<p>عدد الأطباء: " . count($doctors) . "</p>\n";
    foreach ($doctors as $doctor) {
        echo "<p>الطبيب: " . $doctor->getName() . " - التخصص: " . $doctor->getMajor() . "</p>\n";
    }
} catch (Exception $e) {
    echo "<p style='color: red;'>خطأ: " . $e->getMessage() . "</p>\n";
}

echo "<hr>\n";

// اختبار 2: جلب جميع التخصصات
echo "<h2>2. اختبار get_all_majors() - جلب جميع التخصصات:</h2>\n";
try {
    $majors = Doctor::get_all_majors($pdo);
    echo "<p>التخصصات المتاحة:</p>\n";
    foreach ($majors as $major) {
        echo "<p>- " . $major . "</p>\n";
    }
} catch (Exception $e) {
    echo "<p style='color: red;'>خطأ: " . $e->getMessage() . "</p>\n";
}

echo "<hr>\n";

// اختبار 3: جلب أسماء جميع الأطباء
echo "<h2>3. اختبار get_all_doctor_by_name() - جلب أسماء الأطباء:</h2>\n";
try {
    $names = Doctor::get_all_doctor_by_name($pdo);
    if ($names) {
        echo "<p>أسماء الأطباء:</p>\n";
        foreach ($names as $name) {
            echo "<p>- " . $name . "</p>\n";
        }
    } else {
        echo "<p>لا توجد أسماء أطباء</p>\n";
    }
} catch (Exception $e) {
    echo "<p style='color: red;'>خطأ: " . $e->getMessage() . "</p>\n";
}

echo "<hr>\n";

// اختبار 4: البحث عن طبيب بالـ ID
echo "<h2>4. اختبار get_doctor_by_id() - البحث بالـ ID:</h2>\n";
try {
    $doctor = Doctor::get_doctor_by_id($pdo, 1);
    if ($doctor) {
        echo "<p>تم العثور على الطبيب:</p>\n";
        echo "<p>الاسم: " . $doctor->getName() . "</p>\n";
        echo "<p>الإيميل: " . $doctor->getEmail() . "</p>\n";
        echo "<p>الهاتف: " . $doctor->getPhone() . "</p>\n";
        echo "<p>التخصص: " . $doctor->getMajor() . "</p>\n";
    } else {
        echo "<p>لم يتم العثور على طبيب بهذا الـ ID</p>\n";
    }
} catch (Exception $e) {
    echo "<p style='color: red;'>خطأ: " . $e->getMessage() . "</p>\n";
}

echo "<hr>\n";

// اختبار 5: البحث عن أطباء بالتخصص
echo "<h2>5. اختبار get_doctors_by_major() - البحث بالتخصص:</h2>\n";
try {
    // جرب البحث بأول تخصص متاح
    $majors = Doctor::get_all_majors($pdo);
    if (!empty($majors)) {
        $firstMajor = $majors[0];
        echo "<p>البحث عن أطباء في تخصص: " . $firstMajor . "</p>\n";
        $doctors = Doctor::get_doctors_by_major($pdo, $firstMajor);
        echo "<p>عدد الأطباء في هذا التخصص: " . count($doctors) . "</p>\n";
        foreach ($doctors as $doctor) {
            echo "<p>- " . $doctor->getName() . "</p>\n";
        }
    } else {
        echo "<p>لا توجد تخصصات متاحة للاختبار</p>\n";
    }
} catch (Exception $e) {
    echo "<p style='color: red;'>خطأ: " . $e->getMessage() . "</p>\n";
}

echo "<hr>\n";

// اختبار 6: البحث عن طبيب بالاسم
echo "<h2>6. اختبار get_doctor_by_name() - البحث بالاسم:</h2>\n";
try {
    // جرب البحث بأول اسم متاح
    $names = Doctor::get_all_doctor_by_name($pdo);
    if ($names && !empty($names)) {
        $firstName = $names[0];
        echo "<p>البحث عن الطبيب: " . $firstName . "</p>\n";
        $doctor = Doctor::get_doctor_by_name($pdo, $firstName);
        if ($doctor) {
            echo "<p>تم العثور على الطبيب:</p>\n";
            echo "<p>الاسم: " . $doctor->getName() . "</p>\n";
            echo "<p>التخصص: " . $doctor->getMajor() . "</p>\n";
        } else {
            echo "<p>لم يتم العثور على الطبيب</p>\n";
        }
    } else {
        echo "<p>لا توجد أسماء أطباء للاختبار</p>\n";
    }
} catch (Exception $e) {
    echo "<p style='color: red;'>خطأ: " . $e->getMessage() . "</p>\n";
}

echo "<hr>\n";

// اختبار 7: البحث عن طبيب بالإيميل
echo "<h2>7. اختبار get_doctor_by_email() - البحث بالإيميل:</h2>\n";
try {
    // جرب البحث بأول إيميل متاح من الأطباء الموجودين
    $doctors = Doctor::get_info_doctros($pdo);
    if (!empty($doctors)) {
        $firstEmail = $doctors[0]->getEmail();
        echo "<p>البحث عن الطبيب بالإيميل: " . $firstEmail . "</p>\n";
        $doctor = Doctor::get_doctor_by_email($pdo, $firstEmail);
        if ($doctor) {
            echo "<p>تم العثور على الطبيب:</p>\n";
            echo "<p>الاسم: " . $doctor->getName() . "</p>\n";
            echo "<p>الإيميل: " . $doctor->getEmail() . "</p>\n";
            echo "<p>الهاتف: " . $doctor->getPhone() . "</p>\n";
            echo "<p>التخصص: " . $doctor->getMajor() . "</p>\n";
        } else {
            echo "<p>لم يتم العثور على الطبيب</p>\n";
        }
    } else {
        echo "<p>لا توجد أطباء للاختبار</p>\n";
    }
} catch (Exception $e) {
    echo "<p style='color: red;'>خطأ: " . $e->getMessage() . "</p>\n";
}

echo "<hr>\n";

// اختبار 8: إنشاء طبيب جديد
echo "<h2>8. اختبار create_doctor() - إنشاء طبيب جديد:</h2>\n";
try {
    $newDoctor = Doctor::create_doctor($pdo, "د. أحمد محمد", "ah545454544545454med@example.com", "01234567890", "طب عام");
    if ($newDoctor) {
        echo "<p>تم إنشاء طبيب جديد بنجاح:</p>\n";
        echo "<p>ID: " . $newDoctor->getId() . "</p>\n";
        echo "<p>الاسم: " . $newDoctor->getName() . "</p>\n";
        echo "<p>الإيميل: " . $newDoctor->getEmail() . "</p>\n";
        echo "<p>الهاتف: " . $newDoctor->getPhone() . "</p>\n";
        echo "<p>التخصص: " . $newDoctor->getMajor() . "</p>\n";
    } else {
        echo "<p>فشل في إنشاء الطبيب الجديد</p>\n";
    }
} catch (Exception $e) {
    echo "<p style='color: red;'>خطأ: " . $e->getMessage() . "</p>\n";
}

echo "<hr>\n";
echo "<h2>انتهى الاختبار</h2>\n";
?>
