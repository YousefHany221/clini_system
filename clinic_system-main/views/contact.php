
<?php
// Include the contact controller to handle form submission
require_once __DIR__ . "/../Controllers/ContactControllers.php";
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