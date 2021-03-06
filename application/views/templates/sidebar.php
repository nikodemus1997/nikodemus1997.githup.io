<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <!-- <div class="sidebar-brand-icon rotate-n-15"> -->
        <!-- <i class="fab fa-asymmetrik"></i> -->
        <img src="<?= base_url('assets/img/farma.jpg') ?>" alt="" sizes="50px" class="rounded-circle img-thumbnail alert-dark">
        <!-- </div> -->
        <div class="sidebar-brand-text mx-3">Apotek A. Farma <sup></sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider  ">

    <!-- SELECT column-names
    FROM table-name1 JOIN table-name2
    ON column-name1 = column-name2
    WHERE condition -->

    <!-- // QUERY MENU  -->
    <?php
    $role_id = $this->session->userdata('role_id');
    $queryMenu = "SELECT `user_menu`.`id`,`menu`         
                    FROM `user_menu` JOIN `user_access_menu`
                    ON `user_menu`.`id` = `user_access_menu`.`menu_id`
                    WHERE `user_access_menu`.`role_id` = $role_id
                    ORDER BY `user_access_menu`.`menu_id` ASC    

        ";
    $menu = $this->db->query($queryMenu)->result_array();

    ?>


    <!-- LOOPING MENU -->
    <?php foreach ($menu as $m) : ?>
        <div class="sidebar-heading">
            <?= $m['menu']; ?>
        </div>


        <!-- SIAPKAN SUB-MENU SESUAI MENU -->
        <?php

        $menuId = $m['id'];
        $querySupMenu = "SELECT *        
                    FROM `user_sup_menu` JOIN `user_menu`
                    ON `user_sup_menu`.`menu_id` = `user_menu`.`id`
                    WHERE `user_sup_menu`.`menu_id` = $menuId
                    AND `user_sup_menu`.`is_active` = 1

                ";
        $supMenu = $this->db->query($querySupMenu)->result_array();

        ?>
        <?php foreach ($supMenu as $sm) : ?>
            <?php if ($title == $sm['title']) : ?>
                <li class="nav-item active">
                <?php else : ?>
                <li class="nav-item">
                <?php endif; ?>
                <a class="nav-link pb-0" href="<?= base_url($sm['url']); ?>">
                    <i class="<?= $sm['icon']; ?>"></i>
                    <span><?= $sm['title']; ?></span></a>
                </li>

            <?php endforeach; ?>

            <!-- Divider -->
            <hr class="sidebar-divider mt-3">
        <?php endforeach; ?>


        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('auth/logout') ?>">
                <i class="fas fa-fw fa-sign-out-alt"></i>
                <span>Logout</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <div class="sidebar-divider d-none d-md-block"></div>

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

</ul>
<!-- End of Sidebar -->