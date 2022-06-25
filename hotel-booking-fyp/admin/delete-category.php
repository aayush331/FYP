<?php
    //Include Constants File
    include('../config/constants.php');

    //echo "delete page";
    //Check whether the ID and image_name value is set or not 
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        //Get the value and delete
        //echo "Get value and Delete";
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        // Remove the physical image file if available 
        if($image_name != "")
        {
            //image is available
            $path = "../images/category/".$image_name;
            //Remove the image
            $remove = unlink($path);

            //if failed to remove image then add an error message and stop the process
            if($remove==false)
            {
                //Set the session message
                $_SESSION['remove'] = "Failed to remove Category Image.";
                //redirect to manage category
                header('location:'.SITEURL.'admin/manage-category.php');
                //Stop the process
                die();
            }
        }


        //delete data from database 
        //SQL query delete data from database
        $sql = "DELETE FROM tbl_category WHERE id=$id";

        //execute the query
        $res = mysqli_query($conn, $sql);

        //CHeck whether the data is delete from database or not
        if($res==true)
        {
            //Set success message and redirect
            $_SESSION['delete'] = "Category Deleted Successfully";

            //Redirect to manage category
            header('location'.SITEURL.'admin/manage-category.php');

        }
        else
        {
            //Set fail message and redirect
            $_SESSION['delete'] = "Failed to delete category";

            //Redirect to manage category
            header('location'.SITEURL.'admin/manage-category.php');
        }
        //redirect to manage category page with message

    }
    else
    {
        //redirect to manage category page
        header('location:'.SITEURL.'admin/manage-category.php');

    }

?>