
<nav class="navbar navbar-dark bg-dark ">
    <div class="container-fluid">
        <a class="navbar-brand" href="adminProfile.php">Admin Section</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
            aria-controls="offcanvasNavbar">
            <span class="text-dark navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Admin Section Options</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div class="bg-dark py-4">
                    <div class="d-flex flex-column gap-2">
                        <a href="admin.php" class="btn btn-dark">Admin Login</a>
                        <a href="logout.php" class="btn btn-dark">Logout</a>
                        <a href="adminProfile.php" class="btn btn-dark">Admin List</a>
                        <a href="addAdmin.php" class="btn btn-dark">Add Admin</a>
                        <a href="orderList.php" class="btn btn-dark">Order List</a>
                        <a href="confirmedOrders.php" class="btn btn-dark">Confirmed Orders</a>
                        <a href="itemList.php" class="btn btn-dark">Item List</a>
                        <a href="addItem.php" class="btn btn-dark">Add Item</a>
                        <a href="updateInfo.php" class="btn btn-dark">Website info</a>
                        <a href="message.php" class="btn btn-dark">Messages</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>