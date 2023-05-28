<?php
ob_start();
// Page Title
$pageTitle = 'Users';
include 'init.php'; // Include Init
session_start(); // Start Session
if (isset($_SESSION['foursan'])) {
    if (filterPage() == 'Edit') {
        include 'inc/temp/topbar.php';
        include 'inc/temp/sidebar.php';
        include $pageAccounts . 'edit.php';
    }
} else {
    include $pageAccounts . 'add.php';
}
// Include Footer File
include $footer;