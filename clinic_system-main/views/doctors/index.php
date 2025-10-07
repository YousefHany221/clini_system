<?php

use Clini_system_mousa\Clinic_system\Clinic\Doctor;
require_once __DIR__ . "/../../Clinic/Doctor.php";
require_once __DIR__ . "/../../Clinic/Appointment.php";
require_once __DIR__ . "/../../Clinic/Contact.php";
require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../../Clinic/database.php";

$db = \Database::get_instance($config);
$pdo = $db->get_connection();

$doctors = Doctor::get_info_doctros($pdo);






?>


<div class="container">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="fw-bold my-4 h4">
        <ol class="breadcrumb justify-content-center">
            <li class="breadcrumb-item"><a class="text-decoration-none" href="./index.php?page=home">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Doctors</li>
        </ol>
    </nav>
    <div class="doctors-grid d-flex flex-wrap gap-4 justify-content-center">
        <?php foreach ($doctors as $doctor) : ?>
            <div class="card p-2" style="width: 18rem;">
                <img src="views/assets/images/major.jpg" class="card-img-top rounded-circle card-image-circle"
                    alt="doctor">
                <div class="card-body d-flex flex-column gap-1 justify-content-center">
                    <h4 class="card-title fw-bold text-center"><?= $doctor->getName() ?></h4>
                    <h6 class="card-title fw-bold text-center"><?= $doctor->getMajor() ?></h6>
                    <a href="./index.php?page=doctor&id=<?= $doctor->getId() ?>" class="btn btn-outline-primary card-button">Book an
                        appointment</a>
                </div>
            </div>
        <?php endforeach; ?>
        <!-- <div class="card p-2" style="width: 18rem;">
                <img src="views/assets/images/major.jpg" class="card-img-top rounded-circle card-image-circle"
                    alt="major">
                <div class="card-body d-flex flex-column gap-1 justify-content-center">
                    <h4 class="card-title fw-bold text-center">Doctor Name</h4>
                    <h6 class="card-title fw-bold text-center">Major</h6>
                    <a href="./index.php?page=doctor" class="btn btn-outline-primary card-button">Book an
                        appointment</a>
                </div>
            </div>
            <div class="card p-2" style="width: 18rem;">
                <img src="views/assets/images/major.jpg" class="card-img-top rounded-circle card-image-circle"
                    alt="major">
                <div class="card-body d-flex flex-column gap-1 justify-content-center">
                    <h4 class="card-title fw-bold text-center">Doctor Name</h4>
                    <h6 class="card-title fw-bold text-center">Major</h6>
                    <a href="./index.php?page=doctor" class="btn btn-outline-primary card-button">Book an
                        appointment</a>
                </div>
            </div>
            <div class="card p-2" style="width: 18rem;">
                <img src="views/assets/images/major.jpg" class="card-img-top rounded-circle card-image-circle"
                    alt="major">
                <div class="card-body d-flex flex-column gap-1 justify-content-center">
                    <h4 class="card-title fw-bold text-center">Doctor Name</h4>
                    <h6 class="card-title fw-bold text-center">Major</h6>
                    <a href="./index.php?page=doctor" class="btn btn-outline-primary card-button">Book an
                        appointment</a>
                </div>
            </div>
            <div class="card p-2" style="width: 18rem;">
                <img src="views/assets/images/major.jpg" class="card-img-top rounded-circle card-image-circle"
                    alt="major">
                <div class="card-body d-flex flex-column gap-1 justify-content-center">
                    <h4 class="card-title fw-bold text-center">Doctor Name</h4>
                    <h6 class="card-title fw-bold text-center">Major</h6>
                    <a href="./index.php?page=doctor" class="btn btn-outline-primary card-button">Book an
                        appointment</a>
                </div>
            </div>
            <div class="card p-2" style="width: 18rem;">
                <img src="views/assets/images/major.jpg" class="card-img-top rounded-circle card-image-circle"
                    alt="major">
                <div class="card-body d-flex flex-column gap-1 justify-content-center">
                    <h4 class="card-title fw-bold text-center">Doctor Name</h4>
                    <h6 class="card-title fw-bold text-center">Major</h6>
                    <a href="./index.php?page=doctor" class="btn btn-outline-primary card-button">Book an
                        appointment</a>
                </div>
            </div>
            <div class="card p-2" style="width: 18rem;">
                <img src="views/assets/images/major.jpg" class="card-img-top rounded-circle card-image-circle"
                    alt="major">
                <div class="card-body d-flex flex-column gap-1 justify-content-center">
                    <h4 class="card-title fw-bold text-center">Doctor Name</h4>
                    <h6 class="card-title fw-bold text-center">Major</h6>
                    <a href="./index.php?page=doctor" class="btn btn-outline-primary card-button">Book an
                        appointment</a>
                </div>
            </div>
            <div class="card p-2" style="width: 18rem;">
                <img src="views/assets/images/major.jpg" class="card-img-top rounded-circle card-image-circle"
                    alt="major">
                <div class="card-body d-flex flex-column gap-1 justify-content-center">
                    <h4 class="card-title fw-bold text-center">Doctor Name</h4>
                    <h6 class="card-title fw-bold text-center">Major</h6>
                    <a href="./index.php?page=doctor" class="btn btn-outline-primary card-button">Book an
                        appointment</a>
                </div>
            </div>
            <div class="card p-2" style="width: 18rem;">
                <img src="views/assets/images/major.jpg" class="card-img-top rounded-circle card-image-circle"
                    alt="major">
                <div class="card-body d-flex flex-column gap-1 justify-content-center">
                    <h4 class="card-title fw-bold text-center">Doctor Name</h4>
                    <h6 class="card-title fw-bold text-center">Major</h6>
                    <a href="./index.php?page=doctor" class="btn btn-outline-primary card-button">Book an
                        appointment</a>
                </div>
            </div>
            <div class="card p-2" style="width: 18rem;">
                <img src="views/assets/images/major.jpg" class="card-img-top rounded-circle card-image-circle"
                    alt="major">
                <div class="card-body d-flex flex-column gap-1 justify-content-center">
                    <h4 class="card-title fw-bold text-center">Doctor Name</h4>
                    <h6 class="card-title fw-bold text-center">Major</h6>
                    <a href="./index.php?page=doctor" class="btn btn-outline-primary card-button">Book an
                        appointment</a>
                </div>
            </div>
            <div class="card p-2" style="width: 18rem;">
                <img src="views/assets/images/major.jpg" class="card-img-top rounded-circle card-image-circle"
                    alt="major">
                <div class="card-body d-flex flex-column gap-1 justify-content-center">
                    <h4 class="card-title fw-bold text-center">Doctor Name</h4>
                    <h6 class="card-title fw-bold text-center">Major</h6>
                    <a href="./index.php?page=doctor" class="btn btn-outline-primary card-button">Book an
                        appointment</a>
                </div>
            </div>
            <div class="card p-2" style="width: 18rem;">
                <img src="views/assets/images/major.jpg" class="card-img-top rounded-circle card-image-circle"
                    alt="major">
                <div class="card-body d-flex flex-column gap-1 justify-content-center">
                    <h4 class="card-title fw-bold text-center">Doctor Name</h4>
                    <h6 class="card-title fw-bold text-center">Major</h6>
                    <a href="./index.php?page=doctor" class="btn btn-outline-primary card-button">Book an
                        appointment</a>
                </div>
            </div> -->


    </div>
    <nav class="mt-5" aria-label="navigation">
        <ul class="pagination justify-content-center">
            <li class="page-item">
                <a class="page-link page-prev" href="./index.php?page=doctors" aria-label="Previous">
                    <span aria-hidden="true">
                        < </span>
                </a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link page-next" href="#" aria-label="Next">
                    <span aria-hidden="true"> > </span>
                </a>
            </li>
        </ul>
    </nav>
</div>