<?php
ob_start();
session_start(); // Start Session
if (isset($_SESSION['foursan'])&&$_SESSION['idForsan']==1) {
    // Page Title
    $pageTitle = 'Transactions';
    include 'init.php'; // Include Init File
    include $topbar; // Include Topbar File
    include $sidebar; // Include Sidebar File
    if (filterPage() == 'View') {
        include $pageTransactions . 'view.php';
    } elseif (filterPage() == 'Add') {
        include $pageTransactions . 'add.php';
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
    if ($('a').hasClass('active-transactions-class')) {
        $('.active-dashboard-class').removeClass('active');
        $('.active-transactions-class').addClass('active');
    }
});
</script>
