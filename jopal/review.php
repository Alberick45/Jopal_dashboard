

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
        !in_array($accesslevel, [3]) || 
        in_array($position, ["AC1-SC","AC2-FM","AC2-AA","AC1-C"])
    ) {
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
    <title>Jopal reviews | <?php echo $user_name ?> </title>
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
                        <h4 class="page-title">Reviews Table</h4>
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
                            <h3 class="box-title">Reviews Table</h3> 
                            <div class="table-responsive">
                                <table class="table text-nowrap">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0">#</th>
                                            <th class="border-top-0">review</th>
                                            <th class="border-top-0">customer name</th>
                                            <th class="border-top-0">suggestion</th>
                                            <?php 
                                        require("plugins/actions/config.php");
                                            if (
                                                in_array($accesslevel, [1,2,3])
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
                
                
                $sql = "SELECT review_id, review, customer_name, suggestion  FROM review left join customers on review.customer_id = customers.customer_id";
                $result = $conn->query($sql);
                
                $record = "";
                
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $reviewid = htmlspecialchars($row["review_id"]);
                        $review = htmlspecialchars($row["review"]);
                        $customername = htmlspecialchars($row["customer_name"]);
                        $suggestion = htmlspecialchars($row["suggestion"]);
                        ?>
                        
                        <tr>
                        <td> <?php echo $reviewid; ?> </td>
                        <td> <?php echo $review; ?> </td>
                        <td> <?php echo $customername; ?> </td>
                        <td> <?php echo $suggestion; ?> </td>
                        <?php 
                                require("plugins/actions/config.php");
                                    if (
                                        in_array($accesslevel, [1,2,3])
                                    )  { ?>
                            
                        <td>
                        <a class='btn btn-danger' href='plugins/actions/review-operations.php?action=deletereview&rvid=<?php echo urlencode($reviewid); ?>' role='button'>Delete</a> |
                        <a class='btn btn-warning'type='button' data-bs-toggle='modal' data-bs-target='#update-reviews-modal-<?php echo $reviewid; ?>' >Update</a> 
                       </td>
                       <?php 
                                }
                            ?>
                    </tr>
        
              <!-- this is the Update meals modal -->
    <div class="modal fade" id="update-reviews-modal-<?php echo $reviewid; ?>" tabindex="-1" aria-labelledby="update-reviews-modal-title-<?php echo $reviewid; ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="update-reviews-modal-title-<?php echo $reviewid; ?>">Update reviews Details-<?php echo $reviewid; ?></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="plugins/actions/review-operations.php" method = 'POST' id="reviews" class="needs-validation" novalidate>

            <!-- Hidden input to store meal ID -->
            <input type="hidden" name="review_id" id="review-id" value="<?php echo $reviewid; ?>">

            <input type="hidden" name="reviewlist" value="Update">
            <div class="row g-3">
              <div class="col-6">
                <h4 class="text-center text-success"> Review- <?php if (!empty($review)){echo $review; }else {echo 'review';}?></h4>
              </div>
             
              <div class="col-12">
                        <textarea class="form-control" placeholder="<?php if (!empty($suggestion)){echo $suggestion; }else {echo 'suggestions';}  ?>" aria-label="suggestion" name="suggestion"><?php /* if (!empty($suggestion)){echo $suggestion; }else {echo 'suggestions';}  */ ?></textarea>

               </div>
          
            </div> 
            <button type="submit" class="btn btn-outline-danger" name="Update_reviews"  id="reviews">Update</button>
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
                    $record = "<tr><td colspan='4'>No Reviews available</td></tr>";
                }
                
                $conn->close();
                echo $record;
                ?>
                    
                                    </tbody>
                           
                                </table>
                                <?php 
                                        require("plugins/actions/config.php");
                                            if (
                                                in_array($position, ["AC1-SC","AC1-C"])
                                            )  { ?>
                           
                                         <!-- Add Reviews button that toggles to the add Reviews modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-review-modal"  >
              Add Review
            </button>
            <?php 
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





            <!-- this is the Add Reviews modal -->
            <div class="modal fade" id="add-review-modal" tabindex="-1" aria-labelledby="review-modal-title" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="review-modal-title">Add Review</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="plugins/actions/review-operations.php" method = 'POST' id="review" class="needs-validation" novalidate>
                    <input type="hidden" name="reviewlist" value="Add">
                    <div class="row g-3">

                   

                      <div class="col-12">
                        <select name="customerid" id="" class="form-select" aria-label="Customer" required>
                            <option value="" disabled>Customers</option>
                            <?php
                            require("plugins/actions/config.php");
                            $customersql = "SELECT  customer_id, customer_name FROM customers";
                            $customerresult = $conn -> query($customersql);

                            if ($customerresult -> num_rows > 0){
                                while ($row = $customerresult -> fetch_assoc()){
                                    $customerid = $row['customer_id'];
                                    $customername = $row['customer_name'];
                                    echo " <option value='$customerid'> $customername</option>";
                                }
                            }
                            ?>
                        </select>
                      </div>
                    
                    <div class="col-6">
                        <textarea class="form-control" placeholder="review" aria-label="review" name="review" required></textarea>

                    </div>



                      <div class="col-6">
                        <textarea class="form-control" placeholder="suggestion" aria-label="suggestion" name="suggestion">None</textarea>

                      </div>
                      
                     

                    </div> 
                    <button type="submit" class="btn btn-outline-danger" name="Add_review"  id="customer">Add</button>
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