<?php include('partials/menu.php');?>


<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>

        <br><br>
        <?php
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>
 
    <br><br>
        <!--Add Category form starts -->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>
                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image">
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
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>

            </table>


        </form>
        <!--Add Category form ends -->
        <?php
            // Check whether the submit button is clicked or not
            if(isset($_POST['submit']))
            {
                //echo "Clicked";

                //1. Get the value from category form
                $title = $_POST['title'];

                //for radio input type, we need to check whether the button is selected or not
                if(isset($_POST['featured']))
                {
                    //Get the value from form
                    $featured = $_POST['featured'];
                }
                else
                {
                    //Set the default value
                    $featured = "No";
                }
              
                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "No";
                }
                //check whether the image is selected or not and set the value for image name accordingly
                // print_r($_FILES['image']);

                // die();//Break the code here

                if(isset($_FILES['image']['name']))
                {   
                    //upload image only if image is selected
                    if ($image_name != "") 
                    {

                    //Upload the image
                        //to upload image we need image name, source path and destination path
                        $image_name = $_FILES['image']['name'];

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
                            header('location:'.SITEURL.'admin/add-category.php');
                            //Stop the process
                            die();
                        }
                    }
                   
                }
                else
                {
                    //Don't upload image and set the image name as blank
                    $image_name="";
                }

                //2 create SQL query to insert category into Database
                $sql = "INSERT INTO tbl_category SET
                title='$title',
                image_name = '$image_name',
                featured='$featured',
                active='$active'";

                //3. Execute the Query and Save in Database
                $res = mysqli_query($conn, $sql);

                //4. Check whether the query is executed or not and data added or not 
                if($res=True)
                {
                    //Query executed and Category added 
                    $SESSION['add'] = "Added Successfully";
                    // Redirect to Manage Category Page
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else
                {
                    //failed to add category 
                    $SESSION['add'] = "Faileed to add Category";
                    // Redirect to Manage Category Page
                    header('location:'.SITEURL.'admin/manage-category.php');

                }

            }
        ?>
    </div>

</div>














<?php include('partials/footer.php');?>