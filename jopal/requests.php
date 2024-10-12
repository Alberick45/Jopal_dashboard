<?php 
session_start();
require("plugins/actions/config.php");

global $conn;
if (!isset($_SESSION['staff_id'])) {
    header("Location: login-signup.html?You are not logged in");
    echo "You are not logged in";
    exit();
}elseif(!isset($_SESSION["access_level"])) {
    header("Location: ../index.php?You are not authorized");
    echo "You are not authorized";
    exit();
} else {
    $staff_id = $_SESSION['staff_id'];
    $userdata = "SELECT * FROM staff WHERE Staff_id = '$staff_id'";
    $result = $conn -> query($userdata);
    $row = $result -> fetch_assoc();
    $staff_id = $row["staff_id"];
    $position = $row["position_id"];
    $accesslevel = $row["access_level"];
    $user_name = $row['username'];
    $profile_pic =$row["profile_pic"];

   
    // $profile_pic =$row["ru_pic"];
    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
    if (
        !in_array($accesslevel, [1,2,3])
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
    <title>Jopal requests | <?php echo $user_name ?> </title>
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
                                <img src="plugins/images/users/<?php echo $profile_pic?>" alt="user-img" width="45" height="45"
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
                                in_array($position, ["AC2-AA", "AC1-SC","AC2-FM"])
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
                                in_array($position, ["AC2-AA"])
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
                                in_array($position, ["AC1-SC","AC2-FM","AC2-AA"])
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
                        <h4 class="page-title">Requests Table</h4>
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
                            <h3 class="box-title">Requests Table</h3>
                            <div class="table-responsive">
                                <table class="table text-nowrap">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0">#</th>
                                            <th class="border-top-0">Request</th>
                                            <th class="border-top-0">Request Category</th>
                                            <th class="border-top-0">Request Status</th>
                                            <th class="border-top-0">Request Date</th>
                                            <?php 
                                        require("plugins/actions/config.php");
                                            if (
                                                in_array($accesslevel, [3])
                                            )  { ?>
                            
                                            <th class="border-top-0 " >Actions</th>
                                            <?php 
                                                }
                                            ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                require("plugins/actions/config.php");
                
                
                $sql = "SELECT request_id, request, financial_category.category_name ,financial_category.category_id, request_status, request_date FROM requests left join financial_category on requests.category_id = financial_category.category_id";
                $result = $conn->query($sql);
                
                
                
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $requestid = htmlspecialchars($row["request_id"]);
                        $request = htmlspecialchars($row["request"]);
                        $categoryname = htmlspecialchars($row["category_name"]);
                        $category_id = htmlspecialchars($row["category_id"]);
                        $requeststatus = htmlspecialchars($row["request_status"]);
                        $requestdate = htmlspecialchars($row["request_date"]);
                                ?>

                        <tr>
                        <td> <?php echo $requestid; ?> </td>
                        <td> <?php echo $request; ?> </td>
                        <td> <?php echo $categoryname; ?> </td>
                        <td> <?php echo $requeststatus; ?> </td>
                        <td> <?php echo $requestdate; ?> </td>
                        <?php 
                                        require("plugins/actions/config.php");
                                            if (
                                                in_array($accesslevel, [3])
                                            )  { ?>
                            
                        <td>
                        <a class='btn btn-danger' href='plugins/actions/requests-operations.php?action=deleterequest&rid=<?php echo urlencode($requestid); ?>' role='button'>Delete</a> |
                        <a class='btn btn-warning'type='button' data-bs-toggle='modal' data-bs-target='#update-requests-modal-<?php echo $requestid; ?>' >Update</a> 
                       </td>
                       <?php 
                                }
                            ?>
                    </tr>
        
              <!-- this is the Update meals modal -->
    <div class="modal fade" id="update-requests-modal-<?php echo $requestid; ?>" tabindex="-1" aria-labelledby="update-requests-modal-title-<?php echo $requestid; ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="update-requests-modal-title-<?php echo $requestid; ?>">Update requests Details-<?php echo $requestid; ?></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="plugins/actions/requests-operations.php" method = 'POST' id="requests" class="needs-validation" novalidate>

            <!-- Hidden input to store meal ID -->
            <input type="hidden" name="request_id" id="request-id" value="<?php echo $requestid; ?>">

            <input type="hidden" name="requestlist" value="Update">
            <div class="row g-3">
            <input type="hidden" name="approver_id" value="<?php echo $staff_id?>">


            <div class="col-6">
                <h4 class="text-center text-success">Request- <?php if (!empty($request)){echo $request; }else {echo 'request';}?></h4>
              </div>

              <div class="col-12">
              <select name="requestcategory" id="" class="form-select" aria-label="category" required>
                                <option value="" disabled>FInancial Category</option>
                                <?php
                                require("plugins/actions/config.php");
                                $categorysql = "SELECT  category_id, category_name FROM financial_category";
                                $categoryresult = $conn -> query($categorysql);

                                if ($categoryresult -> num_rows > 0){
                                    while ($row = $categoryresult -> fetch_assoc()){
                                        $categoryid = $row['category_id'];
                                        $categoryname = $row['category_name'];
                                        $selected = ($categoryid == $category_id) ? 'selected' : '';
                                  echo "<option value=\"$categoryid\" $selected>$categoryname</option>";  
                                        echo " <option value='$categoryid'> $categoryname</option>";
                                    }
                                }
                                ?>
                            </select>
                
              </div>
             
              <div class="col-12">
                        <select name="requeststatus" id="" class="form-select" aria-label="request status" required>
                            <option value="" disabled>request status</option>
                            <?php
                            
                            $requeststatuses = ["approved", "pending","disapproved"];
                            foreach ($requeststatuses as $requeststat) {
                                $selected = ($requeststat == $requeststatus) ? 'selected' : '';  
                                echo "<option value=\"$requeststat\" $selected>$requeststat</option>"; 
                            }
                           
                            ?>
                          
                        </select>
                </div>
          

              


            </div> 
            <button type="submit" class="btn btn-outline-danger" name="Update_requests"  id="requests">Update</button>
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
                    echo  "<tr><td colspan='4'>No Requests found</td></tr>";
                }
                
                $conn->close();
                
                ?>
                    
                                    </tbody>
                           
                                </table>
                                <?php 
                                        require("plugins/actions/config.php");
                                            if (
                                                in_array($accesslevel, [1,2])
                                            )  { ?>
                            
                                         <!-- Add Requests button that toggles to the add Requests modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-request-modal"  >
              Add Request
            </button><?php 
                            }
                        ?>
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





            <!-- this is the Add Requests modal -->
            <div class="modal fade" id="add-request-modal" tabindex="-1" aria-labelledby="request-modal-title" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="request-modal-title">Add Requests</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="plugins/actions/requests-operations.php" method = 'POST' id="request" class="needs-validation" novalidate>
                    <input type="hidden" name="requestlist" value="Add">
                    <div class="row g-3">


                        <div class="col-6">
                            <textarea class="form-control" placeholder="request" aria-label="request" name="request"></textarea>

                        </div>

                        <input type="hidden" name="requester" value="<?php echo $staff_id?>">

                        <div class="col-12">
                            <select name="categoryid" id="" class="form-select" aria-label="category" required>
                                <option value="" disabled>FInancial Category</option>
                                <?php
                                require("plugins/actions/config.php");
                                $categorysql = "SELECT  category_id, category_name FROM financial_category";
                                $categoryresult = $conn -> query($categorysql);

                                if ($categoryresult -> num_rows > 0){
                                    while ($row = $categoryresult -> fetch_assoc()){
                                        $categoryid = $row['category_id'];
                                        $categoryname = $row['category_name'];
                                        echo " <option value='$categoryid'> $categoryname</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        
                        

                    </div> 
                    <button type="submit" class="btn btn-outline-danger" name="Add_request"  id="request">Add</button>
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