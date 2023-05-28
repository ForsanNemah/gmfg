<?php
ob_start();
session_start(); // Start Session
if (isset($_SESSION['foursan'])&&$_SESSION['idForsan']==2) {
    // Page Title
    $pageTitle = 'Report';
    include 'init.php'; // Include Init File
    include $topbar; // Include Topbar File
    include $sidebar; // Include Sidebar File
    if (filterPage() == 'View') {
        include $pageReport . 'view.php';
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
    if ($('a').hasClass('active-report-class')) {
        $('.active-dashboard-class').removeClass('active');
        $('.active-report-class').addClass('active');
    }
});
</script>
