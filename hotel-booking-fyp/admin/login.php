<?php include('../config/constants.php');

?>
<html>
    <head>
        <title>Login - Hotel Booking System</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>


    <body class="logincs">
        <div class="login" class="text-centre">
            <img src="../images/logo.jpg" alt="logo" class="avatar">

            <br><br>
            
            <h1 class="text-centre">Login</h1>
            

            <?php 
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
                if(isset($_SESSION['no-login-message']))
                {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
            ?>
            <br><br>

            <!-- Login form starts here -->
            <form action="" method="POST" class="text-centre">
            <div class="container">
            Username:
            <input type="text" name="username" placeholder="Enter Username"><br><br>
            Password: 
            <input type="password" name="password" placeholder="Enter Password"><br><br>
            
            <input type="submit" name="submit" value="Login" class="btn-primary"><br><br>
            </form>
        </div>

            <!-- Login form ends here -->
            <p class="text-centre">Created By - <a href="www.aayushkhdka93.com">Aayush khadka</a></p>
            
        <a href="<?php echo SITEURL; ?>index.php" class="btn-danger">Home Page</a>
        </div>
    </body>
</html>


<?php

    //check whether the submit button is clicked or not
    if(isset($_POST['submit']))
    {
        //Process for login
        //1. Get the data from Login form
        echo $username = $_POST['username'];
        echo $password = md5($_POST['password']);
        //2. SQL to check whether the user with username and password exists or not
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
        //3. Execute the Query
        $res = mysqli_query($conn, $sql);
        //4. Count rows to check whether the user exists or not
        $count = mysqli_num_rows($res);
        if($count==1)
        {
            //User available and login success
            $_SESSION['login'] = "<div class='success text-centre'>Login Successful.";
            $_SESSION['user'] = $username; //To check whether the user is logged in or not 
            //redirect to home page/Dashboard
            header('location:'.SITEURL.'admin/');
        }
        else
        {
            //user not available and login failed 
            $_SESSION['login'] = "<div class='error text-centre'>Username or Password did not match.";
            //redirect to home page/Dashboard
            header('location:'.SITEURL.'admin/login.php');
        }

        


    }


?>