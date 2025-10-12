<?php
require_once __DIR__ . "/../../Controllers/Admin/DoctorControllers.php";
?>

<div class="container mt-5">
    <div class="d-flex justify-content-center align-items-center">
        <h1 class="mb-4">Create Doctor</h1>
    </div>
    
    <?php if (!empty($message)): ?>
        <div class="alert alert-<?php echo $messageType; ?> alert-dismissible fade show" role="alert">
            <?php echo htmlspecialchars($message); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    
    <form method="post" enctype="multipart/form-data" action="index.php?page=create_doctor">
        <div class="mb-3">
            <label for="name" class="form-label required-label">Name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Enter doctor name" 
                   value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>" required>
        </div>
        
        <div class="mb-3">
            <label for="email" class="form-label required-label">Email</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Enter email address" 
                   value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" required>
        </div>
        
        <div class="mb-3">
            <label for="phone" class="form-label required-label">Phone</label>
            <input type="tel" class="form-control" name="phone" id="phone" placeholder="Enter phone number" 
                   value="<?php echo htmlspecialchars($_POST['phone'] ?? ''); ?>" required>
        </div>
        
        <div class="mb-3">
            <label for="major" class="form-label required-label">Major/Specialty</label>
            <input type="text" class="form-control" name="major" id="major" placeholder="Enter medical specialty" 
                   value="<?php echo htmlspecialchars($_POST['major'] ?? ''); ?>" required>
        </div>
        
        <div class="mb-3">
            <label for="image" class="form-label">Major Image</label>
            <input type="file" class="form-control" name="image" id="image" accept="image/*">
            <div class="form-text">Upload an image for this medical specialty. If no image is uploaded, a default image will be used based on the major name.</div>
        </div>
        
        <div class="d-grid">
            <button type="submit" name="create-doctor" class="btn btn-primary">Add Doctor</button>
        </div>
    </form>
</div>