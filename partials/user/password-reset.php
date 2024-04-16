<form action="../../includes/user/password-reset.php" method="post" class="needs-validation" novalidate>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" name="email" placeholder="Enter your email" required>
        <div class="invalid-feedback">
            Please enter a valid email address.
        </div>
    </div>
    <div class="mb-3">
        <label for="new_password" class="form-label">New Password</label>
        <input type="password" class="form-control" name="new_password" placeholder="Enter new password" required>
        <div class="invalid-feedback">
            Please enter a new password.
        </div>
    </div>
    <button type="submit" name="password_reset" class="btn btn-success">Reset Password</button>

    <!-- Alert container for success notification -->
    <div id="success-alert" class="alert alert-success alert-dismissible fade show mt-3 d-none" role="alert">
        Password reset successful! You can now log in with your new password.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</form>
