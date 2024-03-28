<?php 

try {

  // SQL to fetch users
  $fetch_all_users_sql = "SELECT * FROM users";
  $fetch_all_users_stmt = $pdo->prepare($fetch_all_users_sql);
  $fetch_all_users_stmt->execute();
  $users = $fetch_all_users_stmt->fetchAll(PDO::FETCH_ASSOC);

  // Display a list of users

  if (!empty($users)) {
    echo "<div class='dashboard'>";
    
      echo "<div class='left'>";
        echo "<h2 style='text-align: center'>Users</h2>";
      
        echo "<ul>";
        foreach($users as $user) {
          if ($user['is_admin'] === 0 ) {
            echo "<li style='text-align: center'><a href='user_details.php?username={$user['username']}'>{$user['username']}{$user['username']}</a>";
            echo "<form action='../includes/admin/delete_user.php' method='post'>";
            echo "<input type='hidden' name='user_id' value='{$user['user_id']}'>";
            echo "<input type='submit' value='Delete' onclick='return confirm(\"Are you sure you want to delete this user?\");'>";
            echo "</form>";
            echo "</li>";
          }
        }
        echo "</ul>";
      echo "</div>";
    
    echo "</div>";
  }

} catch (PDOException $e) {
  echo "<h3>Error: </h3>" . $e->getMessage();
}

?>