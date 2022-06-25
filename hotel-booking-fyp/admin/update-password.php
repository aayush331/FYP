<?php
include('partials/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>
<?php

    if (isset($_GET['id'])) {
        //1 Get the id of selected admin
        $id=$_GET['id'];
    }



?>

        <form action="#" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>
                        Current Password:                 
                    </td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current Password">
                    </td>
                </tr>

                <tr>
                    <td>New Password:</td>
                    <td>
                        <input type="password" name="new_password" placeholder="New Password">
                    </td>
                </tr>
                <tr>
                    <td>Confirm Password: </td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="confirm_password">
                    </td>
                </tr>
            <tr>
                <td colspan="2">
                <input type="hidden" name="id" value="<?php echo $id;?>">
                <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                </td>
            </tr>
            
            </table>

        </form>

    </div>
</div>

    <?php
        //Check whether the submit button is clicked or not
        if (isset($_POST['submit'])) {
            //echo "clicked";

            //1. Get the data from form
            $id=$_POST['id'];
            $current_password = md5($_POST['current_password']);
            $new_password = md5($_POST['new_password']);
            $confirm_password = md5($_POST['confirm_password']);


            //2. check whether the user with current ID and Current Password Exists or not.
            $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

            //execution
            $res = mysqli_query($conn, $sql);
            $count=mysqli_num_rows($res);

         

            if ($res==true)
            {
               

                if ($count==1)
                 {
                    //user exists
                    //echo "User Found";
                    if ($new_password==$confirm_password) 
                    {
                        //update password
                        $sql2 = "UPDATE tbl_admin SET
                        password='$new_password'
                        WHERE id=$id";

                        $res2 = mysqli_query($conn, $sql2);

                        if ($res2==true) 
                        {
                            $_SESSION['change-pwd'] = "Password changed.";
                            header('location:'.SITEURL.'admin/manage-admin.php');
                        } else 
                        {
                            $_SESSION['change-pwd'] = "Failed to change Password .";
                            header('location:'.SITEURL.'admin/manage-admin.php');
                        }
                    } else
                    {
                        //redirect
                        $_SESSION['pwd-not-match'] = "Password did not match.";
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                } else
                {
                    $_SESSION['user-not-found'] = "User Not Found";
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }
        }


            //3. Check whether the new Password 
        

    ?>



<?php include('partials/footer.php'); ?>