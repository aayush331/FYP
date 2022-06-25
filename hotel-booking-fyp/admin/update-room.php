<?php include('partials/menu.php');?>
<?php
ob_start();
?>
<?php
    //Check whether id is set or not 
    if(isset($_GET['id']))
    {
        //Get all the details
        $id = $_GET['id'];

        //SQL Query to get the selected room 
        $sql2 = "SELECT * FROM tbl_room WHERE id=$id";

        //execute the Query 
        $res2 = mysqli_query($conn, $sql2);

        //Get the value based on query executed 
        $row2 = mysqli_fetch_assoc($res2);

        //Get the individual value of selected room
        $title = $row2['title'];
        $description = $row2['description'];
        $price = $row2['price'];
        $current_image = $row2['image_name'];
        $current_category = $row2['category_id'];
        $featured = $row2['featured'];
        $active = $row2['active'];

    }
    else
    {
        //Redirect to manage room
        header('location:'.SITEURL.'admin/manage-room.php');
    }

?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update room</h1>
        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">
        <table class="tbl-30">
        <tr>
                    <td>
                        Title:
                    </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title;?>" >
                    </td>
                </tr>
                <tr>
                    <td>Desciption: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5"  ><?php echo $description;?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price;?>">
                    </td>
                </tr>
                <tr>
                    <td> Current Image: </td>
                    <td>
                        <?php
                            if($current_image == "")
                            {
                                //Image not available
                                echo "Image not available"; 
                            }
                            else
                            {
                                //Image Available 
                                ?>
                                    <img src="<?php echo SITEURL;?>images/room/<?php echo $current_image;?>" width="150px">
                                <?php
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Select New Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">

                            <?php
                                //Query to Get active Categories
                                $sql = "SELECT * FROM tbl_category WHERE active='yes'";
                                //Execute the Query
                                $res = mysqli_query($conn, $sql);
                                //Count rows
                                $count = mysqli_num_rows($res);

                                //Check whether category available or not 
                                if($count>0)
                                {
                                    //Category Available 
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        $category_title = $row['title'];
                                        $category_id = $row['id'];

                                        //echo "<option value='$category_title'>$category_title</option>";
                                        ?>
                                        <option <?php if($current_category==$category_id) {echo "selected";} ?> value="<?php echo $category_id;?>"><?php echo $category_title;?></option>
                                        <?php
                                    }
                                }
                                else
                                {
                                    //Category not available 
                                    echo "<option value='0'>CAtegory Not available.</option>";
                                    
                                }
                            ?>



                            <option value="0">Test Category</option>
                        </select> 
                    </td>
                </tr>




                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if($featured =="Yes") {echo "checked";}?> type="radio" name="featured" value="Yes"> Yes
                        <input <?php if($featured =="No") {echo "checked";}?> type="radio" name="featured" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if($active =="Yes") {echo "checked";}?> type="radio" name="active" value="Yes"> Yes
                        <input <?php if($active =="No") {echo "checked";}?> type="radio" name="active" value="No"> No
                    </td>
                </tr>
                <tr>
                    
                <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image;?>">
                        <input type="submit" name="submit" value="Update room" class="btn-secondary">
                </td>
                </tr>
        </table>
        </form>

        <?php
            if(isset($_POST['submit']))
            {
                //echo "button clicked";
                //1. Get all the details from the form
                $id = $_POST['id'];
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $current_image = $_POST['current_image'];
                $category = $_POST['category'];

                $featured = $_POST['featured'];
                $active = $_POST['active'];
                
                //2. Upload the image if selected

                //Check whether upload button is clicked or not 
                if(isset($_FILES['image']['name']))
                {
                    //Upload button clicked
                    $image_name = $_FILES['image']['name']; //New image name
                    //Check whether the file is available or not 
                    if($image_name !="")
                    {
                        //Image is available 
                        //A. Uploading new image
                        //Rename the image 
                        $ext = end(explode('.', $image_name)); //Get the extension of the image

                        $image_name = "Foood-name-".rand(0000, 9999).'.'.$ext; //This will be renamed image 
                    
                        //Get the source path and destination path
                        $src_path = $_FILES['image']['tmp_name']; // Source path
                        $dest_path = "../images/room/".$image_name; //Destination Path

                        //Upload the image 
                        $upload = move_uploaded_file($src_path, $dest_path);

                        //Check whether the image is uploaded or not 
                        if($upload==false)
                        {
                            //Failed to upload 
                            $_SESSION['upload'] = "Failed to upload new image";
                            //Redirect to manage room
                            header('location'.SITEURL.'admin/manage-room.php');
                            //Stop the process
                            die();
                        }
                                        //3. Remove the image if new image is uploaded and current image exists
                        //B. Remove current image if available 
                        if($current_image !="")
                        {
                            //Currentimage is available 
                            //remove the image
                            $remove_path = "../images/room/".$current_image;

                            $remove = unlink($remove_path);

                            //Check whether the image is removed or not 
                            if($remove==false)
                            {
                                //failed to remove current image
                                $_SESSION['remove-failed'] = "Failed to remove image";
                                //Redirect to manage room
                                header('location'.SITEURL.'admin/manage-room.php');
                                //Stop the process
                                die();
                            }
                        }
                    }
                    else
                    {
                        $image_name = $current_image; // Default image when IMage is not selected 
                    }
                }
                else
                {
                    $image_name = $current_image; //Default image when button is clicked
                }


                //4. Update the room in database
                $sql3 = "UPDATE tbl_room SET 
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = '$category',
                    featured = '$featured', 
                    active = '$active'
                    WHERE id=$id
                ";

                //Execute the sql Query
                $res3 = mysqli_query($conn, $sql3);

                //Check whether is executed or not 
                if($res3==true)
                {
                    //Query Executed and room updated
                    $_SESSION['update'] = "<div class='success text-centre'>Room updated Successfully</div>";
                    header('location:'.SITEURL.'admin/manage-room.php');
                }
                else
                {
                    //Failed to update room 
                    $_SESSION['update'] = "<div class='error text-centre'>Failed to updated Successfully</div>";
                    header('location:'.SITEURL.'admin/manage-room.php');
                }

                //Redirect to manage room with session message
            }
        ?>
    </div>
</div>









<?php include('partials/footer.php');?>