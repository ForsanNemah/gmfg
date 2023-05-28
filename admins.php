<?php
ob_start();
session_start(); // Start Session
if (isset($_SESSION['foursan'])&&$_SESSION['idForsan']==1) {
    // Page Title
    $pageTitle = 'Admins';
    include 'init.php'; // Include Init File
    include $topbar; // Include Topbar File
    include $sidebar; // Include Sidebar File
    if (filterPage() == 'View') {
        include $pageAdmins . 'view.php';
    } elseif (filterPage() == 'Add') {
        include $pageAdmins . 'add.php';
    } elseif (filterPage() == 'Edit') {
        include $pageAdmins . 'edit.php';
    } elseif (filterPage() == 'Delete') {
        include $pageAdmins . 'delete.php';
    } elseif (filterPage() == 'Active') {
        include $pageAdmins . 'active.php';
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
    if ($('a').hasClass('active-admins-class')) {
        $('.active-dashboard-class').removeClass('active');
        $('.active-admins-class').addClass('active');
    }
});
</script>
