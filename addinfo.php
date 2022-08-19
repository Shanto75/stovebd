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
} else {

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['snoEdit'])) {
            // Update the record

            $sno = $_POST["snoEdit"];
            $about = $_POST["about"];
            $address = $_POST['address'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];

            // Sql query to be executed
            $sql = "INSERT INTO `info`(`about`, `address`, `email`, `phone`) VALUES ('$about' , '$address','$email' , '$phone') ";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $update = true;
            } else {
                $updatefail = true;
            }
        }

        if (!empty($_FILES["img"]["name"])) {
            // Get file info 
            $allowTypes = array('jpg','png','jpeg','gif'); 
    
    
            $fileName = basename($_FILES["img"]["name"]);
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
    
            if(in_array($fileType, $allowTypes)){ 
                $image = $_FILES['img']['tmp_name'];
                $imgContent = addslashes(file_get_contents($image));

                if($_POST["updatepic"] == "logo"){
                    $sql = "INSERT INTO `info` (`logo`) VALUES ('$imgContent')";
                }
                elseif($_POST["updatepic"] == "menu"){
                    $sql = "INSERT INTO `info` (`menuPhoto`) VALUES ('$imgContent')";
                }
                elseif($_POST["updatepic"] == "aboutpic"){
                    $sql = "INSERT INTO `info` (`aboutpic`) VALUES ('$imgContent')";
                }
    
    
                $result = mysqli_query($conn, $sql);
        
                if ($result) {
                    $update = true;
                }
                else{
                    $updatefail = true;
                }
            }else{
                $updatefail = true;
            }
    
        }
        
    }

    $sql = "SELECT * FROM `info`";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web site Information</title>

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

    <!-- Edit Modal -->
    <div class="modal fade mx-auto" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog bg-dark text-white" role="document">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="bg-dark mx-auto p-5  text-white " action="updateInfo.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="snoEdit" id="snoEdit">
                    <h1 class="text-center text-white pb-4">Add Item Information</h1>
                    <div class="mb-3">
                        <label class="form-label">About</label>
                        <!-- <input type="textarea" class="form-control" name="about" id="editabout" required> -->
                        <textarea class="form-control" name="about" id="editabout" rows="6"></textarea required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <input type="text" class="form-control" name="address" id="editaddress" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="text" class="form-control" name="email" id="editemail" required>
                    </div>

                    <div class="mb-3">
                        <label for="pass" class="form-label">Phone</label>
                        <input type="text" class="form-control" name="phone" id="editphone" required>
                    </div>

                    <div class="d-flex align-items-center justify-content-center ">
                        <button type="submit" class="py-3 mt-4 px-5 btn btn-outline-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade mx-auto" id="imgmodal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog bg-dark text-white" role="document">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="bg-dark mx-auto p-5 text-white " action="updateInfo.php" method="post" enctype="multipart/form-data">
                    <h5 class="text-center text-white">Add Image</h5>
                    <input type="hidden" name="updatepic" id="updatepic">
                    <div class="mb-3">
                        <label for="menu" class="form-label">Image</label>
                        <input type="file" class="form-control" name="img" id="img" required>
                    </div>
                    <div class="d-flex align-items-center justify-content-center ">
                        <button type="submit" class="py-3 mt-4 px-5 btn btn-outline-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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
    if ($update) {
        echo "<div class='text-center alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Success!</strong> Information Updated Successfully !!
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>×</span>
            </button>
        </div>";
    }
    if ($updatefail) {
        echo "<div class=' text-center alert alert-danger alert-dismissible fade show' role='alert'>
            <strong>Failed!</strong> Could not update the Information successfully !!
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>×</span>
            </button>
        </div>";
    }
    ?>

    <!-- admin profile start -->

    <div>
        <div class="row">

            <div class=" bg-light overflow-auto">
                <h5 class="text-center mt-3">Web site Information</h5>

                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">About</th>
                            <th scope="col">Address</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                            echo " <tr>
                                <td>" . $row['about'] . "</td>
                                <td>" . $row['address'] . "</td>
                                <td>" . $row['email'] . "</td>
                                <td>" . $row['phone'] . "</td>
                                <td>
                                <button class='update m-1 btn btn-sm btn-primary'>AddInfo</button>
                                </td>
                                </tr>";

                        ?>

                    </tbody>
                </table>

                <div class="d-flex gap-2">
                    <div class="card" style="width: 18rem;">
                        <h5 class="card-title text-center">Logo</h5>
                        <img  src='data:image/jpg;charset=utf8;base64, <?php echo base64_encode($row['logo']);?>' />
                        <div class="card-body">
                            <button onclick="logo()" class='logo m-1 btn btn-sm btn-primary'>Add Photo</button>
                        </div>
                    </div>

                    <div class="card" style="width: 18rem;">
                        <h5 class="card-title text-center">Menu</h5>
                        <img  src='data:image/jpg;charset=utf8;base64, <?php echo base64_encode($row['menuPhoto']);?>' />
                        <div class="card-body">
                            <button onclick="menu()" class='menu m-1 btn btn-sm btn-primary'>Add Photo</button>
                        </div>
                    </div>

                    <div class="card" style="width: 18rem;">
                        <h5 class="card-title text-center">About Photo</h5>
                        <img  src='data:image/jpg;charset=utf8;base64, <?php echo base64_encode($row['aboutpic']);?>' />
                        <div class="card-body">
                            <button onclick="aboutpic()" class='menu m-1 btn btn-sm btn-primary'>Add Photo</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <!-- admin profile end -->


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
    updates = document.getElementsByClassName('update');
    Array.from(updates).forEach((element) => {
        element.addEventListener("click", (e) => {
            tr = e.target.parentNode.parentNode;

            about = tr.getElementsByTagName("td")[0].innerText;
            address = tr.getElementsByTagName("td")[1].innerText;
            email = tr.getElementsByTagName("td")[2].innerText;
            phone = tr.getElementsByTagName("td")[3].innerText;
            
            editabout.value = about;
            editaddress.value = address;
            editemail.value = email;
            editphone.value = phone;

            snoEdit.value = email;

            $('#editModal').modal('toggle');
        })
    })

    function logo(){
        $('#imgmodal').modal('toggle');
        updatepic.value = "logo";
    }
    function menu(){
        $('#imgmodal').modal('toggle');
        updatepic.value = "menu";
    }
    function aboutpic(){
        $('#imgmodal').modal('toggle');
        updatepic.value = "aboutpic";
    }

    </script>
</body>

</html>