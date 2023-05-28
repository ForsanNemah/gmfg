<?php
// Check If Server User Coming From HTTP Post Request
echo $_POST['customer'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get Variables From Form
    $customer = filterRequest('customer');
    $type = filterRequest('type');
    $balance = filterRequest('balance');
    $desc = filterRequest('desc');
    $total = 0;
    // Array Errors
    $errors = array();
    // Balance Error
    if (empty($balance)) {
        $errors[] = 'Enter Balance';
    } elseif ($balance>getLastItem('total', 'transactions', 'user_id = ?', userId())&&$type==1) {
        $errors[] = 'The Amount Is Greater then the Available Balance';
    }
    // Add Informatio To Database
    if (empty($errors)) {
        if ($type==1) {
            $total = intval(getLastItem('total', 'transactions', 'user_id = ?', userId())) - intval($balance);
        } elseif ($type==2) {
            $total = intval(getLastItem('total', 'transactions', 'user_id = ?', userId())) + intval($balance);
        }
        $add = $con->prepare('INSERT INTO transactions(user_id, customer_id, process_type, balance, total, descr) VALUES(?, ?, ?, ?, ?, ?)');
        $add->execute(array(userId(), $customer, $type, $balance, $total, $desc));
        header('location: ?Page=View&User='.$_GET['User']);
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
                    <a class="nav-link btn btn-danger btn-sm" aria-current="page" href="users.php?Page=View">
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
                <div class="panel-heading">Add New Transactions</div>
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
                        <!------------------------ UserName ------------------------>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>UserName</label>
                                <input type="text" class="form-control text-center" autocomplete="off" readonly value="<?php echo getItem('users',userId(),'id=?','username')?>">
                            </div>
                        </div> <!-- UserName -->
                        <!------------------------ Customer ------------------------>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Customer</label>
                                <select name="customer" class="chosen">
                                    <?php foreach (getData('customers') as $all) { ?>
                                    <option value="<?php echo $all['id'] ?>">
                                    <?php echo $all['fullname'] ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div> <!-- Customer -->
                        <!------------------------ Type ------------------------>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Process Type</label>
                                <select name="type" class="form-control">
                                    <?php if (getCount('transactions','user_id = ?',array(userId()))>0) {?>
                                    <option value="1"
                                    <?php if(isset($type)&&$type==1){echo'selected';}?>>سحب</option>
                                    <?php } ?>
                                    <option value="2"
                                    <?php if(isset($type)&&$type==2){echo'selected';}?>>ايداع</option>
                                </select>
                            </div>
                        </div> <!-- Type -->
                        <!------------------------ Balance ------------------------>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Balance</label>
                                <input type="number" class="form-control" autocomplete="off" name="balance" value="<?php if(isset($balance)){echo$balance;}?>">
                            </div>
                        </div> <!-- Balance -->
                        <!------------------------ Description ------------------------>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" autocomplete="off" name="desc" rows="10"><?php if(isset($desc)){echo$desc;}?></textarea>
                            </div>
                        </div> <!-- Description -->
                    </div> <!-- Raw -->
                </div> <!-- Body -->
            </div> <!-- Beasic -->
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-sm">Save</button>
            </div>
        </div> <!-- Container -->
    </form> <!-- Form -->
</div> <!-- Content -->