<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
  header("location: admin.php");
  exit;
}

require './db/db.php';
$delete = false;
$confirm = false;
$confirmfailed = false;
$update = false;
$updatefail = false;
if (!$conn) {
    die("Sorry we failed to connect: " . mysqli_connect_error());
}
else{
    if (isset($_GET['delete'])) {
        $sno = $_GET['delete'];
        $sql = "DELETE FROM `order` WHERE `orderId` = '$sno'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $delete = true;
        }
        else{
            $deletionFail = true;
        }
    }
    elseif (isset($_GET['confirm'])) {
        $sno = $_GET['confirm'];
        
        $sql = "SELECT * FROM `order` WHERE `orderId` = '$sno'";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_assoc($result);

            $orderId = $row['orderId'];
            $name = $row['userName'];
            $email = $row['userEmail'];
            $itemname = $row['itemName'];
            $quantity = $row['quantity'];
            $phone = $row['phone'];
            $address = $row['userAddress'];

            $sql = "INSERT INTO `confirmorders`(`orderId`, `userEmail`, `userName`, `itemName`, `quantity`, `phone`, `userAddress`) VALUES ('$orderId', '$email', '$name', '$itemname', '$quantity', '$phone', '$address')";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                $sql = "DELETE FROM `order` WHERE `orderId` = '$sno'";
                $result = mysqli_query($conn, $sql);
                $confirm = true;
                } else {
                $confirmfailed = true;
            }
        }
        else {
            $confirmfailed = true;
        }
    }
    elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['snoEdit'])) {
            // Update the record

            $id = $_POST['id'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $itemname = $_POST['itemname'];
            $quantity = $_POST['quantity'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            
            $sql = "UPDATE `order` SET `orderId` = '$id' , `userEmail` = '$email' , `userName` = '$name', `itemName` = '$itemname', `quantity` = '$quantity', `phone` = '$phone', `userAddress` = '$address' WHERE `order`.`orderId` = '$id'";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $update = true;
            } else {
                $updatefail = true;
            }
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
    <!-- Edit Modal -->
    <div class="modal fade mx-auto" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
        aria-hidden="true">
        <div class="modal-dialog bg-dark text-white" role="document">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="editModalLabel">Edit Admin Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="bg-dark mx-auto p-5  text-white " action="orderList.php" method="post">
                    <input type="hidden" name="snoEdit" id="snoEdit">
                    <h1 class="text-center text-white pb-4">Update Order Information</h1>
                    <div class="mb-3">
                        <label class="form-label">Order ID</label>
                        <input type="number" class="form-control" name="id" id="editid" required readonly>
                    </div>
                    <div class="my-3">
                        <label for="exampleInputName1" class="form-label">Your Name</label>
                        <input type="text" class="form-control" name="name" id="editname">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email Address</label>
                        <input type="email" class="form-control" name="email" id="editemail" aria-describedby="emailHelp">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputDate1" class="form-label">Item Name</label>
                        <input type="text" class="form-control" name="itemname" id="edititemname">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputNumber1" class="form-label">Quantity</label>
                        <input type="number" class="form-control" name="quantity" id="editquantity">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputName1" class="form-label">Phone Number</label>
                        <input type="number" class="form-control" name="phone" id="editphone">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputName1" class="form-label">Address</label>
                        <input type="text" class="form-control" name="address" id="editaddress">
                    </div>
                    <!-- <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Submit Order</button>
                    </div> -->

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

    <!-- alart -->

    <?php
    if ($delete) {
            echo "<div class='text-center alert alert-success alert-dismissible fade show' role='alert'>
                    <strong>Success!</strong> Order Canceled successfully !! 
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>×</span>
                    </button>
                </div>";
    }
    if ($confirm) {
        echo "<div class='text-center alert alert-success alert-dismissible fade show' role='alert'>
                <strong>Success!</strong> Order Confirm successfully !! 
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>×</span>
                </button>
            </div>";
    }
    if ($confirmfailed) {
    echo "<div class='text-center alert alert-danger alert-dismissible fade show' role='alert'>
            <strong>Success!</strong> Order confirm faild !! 
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

    <div class="container bg-light overflow-auto">
        <h5 class="text-center my-3">Order List</h5>

        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">User Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Item Name</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Address</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    require './db/db.php';
                    if (!$conn) {
                    die("Sorry we failed to connect: " . mysqli_connect_error());
                    }

                    $sql = "SELECT * FROM `order` ORDER BY `orderId`";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo " <tr>
                        <td>" . $row['orderId'] . "</td>
                        <td>" . $row['userName'] . "</td>
                        <td>" . $row['userEmail'] . "</td>
                        <td>" . $row['itemName'] . "</td>
                        <td>" . $row['quantity'] . "</td>
                        <td>" . $row['phone'] . "</td>
                        <td>" . $row['userAddress'] . "</td>
                        <td>
                        <button class='confirm m-1 btn btn-sm btn-primary'>Confirm</button>
                        <button class='update m-1 btn btn-sm btn-primary'>Update</button>
                        <button class='delete m-1 btn btn-sm btn-primary'>Cancel</button>
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
    updates = document.getElementsByClassName('update');
    Array.from(updates).forEach((element) => {
        element.addEventListener("click", (e) => {
            tr = e.target.parentNode.parentNode;

            id = tr.getElementsByTagName("td")[0].innerText;
            name = tr.getElementsByTagName("td")[1].innerText;
            email = tr.getElementsByTagName("td")[2].innerText;
            itemname = tr.getElementsByTagName("td")[3].innerText;
            quantity = tr.getElementsByTagName("td")[4].innerText;
            phone = tr.getElementsByTagName("td")[5].innerText;
            address = tr.getElementsByTagName("td")[6].innerText;

            editid.value = id;
            editname.value = name;
            editemail.value = email;
            edititemname.value = itemname;
            editquantity.value = quantity;
            editphone.value = phone;
            editaddress.value = address;

            snoEdit.value = e.target.id;


            $('#editModal').modal('toggle');
        })
    })


    confirms = document.getElementsByClassName('confirm');
    Array.from(confirms).forEach((element) => {
        element.addEventListener("click", (e) => {
            tr = e.target.parentNode.parentNode;
            sno = tr.getElementsByTagName("td")[0].innerText;
            console.log(sno);

            if (confirm("Are you sure you want to confirm this order!")) {
                window.location = `orderList.php?confirm=${sno}`;
            }
        })
    })

    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
        element.addEventListener("click", (e) => {
            console.log("delete");
            tr = e.target.parentNode.parentNode;
            sno = tr.getElementsByTagName("td")[0].innerText;

            if (confirm("Are you sure you want to cancel this order!")) {
                window.location = `orderList.php?delete=${sno}`;
            }
        })
    })
    </script>
</body>

</html>