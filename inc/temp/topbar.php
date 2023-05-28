<div class="topbar">
    <div class="title-arae">
        <i class="fa fa-bars fa-fw" id="toggleSidebar"></i>
        <p>Get Mony From Gmail</p>
    </div>
    <div class="actions">
        <div class="users-area">
            <i class="fa fa-user fa-fw"></i>
            <div>
                <?php if ($_SESSION['idForsan'] == 2) { ?>
                <a href="accounts.php?Page=Edit&ID=<?php echo intval(getItem('users',$_SESSION['foursan'],'username=?','id'))?>">Change Password</a>
                <?php } ?>
                <a href="logout.php">Logout</a>
            </div>
        </div>
    </div>
</div>