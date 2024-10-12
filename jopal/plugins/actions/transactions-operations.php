
<?php
require("config.php");
session_start();
/* 
$staffid = $_SESSION['staff_id']; */
function addtransactions() {
    global $conn;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['transaction_item'], $_POST['total_amount'], $_POST['categoryid'])) {
            // Escape and assign POST data to variables
            $transactionitem = $conn->real_escape_string($_POST['transaction_item']);
            $transactionprice = $conn->real_escape_string($_POST['total_amount']);
            $transactioncategory = $conn->real_escape_string($_POST['categoryid']);

            // Additional fields
            $transactionquantity = isset($_POST['transaction_quantity']) ? $conn->real_escape_string($_POST['transaction_quantity']) : 'None';
            $transactions_officer =  $conn -> real_escape_string($_POST['transactions_officer']);


            // SQL query for inserting transaction details including additional fields
            $sql = "call add_transactions('$transactionitem', $transactioncategory, $transactions_officer, '$transactionquantity', '$transactionprice')";
            $conn->query($sql);

            $_SESSION['message'] = "successful";
            
       }else {
            $_SESSION['message'] = "Please fill all fields.";
        }
    }
    header('Location: ../../transactions-history.php');
    $conn->close();
}



            

      

function deletetransaction($tid) {
    global $conn ;
    $sql = "call delete_transactions($tid)";
    $conn -> query($sql);
     header('Location: ../../transactions-history.php');
    
    $conn -> close();
}

function updatetransaction() {
    global $conn /* $staffid */;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $transactionid = $conn->real_escape_string($_POST['transaction_id']);
            
           /*  if (isset($_POST['transaction_item'])  && !empty($_POST['transaction_item'])) {
                $transactionitem = $conn->real_escape_string($_POST['transaction_item']) ;
                $sql = "call update_transactions_text('transaction_name','$transactionitem', $transactionid)";
                $conn ->query($sql);
            } */
            if (isset($_POST['transactionprice'])  && !empty($_POST['transactionprice'])) {
                $transactionprice = $_POST['transactionprice'];
                $sql = "call update_transactions_decimal('total_price','$transactionprice',$transactionid)";
                $conn ->query($sql);
            }
            if (isset($_POST['transactionscategory'])  && !empty($_POST['transactionscategory'])) {
                $transactioncategory = $_POST['transactionscategory'];
                $sql = "call update_transactions_int('category_id', $transactioncategory,$transactionid)";
                $conn ->query($sql);
            }

            if (isset($_POST['transaction_quantity'])  && !empty($_POST['transaction_quantity'])) {
                $transactionquantity = $conn->real_escape_string($_POST['transaction_quantity']);
                $sql = "call update_transactions_int('transaction_quantity',$transactionquantity,$transactionid)";
                $conn ->query($sql);
            }
            
                header('Location: ../../transactions-history.php');
             $conn->close();
        } 
        
}
   


/* Function calls */
if (isset($_POST['transactionlist'])) {
    if ($_POST['transactionlist'] === "Add") {
        addtransactions();
        exit();
    } elseif ($_POST['transactionlist'] === "Update"){
            updatetransaction();
            exit();
        
    }  
    else {
        $_SESSION['message'] =  "Invalid function call: " . $_POST['transactionlist'];
        header('Location: ../../transactions-history.php');
        
    }
} 

else {

    if (isset($_GET["action"])) {
    
        if (isset($_GET['tid']) && $_GET["action"] === "delete_transaction") {
            $transaction = htmlspecialchars($_GET['tid']);
            deletetransaction($transaction);
             exit();
        }
    }else{
   $_SESSION['message'] =  "Form submission error.";
   header('Location: ../../transactions-history.php');
    }
}













