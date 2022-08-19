<?php

$showAlert = false;
$failed = false;

require './db/db.php';

// Die if connection was not successful
if (!$conn) {
    die("Sorry we failed to connect: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $itemname = $_POST['itemname'];
    $quantity = $_POST['quantity'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    // Sql query to be executed

    $sql = "INSERT INTO `order`(`userEmail`, `userName`, `itemName`, `quantity`, `phone`, `userAddress`) VALUES ('$email', '$name', '$itemname', '$quantity', '$phone', '$address')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $showAlert = true;
    } else {
        $failed = true;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Oswald:wght@500;600;700&family=Pacifico&display=swap" rel="stylesheet">

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
    <?php require './resource/navbar.php' ?>
    <!-- Topbar and navbar End -->

    <!-- Page Header Start -->
    <div class="container-fluid bg-dark bg-img p-5 mb-5">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-4 text-uppercase text-white">Menu & Pricing</h1>
                <a href="">Home</a>
                <i class="far fa-square text-primary px-2"></i>
                <a href="">Menu & Pricing</a>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <?php
    if ($showAlert) {
        echo ' <div class="text-center alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!!</strong> Order successfully done.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> ';
    }
    if ($failed) {
        echo ' <div class="text-center alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!!</strong> Order failed.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> ';
    }
    ?>

    <!-- Edit Modal -->
    <div class="modal fade mx-auto" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog bg-dark text-white" role="document">
            <div class="modal-content bg-dark">
                <div class="modal-header">
                    <h5 class="text-center text-white">Enter Order Information</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="menu.php" method="post" class="item-center mx-5 bg-dark text-white">
                    <div class="my-3">
                        <label for="exampleInputName1" class="form-label">Your Name</label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email Address</label>
                        <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputDate1" class="form-label">Item Name</label>
                        <input type="text" class="form-control" name="itemname" id="itemname">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputNumber1" class="form-label">Quantity</label>
                        <input type="number" class="form-control" name="quantity" id="quantity">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputName1" class="form-label">Phone Number</label>
                        <input type="number" class="form-control" name="phone" id="phone">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputName1" class="form-label">Address</label>
                        <input type="text" class="form-control" name="address" id="address">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Submit Order</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container">

        <h1 class="text-center my-4">Menu</h5>

            <div class="w-auto p-4">
                <?php
                $sql = "SELECT * FROM `info`";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                ?>
                <img class="img-fluid mx-auto d-block" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['menuPhoto']); ?> " alt="img" />
                
            </div>


            <h1 class="text-center my-5">Item List</h5>

                <div class=" ">

                    <div class="row row-cols-1 row-cols-lg-3 g-4  ">

                        <?php
                        require './db/db.php';
                        if (!$conn) {
                            die("Sorry we failed to connect: " . mysqli_connect_error());
                        }
                        $img = "./img/hero.jpg";
                        $sql = "SELECT * FROM `items` ORDER BY `itemId`";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<div class=" col d-flex justify-content-center ">
                            <div class="card overflow-hidden" style="width: 20rem;" >
                                <img style="height: 15rem;width: 20rem;" src="data:image/jpg;charset=utf8;base64,'. base64_encode($row['photo']) .'" />
                            <div class="card-body">
                                <h5 id=' . $row['itemId'] . ' class="card-title">' . $row['itemName'] . '</h5>
                                <p class="card-text"> Price: ' . $row['price'] . ' TK</p>
                                <p class="card-text">Description: ' . $row['description'] . '</p>
                                </div>
                                <div class="card-footer text-center">
                                    <button class="order btn btn-primary" id=' . $row['itemId'] . '>Order</button>
                                </div>
                            </div>
                        </div>';
                        }
                        ?>
                    </div>
                </div>

    </div>

    <!-- Footer Start -->
    <?php require './resource/footer.php' ?>
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

    <script>
        edits = document.getElementsByClassName('order');
        Array.from(edits).forEach((element) => {
            element.addEventListener("click", (e) => {
                var itemname = document.getElementById("itemname");
                console.log(e.target.id);


                $('#orderModal').modal('toggle');
            })
        })
    </script>
</body>

</html>