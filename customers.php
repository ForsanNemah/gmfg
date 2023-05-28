<?php
ob_start();
session_start(); // Start Session
if (isset($_SESSION['foursan'])&&$_SESSION['idForsan']==1) {
    // Page Title
    $pageTitle = 'Customers';
    include 'init.php'; // Include Init File
    include $topbar; // Include Topbar File
    include $sidebar; // Include Sidebar File
    if (filterPage() == 'View') {
        include $pageCustomers . 'view.php';
    } elseif (filterPage() == 'Add') {
        include $pageCustomers . 'add.php';
    } elseif (filterPage() == 'Edit') {
        include $pageCustomers . 'edit.php';
    } elseif (filterPage() == 'Delete') {
        include $pageCustomers . 'delete.php';
    } elseif (filterPage() == 'Active') {
        include $pageCustomers . 'active.php';
    }
    // Include Footer File
    include $footer;
} else {
    header('Location: index.php');
    exit();
}
?>
<script>
$(document).ready(function() {
    if ($('a').hasClass('active-customers-class')) {
        $('.active-dashboard-class').removeClass('active');
        $('.active-customers-class').addClass('active');
    }
});
</script>
