<?php
function getTitle() {
    global $pageTitle;
    if (isset($pageTitle)) {
        echo $pageTitle;
    } else {
        echo 'لا يوجد عنوان';
    }
}

function filterRequest($requestname) {
    return  htmlspecialchars(strip_tags($_POST[$requestname]));
}

function filterPage() {
    if (isset($_GET['Page']) && !empty($_GET['Page'])) {
        return filter_var($_GET['Page'], FILTER_SANITIZE_STRING);
    }
}

// Check If Get Request ID Is Numeric And Get Integer Value Of It
function id() {
    if (isset($_GET['ID']) && is_numeric($_GET['ID']) && !empty($_GET['ID'])) {
        return intval($_GET['ID']);
    }
}

// Check If Get Request ID Is Numeric And Get Integer Value Of It
function userId() {
    if (isset($_GET['User']) && is_numeric($_GET['User']) && !empty($_GET['User'])) {
        return intval($_GET['User']);
    }
}

function getItem($table, $value, $where, $select) {
    global $con;
    $statment = $con->prepare("SELECT * FROM $table WHERE $where");
    $statment->execute(array($value));
    $fetch = $statment->fetch();
    return $fetch[$select];
}

function getData ($table, $where = '1 = 1', $value = null, $by = 'id', $order = 'DESC', $limit = null) {
    global $con;
    $statment = $con->prepare("SELECT * FROM $table WHERE $where ORDER BY $by $order $limit");
    $statment->execute($value);
    return $statment->fetchAll();
}

function getCount ($table, $where = '1 = 1', $value = null) {
    global $con;
    $statment = $con->prepare("SELECT * FROM $table WHERE $where");
    $statment->execute($value);
    return $statment->rowCount();
}

function printName($number) {
    if ($number == 1) {
        return 'Enabled';
    } else {
        return 'Disabled';
    }
}

function active(){
    return array(0=>'Disabled',1=>'Enabled');
}

function getLastItem ($select, $table, $where = '1 = 1', $value) {
    global $con;
    $statment = $con->prepare("SELECT * FROM $table WHERE $where");
    $statment->execute(array($value));
    $last = '';
    foreach ($statment->fetchAll() as $all) {$last = $all[$select];}
    return $last;
}