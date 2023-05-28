<?php
include 'connect.php';
/*************** Admin Folders ***************/
$inc = 'inc/';
$lay = 'lay/';
$img = 'images/';
/*************** Includes Folders ***************/
$page = $inc . 'page/';
$temp = $inc . 'temp/';
/*************** Includes Pages Files ***************/
$pageAdmins = $page . 'admins/';
$pageCustomers = $page . 'customers/';
$pageUsers = $page . 'users/';
$pageTransactions = $page . 'transactions/';
$pageReport = $page . 'report/';
$pageAccounts = $page . 'accounts/';
/*************** Includes Templates Files ***************/
include $temp . 'header.php';
$topbar = $temp . 'topbar.php';
$sidebar = $temp . 'sidebar.php';
$footer = $temp . 'footer.php';
