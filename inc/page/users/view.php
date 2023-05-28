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
                    <a class="nav-link btn btn-dark btn-sm" aria-current="page" href="#" id="search">
                        <i class="fa fa-search fa-fw"></i>
                        <span>Search</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-primary btn-sm" aria-current="page" href="?Page=Add">
                        <i class="fa fa-plus fa-fw"></i>
                        <span>Add New</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav> <!-- Navbar -->
    <!------------------------ Container ------------------------>
    <div class="container">
        <!------------------------ Search ------------------------>
        <div class="search">
            <div class="form-group">
                <input type="text" name="search" class="form-control text-center">
            </div>
        </div> <!-- Search -->
        <!------------------------ Table Responsive ------------------------>
        <div class="table-responsive">
            <!------------------------ Table ------------------------>
            <table class="table">
                <!------------------------ Table Head ------------------------>
                <thead>
                    <tr>
                        <th scope="col">User Name</th>
                        <th scope="col">Total Balance</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Main Email</th>
                        <th scope="col">Emails</th>
                        <th scope="col">Date Add</th>
                        <th scope="col">Active</th>
                        <th scope="col">Control</th>
                    </tr>
                </thead> <!-- Table Head -->
                <!------------------------ Table Body ------------------------>
                <tbody>
                    <?php
                    $where = '1 = ?';
                    $value = array(1);
                    if (isset($_GET['ID'])&&!empty($_GET['ID'])) {
                        $where = 'id = ?';
                        $value = array($_GET['ID']);
                    }
                    foreach (getData('users', $where, $value) as $all) {
                    ?>
                    <tr>
                        <td><?php echo $all['username'] ?></td>
                        <td>
                            <?php
                            $total = getLastItem('total', 'transactions', 'user_id = ?', $all['id']);
                            if ($total == '') {
                                echo 0;
                            } else {
                                echo $total;
                            }
                            ?>
                        </td>
                        <td><?php echo $all['phone'] ?></td>
                        <td><?php echo $all['main_email'] ?></td>
                        <td><?php echo $all['email'] ?></td>
                        <td><?php echo $all['us_date'] ?></td>
                        <td><?php echo printName($all['active']) ?></td>
                        <td>
                            <?php if ($all['active'] == 1) { ?>
                            <a href="transactions.php?Page=View&User=<?php echo $all['id'] ?>" class="btn btn-dark btn-sm">
                                <i class="fa fa-eye fa-fw"></i>
                            </a>
                            <?php } ?>
                            <?php if ($all['active'] == 1) { ?>
                            <a href="transactions.php?Page=Add&User=<?php echo $all['id'] ?>" class="btn btn-primary btn-sm">
                                <i class="fa fa-add fa-fw"></i>
                            </a>
                            <?php } ?>
                            <a href="?Page=Edit&ID=<?php echo $all['id'] ?>" class="btn btn-success btn-sm">
                                <i class="fa fa-edit fa-fw"></i>
                            </a>
                            <a href="#delete" class="btn btn-danger btn-sm" data-id="<?php echo $all['id']?>" data-page="users">
                                <i class="fa fa-trash fa-fw"></i>
                            </a>
                            <?php if ($all['active'] == 0) { ?>
                            <a href="?Page=Active&ID=<?php echo $all['id'] ?>" class="btn btn-primary btn-sm">
                                <i class="fa fa-check fa-fw"></i>
                            </a>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody> <!-- Table Body -->
            </table> <!-- Table -->
        </div> <!-- Table Responsive -->
    </div> <!-- Container -->
</div> <!-- Content -->