
<?php
require("config.php");
session_start();
/* 
$staffid = $_SESSION['staff_id']; */
function adddepartments() {
    global $conn;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['departmentid'], $_POST['departmentname'])) {
            // Escape and assign POST data to variables
            $departmentid = $_POST['departmentid'];
            $department = $conn->real_escape_string($_POST['departmentname']);

          
        // check if department already exists
        $checksql = "select * from department where department_name = '$department'";
        $results = $conn -> query($checksql);
        if ($results -> num_rows > 0){
            echo "<script>
            alert('department already exists');
            window.location.href = '../../departments.php';
            </script>";
        } else {

            // SQL query for inserting department details including additional fields
            $sql = "call add_departments('$departmentid', '$department')";
            $conn->query($sql);

            $_SESSION['message'] = "successful";
            
        } }else {
            $_SESSION['message'] = "Please fill all fields.";
        }
    }
    header('Location: ../../departments.php');
    $conn->close();
}


            

      

function deletedepartment($did) {
    global $conn ;
    $sql = "call delete_departments('$did')";
    $conn -> query($sql);
     header('Location: ../../departments.php');
    
    $conn -> close();
}

   


/* Function calls */
if (isset($_POST['departmentlist'])) {
    if ($_POST['departmentlist'] === "Add") {
        adddepartments();
        exit();
    }
    else {
        $_SESSION['message'] =  "Invalid function call: " . $_POST['departmentlist'];
        header('Location: ../../departments.php');
        
    }
} 

else {

    if (isset($_GET["action"])) {
    
        if (isset($_GET['did']) && $_GET["action"] === "delete_department") {
            $department = htmlspecialchars($_GET['did']);
            deletedepartment($department);
             exit();
        }
    }else{
   $_SESSION['message'] =  "Form submission error.";
   header('Location: ../../departments.php');
    }
}








