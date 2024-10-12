<?php
require("config.php");

$countryCodes = [
    "+233" => "Ghana (+233)",
    "93" => "Afghanistan (+93)",
    "355" => "Albania (+355)",
    "213" => "Algeria (+213)",
    "1684" => "American Samoa (+1684)",
    "376" => "Andorra (+376)",
    "244" => "Angola (+244)",
    "1264" => "Anguilla (+1264)",
    "672" => "Antarctica (+672)",
    "1268" => "Antigua and Barbuda (+1268)",
    "54" => "Argentina (+54)",
    "374" => "Armenia (+374)",
    "297" => "Aruba (+297)",
    "61" => "Australia (+61)",
    "43" => "Austria (+43)",
    "994" => "Azerbaijan (+994)",
    "1242" => "Bahamas (+1242)",
    "973" => "Bahrain (+973)",
    "880" => "Bangladesh (+880)",
    "1246" => "Barbados (+1246)",
    "375" => "Belarus (+375)",
    "32" => "Belgium (+32)",
    "501" => "Belize (+501)",
    "229" => "Benin (+229)",
    "1441" => "Bermuda (+1441)",
    "975" => "Bhutan (+975)",
    "591" => "Bolivia (+591)",
    "387" => "Bosnia and Herzegovina (+387)",
    "267" => "Botswana (+267)",
    "55" => "Brazil (+55)",
    "246" => "British Indian Ocean Territory (+246)",
    "1284" => "British Virgin Islands (+1284)",
    "673" => "Brunei (+673)",
    "359" => "Bulgaria (+359)",
    "226" => "Burkina Faso (+226)",
    "257" => "Burundi (+257)",
    "855" => "Cambodia (+855)",
    "237" => "Cameroon (+237)",
    "1" => "Canada (+1)",
    "238" => "Cape Verde (+238)",
    "1345" => "Cayman Islands (+1345)",
    "236" => "Central African Republic (+236)",
    "235" => "Chad (+235)",
    "56" => "Chile (+56)",
    "86" => "China (+86)",
    "+61" => "Christmas Island (+61)",
    /* "+61" => "Cocos Islands (+61)", */
    "57" => "Colombia (+57)",
    "269" => "Comoros (+269)",
    "682" => "Cook Islands (+682)",
    "506" => "Costa Rica (+506)",
    "385" => "Croatia (+385)",
    "53" => "Cuba (+53)",
    "599" => "Curacao (+599)",
    "357" => "Cyprus (+357)",
    "420" => "Czech Republic (+420)",
    "45" => "Denmark (+45)",
    "253" => "Djibouti (+253)",
    "1767" => "Dominica (+1767)",
    "1849" => "Dominican Republic (+1849)",
    "593" => "Ecuador (+593)",
    "20" => "Egypt (+20)",
    "503" => "El Salvador (+503)",
    "240" => "Equatorial Guinea (+240)",
    "291" => "Eritrea (+291)",
    "372" => "Estonia (+372)",
    "251" => "Ethiopia (+251)",
    "500" => "Falkland Islands (+500)",
    "298" => "Faroe Islands (+298)",
    "679" => "Fiji (+679)",
    "358" => "Finland (+358)",
    "33" => "France (+33)",
    "594" => "French Guiana (+594)",
    "689" => "French Polynesia (+689)",
    "241" => "Gabon (+241)",
    "220" => "Gambia (+220)",
    "995" => "Georgia (+995)",
    "49" => "Germany (+49)",
    "350" => "Gibraltar (+350)",
    "30" => "Greece (+30)",
    "299" => "Greenland (+299)",
    "1473" => "Grenada (+1473)",
    "590" => "Guadeloupe (+590)",
    "1671" => "Guam (+1671)",
    "502" => "Guatemala (+502)",
    "224" => "Guinea (+224)",
    "245" => "Guinea-Bissau (+245)",
    "592" => "Guyana (+592)",
    "509" => "Haiti (+509)",
    "504" => "Honduras (+504)",
    "852" => "Hong Kong (+852)",
    "36" => "Hungary (+36)",
    "354" => "Iceland (+354)",
    "91" => "India (+91)",
    "62" => "Indonesia (+62)",
    "98" => "Iran (+98)",
    "964" => "Iraq (+964)",
    "353" => "Ireland (+353)",
    "972" => "Israel (+972)",
    "39" => "Italy (+39)",
    "225" => "Ivory Coast (+225)",
    "1876" => "Jamaica (+1876)",
    "81" => "Japan (+81)",
    "962" => "Jordan (+962)",
    "7" => "Kazakhstan (+7)",
    "254" => "Kenya (+254)",
    "686" => "Kiribati (+686)",
    "383" => "Kosovo (+383)",
    "965" => "Kuwait (+965)",
    "996" => "Kyrgyzstan (+996)",
    "856" => "Laos (+856)",
    "371" => "Latvia (+371)",
    "961" => "Lebanon (+961)",
    "266" => "Lesotho (+266)",
    "231" => "Liberia (+231)",
    "218" => "Libya (+218)",
    "423" => "Liechtenstein (+423)",
    "370" => "Lithuania (+370)",
    "352" => "Luxembourg (+352)",
    "853" => "Macau (+853)",
    "389" => "Macedonia (+389)",
    "261" => "Madagascar (+261)",
    "265" => "Malawi (+265)",
    "60" => "Malaysia (+60)",
    "960" => "Maldives (+960)",
    "223" => "Mali (+223)",
    "356" => "Malta (+356)",
    "692" => "Marshall Islands (+692)",
    "596" => "Martinique (+596)",
    "222" => "Mauritania (+222)",
    "230" => "Mauritius (+230)",
    "262" => "Mayotte (+262)",
    "52" => "Mexico (+52)",
    "691" => "Micronesia (+691)",
    "373" => "Moldova (+373)",
    "377" => "Monaco (+377)",
    "976" => "Mongolia (+976)",
    "382" => "Montenegro (+382)",
    "1664" => "Montserrat (+1664)",
    "212" => "Morocco (+212)",
    "258" => "Mozambique (+258)",
    "95" => "Myanmar (+95)",
    "264" => "Namibia (+264)",
    "674" => "Nauru (+674)",
    "977" => "Nepal (+977)",
    "31" => "Netherlands (+31)",
    "687" => "New Caledonia (+687)",
    "64" => "New Zealand (+64)",
    "505" => "Nicaragua (+505)",
    "227" => "Niger (+227)",
    "234" => "Nigeria (+234)",
    "683" => "Niue (+683)",
    "850" => "North Korea (+850)",
    "1670" => "Northern Mariana Islands (+1670)",
    "47" => "Norway (+47)",
    "968" => "Oman (+968)",
    "92" => "Pakistan (+92)",
    "680" => "Palau (+680)",
    "970" => "Palestine (+970)",
    "507" => "Panama (+507)",
    "675" => "Papua New Guinea (+675)",
    "595" => "Paraguay (+595)",
    "51" => "Peru (+51)",
    "63" => "Philippines (+63)",
    "48" => "Poland (+48)",
    "351" => "Portugal (+351)",
    "1787" => "Puerto Rico (+1787)",
    "974" => "Qatar (+974)",
    "242" => "Republic of the Congo (+242)",
    "+262" => "Reunion (+262)",
    "40" => "Romania (+40)",
    "+7" => "Russia (+7)",
    "250" => "Rwanda (+250)",
    "290" => "Saint Helena (+290)",
    "1869" => "Saint Kitts and Nevis (+1869)",
    "1758" => "Saint Lucia (+1758)",
    "508" => "Saint Pierre and Miquelon (+508)",
    "1784" => "Saint Vincent and the Grenadines (+1784)",
    "685" => "Samoa (+685)",
    "378" => "San Marino (+378)",
    "239" => "Sao Tome and Principe (+239)",
    "966" => "Saudi Arabia (+966)",
    "221" => "Senegal (+221)",
    "381" => "Serbia (+381)",
    "248" => "Seychelles (+248)",
    "232" => "Sierra Leone (+232)",
    "65" => "Singapore (+65)",
    "1721" => "Sint Maarten (+1721)",
    "421" => "Slovakia (+421)",
    "386" => "Slovenia (+386)",
    "677" => "Solomon Islands (+677)",
    "252" => "Somalia (+252)",
    "27" => "South Africa (+27)",
    "82" => "South Korea (+82)",
    "211" => "South Sudan (+211)",
    "34" => "Spain (+34)",
    "94" => "Sri Lanka (+94)",
    "249" => "Sudan (+249)",
    "597" => "Suriname (+597)",
    "268" => "Swaziland (+268)",
    "46" => "Sweden (+46)",
    "41" => "Switzerland (+41)",
    "963" => "Syria (+963)",
    "886" => "Taiwan (+886)",
    "992" => "Tajikistan (+992)",
    "255" => "Tanzania (+255)",
    "66" => "Thailand (+66)",
    "228" => "Togo (+228)",
    "690" => "Tokelau (+690)",
    "676" => "Tonga (+676)",
    "1868" => "Trinidad and Tobago (+1868)",
    "216" => "Tunisia (+216)",
    "90" => "Turkey (+90)",
    "993" => "Turkmenistan (+993)",
    "1649" => "Turks and Caicos Islands (+1649)",
    "688" => "Tuvalu (+688)",
    "256" => "Uganda (+256)",
    "380" => "Ukraine (+380)",
    "971" => "United Arab Emirates (+971)",
    "44" => "United Kingdom (+44)",
    "+1" => "United States (+1)",
    "598" => "Uruguay (+598)",
    "998" => "Uzbekistan (+998)",
    "678" => "Vanuatu (+678)",
    "379" => "Vatican (+379)",
    "58" => "Venezuela (+58)",
    "84" => "Vietnam (+84)",
    "+1284" => "British Virgin Islands (+1284)",
    "1340" => "U.S. Virgin Islands (+1340)",
    "681" => "Wallis and Futuna (+681)",
    "+212" => "Western Sahara (+212)",
    "967" => "Yemen (+967)",
    "260" => "Zambia (+260)",
    "263" => "Zimbabwe (+263)"
];   

function add_staff(){
    session_start();
    global $conn,$countryCodes;;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["fullname"], $_POST["dob"], $_POST["gender"], $_POST["phone"], $_POST["username"], $_POST["password"], $_POST["access"])) {
            
            // Sanitizing input data
            $FullName = $conn->real_escape_string($_POST["fullname"]);
            $username = $conn->real_escape_string($_POST["username"]);
            $dob = $conn->real_escape_string($_POST["dob"]);
            $gender = $conn->real_escape_string($_POST["gender"]);
            $phone = $conn->real_escape_string($_POST["phone"]);
            $password = $conn->real_escape_string($_POST["password"]);
            $access_codes = $conn->real_escape_string($_POST["access"]);
            
            // Convert date of birth to age
            $dob = strtotime($dob);
            $age = date("Y") - date("Y", $dob);
            
            // Adjust age if the birthday hasn't occurred this year
            if (date("md") < date("md", $dob)) {
                $age--;
            }

            // Check if the password length is at least 8 characters
            if (strlen($password) < 8) {
                echo "<script>
                        alert('Password must be at least 8 characters long');
                        window.location.href = '../../../signup-page.php';
                    </script>";
                exit();
            }

            // Check if the user already exists
            $checkUserQuery = "SELECT staff_id FROM staff WHERE username = ?";
            $stmt = $conn->prepare($checkUserQuery);
            $stmt->bind_param('s', $username);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                // User already exists 
                echo "<script>
                        alert('Username already taken');
                        window.location.href = '../../../login-signup.html';
                    </script>";
            } else {
                // User does not exist, proceed with registration
                $HashedPassword = password_hash($password, PASSWORD_BCRYPT);
                /* $access_level = 1;
 */
                // Determine access level based on access codes
                if ($access_codes == "LEV999" || $access_codes[2] == "3") {
                    $access_level = 3;
                } elseif ($access_codes[2] == "2") {
                    $access_level = 2;
                } elseif ($access_codes[2] == "1") {
                    $access_level = 1;
                }
                // Insert user into staff table
                $sqlinsert = "call add_staff('$FullName', '$access_codes', $age, '$phone', '$gender', '$username', $access_level, '$HashedPassword')";

                if ($conn -> query($sqlinsert)) {
                    // Retrieve the staff ID and set session variables
                    $passretrieval = "SELECT staff_id FROM staff WHERE username = ?";
                    $stmt = $conn->prepare($passretrieval);
                    $stmt->bind_param('s', $username);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result && $result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $staff_id = $row["staff_id"];
                        $_SESSION["staff_id"] = $staff_id;
                        $_SESSION["username"] = $username;
                        $_SESSION['countrycodes'] = $countryCodes;
                        $_SESSION["access_level"] = $access_level;
                        $_SESSION['message'] = "You are logged in successfully " . $username ;
                        header("Location: ../../../profile.php");
                        exit();
                    } else {
                        echo "Problem with code: " . $conn->error;
                    }
                } else {
                    echo "Error inserting data: " . $conn->error;
                }
            } 
            
        }
        else{
            echo "is not set";
        }
    }
    else{
        echo "server requestmethod";
    }

}



function updatestaff() {
    global $conn;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $staffid = $conn->real_escape_string($_POST['staff_id']);
        $old_pp = $_POST['old_pp'];


        if ((isset($_POST['full_name']) && !empty($_POST['full_name'])) ){
            $updated_staff_name = $conn->real_escape_string($_POST['full_name']);
            
            $sql = "call update_staff_text('staff_name','$updated_staff_name',$staffid)";
            if($conn -> query($sql)){
                echo "updated staff name successfully";
            };
        }
        
        if (isset($_POST['phone_number']) && !empty($_POST['phone_number']) && isset($_POST['country']) && !empty($_POST['country'])) {
            
            $updated_cnt_code = $conn->real_escape_string($_POST['country']);
            $updated_number = $conn->real_escape_string($_POST['phone_number']);
            $updated_phone_number = $conn->real_escape_string($updated_cnt_code. " ". $updated_number);
            
            $sql = "call update_staff_text('phone_number','$updated_phone_number',$staffid)";
            if($conn -> query($sql)){
                echo "updated phone number successfully";
            };
        }
        
        
        if (isset($_POST['dob']) && !empty($_POST['dob']) ) {
            $updated_dob = $conn->real_escape_string($_POST['dob']);
            $updated_dob = strtotime($updated_dob);
            $updated_age = date("Y") - date("Y", $updated_dob); 
            
            
            $sql = "call update_staff_int('age',$updated_age,$staffid)";
            if($conn -> query($sql)){
                echo "updated successfully";
            };
        }
        

        if (isset($_POST['location'])  && !empty($_POST['location'])) {
            $updated_location = $conn->real_escape_string($_POST['location']);
            
            $sql = "call update_staff_text('location','$updated_location',$staffid)";
            if($conn -> query($sql)){
                echo "updated successfully";
            };}
        }
        

        if (isset($_POST['next_of_kin'])  && !empty($_POST['next_of_kin'])) {
            $updated_next_of_kin = $conn->real_escape_string($_POST['next_of_kin']);
            
            $sql = "call update_staff_text('next_of_kin','$updated_next_of_kin',$staffid)";
            if($conn -> query($sql)){
                echo "updated next of kin successfully";
            };
        }
        

        if (isset($_POST['username'])  && !empty($_POST['username'])) {
            $username = $conn->real_escape_string($_POST['username']);
            
            $sql = "call update_staff_text('username','$username',$staffid)";
            if($conn -> query($sql)){
                echo "updated username successfully";
            };
        }





        if (isset($_FILES['pp']['name']) AND !empty($_FILES['pp']['name'])) {
         
        
            $img_name = $_FILES['pp']['name'];
            $tmp_name = $_FILES['pp']['tmp_name'];
            $error = $_FILES['pp']['error'];
            
            if($error === 0){
               $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
               $img_ex_to_lc = strtolower($img_ex);
   
               $allowed_exs = array('jpg', 'jpeg', 'png');
               if(in_array($img_ex_to_lc, $allowed_exs)){
                  $new_img_name = uniqid($staffid, true).'.'.$img_ex_to_lc;
                  $img_upload_path = '../../plugins/images/users/'.$new_img_name;
                  // Delete old profile pic
                  $old_pp_des = "../../plugins/images/users/$old_pp";
                  if(unlink($old_pp_des)){
                        // just deleted
                        move_uploaded_file($tmp_name, $img_upload_path);
                  }else {
                     // error or already deleted
                        move_uploaded_file($tmp_name, $img_upload_path);
                  }
                  
   
                  // update the Database
                  $sql = "UPDATE staff 
                          SET profile_pic=?
                          WHERE staff_id=?";
                  $stmt = $conn->prepare($sql);
                  $stmt->execute([$new_img_name, $staffid]);
                  
                  header("Location: ../../../profile.php?success=Your account has been updated successfully");
                   exit;
               }else {
                  $em = "You can't upload files of this type";
                  header("Location: ../../../profile.php?error=$em");
                  exit;
               }
            }else {
               $em = "unknown error occurred!";
               header("Location: ../../../profile.php?error=$em");
               exit;
             }
   
           
         } 


      
        

        
        header('Location: ../../profile.php');
    $conn->close();
    
}
  


function deletestaff($sid) {
    global $conn ;
    $sql = "call delete_staff($sid)";
    $conn -> query($sql);
     header('Location: ../../profile.php');
    
    $conn -> close();
}






if (isset($_GET["action"])) {
    
    if (isset($_GET['sid']) && $_GET["action"] === "deletestaff") {
        $staff = htmlspecialchars($_GET['sid']);
        deletestaff($staff);
         exit();
    }
}elseif (isset($_POST['stafflist'])) {
    if ($_POST['stafflist'] === "Update"){
        updatestaff();
        header("location : ../../../profile.php");
        exit();
    }
} 
else{
    add_staff();
}
?>
