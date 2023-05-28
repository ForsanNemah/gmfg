<?php
ob_start();
session_start(); // Start The Session
session_unset(); // Unset The Session
session_destroy(); // Destroy The Session
header( 'Location: index.php' ); // Redirect To Index Page
exit();