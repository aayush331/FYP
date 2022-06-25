<?php include('partials/menu.php'); ?>


<div class="main-content">
   <div class="wrapper">
       <h1>Update Category</h1>


       <br><br>
       <?php 
       // check whether the id is set or not
       if(isset($_GET['id']))
       {
           //Get the ID and all other details
           //echo "Getting the data";
           $id = $_GET['id'];
           //Create SQl query to get all other details
           $sql = "SELECT * FROM tbl_category WHERE id=$id";

           //Execute the query
           $res = mysqli_query($conn, $sql);

           //Count the rows to check whether the id is valid or not
           $count = mysqli_num_rows($res);

            if($count==1)
            {
                //Get all the data
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $current_image = $row['image_name'];
                $featured = $row['featured'];
                $active = $row['active'];

            }
            else 
            {
                //redirect to manage category with session message
                $_SESSION['no-category-found'] = "CAtegory not found";
                header('location:'.SITEURL.'admin/manage-category.php');
            }
            
       }
       else
       {
           //redirect to manage Category
           header('location:'.SITEURL.'add/manage-category.');
       }


       ?>
    <form action="" method="POST" enctype="multipart/form-data">
       <table class="tbl-30">
            <tr>
                <td>Title: </td>
                <td><input type="text" name="title" value="<?php echo $title;?>">
                </td>
            </tr>

            <tr>
                <td>Current Image: </td>
                <td>
                    <?php 
                        if($current_image != "")
                        {
                            //Display the image
                            ?>
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image;?>" width="150px">
                            <?php
                        }
                        else
                        {
                            //Display the message
                            echo "Image was not added";
                        }
                    ?>
                </td>
            </tr>

            <tr>
                <td>New Image: </td>
                <td>
                    <input type="file" name="image" >
                </td>
            </tr>

            <tr>
                <td>Featured: </td>
                <td>
                    <input <?php if($featured=="Yes"){echo "checked";}?> type="radio" name="featured" value="Yes"> Yes
                    <input <?php if($featured=="No"){echo "checked";}?> type="radio" name="featured" value="No"> No
                </td>
            </tr>

            <tr>
                <td>Active: </td>
                <td>
                <input <?php if($active=="Yes"){echo "checked";}?> type="radio" name="active" value="Yes"> Yes
                <input <?php if($active=="No"){echo "checked";}?>type="radio" name="active" value="No"> No
                </td>
            </tr>

            <tr>
                <td>
                <input type="hidden" name="current_image" value="<?php echo $current_image;?>">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                 <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                </td>
            </tr>
       </table>
    </form>
<?php
    if(isset($_POST['submit']))
    {
        // echo "clicked";  
        //1. Get all the values from our form
        $id = $_POST['id'];
        $title = $_POST['title'];
        $current_image = $_POST['current_image'];
        $featured = $_POST['featured'];
        $active = $_POST['active'];

        //2. Updating new image if selected 
        //Check whether the image is selected or not 
        if(isset($_FILES['image']['name']))
        {
            //Get the Image Details
            $image_name = $_FILES['image']['name'];

            //Check whether the image is available or not
            if($image_name !="")
            {
                //Image Available

                //Upload the new image

                //Auto rename our Image
                        //Get the Extension of our image(jpg, png, gif, etc)
                        $ext = end(explode('.', $image_name));

                        //Rename the image
                        $image_name = "room_Category_".rand(000, 999).'.'.$ext;
                    

                        $source_path = $_FILES['image']['tmp_name'];
                        
                        $destination_path = "../images/category/".$image_name;

                        // finally Upload the image
                        $upload = move_uploaded_file($source_path, $destination_path);

                        //check whether the image is uploaded or not
                        //And the image is not uploaded then we will stop the process and redirect with error message
                        if ($upload==false) {
                            //set message
                            $SESSION['upload'] = "Failed to upload image.";
                            //redirect to add category page
                            header('location:'.SITEURL.'admin/manage-category.php');
                            //Stop the process
                            die();
                        }

                //remove the Current Image if available 
                if($current_image !="")
                {
                    $remove_path = "../images/category/".$current_image;
                
                    $remove = unlink($remove_path);
    
                    //Check whether the image is removed or not 
                    //If failed to remove then display message and stop the process
                    if($remove==false)
                    {
                        //failed to remove image
                        $_SESSION['failed-remove'] = "Failed to remove current image";
                        header('location'.SITEURL.'admin/manage-category.php');
                        die();//stop the process
                    }
                }

            }
        }
        else
        {
            $image_name = $current_image;
        }

        //3. update the database
        $sql2 = "UPDATE tbl_category SET
        title = '$title',
        image_name = '$image_name',
        featured = '$featured',
        active = '$active'
        WHERE id=$id";
        //execute the query
        $res2 = mysqli_query($conn, $sql2);

        //4. Redirect to manage category with message
        //Check whether the query is executed or not
        if($res2==true)
        {
            //Category Updated
            $_SESSION['update'] = "<div class='success text-center'>Category Updated Successfully.</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else
        {
            //failed to update category
            $_SESSION['update'] = "Failed to update category.";
            header('location:'.SITEURL.'admin/manage-category.php');

        }

    }
?>


   </div> 
</div>









<?php include('partials/footer.php'); ?>