<?php

    //include constants page
    include('../config/constants.php');

    //echo "Delete room page";

    if(isset($_GET['id']) && isset($_GET['image_name'])) // Either use && or and
    {
        //Process to Delete
        //echo "Process to Delete";

        //1. Get id and image name
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //2. Remove the image if available 
        //Check whether the image is available or not and delete only if available 
        if($image_name != "")
        {
            //It has image and need to remove from folder 
            //Get the image path
            $path = "../images/room/".$image_name;

            //remove image file from folder 
            $remove = unlink($path);

            //Check whether the image is removed or not 
            if($remove==false)
            {
                //Failed to remove image
                $_SESSION['upload'] = "Failed to remove image file";
                //Redirect to manage room 
                header('location:'.SITEURL.'admin/manage-room.php');
                //Stop the process of deleting room
                die();
            }
        }

        //3.Delete room from database 
        $sql = "DELETE FROM tbl_room WHERE id=$id";
        //Execute the Query 
        $res = mysqli_query($conn, $sql);
                //4. redirect to manage room with session message
        //Check whether the query is executed or not and set the session message respectively 
        if($res==true)
        {
            //room Delete
            $_SESSION['delete'] = "<div class='success text-center'>Room Deleted Successfully.</div>.";
            header('location:'.SITEURL.'admin/manage-room.php');
        }
        else
        {
            //Failed to delete room 
            $_SESSION['delete'] = "Failed to delete.";
            header('location:'.SITEURL.'admin/manage-room.php');
        }

 


    }
    else
    {
        //Redirecting to manage room page
        //echo "Redirect";
        $_SESSION['Unauthorize'] = "Unauthorized Access.";
        header('location:'.SITEURL.'admin/manage-room.php');
    }


?>