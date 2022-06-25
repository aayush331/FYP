<?php include('partials-front/menu.php');?>



    <?php
        //Check whether id is passed or not 
        if(isset($_GET['category_id']))
            {
                //Category id is set and get the id 
                $category_id = $_GET['category_id'];
                // Get the category title based on category ID
                $sql = "SELECT title FROM tbl_category WHERE id=$category_id";

                //Execute the Query
                $res = mysqli_query($conn, $sql);

                //GET the value from database 
                $row = mysqli_fetch_assoc($res);
                //Get the title
                $category_title = $row['title'];

            }
            
        else
            {
                //category not passed
                //redirect to home page
                header('location:'.SITEURL);
            }


        ?>

    <!-- room sEARCH Section Starts Here -->
    <section class="room-search text-center">
        <div class="container">

            <h2>rooms on <a href="#" class="text-white">"<?php echo $category_title;?>"</a></h2>

        </div>
    </section>
    <!-- room sEARCH Section Ends Here -->



    <!-- room MEnu Section Starts Here -->
    <section class="room-menu">
        <div class="container">
            <h2 class="text-center">Room Menu</h2>

            <?php
                //Create SQL Query to get Rooms based on Selected Category
                $sql2 = "SELECT * from tbl_room WHERE category_id=$category_id";

                //Execute the query
                $res2 = mysqli_query($conn, $sql2);

                //count the rows
                $count2 = mysqli_num_rows($res2);

                //Check whether room is available or not
                if($count2>0)
                {
                    //ROom is available
                    while($row2=mysqli_fetch_assoc($res2))
                    {
                        $id = $row2['id'];
                        $title = $row2['title'];
                        $price = $row2['price'];
                        $description = $row2['description'];
                        $image_name = $row2['image_name'];
                        ?>
                        <div class="room-menu-box">
                            <div class="room-menu-img">
                                <?php
                                    if($image_name =="")
                                    {
                                        //Image not available
                                        echo"<div class='error'>Image not Available.</div>";
                                    }
                                    else
                                    {
                                        //Iamge Available
                                        ?>
                                                <img src="<?php echo SITEURL; ?>images/room/<?php echo $image_name;?>"  class="img-responsive img-curve">

                                        <?php
                                    }
                                ?>
                            </div>

                            <div class="room-menu-desc">
                                <h4><?php echo $title; ?></h4>
                                <p class="room-price">Nrp<?php echo $price; ?></p>
                                <p class="room-detail">
                                    <?php echo $description; ?>
                                </p>
                                <br>

                                <a href="<?php echo SITEURL; ?>/booking.php?room_id=<?php echo $id; ?>" class="btn btn-primary">Book Now</a>
                            </div>
                        </div>

                        <?php
                    }
                }
                else
                {
                    //Food not available
                    echo"<div class='error'>Room not Available.</div>";
                }
            
            ?>
            <div class="room-menu-box">
                <div class="room-menu-img">
                    <img src="images/menu-pizza.jpg"  class="img-responsive img-curve">
                </div>


            <div class="clearfix"></div>



        </div>

    </section>
    <!-- room Menu Section Ends Here -->

    <?php include('partials-front/footer.php');?>

