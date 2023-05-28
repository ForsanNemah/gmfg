<?php
$delete = $con->prepare('DELETE FROM customers WHERE id = ?');
$delete->execute(array(id()));
if ($delete->rowCount() > 0) {
    header('location: ?Page=View');
}