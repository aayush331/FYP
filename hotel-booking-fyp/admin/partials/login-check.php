
<?php

//Authorization - Access Control
//Check whether the user is logged in or not 
if(!isset($_SESSION['user'])) //if user session is not set 
{
    //User not logged in 
    //redirect to login page with message 
    $_SESSION['no-login-message'] = "<div class='text-centre'> login to access Admin Panel.</div>";
    //Redirect to Login page
    header('location:'.SITEURL.'admin/login.php');
}

?>