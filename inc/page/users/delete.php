<?php
$delete = $con->prepare('DELETE FROM users WHERE id = ?');
$delete->execute(array(id()));
if ($delete->rowCount() > 0) {
    header('location: ?Page=View');
}