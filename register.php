<?php
require 'config/config.php';
require 'includes/form_handlers/register_handler.php';
require 'includes/form_handlers/login_handler.php';


?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=r">
    <link rel="stylesheet" type="text/css" href="assets/css/register.css">
    <title>Register Page</title>
</head>
<body>
<div class="wrapper">
    <form action="register.php" method="POST">
        <input type="email" name="log_email" placeholder="Enter Your Email Address" value="<?php 
        if (isset($_SESSION['log_email'])) {
            echo $_SESSION['log_email'];
        }
        ?>" required>
        <br>
        <input type="password" name="log_password" placeholder="Enter Your Password">
        <br>
        <input type="submit" name="log_btn" value="Login">
        <br>
        <?php if(in_array("Email or Password was Incorrect<br>", $err_array)) echo "Email or Password was Incorrect<br>"; ?>
    </form>
    <form action="register.php" method="POST">
        <input type="text" name="reg_fname" placeholder="First Name" value="<?php 
        if (isset($_SESSION['reg_fname'])) {
            echo $_SESSION['reg_fname'];}?>"
            required>
        <br>
        <?php if(in_array("Your first name must between 2 and 25 characters<br>",$err_array)){echo "Your first name must between 2 and 25 characters<br>";}?>
        <input type="text" name="reg_lname" placeholder="Last Name" value="<?php
        if (isset($_SESSION['reg_lname'])) {
            echo $_SESSION['reg_lname'];
        }
        ?>" required>
        <br>
        <?php if(in_array("Your last name must between 2 and 25 characters<br>",$err_array)){echo "Your last name must between 2 and 25 characters<br>";}?>
        <input type="email" name="reg_email" placeholder="Your Email" value="<?php 
        if (isset($_SESSION['reg_email'])) {
            echo $_SESSION['reg_email'];
        }
        ?>" required>
        <br>
        <?php if(in_array("Email already exists<br>",$err_array)){echo "Email already exists<br>";
        } 
        else if (in_array("Invalid Email Format<br>", $err_array)) {
            echo "Invalid Email Format<br>";
        }
        else if (in_array("Emails dont Match<br>", $err_array)) {
            echo "Emails dont Match<br>";
        }
        ?>
        <input type="email" name="reg_email2" placeholder="Confirm Email" value="<?php 
        if(isset($_SESSION['reg_email2'])){
            echo $_SESSION['reg_email2'];
        }
        ?>" required>
        <br>
        <input type="password" name="reg_password" placeholder="Your Password" required>
        <br>
        <?php if(in_array("Your Passwords do not Match<br>",$err_array)){echo "Your Passwords do not Match<br>";
        } 
        else if (in_array("Password Can only contain characters or numbers<br>", $err_array)) {
            echo "Password Can only contain characters or numbers<br>";
        } 
        else if (in_array("Password must be between 8 and 32 characters<br>", $err_array)) {
            echo "Password must be between 8 and 32 characters<br>";
        }
        ?>
        <input type="password" name="reg_password2" placeholder="Confirm Password" required>
        <br>
        <input type="submit" name="reg_btn" value="Register">
        <br>
        <?php if(in_array("<span style='color: #14C800;'>Account Created Successfully</span><br>",$err_array)){echo "<span style='color: #14C800;'>Account Created Successfully</span><br>";}?>
    </form> 
</div>
</body>

</html>