<?php
$delete = $con->prepare('DELETE FROM admins WHERE id = ?');
$delete->execute(array(id()));
if ($delete->rowCount() > 0) {
    header('location: ?Page=View');
}