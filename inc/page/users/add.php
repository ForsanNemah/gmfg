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
    $active = filterRequest('active');
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
        $add = $con->prepare('INSERT INTO users(username, pass, phone, main_email, email, active) VALUES(?, ?, ?, ?, ?, ?)');
        $add->execute(array($username, $password1, $phone, $main, $email, $active));
        header('location: ?Page=View&ID='.getLastItem('id','users','1=?',1));
    }
}
?>
<!------------------------ Content ------------------------>
<div class="content">
    <!------------------------ Navbar ------------------------>
    <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand">
            <span><?php echo $pageTitle ?></span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link btn btn-danger btn-sm" aria-current="page" href="?Page=View">
                        <i class="fa fa-chevron-left fa-fw"></i>
                        <span>Back</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav> <!-- Navbar -->
    <!------------------------ Form ------------------------>
    <form method="post" enctype="multipart/form-data">
        <!------------------------ Container ------------------------>
        <div class="container">
            <!------------------------ Beasic ------------------------>
            <div class="panel">
                <!------------------------ Title ------------------------>
                <div class="panel-heading">Add New User</div>
                <!------------------------ Body ------------------------>
                <div class="panel-body">
                    <!------------------------ Raw ------------------------>
                    <div class="row">
                        <div class="col-12">
                            <?php
                            if (isset($errors) && !empty($errors)) {
                            foreach ($errors as $error) {
                            ?>
                            <div class="alert alert-danger">
                                <?php echo $error ?>
                            </div>
                            <?php } } ?>
                        </div>
                        <!------------------------ User Name ------------------------>
                        <div class="col-md-4 col-sm-6">
                            <div class="form-group">
                                <label>User Name</label>
                                <input
                                    type="text"
                                    name="username"
                                    class="form-control"
                                    autocomplete="off"
                                    value="<?php if(isset($username)){echo$username;}?>">
                            </div>
                        </div> <!-- User Name -->
                        <!------------------------ Password ------------------------>
                        <div class="col-md-4 col-sm-6">
                            <div class="form-group">
                                <label>Password</label>
                                <input
                                    type="password"
                                    name="password1"
                                    class="form-control"
                                    autocomplete="off"
                                    value="<?php if(isset($password1)){echo$password1;}?>">
                            </div>
                        </div> <!-- Password -->
                        <!------------------------ Reenter Password ------------------------>
                        <div class="col-md-4 col-sm-6">
                            <div class="form-group">
                                <label>Reenter Password</label>
                                <input
                                    type="password"
                                    name="password2"
                                    class="form-control"
                                    autocomplete="off"
                                    value="<?php if(isset($password2)){echo$password2;}?>">
                            </div>
                        </div> <!-- Reenter Password -->
                        <!------------------------ Phone ------------------------>
                        <div class="col-md-4 col-sm-6">
                            <div class="form-group">
                                <label>Phone Number</label>
                                <input
                                    type="number"
                                    name="phone"
                                    class="form-control"
                                    autocomplete="off"
                                    value="<?php if(isset($phone)){echo$phone;}?>">
                            </div>
                        </div> <!-- Phone -->
                        <!------------------------ Email ------------------------>
                        <div class="col-md-4 col-sm-6">
                            <div class="form-group">
                                <label>Main Email</label>
                                <input
                                    type="text"
                                    name="main"
                                    class="form-control"
                                    autocomplete="off"
                                    value="<?php if(isset($main)){echo$main;}?>">
                            </div>
                        </div> <!-- Email -->
                        <!------------------------ Active ------------------------>
                        <div class="col-md-4 col-sm-6">
                            <div class="form-group">
                                <label>Active</label>
                                <div class="form-group">
                                    <select name="active" class="form-control">
                                        <option value="0" <?php if(isset($active)&&$active==0){echo'selected';}?>>Disabled</option>
                                        <option value="1"<?php if (isset($active)&&$active==1){echo'selected';}?>>Enabled</option>
                                    </select>
                                </div>
                            </div>
                        </div> <!-- Active -->
                        <!------------------------ Email ------------------------>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Emails</label>
                                <textarea name="email" class="form-control" autocomplete="off" rows="7"><?php if(isset($email)){echo$email;}?></textarea>
                            </div>
                        </div> <!-- Email -->
                    </div> <!-- Raw -->
                </div> <!-- Body -->
            </div> <!-- Beasic -->
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-sm">Save</button>
            </div>
        </div> <!-- Container -->
    </form> <!-- Form -->
</div> <!-- Content -->