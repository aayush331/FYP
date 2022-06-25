<?php
    //Include constanta.php
    include('../config/constants.php');

    //1. get id of admin to delete.
    echo $id = $_GET['id'];


    //2. create SQL query to delete admin.
    $sql = "DELETE FROM tbl_admin WHERE id=$id";


    //Execute the query
    $res = mysqli_query($conn, $sql);

    //Check whether the query executed successfully or not
    if($res==TRUE)
    {
        //Query executed successfully and delete admin
        //echo "Admin Deleted";
        //Create session variable to dispaly message 
        $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully</div>";
        //redirecting to manage admin page
        header('location:'.SITEURL.'admin/manage-admin.php');

    }
    else{
        //failed.
        echo "Failed to delete";
                //Create session variable to dispaly message 
                $_SESSION['delete'] = "<div class='error'>Failed to delete Admin</div>";
                //redirecting to manage admin page
                header('location:'.SITEURL.'admin/manage-admin.php');
    }


    //3. Redirect to manage admin page with message.

?>
