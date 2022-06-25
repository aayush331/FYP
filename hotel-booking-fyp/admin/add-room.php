<?php include('partials/menu.php');?>

<?php
ob_start()
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Room</h1>
        
        <br><br>

        <?php
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

        ?>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>
                        Title:
                    </td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the room" required>
                    </td>
                </tr>
                <tr>
                    <td>Desciption: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Description of the room" required></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price" placeholder="Price of the room" required>
                    </td>
                </tr>
                <tr>
                    <td>Image: </td>
                    <td>
                        <input type="file" name="image" required>
                    </td>
                </tr>
                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">

                            <?php 
                                //Create Php code to display categories from database
                                //1. Create SQL to get all active categories from database 
                                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                                // executing queery
                                $res = mysqli_query($conn, $sql);

                                //Count Rows to check whether we have categories or not
                                $count = mysqli_num_rows($res);

                                //IF count is greater than zero, we have categories else we do not have categories 
                                if($count>0)
                                {
                                    //We have categories
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        //get the details of categories
                                        $id = $row['id'];
                                        $title = $row['title'];
                                        ?>

                                        <option value="<?php echo $id;?>"><?php echo $title;?></option>

                                        <?php
                                        
                                    }

                                }
                                else
                                {
                                    // We do not have category
                                    ?>
                                        <option value="0">No category Found</option>
                                    <?php
                                }

                                //2. Display on Dropdown 
                            ?>


                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add room" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>
  
  
  
  
  
    <?php

        //Check whether the button is clicked or not
        if(isset($_POST['submit']))
        {
            //Add the room in database 
            // echo "Clicked";

            //1. Get the data from form 
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];

            //Check whether the radio button for feature and active are checked or not 
            if(isset($_POST['featured']))
            {
                $featured = $_POST['featured'];
            }
            else
            {
                $featured = "No"; //setting default value
            }
            if(isset($_POST['active']))
            {
                $active = $_POST['active'];
            }
            else
            {
                $active = "No"; //Setting Default Value 
            }

            //2. Upload the image if selected 
            //Check whether the select image is clicked or not and upload the image only if the image is selected 
            if(isset($_FILES['image']['name']))
            {
                //Get the details of the selected image 
                $image_name = $_FILES['image']['name'];

                // Check whether the image is selected or not and upload image only if selected 
                if($image_name !="")
                {
                    //Image is selected 
                    //A. Rename the image
                    //Get the extension of selected image (jpg.png, gif, etc.)
                    $ext = end(explode('.', $image_name));

                    //Create new name for image 
                    $image_name = "room-Name-".rand(0000,9999).".".$ext; // New image name may be "room-Name-"
                    
                    //B. Upload the image
                    //Get the source path and destinaiton path

                    //Source path is the current location of the image 
                    $src = $_FILES['image']['tmp_name'];

                    //Destination path for the image to be uploaded 
                    $dst = "../images/room/".$image_name;

                    //Finally upload the room image
                    $upload = move_uploaded_file($src, $dst);

                    //Check whether image uploaded or not 
                    if($upload==false)
                    {
                        //Failed to upload the image
                        
                        //redirect to add room page with error message 
                        $_SESSION['upload'] = "Failed to upload image.";
                        header('location:'.SITEURL.'admin/add-room.php');
                        //Stop the process
                        die();
                    }

                }
            }
            else
            {
                $image_name = ""; //Selecting default value as blank
            }

            //3. Insert into Database 

            //Create the sql query to save or add room
            //For numerical value we do not nedd to pass value inside quotes '' But for string value it is mandatory 
            $sql2 = "INSERT INTO tbl_room SET
                title = '$title',
                description = '$description',
                price = $price,
                image_name = '$image_name',
                category_id = $category,
                featured = '$featured',
                active = '$active'
            ";

            //Execute the query
            $res2 = mysqli_query($conn, $sql2);
            //Check whether data is inserted or not

            if($res2==true)
            {
                //Data inserted Successfully
                $_SESSION['add'] = "<div class='success text-center'>Room Added Successfully.</div>";
                header('location:'.SITEURL.'admin/manage-room.php');
            }
            else
            {
                //Failed to insert data
                $_SESSION['add'] = "room Added Successfully";
                header('location:'.SITEURL.'admin/manage-room.php');
            }


            //4. Redirect with message to manage room page
        }

    ?>
    </div>

</div>




<?php include('partials/footer.php');?>