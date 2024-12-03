<?php
session_start();
session_unset();
session_destroy();

// Redirect to website homepage
header("Location: /techdrivelab/index.php");
exit;
?>
