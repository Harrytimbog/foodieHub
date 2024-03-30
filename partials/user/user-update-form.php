<h2>Update Personal Details</h2>
<form action="/includes/user/update_user.php" method="POST" enctype="multipart/form-data">
  <select name="role" id="role">
    <option value="Viewer" <?php if(isset($user['role']) && $user['role'] === 'Viewer') echo 'selected'; ?>>Viewer</option>
    <option value="Chef" <?php if(isset($user['role']) && $user['role'] === 'Chef') echo 'selected'; ?>>Chef</option>
  </select>

  <label for="photo">Photo:</label>
  <!-- <input type="text" id="photo" name="photo" value="<?php echo $user['photo']; ?>"><br><br> -->
  <input id="photo" name="photo" type="file" value="<?php echo $user['photo']; ?>">

  <button type="submit">Update Profile</button>
</form>