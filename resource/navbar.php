
<?php
    require './db/db.php';
    if (!$conn) {
        die("Sorry we failed to connect: " . mysqli_connect_error());
    }
    $sql = "SELECT * FROM `info`";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
?>
<!-- Topbar Start -->
<div class="container-fluid bg-light px-0 d-none d-lg-block">
    <div class="row gx-0 d-flex">
        <div class="col-lg-4 text-center py-3">
            <div class="d-inline-flex align-items-center justify-content-center">
                <i class="bi bi-envelope fs-1 text-primary me-3"></i>
                <div class="text-start">
                    <h6 class="text-uppercase mb-1">Email Us</h6>
                    <span>
                    <?php
                    echo $row['email'];
                    ?>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-lg-4 text-center py-3">
            <div class="d-inline-flex align-items-center justify-content-center">
                <a href="index.php" class="navbar-brand">
                    <!-- <img class=" w-50 " src="./img/logo2.png" alt="img" > -->
                    <img class="w-50" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['logo']); ?> " alt="img" />
                </a>
            </div>
        </div>
        <div class="col-lg-4 text-center py-3">
            <div class="d-inline-flex align-items-center justify-content-center">
                <i class="bi bi-phone-vibrate fs-1 text-primary me-3"></i>
                <div class="text-start">
                    <h6 class="text-uppercase mb-1">Call Us</h6>
                    <span>
                    <?php
                    echo $row['phone'];
                    ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Topbar End -->


<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-dark navbar-dark shadow-sm py-3 py-lg-0 px-3 px-lg-0">
    <a href="index.html" class="navbar-brand d-block d-lg-none">
        <h1 class="m-0 text-uppercase text-white"><i class="fa fa-birthday-cake fs-1 text-primary me-3"></i>STOVE</h1>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav text-center ms-auto mx-lg-auto py-0">
            <a href="index.php" class="nav-item nav-link">Home</a>
            <a href="about.php" class="nav-item nav-link">About Us</a>
            <a href="menu.php" class="nav-item nav-link">Menu & Pricing</a>
            <a href="contact.php" class="nav-item nav-link">Contact Us</a>

            <!-- <div class="d-flex align-items-center justify-content-center">
                <button type="button" class="p-2 btn btn-primary position-relative">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                        class="bi bi-bag-plus-fill" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5v-.5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0zM8.5 8a.5.5 0 0 0-1 0v1.5H6a.5.5 0 0 0 0 1h1.5V12a.5.5 0 0 0 1 0v-1.5H10a.5.5 0 0 0 0-1H8.5V8z" />
                    </svg>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        2
                    </span>
                </button>
            </div> -->
            
        </div>
    </div>
</nav>
<!-- Navbar End -->