<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
  header("location: admin.php");
  exit;
}

$showAlert = false;
$failed = false;

require './db/db.php';

// Die if connection was not successful
if (!$conn) {
    die("Sorry we failed to connect: " . mysqli_connect_error());
}
else {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = $_POST['name'];
    $price = $_POST['price'];
    $des = $_POST['des'];

    $image = $_FILES['image']['tmp_name'];
    $imgContent = addslashes(file_get_contents($image));

    // Sql query to be executed
    
    $sql = "INSERT INTO `items` (`itemName`, `price`, `description` , `photo`) VALUES ('$name', '$price', '$des', '$imgContent')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
      $showAlert = true;
    } else {
      $failed = true;
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
        if ($showAlert) {
            echo ' <div class="text-center alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!!</strong> New Item added successfully.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> ';
        }
        if ($failed) {
            echo ' <div class="text-center alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!!</strong> Failed to add new Item.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> ';
        }
    ?>

    <div class="container bg-light overflow-auto">
        <div class="container">
            <h1 class="text-center p-4">Add New Item</h1>
            <form class="bg-dark mx-auto p-5 col-lg-6 text-white " action="addItem.php" method="post"
                enctype="multipart/form-data">
                <div class="d-flex justify-content-center">
                </div>
                <div class="mb-3">
                    <label class="form-label">Item Name</label>
                    <input type="text" class="form-control" name="name" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Price</label>
                    <input type="number" class="form-control" name="price" aria-describedby="emailHelp" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <input type="text" class="form-control" name="des" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Upload Image</label>
                    <input type="file" class="form-control" name="image" required>
                </div>

                <div class="d-flex align-items-center justify-content-center ">
                    <button type="submit" class="py-3 mt-4 px-5 btn btn-outline-primary">Submit</button>
                </div>
            </form>
        </div>

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