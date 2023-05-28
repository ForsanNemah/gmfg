<?php
// Check If Server User Coming From HTTP Post Request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get Variables From Form
    $password1 = filterRequest('password1');
    $password2 = filterRequest('password2');
    // Array Errors
    $errors = array();
    // Password Error
    if (empty($password1)) {
        $errors[] = 'Enter Password';
    } elseif (strlen($password1) < 8) {
        $errors[] = 'Password Cannot Be Less Then 8 Characters';
    } elseif (empty($password2)) {
        $errors[] = 'Reenter Password';
    } elseif ($password1 != $password2) {
        $errors[] = 'The Password Is Not Equal';
    }
    // Add Informatio To Database
    if (empty($errors)) {
        $add = $con->prepare('UPDATE users SET pass = ? WHERE id = ?');
        $add->execute(array($password1, id()));
        header('location: report.php?Page=View');
    }
}
?>
<div class="container">
    <div class="login">
        <?php
        if (isset($errors)&&!empty($errors)) {
            foreach ($errors as $error) {
                echo "<div class='alert alert-danger alert-sm'>$error</div>";
            }
            echo '<br>';
        }
        ?>
        <h3>Edit Profile</h3>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>?Page=Edit&ID=<?php echo id() ?>" method="post">
            <div class="form-group">
                <label for="password">Password</label>
                <i class="fa fa-lock fa-fw"></i>
                <input
                    type="password"
                    name="password1"
                    id="password"
                    class="form-control"
                    value="<?php if(isset($password1)){echo$password1;}else{echo getItem('users',id(),'id=?','pass');}?>">
                <i class="fa fa-eye" id="showPassword"></i>
            </div>
            <div class="form-group">
                <label for="reenter">Reenter Password</label>
                <i class="fa fa-lock fa-fw"></i>
                <input
                    type="password"
                    name="password2"
                    id="reenter"
                    class="form-control"
                    value="<?php if(isset($password2)){echo$password2;}else{echo getItem('users',id(),'id=?','pass');}?>">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success btn-sm">Edit</button>
            </div>
        </form>
    </div>
</div>