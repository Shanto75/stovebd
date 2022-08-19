<?php

$error = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  
    require './db/db.php';

  if (!$conn) {
    die("Sorry we failed to connect: " . mysqli_connect_error());
  } else {

    $email = $_POST['email'];
    $pass = $_POST['pass'];

    $sql = "Select * from admin where email='$email'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 1) {
      while( $row = mysqli_fetch_assoc($result)){

          if ( $pass === $row['password']) {
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['adminEmail'] = $email;
            header("location: adminProfile.php");
          } else {
            $error = "Invalid Input!!";
          }
      }

      
    } else {
      $error = "Invalid Input!!";
    }
} 
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Section</title>

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Oswald:wght@500;600;700&family=Pacifico&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>

    <!-- Topbar and navbar Start -->
    <?php require './resource/sidebar.php'?>
    <!-- Topbar and navbar End -->
    
    <?php

        if ($error) {
            echo ' <div class="text-center alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> ' . $error . '
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div> ';
        }
    ?>


    <div class="container mt-5 ">
        <form action="admin.php" method="post">
            <div class="col-lg-6 p-5 bg-dark mx-auto text-white">
                <h1 class="text-center text-white">Admin LogIn</h1>
                <hr>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email Address</label>
                    <input type="email" class="form-control" name="email" id="exampleInputEmail1"
                        aria-describedby="emailHelp">
                </div>
                <div class="mb-5">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" name="pass" id="exampleInputPassword1">
                </div>
                <!-- <div class="mb-3 text-center alert alert-danger" role="alert">
                    Forgot your password? <a href="#" class="alert-link">Click hear to change.</a>
                </div> -->
                <div class="d-flex align-items-center justify-content-center ">
                    <button type="submit" class="py-3 mt-4 px-5 btn btn-outline-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>


    <!-- Footer Start -->
    <?php require './resource/footer.php'?>
    <!-- Footer End -->

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>