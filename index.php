<?php
ob_start();
session_start(); // Start Session
$pageTitle = 'Login';
include 'init.php'; // Include Init File
// Check If Server User Coming From HTTP Post Request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get Variables From Form
    $username = filterRequest('username');
    $password = filterRequest('password');
    // Settings Errors
    $errors = array();
    // UserName Error
    if (empty($username)) {
        $errors[] = 'UserName Can Not Be Empty';
    } elseif (getCount('admins', 'username = ?', array($username)) == 0 && getCount('users', 'username = ?', array($username)) == 0) {
        $errors[] = 'The UserName Or Password Is Incorrect';
    } elseif (getItem('users', $username, 'username = ?', 'active') == 0) {
        $errors[] = 'Waiting For Activation';
    }
    // Password Error
    if (empty($password)) {
        $errors[] = 'Password Can Not Be Empty';
    }
    // If Count > 0 This Main The Database Contain Record About This UserName
    if (getCount('admins', 'username = ? and pass = ? and active = 1', array($username, $password)) > 0) {
        // Register Session User Name
        $_SESSION['foursan'] = $username;
        $_SESSION['idForsan'] = getItem('admins', $username, 'username = ?', 'type');
        // Redirect To Dashboard
        header('Location: admins.php?Page=View');
        exit();
    }
    // If Count > 0 This Main The Database Contain Record About This UserName
    if (getCount('users', 'username = ? and pass = ? and active = 1', array($username, $password)) > 0) {
        // Register Session User Name
        $_SESSION['foursan'] = $username;
        $_SESSION['idForsan'] = getItem('users', $username, 'username = ?', 'type');
        // Redirect To Dashboard
        header('Location: report.php?Page=View');
        exit();
    }
}

if (isset($_SESSION['foursna'])&&$_SESSION['idForsan']==1) {
    header('Location: admins.php?Page=View');
} elseif (isset($_SESSION['foursna'])&&$_SESSION['idForsan']==2) {
    header('Location: report.php?Page=View');
}
//
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
        if (isset($_GET['Status'])) {
            echo "<div class='alert alert-success'>The Account Has Been Created Successfully</div>";
            echo "<div class='alert alert-warning'>Waiting For Activation</div><br>";
        }
        ?>
        <h3>Get Mony From Gmail</h3>
   
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <i class="fa fa-user fa-fw"></i>
                <input
                    type="text"
                    name="username"
                    id="username"
                    class="form-control"
                    value="<?php if(isset($username)) {echo $username;} ?>">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <i class="fa fa-lock fa-fw"></i>
                <input type="password" name="password" id="password" class="form-control">
                <i class="fa fa-eye" id="showPassword"></i>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-sm">Login</button>
            </div>
        </form>
        <div class="anchor">
            <a href="accounts.php?Page=Add">Create Account</a>
        </div>
    </div>
</div>
<?php include $footer ?>