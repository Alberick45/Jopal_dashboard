
<?php
require("config.php");
session_start();
/* 
$staffid = $_SESSION['staff_id']; */
function addreviews() {
    global $conn;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['review'], $_POST['customerid'])) {
            // Escape and assign POST data to variables
            $review = $conn->real_escape_string($_POST['review']);
            $customerid = $conn->real_escape_string($_POST['customerid']);

            // Additional fields
            $suggestion = isset($_POST['suggestion']) ? $conn->real_escape_string($_POST['suggestion']) : 'None';

            
        // check if review already exists
        $checksql = "select * from review where review = '$review'";
        $results = $conn -> query($checksql);
        if ($results -> num_rows > 0){
            echo "<script>
            alert('review already exists');
            window.location.href = '../../review.php';
            </script>";
        } else {

            // SQL query for inserting review details including additional fields
            $sql = "call add_reviews($customerid, '$review', '$suggestion')";
            $conn->query($sql);

            $_SESSION['message'] = "successful";
            
        } }else {
            $_SESSION['message'] = "Please fill all fields.";
        }
    }
    header('Location: ../../review.php');
    $conn->close();
}


    


            

      

function deletereview($rvid) {
    global $conn ;
    $sql = "call delete_meal($rvid)";
    $conn -> query($sql);
     header('Location: ../../review.php');
    
    $conn -> close();
}

function updatereview() {
    global $conn /* $staffid */;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $reviewid = $conn->real_escape_string($_POST['review_id']);
            
         /*    if (isset($_POST['review'])  && !empty($_POST['review'])) {
                $review = $conn->real_escape_string($_POST['review']) ;
                $sql = "call update_reviews_text('review','$review', $reviewid)";
                $conn ->query($sql);
            } */
                if (isset($_POST['suggestion'])  && !empty($_POST['suggestion'])) {
                    $suggestion = $conn->real_escape_string($_POST['suggestion']);
                    $sql = "call update_reviews_text('suggestion','$suggestion',$reviewid)";
                    $conn ->query($sql);
            }
                header('Location: ../../review.php');
             $conn->close();
        } 
        
}
   


/* Function calls */
if (isset($_POST['reviewlist'])) {
    if ($_POST['reviewlist'] === "Add") {
        addreviews();
        exit();
    } elseif ($_POST['reviewlist'] === "Update"){
            updatereview();
            exit();
        
    }
    else {
        $_SESSION['message'] =  "Invalid function call: " . $_POST['reviewlist'];
        header('Location: ../../review.php');
        
    }
} 

else {

    if (isset($_GET["action"])) {
    
        if (isset($_GET['rvid']) && $_GET["action"] === "delete_review") {
            $review = htmlspecialchars($_GET['rvid']);
            deletereview($review);
             exit();
        }
    }else{
   $_SESSION['message'] =  "Form submission error.";
   header('Location: ../../review.php');
    }
}










