<div class="navbar-header">
    <div class="d-flex">
        <!-- LOGO -->
        <div class="navbar-brand-box">
            <a href="home.php" class="logo logo-dark"> <span class="logo-sm">
                        <h3 style="color:#fff;" height="22">SOFTPRO</h3>
                    </span>
                <span class="logo-lg">
                        <h3 style="color:#fff;" height="17">SOFTPRO</h3>
                    </span>
            </a>
            <a href="home.php" class="logo logo-light"> <span class="logo-sm">
                        <h3 style="color:#fff;margin-top: 20px;font-weight: bold;" height="22">SOFTPRO v2</h3>
                    </span>
                <span class="logo-lg">
                        <h3 style="color:#fff;margin-top: 20px;font-weight: bold;" height="19">SOFTPRO V2</h3>
                    </span>
            </a>
        </div>
        <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn"> <i class="fa fa-fw fa-bars"></i>
        </button>
    </div>
    <div class="d-flex">
        <div class="dropdown d-none d-lg-inline-block ms-1">
            <button type="button" class="btn header-item noti-icon waves-effect" data-bs-toggle="fullscreen"> <i class="bx bx-fullscreen"></i>
            </button>
        </div>
        <div class="dropdown d-inline-block">
            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php  
                    $profilesql = mysqli_query($con, "select photo from user where username='".$_SESSION['username']."'");
                    $profiler = mysqli_fetch_array($profilesql);
                    if($profiler['photo'] == ''){
                        $photo = 'default.png';
                    }else{
                        $photo = $profiler['photo'];
                    }
                ?>
                <img class="rounded-circle header-profile-user" src="assets/profile/<?=$photo;?>" alt="Header Avatar"> <span class="d-none d-xl-inline-block ms-1" key="t-henry"><?=$_SESSION['username'];?></span>
                <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end">
                <!-- item--> <a class="dropdown-item" href="profile.php"><i class="bx bx-user font-size-16 align-middle me-1"></i> <span key="t-profile">Profile</span></a>
                <a class="dropdown-item d-block" href="change-password.php"><span class="badge bg-success float-end"></span><i class="bx bx-wrench font-size-16 align-middle me-1"></i> <span key="t-settings">Settings</span></a>
                <div class="dropdown-divider"></div> <a class="dropdown-item text-danger" href="include/logout.php"><i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span key="t-logout">Logout</span></a>
            </div>
        </div>
    </div>
</div>