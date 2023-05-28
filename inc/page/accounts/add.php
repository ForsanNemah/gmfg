<?php
// Check If Server User Coming From HTTP Post Request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get Variables From Form
    $username = filterRequest('username');
    $password1 = filterRequest('password1');
    $password2 = filterRequest('password2');
    $phone = filterRequest('phone');
    $main = filterRequest('main');
    $email = filterRequest('email');
    // Array Errors
    $errors = array();
    // UserName Error
    if (empty($username)) {
        $errors[] = 'Enter User Name';
    } elseif (getCount('admins', 'username = ?', array($username)) > 0 || getCount('users', 'username = ?', array($username)) > 0) {
        $errors[] = 'User Name Is Exists';
    }
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
    // Phone Error
    if (empty($phone)) {
        $errors[] = 'Enter Phone Number';
    }
    // Email Error
    if (empty($main)) {
        $errors[] = 'Enter Main Email';
    }
    // Add Informatio To Database
    if (empty($errors)) {
        $add = $con->prepare('INSERT INTO users(username, pass, phone, main_email, email) VALUES(?, ?, ?, ?, ?)');
        $add->execute(array($username, $password1, $phone, $main, $email));
        header('location: index.php?Status=Success');
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
        <h3>Create New Account</h3>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>?Page=Add" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <i class="fa fa-user fa-fw"></i>
                <input
                    type="text"
                    name="username"
                    id="username"
                    class="form-control"
                    value="<?php if(isset($username)){echo$username;}?>">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <i class="fa fa-lock fa-fw"></i>
                <input
                    type="password"
                    name="password1"
                    id="password"
                    class="form-control"
                    value="<?php if(isset($password1)){echo$password1;}?>">
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
                    value="<?php if(isset($password2)){echo$password2;}?>">
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <i class="fa fa-phone fa-fw"></i>
                <input
                    type="number"
                    name="phone"
                    id="phone"
                    class="form-control"
                    value="<?php if(isset($phone)){echo$phone;}?>">
            </div>
            <div class="form-group">
                <label for="email">Main Email</label>
                <i class="fa fa-message fa-fw"></i>
                <input
                    type="email"
                    name="main"
                    id="email"
                    class="form-control"
                    value="<?php if(isset($main)){echo$main;}?>">
            </div>
            <div class="form-group">
                <label>All Emails</label>
                <textarea
                    name="email"
                    rows="7"
                    class="form-control"><?php if(isset($email)){echo$email;}?></textarea>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-sm">Add</button>
            </div>
        </form>
    </div>
</div>