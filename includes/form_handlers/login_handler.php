<?php

if(isset($_POST['log_btn'])) {
    $email = filter_var($_POST['log_email'], FILTER_SANITIZE_EMAIL); //sanitize email
    $_SESSION['log_email'] = $email; //store email into a session variable

    $password = md5($_POST['log_password']);
    $check_database = mysqli_query($con,"SELECT * FROM users WHERE email = '$email' AND password = '$password'");
    $check_login_query = mysqli_num_rows($check_database);
    
    if($check_login_query == 1) {
        $row = mysqli_fetch_array($check_database); // store database result into an array
        $username = $row['username'];
        $user_closed_query = mysqli_query($con, "SELECT * FROM users WHERE email='$email' AND user_closed='yes'");
        if(mysqli_num_rows($user_closed_query) == 1) {
            $reopen_account = mysqli_query($con, "UPDATE users SET user_closed='no' WHERE email='$email'");
        }
        $_SESSION['username'] = $username;
        header("Location: index.php");
        exit();
    }
    else {
        array_push($err_array, "<span style='color: red;'>Email or Password was Incorrect</span><br>");
    }


}



?>