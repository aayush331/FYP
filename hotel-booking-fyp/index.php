<?php include('partials-front/menu.php');?>

    <!-- room sEARCH Section Starts Here -->
    <section class="room-search text-center">
        <div class="container">

            <form action="<?php echo SITEURL;?>room-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for room.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- room sEARCH Section Ends Here -->
    <?php
        if(isset($_SESSION['booking']))
        {
            echo $_SESSION['booking'];
            unset($_SESSION['booking']);
        }
        
        if(isset($_SESSION['feedback']))
        {
            echo $_SESSION['feedback'];
            unset($_SESSION['feedback']);
        }
    
    
    ?>
    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Rooms</h2>

            <?php
                //Create SQL Query to display Categories from database
                $sql  = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";
                //Execute the query
                $res = mysqli_query($conn, $sql);
                //Count rows to check wwhether the category is available or not 
                $count = mysqli_num_rows($res);

                if($count>0)
                {
                    //Categories available 
                    while($row = mysqli_fetch_assoc($res))
                    {
                        //get the values like id, title, image_name
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>
                        
                                <a href="<?php echo SITEURL;?>category-rooms.php?category_id=<?php echo $id;?>">
                                    <div class="box-3 float-container">
                                        <?php 
                                            //Check whether the image is available or not 
                                            if($image_name=="")
                                            {
                                                //Display Message
                                                echo "<div class='error'>Image not available</div>";
                                            }
                                            else
                                            {
                                                //Image Available 
                                                ?>
                                                <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name;?>" alt="Pizza" class="img-responsive img-curve">
                                                <?php 
                                            }
                                        ?>
                                        

                                        <h3 class="float-text text-white"><?php echo $title; ?></h3>
                                    </div>
                                </a>

                        <?php
                    }

                }
                else
                {
                    //Categories not available 
                    echo "Category Not added";

                }

            ?>




            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- room MEnu Section Starts Here -->
    <section class="room-menu">
        <div class="container">
            <h2 class="text-center">Room Menu</h2>

            <?php

            //Getting rooms from Database that are active and featured 
            //SQL Query
            $sql2 = "SELECT * FROM tbl_room WHERe active='Yes' AND featured='Yes' LIMIT 6";

            //Execute the query 
            $res2 = mysqli_query($conn, $sql2);

            //Count Rows
            $count2 = mysqli_num_rows($res2);

            //Check whether ood available or not 
            if($count2>0)
            {
                //room Available 
                while($row2=mysqli_fetch_assoc($res2))
                {
                    //Get all the values
                    $id = $row2['id'];
                    $title = $row2['title'];
                    $price = $row2['price'];
                    $description = $row2['description'];
                    $image_name = $row2['image_name'];
                    ?>

                    <div class="room-menu-box">
                                    <div class="room-menu-img">
                                        <?php 
                                            //Check whether the image is available or not 
                                            if($image_name=="")
                                            {
                                                //Image not available 
                                                echo "Image not available";
                                            }
                                            else
                                            {
                                                //Image available 
                                                ?>
                                                <img src="<?php echo SITEURL;?>images/room/<?php echo $image_name;?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                    
                                                <?php
                                            }
                                        ?>
                                        
                                    </div>

                                    <div class="room-menu-desc">
                                        <h4><?php echo $title;?></h4>
                                        <p class="room-price">Nrp<?php echo $price;?></p>
                                        <p class="room-detail">
                                            <?php echo $description;?>
                                        </p>
                                        <br>

                                        <a href="<?php echo SITEURL; ?>booking.php?room_id=<?php echo $id; ?>" class="btn btn-primary">Book Now</a>
                                    </div>
                    </div>

                    <?php
                }

            }
            else
            {
                //room available 
                echo "room not available.";
            }




            ?>





            <div class="clearfix"></div>



        </div>

        <p class="text-center">
            <a href="#">See All rooms</a>
        </p>
    </section>
    <!-- room Menu Section Ends Here -->


    <?php include('partials-front/footer.php');?>