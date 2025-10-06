
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once "./config/database.php";
require_once "./Clinic/Contact.php";
require_once "./Clinic/database.php";

use Clini_system_mousa\Clinic_system\Clinic\Contact\Contact;

// Create PDO connection
$db = Database::get_instance($config);
$pdo = $db->get_connection();

$message = '';
$messageType = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['send_message'])) {
    $name = trim($_POST['name'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $messageText = trim($_POST['message'] ?? '');
    
    // Validate input
    if (empty($name) || empty($phone) || empty($email) || empty($subject) || empty($messageText)) {
        $message = 'All fields are required.';
        $messageType = 'danger';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = 'Please enter a valid email address.';
        $messageType = 'danger';
    } else {
        // Create contact message
        $contact = Contact::create_contact($pdo, $name, $email, $phone, $subject, $messageText);
        
        if ($contact) {
            $message = 'Message sent successfully! We will get back to you soon.';
            $messageType = 'success';
            // Clear form data
            $_POST = [];
        } else {
            $message = 'Failed to send message. Please try again.';
            $messageType = 'danger';
        }
    }
}
?>

<body>
    <div class="page-wrapper">
        
        <?php if (!empty($message)): ?>
            <div class="container mt-3">
                <div class="alert alert-<?php echo $messageType; ?> alert-dismissible fade show" role="alert">
                    <?php echo htmlspecialchars($message); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        <?php endif; ?>
        
        <div class="d-flex flex-column gap-3 account-form mx-auto mt-5">
            <form class="form" method="POST" action="">
                <div class="form-items">
                    <div class="mb-3">
                        <label class="form-label required-label" for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label required-label" for="phone">Phone</label>
                        <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo htmlspecialchars($_POST['phone'] ?? ''); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label required-label" for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label required-label" for="subject">Subject</label>
                        <input type="text" class="form-control" id="subject" name="subject" value="<?php echo htmlspecialchars($_POST['subject'] ?? ''); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label required-label" for="message">Message</label>
                        <textarea class="form-control" id="message" name="message" required><?php echo htmlspecialchars($_POST['message'] ?? ''); ?></textarea>
                    </div>
                </div>
                <button type="submit" name="send_message" class="btn btn-primary">Send Message</button>
            </form>
        </div>

        </div>
    </div>

</body>

</html>