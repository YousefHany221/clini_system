<!-- header -->

<!-- header -->

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

<body>
    <div class="page-wrapper">
        <!-- nav -->

        <!-- nav -->

        <?php if ($success): ?>
            <div class="container mt-3">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo htmlspecialchars($success); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        <?php endif; ?>
        <div class="container-fluid bg-blue text-white pt-3">
            <div class="container pb-5">
                <div class="row gap-2">
                    <div class="col-sm order-sm-2">
                        <img src="./views/assets/images/banner.jpg" class="img-fluid banner-img banner-img" alt="banner-image"
                            height="200">
                    </div>
                    <div class="col-sm order-sm-1">
                        <h1 class="h1">Have a Medical Question?</h1>
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ipsa nesciunt repellendus itaque,
                            laborum
                            saepe
                            enim maxime, delectus, dicta cumque error cupiditate nobis officia quam perferendis
                            consequatur
                            cum
                            iure
                            quod facere.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <h2 class="h1 fw-bold text-center my-4">Our Doctors</h2>
            <div class="d-flex flex-wrap gap-4 justify-content-center">
                <?php foreach ($doctors as $doctor): ?>
                    <div class="card p-2" style="width: 18rem;">
                        <img src="views/assets/images/major.jpg" class="card-img-top rounded-circle card-image-circle"
                            alt="doctor">
                        <div class="card-body d-flex flex-column gap-1 justify-content-center">
                            <h4 class="card-title fw-bold text-center"><?php echo htmlspecialchars($doctor->getName()); ?></h4>
                            <h6 class="card-subtitle text-center text-muted"><?php echo htmlspecialchars($doctor->getMajor()); ?></h6>
                            <a href="./index.php?page=doctor&id=<?php echo $doctor->getId(); ?>" class="btn btn-outline-primary card-button">Book Appointment</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <h2 class="h1 fw-bold text-center my-4">Featured Doctors</h2>
            <section class="splide home__slider__doctors mb-5">
                <div class="splide__track ">
                    <ul class="splide__list">
                        <?php foreach ($doctors as $doctor): ?>
                            <li class="splide__slide">
                                <div class="card p-2" style="width: 18rem;">
                                    <img src="views/assets/images/major.jpg" class="card-img-top rounded-circle card-image-circle"
                                        alt="doctor">
                                    <div class="card-body d-flex flex-column gap-1 justify-content-center">
                                        <h4 class="card-title fw-bold text-center"><?php echo htmlspecialchars($doctor->getName()); ?></h4>
                                        <h6 class="card-subtitle text-center text-muted"><?php echo htmlspecialchars($doctor->getMajor()); ?></h6>
                                        <a href="./index.php?page=doctor&id=<?php echo $doctor->getId(); ?>" class="btn btn-outline-primary card-button">Book an appointment</a>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </section>
        </div>
        <div class="banner container d-block d-lg-grid d-md-block d-sm-block">
            <div class="info">
                <div class="info__details">
                    <img src="https://d1aovdz1i2nnak.cloudfront.net/vezeeta-web-reactjs/55619/_next/static/images/medical-care-icon.svg"
                        alt="" width="50" height="50">
                    <h4 class="title m-0">
                        everything you need is found at VCare.
                    </h4>
                    <p class="content">
                        search for a doctor and book an appointment in a hospital, clinic, home visit or even by phone,
                        you
                        can also order medicine or book a surgery.
                    </p>
                </div>
            </div>
            <div class="info">
                <div class="info__details">
                    <img src="https://d1aovdz1i2nnak.cloudfront.net/vezeeta-web-reactjs/55619/_next/static/images/medical-care-icon.svg"
                        alt="" width="50" height="50">
                    <h4 class="title m-0">
                        everything you need is found at VCare.
                    </h4>
                    <p class="content">
                        search for a doctor and book an appointment in a hospital, clinic, home visit or even by phone,
                        you
                        can also order medicine or book a surgery.
                    </p>
                </div>
            </div>
            <div class="info">
                <div class="info__details">
                    <img src="https://d1aovdz1i2nnak.cloudfront.net/vezeeta-web-reactjs/55619/_next/static/images/medical-care-icon.svg"
                        alt="" width="50" height="50">
                    <h4 class="title m-0">
                        everything you need is found at VCare.
                    </h4>
                    <p class="content">
                        search for a doctor and book an appointment in a hospital, clinic, home visit or even by phone,
                        you
                        can also order medicine or book a surgery.
                    </p>
                </div>
            </div>
            <div class="info">
                <div class="info__details">
                    <img src="https://d1aovdz1i2nnak.cloudfront.net/vezeeta-web-reactjs/55619/_next/static/images/medical-care-icon.svg"
                        alt="" width="50" height="50">
                    <h4 class="title m-0">
                        everything you need is found at VCare.
                    </h4>
                    <p class="content">
                        search for a doctor and book an appointment in a hospital, clinic, home visit or even by phone,
                        you
                        can also order medicine or book a surgery.
                    </p>
                </div>
            </div>
            <div class="bottom--left bottom--content bg-blue text-white">
                <h4 class="title">download the application now</h4>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus facere eveniet in id, quod
                    explicabo minus ut, sint possimus, fuga voluptas. Eius molestias eveniet labore ullam magnam sequi
                    possimus quaerat!</p>
                <div class="app-group">
                    <div class="app"><img
                            src="https://d1aovdz1i2nnak.cloudfront.net/vezeeta-web-reactjs/55619/_next/static/images/google-play-logo.svg"
                            alt="">Google Play</div>
                    <div class="app"><img
                            src="https://d1aovdz1i2nnak.cloudfront.net/vezeeta-web-reactjs/55619/_next/static/images/apple-logo.svg"
                            alt="">App Store</div>
                </div>
            </div>
            <div class="bottom--right bg-blue text-white">
                <img src="views/assets/images/banner.jpg" class="img-fluid banner-img">
            </div>
        </div>
    </div>
    <!-- footer -->

    <!-- footer -->



</body>

</html>