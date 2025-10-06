<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$isLoggedIn = isset($_SESSION['user']) && $_SESSION['user']['logged_in'] === true;
$userName = $isLoggedIn ? $_SESSION['user']['name'] : '';
?>

<nav class="navbar navbar-expand-lg navbar-expand-md bg-blue sticky-top">
    <div class="container">
        <div class="navbar-brand">
            <a class="fw-bold text-white m-0 text-decoration-none h3" href="./index.php?page=home">VCare</a>
        </div>
        <button class="navbar-toggler btn-outline-light border-0 shadow-none" type="button"
            data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <div class="d-flex gap-3 flex-wrap justify-content-center align-items-center" role="group">
                <a type="button" class="btn btn-outline-light navigation--button" href="./index.php?page=home">Home</a>
                <a type="button" class="btn btn-outline-light navigation--button"
                    href="./index.php?page=majors">majors</a>
                <a type="button" class="btn btn-outline-light navigation--button"
                    href="./index.php?page=doctors">Doctors</a>
                <a type="button" class="btn btn-outline-light navigation--button"
                    href="./index.php?page=contact">Contact</a>

                <?php if ($isLoggedIn): ?>
                    <!-- Show user name and logout if logged in -->
                    <a type="button" class="btn btn-outline-light navigation--button" href="./validatoin/logout.php">Logout</a>
                    <span class="text-white">مرحباً، <?php echo htmlspecialchars($userName); ?></span>
                    <?php else: ?>
                        <!-- Show login and register if not logged in -->
                        <a type="button" class="btn btn-outline-light navigation--button" href="./index.php?page=login">login</a>
                        <a type="button" class="btn btn-outline-light navigation--button" href="./index.php?page=register">register</a>
                <?php endif; ?>

            </div>
        </div>
    </div>
</nav>