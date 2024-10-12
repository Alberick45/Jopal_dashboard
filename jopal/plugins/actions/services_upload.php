<?php

require("config.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_FILES['service_file'])) {
    $service_file = $_FILES['service_file'];

    // Check if the file is uploaded without errors
    if ($service_file['error'] == 0) {
        $service_file_path = $service_file['tmp_name'];

        // Validate file type
        $file_ext = pathinfo($service_file['name'], PATHINFO_EXTENSION);
        if ($file_ext !== 'csv') {
            die("Invalid file type. Please upload a CSV file.");
        }
        
        // Open the CSV file
        if (($handle = fopen($service_file_path, "r")) !== FALSE) {
            
            // Get the First row (header) and validate column count and header names
            $headers = fgetcsv($handle, 1000, ",");
            $expected_headers = ['Service Name', 'Service Price',  'Service Category'];

            // Check if the CSV has exactly 5 columns
            if (count($headers) !== 3) {
                die("Invalid CSV format. The file must have exactly 3 columns.");
            }

            // Check if the headers match the expected headers
            if ($headers !== $expected_headers) {
                die("Invalid CSV format. The file headers must be: 'Service Name', 'Service Price', 'Service Category'.");
            }

        
            // Loop through the CSV rows
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $servicename = $conn->real_escape_string($data[0]);
                $serviceprice = $conn->real_escape_string($data[1]);
                $servicecategoryuser = $conn->real_escape_string($data[2]);

                $servicecatsql = "SELECT  category_id FROM service_category WHERE category_name = '$servicecategoryuser'";
                            $servicecatresult = $conn -> query($servicecatsql);

                            if ($servicecatresult -> num_rows > 0){
                                while ($row = $servicecatresult -> fetch_assoc()){
                                    $servicecategory = $row['category_id'];
                                }
                            }else{
                                echo " No Existing Categories available";
                           
                            }
                
        
              

                // Insert the data into the services table
                 
                $sql = "CALL add_services('$servicename','$serviceprice',$servicecategory, Null )";
                $conn -> query($sql);
            }

            // Close the file and database connection
            fclose($handle);
            $conn->close();

            echo "CSV file data successfully imported!";
            header('Location: ../../services.php?message=CSV file data successfully imported!');
        } else {
            echo "Error opening the file.";
        }
    } else {
        echo "Error uploading the file.";
    }
} else {
    echo "No file was uploaded.";
    exit();
}

