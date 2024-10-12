
<?php
require("config.php");
session_start();
/* 
$staffid = $_SESSION['staff_id']; */
function addservicees() {
    global $conn;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['servicename'], $_POST['serviceprice'], $_POST['servicecategory'])) {
            // Escape and assign POST data to variables
            $servicename = $conn->real_escape_string($_POST['servicename']);
            $serviceprice = $conn->real_escape_string($_POST['serviceprice']);
            $servicecategory = $conn->real_escape_string($_POST['servicecategory']);

            // Additional fields
            $preparation = isset($_POST['preparation']) ? $conn -> real_escape_string($_POST['preparation']) : 'None';

        // check if service already exists
        $checksql = "select * from services where service_name = '$servicename'";
        $results = $conn -> query($checksql);
        if ($results -> num_rows > 0){
            echo "<script>
            alert('service already exists');
            window.location.href = '../../services.php';
            </script>";
        } else {

            // SQL query for inserting service details including additional fields
            $sql = "call add_services('$servicename', '$serviceprice', $servicecategory, '$preparation')";
            $conn->query($sql);

            $_SESSION['message'] = "successful";
            
        } }else {
            $_SESSION['message'] = "Please fill all fields.";
        }
    }
    header('Location: ../../services.php');
    $conn->close();
}

function add_material_used() {
    global $conn;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $serviceid= $conn->real_escape_string($_POST['service_id']);
        if (isset($_POST['quantityused'], $_POST['stock_items'])) {
            // Escape and assign POST data to variables
            $quantityused = $conn->real_escape_string($_POST['quantityused']);
            $stock_items = $conn->real_escape_string($_POST['stock_items']);


        

            // SQL query for inserting service details including additional fields
            $sql = "call add_material_used($serviceid,$stock_items, $quantityused)";
            $conn->query($sql);

            
            
        } }else {
            $_SESSION['message'] = "Please fill all fields.";
        }
        header('Location: ../../services.php');
        $conn->close();
    }
    


            

      

function deleteservice($mid) {
    global $conn ;
    $sql = "call delete_meal($mid)";
    $conn -> query($sql);
     header('Location: ../../services.php');
    
    $conn -> close();
}

function updateservice() {
    global $conn /* $staffid */;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $serviceid = $conn->real_escape_string($_POST['service_id']);
            
            if (isset($_POST['servicename'])  && !empty($_POST['servicename'])) {
                $servicename = $conn->real_escape_string($_POST['servicename']) ;
                $sql = "call update_services_text('service_name','$servicename', $serviceid)";
                $conn ->query($sql);
            }
            if (isset($_POST['serviceprice'])  && !empty($_POST['serviceprice'])) {
                $serviceprice = $_POST['serviceprice'];
                $sql = "call update_services_decimal('service_price','$serviceprice',$serviceid)";
                $conn ->query($sql);
            }
            if (isset($_POST['servicecategory'])  && !empty($_POST['servicecategory'])) {
                $servicecategory = $_POST['servicecategory'];
                $sql = "call update_services_int ('service_category', $servicecategory, $serviceid)";
                $conn ->query($sql);
            }

                if (isset($_POST['preparation'])  && !empty($_POST['preparation'])) {
                    $preparation = $conn->real_escape_string($_POST['preparation']);
                    $sql = "call update_services_text('steps','$preparation',$serviceid)";
                    $conn ->query($sql);
            }
               
                header('Location: ../../services.php');
             $conn->close();
        } 
        
}
   




function add_service_category() {
    global $conn;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['service_categoryname'])) {
            // Escape and assign POST data to variables
            $category = $conn->real_escape_string($_POST['service_categoryname']);

          
        // check if category already exists
        $checksql = "select * from service_category where category_name = '$category'";
        $results = $conn -> query($checksql);
        if ($results -> num_rows > 0){
            echo "<script>
            alert('category already exists');
            window.location.href = '../../services.php';
            </script>";
        } else {

            // SQL query for inserting category details including additional fields
            $sql = "call add_service_category( '$category')";
            $conn->query($sql);

            $_SESSION['message'] = "successful";
            
        } }else {
            $_SESSION['message'] = "Please fill all fields.";
        }
    }
    header('Location: ../../services.php');
    $conn->close();
}


            

      

function delete_service_category($scid) {
    global $conn ;
    $sql = "call delete_service_category('$scid')";
    $conn -> query($sql);
     header('Location: ../../services.php');
    
    $conn -> close();
}

   



/* Function calls */
if (isset($_POST['servicelist'])) {
    if ($_POST['servicelist'] === "Add") {
        addservicees();
        exit();
    } elseif ($_POST['servicelist'] === "Update"){
            updateservice();
            exit();
        
    } elseif ($_POST['servicelist'] === "add_material_used"){
        add_material_used();
            exit();
        
    } 
    else {
        $_SESSION['message'] =  "Invalid function call: " . $_POST['servicelist'];
        header('Location: ../../../services.php');
        
    }
} 

else {

    if (isset($_GET["action"])) {
    
        if (isset($_GET['mid']) && $_GET["action"] === "delete_service") {
            $service = htmlspecialchars($_GET['mid']);
            deleteservice($service);
             exit();
        }
    }else{
   $_SESSION['message'] =  "Form submission error.";
   header('Location: ../../../services.php');
    }
}




if (isset($_POST['servicecategorylist'])) {
    if ($_POST['servicecategorylist'] === "Add") {
        add_service_category();
        exit();
    }
    else {
        $_SESSION['message'] =  "Invalid function call: " . $_POST['servicecategorylist'];
        header('Location: ../../services.php');
        
    }
} 

else {

    if (isset($_GET["action"])) {
    
        if (isset($_GET['scid']) && $_GET["action"] === "delete_service_category") {
            $category = htmlspecialchars($_GET['scid']);
            delete_service_category($category);
             exit();
        }
    }else{
   $_SESSION['message'] =  "Form submission error.";
   header('Location: ../../services.php');
    }
}



















