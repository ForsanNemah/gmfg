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
                        <i class="fa fa-plus fa-fw"></i>
                        <span>Add New</span>
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
                        <th scope="col">Full Name</th>
                        <th scope="col">Add Date</th>
                        <th scope="col">Active</th>
                        <th scope="col">Control</th>
                    </tr>
                </thead> <!-- Table Head -->
                <!------------------------ Table Body ------------------------>
                <tbody>
                    <?php foreach (getData('customers') as $all) { ?>
                    <tr>
                        <td><?php echo $all['fullname'] ?></td>
                        <td><?php echo $all['cu_date'] ?></td>
                        <td><?php echo printName($all['active']) ?></td>
                        <td>
                            <a href="?Page=Edit&ID=<?php echo $all['id'] ?>" class="btn btn-success btn-sm">
                                <i class="fa fa-edit fa-fw"></i>
                            </a>
                            <a href="#delete" class="btn btn-danger btn-sm" data-id="<?php echo $all['id']?>" data-page="customers">
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