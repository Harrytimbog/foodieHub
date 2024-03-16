<h2>Update Personal Details</h2>
<form action="/includes/user/update_user.php" method="POST">
  <select name="role" id="role">
    <option value="Viewer" <?php if(isset($user['role']) && $user['role'] === 'Viewer') echo 'selected'; ?>>Viewer</option>
    <option value="Chef" <?php if(isset($user['role']) && $user['role'] === 'Chef') echo 'selected'; ?>>Chef</option>
  </select>
  <button type="submit">Update Profile</button>
</form>