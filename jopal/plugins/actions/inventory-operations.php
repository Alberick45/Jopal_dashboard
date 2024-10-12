
<?php
require("config.php");
session_start();

$staffid = $_SESSION['staff_id'];
function addstockitems() {
    global $conn;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['Itemsname'], $_POST['Itemsprice'], $_POST['Itemsquantity'])) {
            // Escape and assign POST data to variables
            $itemname = $conn->real_escape_string($_POST['Itemsname']);
            $inventoryprice = $conn->real_escape_string($_POST['Itemsprice']);
            $inventoryquantity = $conn->real_escape_string($_POST['Itemsquantity']);


        // check if item already exists
        $checksql = "select * from inventory where item_name = '$itemname'";
        $results = $conn -> query($checksql);
        if ($results -> num_rows > 0){
            echo "<script>
            alert('item already exists');
            window.location.href = '../../inventory.php';
            </script>";
        } else {

            // SQL query for inserting item details including additional fields
            $sql = "call add_inventory('$itemname', '$inventoryprice', $inventoryquantity)";
            $conn->query($sql);

            
            
        } }else {
            $_SESSION['message'] = "Please fill all fields.";
        }
    }
    header('Location: ../../inventory.php');
    $conn->close();
}



      
/* Function calls */
if (isset($_POST['inventorylist'])) {
    if ($_POST['inventorylist'] === "Add") {
        addstockitems();
        exit();
    } 
    else {
        $_SESSION['message'] =  "Invalid function call: " . $_POST['inventorylist'];
        header('Location: ../../inventory.php');
        
    }
} 

else {
   $_SESSION['message'] =  "Form submission error.";
   header('Location: ../../inventory.php');
}




