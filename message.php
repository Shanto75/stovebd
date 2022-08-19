<?php

session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
  header("location: admin.php");
  exit;
}

$delete = false;
$update = false;
$updatefail = false;

require './db/db.php';
if (!$conn) {
    die("Sorry we failed to connect: " . mysqli_connect_error());
}
else{

    if (isset($_GET['delete'])) {
        $sno = $_GET['delete'];
        $sql = "DELETE FROM `message` WHERE `id` = '$sno'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $delete = true;
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
        if ($delete) {
            echo "<div class='text-center alert alert-success alert-dismissible fade show' role='alert'>
                    <strong>Success!</strong> Admin Deleted successfully !! 
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>×</span>
                    </button>
                </div>";
    }
    ?>

    <!-- admin profile start -->


    <div class="container bg-light overflow-auto">
        <h5 class="text-center mt-3">Message List</h5>

        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Subject</th>
                    <th scope="col">message</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    require './db/db.php';
                    if (!$conn) {
                    die("Sorry we failed to connect: " . mysqli_connect_error());
                    }

                    $sql = "SELECT * FROM `message` ORDER BY `id`";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {

                        echo " <tr>
                        <td>" . $row['id'] . "</td>
                        <td>" . $row['name'] . "</td>
                        <td>" . $row['email'] . "</td>
                        <td>" . $row['subject'] . "</td>
                        <td>" . $row['message'] . "</td>
                        <td>
                        <button class='delete m-1 btn btn-sm btn-primary'>Delete</button>
                        </td>
                        </tr>";
                    }

                ?>

            </tbody>
        </table>

    </div>

    <!-- admin profile end -->


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

    <script>

    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
        element.addEventListener("click", (e) => {
            console.log("delete");
            tr = e.target.parentNode.parentNode;
            sno = tr.getElementsByTagName("td")[0].innerText;

            if (confirm("Are you sure you want to Delete this message!")) {
                window.location = `message.php?delete=${sno}`;
            }
        })
    })
    </script>
</body>

</html>