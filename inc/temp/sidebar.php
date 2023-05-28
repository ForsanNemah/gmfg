<div class="sidebar">
    <ul class="menu">
        <?php if ($_SESSION['idForsan']==1) { ?>
        <li>
            <a href="admins.php?Page=View" class="active-admins-class">
                <span>Admins</span>
            </a>
        </li>
        <li>
            <a href="customers.php?Page=View" class="active-customers-class">
                <span>Customers</span>
            </a>
        </li>
        <li>
            <a href="users.php?Page=View" class="active-users-class">
                <span>Users</span>
            </a>
        </li>
        <li>
            <a href="transactions.php?Page=View" class="active-transactions-class">
                <span>Transactions</span>
            </a>
        </li>
        <?php } else { ?>
        <li>
            <a href="report.php?Page=View" class="active-report-class">
                <span>Report</span>
            </a>
        </li>
        <?php } ?>
    </ul>
</div>