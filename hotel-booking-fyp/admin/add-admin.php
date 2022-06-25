<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br><br>
        <?php
              if(isset($_SESSION['add']))//Checking weather the session is set or not
              {
                  echo $_SESSION['add'];//Displaying session message if set
                  unset ($_SESSION['add']);//Removing session message
              }
              
              if(isset($_SESSION['delete']))//Checking weather the session is set or not
              {
                  echo $_SESSION['delete'];//Displaying session message if set
                  unset ($_SESSION['delete']);//Removing session message
              }
        ?> 
        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td><input type="text" name="full_name" placeholder="Enter your Name"></td>
                    
                </tr>
                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="username" placeholder="Enter your Username"></td>
                    
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="password" placeholder="Enter your password"></td>
                    
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>









<?php include('partials/footer.php'); ?>

<?php 

//process the value from form and save it in database
    //check weather the submit button is clicked or not
    if(isset($_POST['submit']))
    {
        //button clicked
        //echo"Button Clicked";
        
        //get data from form
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        //SQl query to save the data into database
        $sql = "INSERT INTO tbl_admin SET 
            full_name='".$full_name."',
            username='".$username."',
            password='".$password."'";

        
        // executing query and saving data into database 
        $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));


        // check weather the data is inserted or not and a message is displayed
        if($res==TRUE){

            //echo "Data Inserted";
            //Create a session variable to dispaly message
            $_SESSION['add'] = "Admin Added Successfully";
            //Redirect Page to manage admin
            header("location:".SITEURL.'admin/manage-admin.php');

        }

        else
        {
            //echo "Failed to insert data";
            $_SESSION['add'] = "Failed to add Admin";
            //Redirect Page to add admin
            header("location:".SITEURL.'admin/add-admin.php');
        }
    }

?>





