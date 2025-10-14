<?php
require_once __DIR__ . "/../../Controllers/Admin/ApoimentsControllers.php";
$apoiments = get_apoiment();
?>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="mb-4">All Apoiments</h1>
        <a href="index.php?page=storeapoiment&action=store" class="btn btn-primary mb-3">Add New Apoiment</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>id</th>
                <th>name</th>
                <th>phone</th>
                <th>email</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($apoiments as $apoiment): ?>
              <?php  
                // Create dynamic avatar based on patient name
                $image_path = "https://ui-avatars.com/api/?name=" . urlencode($apoiment->getName()) . "&background=007bff&color=fff&size=100&rounded=true";
              ?> 
              <tr>
                <td><?php echo $apoiment->getId(); ?></td>
                <td><?php echo $apoiment->getName(); ?></td>
                <td><?php echo $apoiment->getPhone(); ?></td>
                <td><?php echo $apoiment->getEmail(); ?></td>
                <td><img src="<?php echo $image_path; ?>" width="60" height="60" class="rounded-circle" alt="Appointment Avatar" style="object-fit: cover;"></td>
                <td>
                    <a href="index.php?page=apoiments&action=delete&id=<?php echo $apoiment->getId(); ?>" class="btn btn-danger" >Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>