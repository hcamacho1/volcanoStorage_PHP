<?php
session_start();
@ session_unset($_SESSION['validUser']);
$_SESSION = array();
echo 'Successful Logout';
echo '<a href="volcanoHome.html">Return to home page</a>';
echo '<br>';
echo '<a href="customerPage.php">back</a>';
session_destroy();
 header( 'Location: volcanoHome.html' ) ;

$_SESSION['counter'] = 2;

?>