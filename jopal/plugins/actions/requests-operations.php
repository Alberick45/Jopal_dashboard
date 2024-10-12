
<?php
require("config.php");
session_start();
/* 
$staffid = $_SESSION['staff_id']; */
function addrequests() {
    global $conn;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['requester'], $_POST['request'], $_POST['categoryid'])) {
            // Escape and assign POST data to variables
            $requesterid = $conn->real_escape_string($_POST['requester']);
            $request = $conn->real_escape_string($_POST['request']);
            $requestcategoryid = $conn->real_escape_string($_POST['categoryid']);

          
        // check if request already exists
        $checksql = "select * from requests where request = '$request'";
        $results = $conn -> query($checksql);
        if ($results -> num_rows > 0){
            echo "<script>
            alert('request already exists');
            window.location.href = '../../requests.php';
            </script>";
        } else {

            // SQL query for inserting request details including additional fields
            $sql = "call add_requests('$request', $requesterid, $requestcategoryid)";
            $conn->query($sql);

            $_SESSION['message'] = "successful";
            
        } }else {
            $_SESSION['message'] = "Please fill all fields.";
        }
    }
    header('Location: ../../requests.php');
    $conn->close();
}


            

      

function deleterequest($rid) {
    global $conn ;
    $sql = "call delete_requests($rid)";
    $conn -> query($sql);
     header('Location: ../../requests.php');
    
    $conn -> close();
}

function updaterequest() {
    global $conn /* $staffid */;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $requestid = $conn->real_escape_string($_POST['request_id']);
            $approverid = $conn->real_escape_string($_POST['approver_id']);
            
            /* if (isset($_POST['request'])  && !empty($_POST['request'])) {
                $request = $conn->real_escape_string($_POST['request']) ;
                $sql = "call update_requests_text('request','$request', $requestid)";
                $conn ->query($sql);
            } */
            if (isset($approverid)  && !empty($approverid)) {
                $sql = "call update_requests_int('approver_id',$approverid,$requestid)";
                $conn ->query($sql);
            }
            if (isset($_POST['requestcategory'])  && !empty($_POST['requestcategory'])) {
                $requestcategory = $_POST['requestcategory'];
                $sql = "call update_requests_int('category_id',$requestcategory,$requestid)";
                $conn ->query($sql);
            }
            if (isset($_POST['requeststatus'])  && !empty($_POST['requeststatus'])) {
                $requeststatus = $_POST['requeststatus'];
                $sql = "call update_requests_text ('request_status', '$requeststatus', $requestid)";
                $conn ->query($sql);
            }

                header('Location: ../../requests.php');
             $conn->close();
        } 
        
}
   


/* Function calls */
if (isset($_POST['requestlist'])) {
    if ($_POST['requestlist'] === "Add") {
        addrequests();
        exit();
    } elseif ($_POST['requestlist'] === "Update"){
            updaterequest();
            exit();
        
    } 
    else {
        $_SESSION['message'] =  "Invalid function call: " . $_POST['requestlist'];
        header('Location: ../../requests.php');
        
    }
} 

else {

    if (isset($_GET["action"])) {
    
        if (isset($_GET['rid']) && $_GET["action"] === "delete_request") {
            $request = htmlspecialchars($_GET['rid']);
            deleterequest($request);
             exit();
        }
    }else{
   $_SESSION['message'] =  "Form submission error.";
   header('Location: ../../requests.php');
    }
}








