<?php 

// End session
session_start();
session_unset();
session_destroy();

header("Location: ../home.php");