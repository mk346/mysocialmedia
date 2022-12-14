<?php

// variables declaration
$fname = "";
$lname = "";
$eml = "";
$eml2 = "";
$password = "";
$password2 = "";
$date = "";
$err_array = array();

if (isset($_POST['reg_btn'])) {
    $fname = strip_tags($_POST['reg_fname']); // strip html tags to prevent injection attacks
    $fname = str_replace(' ', '', $fname); // remove spaces
    $fname = ucfirst(strtolower($fname)); // uppercase first letter
    $_SESSION['reg_fname'] = $fname; // store fname in a session variable

    $lname = strip_tags($_POST['reg_lname']);
    $lname = str_replace(' ', '', $lname); // remove spaces
    $lname = ucfirst(strtolower($lname)); // uppercase first letter
    $_SESSION['reg_lname'] = $lname;


    $eml = strip_tags($_POST['reg_email']);
    $eml = str_replace(' ', '', $eml); // remove spaces
    $eml = ucfirst(strtolower($eml)); // uppercase first letter
    $_SESSION['reg_email'] = $eml;

    $eml2 = strip_tags($_POST['reg_email2']);
    $eml2 = str_replace(' ', '', $eml2); // remove spaces
    $eml2 = ucfirst(strtolower($eml2)); // uppercase first letter
    $_SESSION['reg_email2'] = $eml2;

    $password = strip_tags($_POST['reg_password']);
    $password2 = strip_tags($_POST['reg_password2']);
    $date = date("Y-m-d"); //gets the current date

    if ($eml == $eml2) {
        //check email format
        if (filter_var($eml, FILTER_VALIDATE_EMAIL)) {
            $eml = filter_var($eml, FILTER_VALIDATE_EMAIL);

            //check if email already exists
            $e_check = mysqli_query($con, "SELECT email FROM users WHERE email='$eml'");

            // count the number of rows returned
            $num_rows = mysqli_num_rows($e_check);
            if ($num_rows > 0) {
                array_push($err_array, "<span style='color: red;'>Email already exists</span><br>");
            }
        } else {
            array_push($err_array, "<span style='color: red;'>Invalid Email Format</span><br>");
        }
    } else {
        array_push($err_array, "<span style='color: red;'>Emails dont Match</span><br>");
    }

    if (strlen($fname) > 25 || strlen($fname) < 2) {
        array_push($err_array, "<span style='color: red;'>Your first name must between 2 and 25 characters</span><br>");
    }
    if (strlen($lname) > 25 || strlen($lname) < 2) {
        array_push($err_array, "<span style='color: red;'>Your last name must between 2 and 25 characters</span><br>");
    }
    if ($password != $password2) {
        array_push($err_array, "<span style='color: red;'>Your Passwords do not Match</span><br>");
    } else {
        if (preg_match('/[^A-Za-z0-9]/', $password)) {
            array_push($err_array, "<span style='color: red;'>Password Can only contain characters or numbers</span><br>");
        }
    }
    if (strlen($password) > 32 || strlen($password) < 8) {
        array_push($err_array, "<span style='color: red;'>Password must be between 8 and 32 characters</span><br>");
    }

    if (empty($err_array)) {
        $password = md5($password); //encrypt password before sending to the database

        $username = strtolower($fname . "_" . $lname); // generating username by concatenating fname and lname with an underscore
        // check if username exists
        $checkuser_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");
        $i = 0;
        // $result = mysqli_result($checkuser_query);
        //if username exists add number to it
        while (mysqli_num_rows($checkuser_query) != 0) {
            $i++;
            $username = $username . "_" . $i;
            $checkuser_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");
        }
        // profile picture 
        $rand = rand(1, 3); //random number btwn 1 and 16
        if ($rand == 1) {
            $profile_pic = "assets/images/profile_pics/defaults/p1.png";
        } else if ($rand == 2) {
            $profile_pic = "assets/images/profile_pics/defaults/p2.png";
        }
        else if ($rand == 3) {
            $profile_pic = "assets/images/profile_pics/defaults/p3.png";
        }


        $query = mysqli_query($con, "INSERT INTO users VALUES('','$fname','$lname','$username','$eml','$password','$date','$profile_pic','0','0','no',',')");
        array_push($err_array, "<span style='color: #14C800;'>Account Created Successfully</span><br>");

        // clear session variables
        $_SESSION['reg_fname']  = "";
        $_SESSION['reg_lname']  = "";
        $_SESSION['reg_email']  = "";
        $_SESSION['reg_email2']  = "";
    }
}







?>