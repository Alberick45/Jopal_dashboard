<?php

require("config.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_FILES['customer_file'])) {
    $customer_file = $_FILES['customer_file'];

    // Check if the file is uploaded without errors
    if ($customer_file['error'] == 0) {
        $customer_file_path = $customer_file['tmp_name'];

        // Validate file type
        $file_ext = pathinfo($customer_file['name'], PATHINFO_EXTENSION);
        if ($file_ext !== 'csv') {
            die("Invalid file type. Please upload a CSV file.");
        }
        
        // Open the CSV file
        if (($handle = fopen($customer_file_path, "r")) !== FALSE) {
            
            // Get the first row (header) and validate column count and header names
            $headers = fgetcsv($handle, 1000, ",");
            $expected_headers = ['First Name', 'Last Name', 'DOB', 'Phone Number'];

            // Check if the CSV has exactly 5 columns
            if (count($headers) !== 4) {
                die("Invalid CSV format. The file must have exactly 4 columns.");
            }

            // Check if the headers match the expected headers
            if ($headers !== $expected_headers) {
                die("Invalid CSV format. The file headers must be: 'First Name', 'Last Name', 'DOB', 'Phone Number'.");
            }

        
            // Loop through the CSV rows
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $fullname = $conn->real_escape_string($data[0]." ".$data[1]);
                $dateOfBirth = $conn->real_escape_string($data[2]);
                $FullNum = $conn->real_escape_string($data[3]);
                list($countrycode, $contactNumber)= explode(' ',$FullNum);

                // Age calculation
                
                $dateforage = strtotime($dateOfBirth);
                $age = date("Y") - date("Y", $dateforage);
                    
                
                
                // Remove leading zero from phone number
                if (substr($contactNumber, 0, 1) === '0') {
                    $contactNumber = substr($contactNumber, 1);
                }

                // Default country code to +233 if none provided
                $countrycode = empty($countrycode) ? '+233' : $countrycode;

                // Combine country code and phone number
                $PhoneNumber = $countrycode . $contactNumber;


                // Insert the data into the customers table
                $sql = "INSERT INTO customers (customer_name, age, phone_number) VALUES (?, ?, ?)";
                $stmt = $conn->stmt_init();
                if ($stmt->prepare($sql)) {
                    $stmt->bind_param('sss', $fullname, $age,  $PhoneNumber);
                    if ($stmt->execute()) {
                        $_SESSION['message'] = "customer added successfully";
                    } else {
                        echo "Error: " . $stmt->error;
                    }
                    $stmt->close();
                } else {
                    echo "Error preparing statement: " . $conn->error;
                }
            }

            // Close the file and database connection
            fclose($handle);
            $conn->close();

            echo "CSV file data successfully imported!";
            header('Location: ../../customers.php?message=CSV file data successfully imported!');
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


