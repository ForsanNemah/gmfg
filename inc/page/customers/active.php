<?php
$active = $con->prepare('UPDATE customers SET active = 1 WHERE id = ?');
$active->execute(array(id()));
if ($active->rowCount() > 0) {
    header('location: ?Page=View');
}