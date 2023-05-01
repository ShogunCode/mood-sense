<?php
session_start();
session_regenerate_id(true);
session_unset();
session_destroy();

// Redirect to the login page
header('Location: index.php');
exit();
?>