<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand topbar mb-4 static-top shadow">

            <button class="btn btn-link d-md-none rounded-circle mr-3" id="sidebarToggleTop">
                <i class="fa fa-bars"></i>
            </button>

            <!-- Topbar Navbar -->


            <div class="row nav-item dropdown no-arrow ml-auto">
                <!-- Nav Item - User Information bagian contact nama-->
                <div class="nav-item dropdown no-arrow ml-auto">
                    <!-- <ul class="navbar-nav ml-auto "> -->
                    <a class="nav-link dropdown-toggle ml-auto" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <button class="btn-nama" type="submit"><span><?= $user['name'] ?></span></button>
                    </a>

                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#">
                            <i class="fa fa-user "></i> Contact
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="https://bit.ly/3zjafVW" data-toggle="modal" data-target="#logoutModal">
                            <i class="fab fa-whatsapp"></i>
                            WhatsApp
                        </a>
                        <a class="dropdown-item" href="https://www.instagram.com/nikodemus_030500/" data-toggle="modal" data-target="#logoutModal">
                            <i class="fab fa-instagram"></i>
                            Instagram
                        </a>
                        <a class="dropdown-item" href="https://www.facebook.com/niko.fardemus">
                            <i class="fab fa-facebook"></i>
                            Facebook
                        </a>
                        <a class="dropdown-item" href="https://github.com/nikodemus1997/">
                            <i class="fab fa-github"></i>
                            Github
                        </a>
                        <a class="dropdown-item" href="https://twitter.com/abestbh?s=08" class="text-dark me-3">
                            <i class="fab fa-twitter"></i>
                            Twitter
                        </a>
                    </div>

                    <!-- </ul> -->
                </div>
                <div class="topbar-divider d-none d-sm-block"></div>
                <div class="nav-item dropdown no-arrow ml-auto">
                    <!-- <ul class="navbar-nav ml-auto bagian image"> -->
                    <a class="nav-link dropdown-toggle ml-auto" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="img-profile rounded-circle" src="<?= base_url('assets/img/profile/') . $user['image']; ?>">
                    </a>

                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="<?= base_url('user/index'); ?>">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?= base_url('auth/logout'); ?>" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>

                    <!-- </ul> -->
                </div>

            </div>


        </nav>
        <!-- End of Topbar -->