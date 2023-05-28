<?php
$total = 0;
foreach (getData('transactions') as $all) {
    if ($all['process_type'] == 1) {
        $total -= $all['balance'];
    } else {
        $total += $all['balance'];
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
                    <a class="nav-link btn btn-primary btn-sm" aria-current="page" href="?Page=Add">
                        <span>
                            Total :
                            <?php
                            if (isset($_GET['User'])&&!empty($_GET['User'])) {
                                echo getLastItem('total', 'transactions', 'user_id = ?', $_GET['User']);
                            } else {
                                echo $total;
                            }
                            ?>
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </nav> <!-- Navbar -->
    <!------------------------ Container ------------------------>
    <div class="container">
        <!------------------------ Table Responsive ------------------------>
        <div class="table-responsive">
            <!------------------------ Table ------------------------>
            <table class="table">
                <!------------------------ Table Head ------------------------>
                <thead>
                    <tr>
                        <th scope="col">UserName</th>
                        <th scope="col">Customer</th>
                        <th scope="col">Process Type</th>
                        <th scope="col">Balance</th>
                        <th scope="col">Total</th>
                        <th scope="col">Description</th>
                        <th scope="col">Date</th>
                    </tr>
                </thead> <!-- Table Head -->
                <!------------------------ Table Body ------------------------>
                <tbody>
                    <?php
                    $where = '1 = ?';
                    $value = array(1);
                    if (isset($_GET['User'])&&!empty($_GET['User'])) {
                        $where = 'user_id = ?';
                        $value = array($_GET['User']);
                    }
                    ?>
                    <?php foreach (getData('transactions', $where, $value) as $all) { $i = 1; ?>
                    <tr>
                        <td><?php echo getItem('users',$all['user_id'],'id=?', 'username') ?></td>
                        <td><?php echo getItem('customers',$all['customer_id'],'id=?','fullname') ?></td>
                        <td><?php if($all['process_type']==1){echo'سحب';}else{echo'ايداع';} ?></td>
                        <td><?php echo $all['balance'] ?></td>
                        <td><?php echo $all['total'] ?></td>
                        <td><?php echo $all['descr'] ?></td>
                        <td><?php echo $all['tr_date'] ?></td>
                    </tr>
                    <?php } ?>
                </tbody> <!-- Table Body -->
            </table> <!-- Table -->
        </div> <!-- Table Responsive -->
    </div> <!-- Container -->
</div> <!-- Content -->