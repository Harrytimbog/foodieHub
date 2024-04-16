<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">

      
      <h2 class='text-center'>Update Personal Details</h2>
      <form action="/includes/user/update_user.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
          <label for="role" class='mt-5'>Role:</label>
          <select class="form-control" name="role" id="role">
            <option value="Viewer" <?php if(isset($user['role']) && $user['role'] === 'Viewer') echo 'selected'; ?>>Viewer</option>
            <option value="Chef" <?php if(isset($user['role']) && $user['role'] === 'Chef') echo 'selected'; ?>>Chef</option>
          </select>
        </div>

        <div class="form-group mt-5">
          <label for="photo">Photo:</label>
          <input class="form-control-file" id="photo" name="photo" type="file" value="<?php echo $user['photo']; ?>">
        </div>

        <button type="submit" class="btn btn-success mt-5">Update Profile</button>
      </form>
    </div>
  </div>
</div>