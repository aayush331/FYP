<?php include('partials/menu.php')?>


    <!-- Main Content Section Starts -->
    <div class="main-content">
    <div class="wrapper">
        <H1>Manage Admin</H1>
        <br><br><br>

        <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];//Displaying session message
                unset ($_SESSION['add']);//Removing session message
            }
            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];//Displaying session message
                unset ($_SESSION['delete']);//Removing session message
            }
            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];//Displaying session message
                unset ($_SESSION['update']);//Removing session message
            }
            if(isset($_SESSION['user-not-found']))
            {
                echo $_SESSION['user-not-found'];//Displaying session message
                unset ($_SESSION['user-not-found']);//Removing session message
            }
            if(isset($_SESSION['psw-not-match']))
            {
                echo $_SESSION['psw-not-match'];//Displaying session message
                unset ($_SESSION['psw-not-match']);//Removing session message
            }
            if(isset($_SESSION['change-pwd']))
            {
                echo $_SESSION['change-pwd'];//Displaying session message
                unset ($_SESSION['change-pwd']);//Removing session message
            }
        ?>
        <br><br><br>
        <!--Button to add admin-->
        <a href="add-admin.php" class="btn-primary">Add Admin</a>
        <br><br><br>


        <table  class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Full Name:</th>
                <th>User Name:</th>
                <th>Actions:</th>
            </tr>

            <?php
            //Query to get all admin
                $sql = "SELECT * FROM tbl_admin";
                //execute the query
                $res = mysqli_query($conn, $sql);

                //check weather the query is executed or not
                if($res==TRUE)
                {
                    // Count rows to check whether we have data in database or not
                    $count = mysqli_num_rows($res); //function to get all the rows from database
                        
                    $sn=1; //Create a variable and assign the value 

                    //check the num of rows
                    if($count>0)
                    {
                        //we have data 
                        while($rows=mysqli_fetch_assoc($res))
                        {
                            //using while loop to get all the data from database.
                            //and while loop will run as long as we have data in database

                            //Get individual data
                            $id=$rows['id'];
                            $full_name=$rows['full_name'];
                            $username=$rows['username'];?>

                            <tr>
                                <td><?php echo $sn++; ?>.</td>
                                <td><?php echo $full_name; ?></td>
                                <td><?php echo $username; ?></td>
                                <td>
                                <a href="<?php echo SITEURL;?>admin/update-password.php?id=<?php echo $id?>" class="btn-primary">Change Password</a>
                                <a href="<?php echo SITEURL;?>admin/update-admin.php?id=<?php echo $id?>" class="btn-secondary">Update Admin</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id?>" class="btn-danger">Delete Admin</a>
                                </td>
                            </tr>






                            <?php
                            
                        }
                    }
                    else
                    {
                        //its empty.
                    }
                }


            
            
            ?>

        </table>

       

    </div>
    <!-- Main Content Section Ends -->

<?php include('partials/footer.php')?>