<!-- For  profile you can edit your profile so you can update progile and you see name age phone location nextofkin username-->
<?php 
session_start();
require("plugins/actions/config.php");
// include("automatic_message_sending.php");

global $conn;
if (!isset($_SESSION['staff_id'])) {
    header("Location: login-signup.html?You are not logged in");
    echo "You are not logged in";
    exit();
}elseif(!isset($_SESSION["access_level"])) {
    header("Location: index.php?You are not authorized");
    echo "You are not authorized";
    exit();
} else {
    $staff_id = $_SESSION['staff_id'];
    $userdata = "SELECT * FROM staff WHERE Staff_id = '$staff_id'";
    $result = $conn -> query($userdata);
    $row = $result -> fetch_assoc();
    $staff_id = $row["staff_id"];
    $position = $row["position_id"];
    $countryCodes = $_SESSION["countrycodes"];
    $accesslevel = $row["access_level"];
    $next_of_kin = $row["next_of_kin"];
    $location = $row["location"];
    $Password = $row["password"];
    $user_name = $row['username'];
    $staff_name=$row["staff_name"];
    $profile_pic =$row["profile_pic"];

    $staff_points=$row["staff_points"];
    list($firstname,$lastname)= explode(" ", $staff_name);
    $age=$row["age"];
    $phone =$row["phone_number"];
    // $profile_pic =$row["ru_pic"];
    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
    
    if (
    !in_array($accesslevel, [1,2,3]) 
) {
    header("Location: login-signup.html?You are not authorized");
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
    <title>Jopal profile | <?php echo $user_name ?></title>
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
                            <a class="profile-pic" href="#">
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
                        <h4 class="page-title">Profile page</h4>
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
                <!-- Row -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-4 col-xlg-3 col-md-12">
                        <div class="white-box">
                            <div class=" user-bg"> <img width="100%" alt="user" src="plugins/images/users/<?php echo $profile_pic?>">
                                <div class="overlay-box">
                                    <div class="user-content">
                                        <a href="javascript:void(0)"><img src="plugins/images/users/<?php echo $profile_pic?>"
                                                class="thumb-lg img-circle" alt="img"></a>
                                        <h4 class="text-white mt-2"><?php echo $user_name ?></h4>
                                        <h5 class="text-white mt-2"><?php echo $phone?></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="user-btm-box mt-5 d-md-flex">
                                

                                <?php 
                            if (
                                in_array($position, ["LEV999"])
                            )  { ?>
                            
                                <div class="col-md-4 col-sm-4 text-center">
                                    <h3>Pay</h3>
                                    <h5><?php echo $salary?></h5>
                                </div>
                                <div class="col-md-4 col-sm-4 text-center">
                                    <h3>Points</h3>
                                    <h5><?php echo $staff_points?></h5>
                                </div>

                            <?php 
                                }else{
                              ?>

                                <div class="col-md-4 col-sm-4 text-center">
                                    <h3>Salary</h3>
                                    <h5><?php echo $salary?></h5>
                                </div>
                                <div class="col-md-4 col-sm-4 text-center">
                                    <h3>Points</h3>
                                    <h5><?php echo $staff_points?></h5>
                                </div>
                                <div class="col-md-4 col-sm-4 text-center">
                                    <h3>Promo</h3>
                                    <h5>-</h5>
                                </div>

                            <?php 
                                }
                              ?>
                

                                


                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-8 col-xlg-9 col-md-12">
                        <div class="card">
                            <div class="card-body">
                            <form class="form-horizontal form-material" action="plugins/actions/staff-operations.php" method="POST"
                            enctype="multipart/form-data">

                            <h4 class="display-4  fs-1">Edit Profile</h4><br>
                            <!-- error -->
                            <?php if(isset($_GET['error'])){ ?>
                            <div class="alert alert-danger" role="alert">
                            <?php echo $_GET['error']; ?>
                            </div>
                            <?php } ?>
                            
                            <!-- success -->
                            <?php if(isset($_GET['success'])){ ?>
                            <div class="alert alert-success" role="alert">
                            <?php echo $_GET['success']; ?>
                            </div>
                            <?php } ?>

                            <input type="hidden" name="staff_id" id="staff-id" value="<?php echo $staff_id; ?>">

                            <input type="hidden" name="stafflist" value="Update">

                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Full Name</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" name="full_name" placeholder="<?php echo $staff_name  ?>"
                                                class="form-control p-0 border-0"> 
                                        </div>
                                    </div>
    
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Phone No</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" name="phone_number" placeholder="<?php echo $phone?>"
                                                class="form-control p-0 border-0">
                                        </div>
                                    </div>
    
                                    <div class="form-group mb-4">
                                        <label class="col-sm-12">Select Country</label>
                                        <div class="col-sm-12 border-bottom">
                                            <select class="form-select shadow-none p-0 border-0 form-control-line" name="country">
                                                <?php foreach ($countryCodes as $code => $name) {
                                                                $selected = ($code == $user_cntcode) ? 'selected' : '';
                                                                echo "<option value=\"$code\" $selected>$name</option>";
                                                            }
                                                ?>
                                                
                                            </select>
                                        </div>
        
                                    </div>

                                    <div class="form-group mb-4">
                                        <div class="input-group ">
                                            <span class="input-group-text">Enter Birthdate</span>
                                            <input type="date" class="form-control" id="date_of_birth" name="dob"  >
                                        </div>
                                        <div class="invalid-feedback">
                                            input your date of birth.
                                        </div>
                                    </div>



                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Location</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" name="location" placeholder="<?php if (!empty($location)){echo $location; }else {echo 'location';}  ?>"
                                                class="form-control p-0 border-0"> 
                                        </div>
                                    </div>

    
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Next of Kin</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" name="next_of_kin" placeholder="<?php if (!empty($next_of_kin)){echo $next_of_kin; }else {echo 'next of kin';}  ?>"
                                                class="form-control p-0 border-0"> 
                                        </div>
                                    </div>

                                    
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">UserName</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" name="username" placeholder="<?php if (!empty($user_name)){echo $user_name; }else {echo 'user name';}  ?>"
                                                class="form-control p-0 border-0"> 
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Profile Picture</label>
                                        <input type="file" 
                                            class="form-control"
                                            name="pp">
                                        <input type="text"
                                            hidden="hidden" 
                                            name="old_pp"
                                            value="<?=$profile_pic?>" >
                                    </div>

                                    <div class="form-group mb-4">
                                        <div class="col-sm-12">
                                            <button class="btn btn-success" type="submit">Update Profile</button>
                                        </div>
                                    </div>
                        
                    </div>
    





    
</form>

                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <!-- Row -->
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
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center"> 2024 © Jopal brought to you by JopalBusinessCenter
                    <p>Theme was reproduced from <a
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