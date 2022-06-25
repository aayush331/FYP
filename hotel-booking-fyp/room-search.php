<?php include('partials-front/menu.php');?>

    <!-- room sEARCH Section Starts Here -->
    <section class="room-search text-center">
        <div class="container">
            <?php 
                //Get the search keyword
                $search = $_POST['search'];
            ?>

            <h2>Rooms on Your Search <a href="#" class="text-white"><?php echo $search;?></a></h2>

        </div>
    </section>
    <!-- room sEARCH Section Ends Here -->



    <!-- room MEnu Section Starts Here -->
    <section class="room-menu">
        <div class="container">
 
        <h2 class="text-center">Room Menu</h2>
            <?php              

                //SQL query to get rooms based on search keyword
                $sql = "SELECT * FROM tbl_room WHERE title LIKE '%$search%' or description LIKE '%$search%'";

                //Execute the query
                $res = mysqli_query($conn, $sql);

                //Count rows
                $count = mysqli_num_rows($res);

                //Check whether room is available or not 
                if($count>0)
                {
                    //room available 
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //Get the details 
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];

                        ?>
                       <div class="room-menu-box">
                            <div class="room-menu-img">
                                <?php
                                    // Check whether image nam eis available or not 
                                    if($image_name=="")
                                    {
                                        //image not available 
                                        echo "<div class='error'>Image not Available.</div>";
                                    
                                    }
                                    else
                                    {
                                        //Image available 
                                        ?>
                                            <img src="<?php echo SITEURL;?>images/room/<?php echo $image_name;?>"  class="img-responsive img-curve">
                                        <?php 
                                    }
                                ?>
                                
                            </div>

                            <div class="room-menu-desc">
                                <h4><?php echo $title;?></h4>
                                <p class="room-price">$<?php echo $price;?></p>
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
                    //room not available 
                    echo "room not available";
                }
            ?>



            <div class="clearfix"></div>



        </div>

    </section>
    <!-- room Menu Section Ends Here -->
    <?php include('partials-front/footer.php');?>
