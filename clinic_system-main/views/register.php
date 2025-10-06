<?php
session_start();
$errors = $_SESSION['errors'] ?? [];
$old = $_SESSION['old'] ?? [];
$success = $_SESSION['success'] ?? '';
unset($_SESSION['errors'], $_SESSION['old'], $_SESSION['success']);
?>

<div class="container">
    <div class="d-flex flex-column gap-3 account-form mx-auto mt-5">

        <?php if ($success): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
        <?php endif; ?>

        <form class="form" method="POST" action="validatoin/Controllers.php">
            <input type="hidden" name="action" value="register">

            <div class="mb-3">
                <label class="form-label required-label" for="name">Name</label>
                <input type="text" class="form-control <?php echo isset($errors['name']) ? 'is-invalid' : ''; ?>"
                    id="name" name="name" value="<?php echo htmlspecialchars($old['name'] ?? ''); ?>" required>
                <?php if (isset($errors['name'])): ?>
                    <div class="invalid-feedback">
                        <?php foreach ($errors['name'] as $error): ?>
                            <div><?php echo htmlspecialchars($error); ?></div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label class="form-label required-label" for="email">Email</label>
                <input type="email" class="form-control <?php echo isset($errors['email']) ? 'is-invalid' : ''; ?>"
                    id="email" name="email" value="<?php echo htmlspecialchars($old['email'] ?? ''); ?>" required>
                <?php if (isset($errors['email'])): ?>
                    <div class="invalid-feedback">
                        <?php foreach ($errors['email'] as $error): ?>
                            <div><?php echo htmlspecialchars($error); ?></div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label class="form-label required-label" for="phone">Phone</label>
                <input type="tel" class="form-control <?php echo isset($errors['phone']) ? 'is-invalid' : ''; ?>"
                    id="phone" name="phone" value="<?php echo htmlspecialchars($old['phone'] ?? ''); ?>" required>
                <?php if (isset($errors['phone'])): ?>
                    <div class="invalid-feedback">
                        <?php foreach ($errors['phone'] as $error): ?>
                            <div><?php echo htmlspecialchars($error); ?></div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label class="form-label required-label" for="password">Password</label>
                <input type="password" class="form-control <?php echo isset($errors['password']) ? 'is-invalid' : ''; ?>"
                    id="password" name="password" required>
                <?php if (isset($errors['password'])): ?>
                    <div class="invalid-feedback">
                        <?php foreach ($errors['password'] as $error): ?>
                            <div><?php echo htmlspecialchars($error); ?></div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label class="form-label required-label" for="password_confirmation">Confirm Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
            </div>

            <button type="submit" class="btn btn-primary">Register</button>
        </form>

        <div class="d-flex justify-content-center gap-2 flex-column flex-lg-row flex-md-row flex-sm-column">
            <span>already have an account?</span>
            <a class="link" href="./index.php?page=login">login</a>
        </div>
    </div>
</div>