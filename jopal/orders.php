

<?php 
session_start();
require("plugins/actions/config.php");

global $conn;
if (!isset($_SESSION['staff_id'])) {
    header("Location: login-signup.html?You are not logged in");
    echo "You are not logged in";
    exit();
}else {
    $staff_id = $_SESSION['staff_id'];
    $userdata = "SELECT * FROM staff WHERE staff_id = '$staff_id'";
    $result = $conn -> query($userdata);
    $row = $result -> fetch_assoc();
    $staff_id = $row["staff_id"];
    $position = $row["position_id"];
    $accesslevel = $row["access_level"];
    $user_name = $row['username'];
    $profile_pic =$row["profile_pic"];

    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
    
    if (
        !in_array($accesslevel, [1]) || 
        in_array($position, ["AC2-AA","AC3-AM","AC2-FM","AC1-C"])
    )  {
        header("Location: 404.php?You are not authorized");
        echo "You are not authorized";
        exit();
    }
    
}

?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"
        content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, Ample lite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, Ample admin lite dashboard bootstrap 5 dashboard template">
    <meta name="description"
        content="Ample Admin Lite is powerful and clean admin dashboard template, inpired from Bootstrap Framework">
    <meta name="robots" content="noindex,nofollow">
    <title>Jopal orders | <?php echo $user_name ?> </title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/ample-admin-lite/" />
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="plugins/images/jop.png">
    <!-- Custom CSS -->
   <link href="plugins/css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin6">
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="index.php">
                        <!-- Logo text -->
                        <span class="logo-text">
                            <!-- dark Logo text -->
                            <img src="plugins/images/jopal-text.png"  width="auto" height="50" alt="homepage" />
                        </span>
                    </a>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <a class="nav-toggler waves-effect waves-light text-dark d-block d-md-none"
                        href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse bg-warning" id="navbarSupportedContent" >
                    <ul class="navbar-nav d-none d-md-block d-lg-none">
                        <li class="nav-item">
                            <a class="nav-toggler nav-link waves-effect waves-light text-white"
                                href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                        </li>
                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav ms-auto d-flex align-items-center">

                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                        <li class=" in">
                            <form role="search" class="app-search d-none d-md-block me-3">
                                <input type="text" placeholder="Search..." class="form-control mt-0">
                                <a href="" class="active">
                                    <i class="fa fa-search"></i>
                                </a>
                            </form>
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <li>
                            <a class="profile-pic" href="profile.php">
                                <img src="plugins/images/users/<?php if(isset($profile_pic)){echo $profile_pic;} else{exit();}?>" alt="user-img" width="45" height="45"
                                    class="img-circle"><span class="text-white font-medium"><?php echo $user_name ?></span></a>
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                <ul id="sidebarnav">
                        <!-- User Profile-->

                        <?php 
                        require("plugins/actions/config.php");
                            if (
                                in_array($accesslevel, [2,3])
                            )  { ?>
    
                        <li class="sidebar-item pt-2">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="index.php"
                                aria-expanded="false">
                                <i class="far fa-clock" aria-hidden="true"></i>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>

                        <?php 
                                }
                              ?>


                        <?php 
                        require("plugins/actions/config.php");
                            if (
                                in_array($accesslevel, [1,2,3])
                            )  { ?>
                            

                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="profile.php"
                                aria-expanded="false">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <span class="hide-menu">Profile</span>
                            </a>
                        </li>
                        <?php 
                            }
                            ?>



                        <?php 
                        require("plugins/actions/config.php");
                            if (
                                in_array($accesslevel, [3]) || 
                                in_array($position, ["AC2-AA", "AC1-SC","AC2-FM","AC1-C"])
                            )  { ?>
                            
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="customers.php"
                                aria-expanded="false">
                                <i class="fa fa-users" aria-hidden="true"></i>
                                <span class="hide-menu">Customers</span>
                            </a>
                        </li>
                        <?php 
                            }
                            ?>



                        <?php 
                        require("plugins/actions/config.php");
                            if (
                                in_array($accesslevel, [1]) || 
                                in_array($position, ["AC2-AA","AC3-AM","AC2-FM","AC1-C"])
                            )  { ?>
                            
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="orders.php"
                                aria-expanded="false">
                                <i class="fas fa-hourglass-start" aria-hidden="true"></i>
                                <span class="hide-menu">Orders</span>
                            </a>
                        </li>
                            <?php 
                                }
                              ?>



                        <?php 
                        require("plugins/actions/config.php");
                            if (
                                in_array($accesslevel, [1,2,3]) 
                            )  { ?>
                            
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="services.php"
                                aria-expanded="false">
                                <i class="fas fa-utensils" aria-hidden="true"></i>
                                <span class="hide-menu">services</span>
                            </a>
                        </li>
                            <?php 
                                }
                              ?>



                        <?php 
                        require("plugins/actions/config.php");
                            if (
                                in_array($accesslevel, [3]) || 
                                in_array($position, ["AC1-SM", "AC2-FM"])
                            )  { ?>
                            
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="inventory.php"
                                aria-expanded="false">
                                <i class="fas fa-box" aria-hidden="true"></i>
                                <span class="hide-menu">Inventory</span>
                            </a>
                        </li>
                            <?php 
                                }
                            ?>

                        <?php 
                        require("plugins/actions/config.php");
                            if (
                                in_array($accesslevel, [3]) ||
                                in_array($position, [ "AC2-FM"])
                            )  { ?>
                            
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="departments.php"
                                aria-expanded="false">
                                <i class="fas fa-box" aria-hidden="true"></i>
                                <span class="hide-menu">Departments</span>
                            </a>
                        </li>
                            <?php 
                                }
                            ?>



                        <?php 
                        require("plugins/actions/config.php");
                            if (
                                in_array($accesslevel, [3]) || 
                                in_array($position, ["AC2-FM"])
                            )  { ?>
                            
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="transactions-history.php"
                                aria-expanded="false">
                                <i class="fas fa-money-bill-alt" aria-hidden="true"></i>
                                <span class="hide-menu">Transactions-history</span>
                            </a>
                        </li>

                            <?php 
                                }
                              ?>



                        <?php 
                        require("plugins/actions/config.php");
                            if (
                                in_array($accesslevel, [1,2,3])
                            )  { ?>
                            
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="requests.php"
                                aria-expanded="false">
                                <i class="fas fa-comment-dots" aria-hidden="true"></i>
                                <span class="hide-menu">Requests</span>
                            </a>
                        </li>
                            <?php 
                                }
                              ?>




                        <?php 
                        require("plugins/actions/config.php");
                            if (
                                in_array($accesslevel, [3]) || 
                                in_array($position, ["AC1-SC","AC2-FM","AC2-AA","AC1-C"])
                            )  { ?>
                            
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="review.php"
                                aria-expanded="false">
                                <i class="far fa-comment-alt" aria-hidden="true"></i>
                                <span class="hide-menu">Reviews</span>
                            </a>
                        </li>
                      <?php 
                                }
                              ?>




                        <?php 
                        require("plugins/actions/config.php");
                            if (
                                in_array($accesslevel, [3])
                            )  { ?>
                            
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="staff.php"
                                aria-expanded="false">
                                <i class="fa fa-users" aria-hidden="true"></i>
                                <span class="hide-menu">Staff</span>
                            </a>
                        </li>
                        <?php 
                                }
                              ?>
                        <li class="text-center p-20 upgrade-btn">
                            <a data-bs-toggle="modal" data-bs-target="#logout-modal" role="button" 
                                class="btn d-grid btn-danger text-white" >
                                Logout</a>
                        </li>
                    </ul>

                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb bg-white">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Orders Table</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <div class="d-md-flex">
                            <ol class="breadcrumb ms-auto">
                                <li><a href="index.php" class="fw-normal">Dashboard</a></li>
                                
                            </ol>
                                </div>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title">Orders Table</h3>
                            <div class="table-responsive">
                                <table class="table text-nowrap">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0">#</th>
                                            <th class="border-top-0">Customer Name</th>
                                            <th class="border-top-0">Service Name</th>
                                            <th class="border-top-0">Order Mode</th>
                                            <th class="border-top-0">Order Status</th>
                                            <th class="border-top-0">Order Quantity</th>
                                            <th class="border-top-0">Order date</th>
                                            <th class="border-top-0">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                require("plugins/actions/config.php");
                
                
                $sql = "SELECT orders.order_id, orders.customer_id, customers.customer_name,orders.delivery_location, orders.service_id, 
                services.service_name, orders.order_date, orders.order_status, orders.order_quantity, orders.payment_status, orders.order_mode 
                FROM orders 
                LEFT JOIN customers ON orders.customer_id = customers.customer_id 
                LEFT JOIN services ON orders.service_id = services.service_id 
                WHERE orders.staff_id = $staff_id AND orders.order_status <> 'cancelled'";
        
                $result = $conn->query($sql);
                
                $record = "";
                
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $orderid = htmlspecialchars($row["order_id"]);
                        $customerid = htmlspecialchars($row["customer_id"]); 
                        $customername = htmlspecialchars($row["customer_name"]); 
                        $delivery_address = htmlspecialchars($row["delivery_location"]); 
                        $serviceid = htmlspecialchars($row["service_id"]);
                        $itemname = htmlspecialchars($row["service_name"]);
                        $orderdate = htmlspecialchars($row["order_date"]);
                        $orderstatus = htmlspecialchars($row["order_status"]);
                        $orderquantity = htmlspecialchars($row["order_quantity"]);
                        $paymentstatus = htmlspecialchars($row["payment_status"]);
                        $ordermode = htmlspecialchars($row["order_mode"]);
                        ?>

                               
                        <tr>
                                <td> <?php echo $orderid; ?> </td>
                                <td> <?php echo $customername; ?> </td>
                                <td> <?php echo $itemname; ?> </td>
                                <td> <?php echo $ordermode; ?> </td>
                                <td> <?php echo $orderstatus; ?> </td>
                                <td> <?php echo $orderquantity; ?> </td>
                                <td> <?php echo $orderdate; ?> </td>
                                <td>
                                <a class='btn btn-danger' href='plugins/actions/order-operations.php?action=cancel_order&orderid=<?php echo urlencode($orderid); ?>' role='button'>Cancel</a> |
                                <a class='btn btn-warning'type='button' data-bs-toggle='modal' data-bs-target='#update-orders-modal-<?php echo $orderid; ?>' >Update</a>
                                </td>
                            </tr>
                
                      <!-- this is the Update orders modal -->
            <div class="modal fade" id="update-orders-modal-<?php echo $orderid; ?>" tabindex="-1" aria-labelledby="update-orders-modal-title-<?php echo $orderid; ?>" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="update-orders-modal-title-<?php echo $orderid; ?>">Update order Details for <?php echo $customername.", order No.". $orderid; ?></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="plugins/actions/order-operations.php" method = 'POST' id="orders" class="needs-validation" novalidate>

                    <!-- Hidden input to store meal ID -->
                    <input type="hidden" name="order_id" id="order-id" value="<?php echo $orderid; ?>">

                    <input type="hidden" name="orderlist" value="Update">
                    <div class="row g-3">
                      <div class="col-6">
                        <input type="number" class="form-control" placeholder="<?php if (!empty($orderquantity)){echo $orderquantity; }else {echo 'order quantity';}?>" aria-label="order quantity" name="orderquantity" >
                      </div>
                      <div class="col-6">
                        <select name="ordermode" id="" class="form-select" aria-label="order mode" required>
                            <option value="" disabled>order mode</option>
                            <?php
                                $ordermodes = ["in-person","online"]; 
                                
                                foreach($ordermodes as $mode){
                                    $selected = ($mode == $ordermode) ? 'selected' : '';
                                        echo " <option value='$mode' $selected> $mode</option>";
                                }
                            ?>
                        </select>
                      </div>

                      
                                <?php if($ordermode == "online") { ?>
                                    <div class="col-12">
                          <input type="text" class="form-control"placeholder="<?php if (!empty($delivery_address)){echo $delivery_address; }else {echo 'delivery_address';}  ?>" id="delivery_address" name="delivery_address" >
                         
                                    </div>
                                <?php } ?>

                      <div class="col-6">
                        <select name="orderstatus" id="" class="form-select" aria-label="order status" required>
                            <option value="" disabled>order status</option>
                            <?php
                            
                            $orderstatuses = ["completed", "pending","cancelled"];
                            foreach ($orderstatuses as $orderstat) {
                                $selected = ($orderstat == $orderstatus) ? 'selected' : '';  
                                echo "<option value=\"$orderstat\" $selected>$orderstat</option>"; 
                            }
                            
                            ?>
                            <?php
                                

                                
                            ?>
                        </select>
                      </div>

                      <div class="col-6">
                        <select name="paymentstatus" id="" class="form-select" aria-label="payment status" required>
                            <option value="" disabled>payment status</option>
                            <?php
                            
                            $paymentstatuses = ["completed","pending"]; 
                            $selected = ($paymentstat == $paymentstatus) ? 'selected' : '';
                                 foreach($paymentstatuses as $paymentstat){
                                    echo "<option value=\"$paymentstat\" $selected>$paymentstat</option>"; 
                                 }
                            
                            ?>
                        </select>
                      </div>

                     

                    </div> 
                    <button type="submit" class="btn btn-outline-danger" name="Update_order"  id="order">Update</button>
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                
                </div>
              </div>
            </div>
          </div>
  
                <?php
                    }
                } else {
                    $record = "<tr><td colspan='4'>No Orders available</td></tr>";
                }
                
                $conn->close();
                echo $record;
                ?>
                    

                              </td>
                            </tr>

                       <tr>
                                
                
               
                    
                                    </tbody>
                           
                                </table>
                                         <!-- Add orderss button that toggles to the add orderss modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-order-modal"  >
              Add Order
            </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center"> 2024 © Jopal brought to you by JopalBusinessCenter
                    <p>Content on this page is reproduced from <a
                    href="https://www.wrappixel.com/">wrappixel.com</a> with permission from the author.</p>

            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>




            <!-- this is the Add orders modal -->
            <div class="modal fade" id="add-order-modal" tabindex="-1" aria-labelledby="orders-modal-title" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="orders-modal-title">Add Orders</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="plugins/actions/order-operations.php" method = 'POST' id="Services" class="needs-validation" novalidate>
                    <input type="hidden" name="orderlist" value="Add">
                    <div class="row g-3">
                      <div class="col-12">
                      <select name="customers" id="customers" class="form-select" aria-label="customers " required>
                            <option value="" disabled>Customers</option>
                            <?php
                                require("plugins/actions/config.php");
                                $customersql = "select customer_id,customer_name from customers";
                                $results = $conn ->query($customersql);
                                if ($results -> num_rows > 0){
                                    while($row = $results ->fetch_assoc())
                                        echo " <option value=' " . $row['customer_id']. "'> ".$row['customer_name']."</option>";
                                }else{
                                    echo " <option value=' ' disabled selected >  No Customers Created </option>";
                               
                                }
            
                            ?>
                        </select>
                     </div>
                      <div class="col-12">
                      <select name="service" id="service" class="form-select" aria-label="Services " required>
                            <option value="" disabled>service</option>
                            <?php
                                require("plugins/actions/config.php");
                                $servicesql = "select service_id,service_name from services";
                                $results = $conn ->query($servicesql);
                                if ($results -> num_rows > 0){
                                    while($row = $results ->fetch_assoc())
                                        echo " <option value=' " . $row['service_id']. "'> ".$row['service_name']."</option>";
                                }else{
                                    echo " <option value=' ' disabled selected >  No services available </option>";
                               
                                }
                                
                            ?>
                        </select>
                     </div>
                      <div class="col-6">
                        <select name="ordermode" id="" class="form-select" aria-label="order mode" required>
                            <option value="" disabled>order mode</option>
                            <?php
                                $ordermode = ["in-person","online"]; 

                                foreach($ordermode as $mode){
                                        echo " <option value='$mode'> $mode</option>";
                                }
                            ?>
                        </select>
                      </div>
                      <div class="col-6">
                      <input type="number" class="form-control" placeholder="order quantity" aria-label="order quantity" name="orderquantity" value="1" required>
                      </div>
                    

                    </div> 
                    <button type="submit" class="btn btn-outline-danger" name="Add_order"  id="Order">Add</button>
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                
                </div>
              </div>
            </div>
          </div>




            <!-- this is the logout modal -->
            <div class="modal fade" id="logout-modal" tabindex="-1" aria-labelledby="logout-modal-title" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="logout-modal-title">Logout</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <?php if($position == "AC1-SC"){
                        echo"<p class='text-danger'>Please connect to the internet to proceed</p><br>";
                    }?>
                  <p>This will log you out. Do you still want to proceed?</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                  
                  <form action="plugins/actions/logout.php" method="post">
                  <button type="submit" class="btn btn-outline-danger" name="logout"  id="logout">Logout</button>
                  </form>
              </div>
            </div>
          </div>
        </div>
  <!-- =============================================== -->
  <!-- =================END OF customer UPLOAD MODAL============== -->
  <!-- =============================================== -->

    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="plugins/js/app-style-switcher.js"></script>
    <!--Wave Effects -->
    <script src="plugins/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="plugins/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="plugins/js/custom.js"></script>

</body>

</html>