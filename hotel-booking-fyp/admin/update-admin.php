<?php
include('partials/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>


<br><br>
<?php
    //1 Get the id of selected admin
    $id=$_GET['id'];

    //2 Create SQL Query to get the Details
    $sql = "SELECT * FROM tbl_admin WHERE id=$id";

    //3 Execute the Query
    $res=mysqli_query($conn, $sql);

    //4 check whether the query is executed or not
    if($res==TRUE)
    {
        //Check whether the data is availabe or not
        $count = mysqli_num_rows($res);
        //Check whether we have admin or not 
        if($count==1){
            //Get the Details
            //echo "Admin Available";
            $row = mysqli_fetch_assoc($res);

            $full_name = $row['full_name'];
            $username = $row['username'];
        }
        else{
            //Redirect to manage admin page
            header('location:'.SITEURL.'admin/manage-admin.php');
        }


    }
?>
        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td><input type="text" name="full_name" value="<?php echo $full_name; ?>"></td>
                    
                </tr>
                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="username" value="<?php echo $username; ?>"></td>
                    
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
</form>

</div>
</div>

<?php
    //check whether the submit Button is Clicked or not 
    if(isset($_POST['submit']))
    {
        //Get all the values from form to update
        $id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
    }

    //Create a SQL Query to Update Admin
    $sql = "UPDATE tbl_admin SET
    full_name = '".$full_name."',
    username = '".$username."'
    WHERE id ='$id'
    ";

    //executing the query
    $res = mysqli_query($conn, $sql);

    //check whether the query is working or not
    if($res== true)
    {
        //Query Executed ands Admin updated
        $_SESSION['update'] = "Admin updated Successfully.";
        //Redirect Page to manage admin
        //header('location:'.SITEURL.'admin/manage-admin.php');

    }
    else
    {
        // query has not been executed.
        $_SESSION['update'] = "Admin updated FAILED!!";
        //Redirect Page to manage admin
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
?>


<?php
include('partials/footer.php');
?>