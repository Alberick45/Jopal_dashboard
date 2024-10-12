<?php


require("config.php");
session_start();

function reports() {
    global $conn;
        $staff_id = $_SESSION['staff_id'];
        $userdata = "SELECT * FROM staff WHERE staff_id = '$staff_id'";
        $result = $conn -> query($userdata);
        $row = $result -> fetch_assoc();
        $position = $row["position_id"];
        if($position == "AC1-SC"){


            // General report
            
            // Initialize variables
        $daily_report = '';
        $daily_sales_report = '';
        // Define the input date for the report (you can get this from a form or set it manually)
        $in_date = date("Y-m-d"  );// Example date

        // Prepare and execute the call to the stored procedure
        $daily_report_query = $conn->prepare("CALL generate_daily_report(?, @out_report)");
        $daily_report_query->bind_param('s', $in_date); // 's' denotes string type (for DATE format)
        $daily_report_query->execute();
        $daily_report_query->close();

        // Retrieve the output parameter
        $out_report_result = $conn->query("SELECT @out_report AS report");

        if ($out_report_result) {
            if ($out_report_row = $out_report_result->fetch_assoc()) {
                $daily_report = $out_report_row['report'];
                echo "Daily Report: " . $daily_report; // Output the report
            }
            $out_report_result->close();
        }

        // Clear the stored procedure result set
        $conn->next_result();




        // Sales report

        // Prepare and execute the call to the stored procedure for the sales report
        $sales_report_query = $conn->prepare("CALL generate_daily_sales_report(?, @out_sales_report)");
        $sales_report_query->bind_param('s', $in_date); // Same input date used
        $sales_report_query->execute();
        $sales_report_query->close();

        // Retrieve the output parameter for the sales report
        $out_sales_result = $conn->query("SELECT @out_sales_report AS total_sales");

        if ($out_sales_result) {
            if ($out_sales_row = $out_sales_result->fetch_assoc()) {
                $daily_sales_report = $out_sales_row['total_sales'];
               }
            $out_sales_result->close();
        }

        // Clear the stored procedure result set
        $conn->next_result();

        }


        $total_report_result = "General report is ".$daily_report."and total sales for today is ".$daily_sales_report;
        
        return $total_report_result;
}
function get_owner_phone(){
    global $conn;
    $ownerdata = "SELECT phone_number FROM staff WHERE position_id = 'LEV999'";
    $result = $conn -> query($ownerdata);
    $row = $result -> fetch_assoc();
    $owner_phone_result = $row["phone_number"];  

    return $owner_phone_result; 
}
function message_reporting($owner,$report){
     // using Mnotify credentials
        // API Key and Endpoint
        $apiKey = '1Tr9eN1Sxjo2BZvwbKByue5QL'; // Replace with your actual API key
        $apiUrl = 'https://apps.mnotify.net/smsapi'; // Endpoint URL
        
        // Message details
        $recipient = $owner; // Replace with the recipient's phone number
        $message = $report;
        $senderId = 'Bdaywishers'; // Optional: Replace with your sender ID if required
        
        // Prepare the URL with query parameters
        $url = $apiUrl . '?key=' . $apiKey . '&to=' . urlencode($recipient) . '&msg=' . urlencode($message) . '&sender_id=' . urlencode($senderId);
 
        // Initialize cURL
        $ch = curl_init();
        // Set cURL options
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // added what is below to bypass ssl verification error code - cURL error: SSL certificate problem: unable to get local issuer certificate
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        // end of addition

        
        // Execute the request and get the response
        $response = curl_exec($ch);
        
        // Check for cURL errors
        if (curl_errno($ch)) {
            echo '<p>cURL error: ' . curl_error($ch).'</p>';
            header('refresh:10 logout.php'); 
        } 
        else {
            echo '<p>Response: ' . $response.'</p>';
           
        }
}


$total_report = reports();
echo $total_report;
$owner_phone = get_owner_phone();
// message_reporting($owner_phone,$total_report);

session_unset();
session_destroy();?>
<!DOCTYPE html>
<html>
<head>
     <!-- add something only store clerks see when they click logout modal so onclicking 
logout and staff is sc it should run a code later well think of a name but it calculates 
all orders and their price along with quantity and gives a generative report with service 
name service total cost customer ad stocks used so then after send sales report to ower number 
so retrieve owner number etc  so first they say connect to internet to continue also for the 
others the customer can sign in as a guest  where first name is guest -no and guest no eetc 
but depart is AC1-C so at the end summaraise daily sales is and expense is   -->
    <title>Logout</title>
    <script type="text/javascript">
        alert("Logged out successfully");
        window.location.href = "../../login-signup.html";
    </script>
</head>
<body>
</body>
</html>