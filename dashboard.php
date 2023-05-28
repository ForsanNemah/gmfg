<?php
session_start(); // Start Session
if (isset($_SESSION['foursan'])&&$_SESSION['idForsan']==1) {
    // Page Title
    $pageTitle = 'dashboard';
    include 'init.php'; // Include Init File
    include $topbar; // Include Topbar File
    include $sidebar; // Include Sidebar File
    include $temp . 'dashboard.php';
    include $footer; // Include Footer File
} else {
    header('Location: index.php');
    exit();
}
