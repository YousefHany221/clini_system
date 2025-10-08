<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}



use Clini_system_mousa\Clinic_system\Clinic\Appointment;
use Clini_system_mousa\Clinic_system\Clinic\Doctor;

require_once __DIR__ . "/../../Clinic/Doctor.php";
require_once __DIR__ . "/../../Clinic/Appointment.php";
require_once __DIR__ . "/../../Clinic/Contact.php";
require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../../Clinic/database.php";


$db = Database::get_instance($config);
$pdo = $db->get_connection();
// 
$doctor = Doctor::get_doctor_by_id($pdo, $_GET['id'] ?? '');

$message = '';
$messageType = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm_booking'])) {
  $name = trim($_POST['name'] ?? '');
  $phone = trim($_POST['phone'] ?? '');
  $email = trim($_POST['email'] ?? '');

  // Validate input
  if (empty($name) || empty($phone) || empty($email)) {
    $message = 'All fields are required.';
    $messageType = 'danger';
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $message = 'Please enter a valid email address.';
    $messageType = 'danger';
  } else {
    // Create appointment
    $appointment = Appointment::create_appointment($pdo, $name, $email, $phone);

    if ($appointment) {
      $message = 'Appointment booked successfully! We will contact you soon.';
      $messageType = 'success';
      // Clear form data
      $_POST = [];
    } else {
      $message = 'Failed to book appointment. Please try again.';
      $messageType = 'danger';
    }
  }
}
?>

<div class="container">
  <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="fw-bold my-4 h4">
    <ol class="breadcrumb justify-content-center">
      <li class="breadcrumb-item"><a class="text-decoration-none" href="./index.php?page=home">Home</a></li>
      <li class="breadcrumb-item"><a class="text-decoration-none" href="./index.php?page=doctors">Doctors</a></li>
      <li class="breadcrumb-item active" aria-current="page"><?php echo htmlspecialchars($_GET['name'] ?? ''); ?></li>
    </ol>
  </nav>

  <?php if (!empty($message)): ?>
    <div class="alert alert-<?php echo $messageType; ?> alert-dismissible fade show" role="alert">
      <?php echo htmlspecialchars($message); ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php endif; ?>

  <div class="d-flex flex-column gap-3 details-card doctor-details">
    <div class="details d-flex gap-2 align-items-center">
      <img
        src="views/assets/images/major.jpg"
        alt="doctor"
        class="img-fluid rounded-circle"
        height="150"
        width="150" />
      <div class="details-info d-flex flex-column gap-3">
        <h4 class="card-title fw-bold"><?php echo htmlspecialchars($doctor->getName() ?? ''); ?></h4>
        <h6 class="card-title fw-bold"><?php echo htmlspecialchars($doctor->getMajor() ?? ''); ?></h6>
        <h6 class="card-title fw-bold"><?php echo htmlspecialchars($doctor->getPhone() ?? ''); ?></h6>
      </div>
    </div>
    <hr />
    <form class="form" method="POST" action="">
      <div class="form-items">
        <div class="mb-3">
          <label class="form-label required-label" for="name">Name</label>
          <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>" required />
        </div>
        <div class="mb-3">
          <label class="form-label required-label" for="phone">Phone</label>
          <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo htmlspecialchars($_POST['phone'] ?? ''); ?>" required />
        </div>
        <div class="mb-3">
          <label class="form-label required-label" for="email">Email</label>
          <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" required />
        </div>
        <button type="submit" name="confirm_booking" class="btn btn-primary">Confirm Booking</button>
    </form>
  </div>
</div>

<script>
  const stars = document.querySelectorAll(".star");
  stars.forEach((star, index) => {
    star.addEventListener("click", () => {
      const isActive = star.classList.contains("active");
      if (isActive) {
        star.classList.remove("active");
      } else {
        star.classList.add("active");
      }
      for (let i = 0; i < index; i++) {
        stars[i].classList.add("active");
      }
      for (let i = index + 1; i < stars.length; i++) {
        stars[i].classList.remove("active");
      }
    });
  });
</script>