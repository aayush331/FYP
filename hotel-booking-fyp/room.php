<?php include('partials-front/menu.php');?>

    <!-- room sEARCH Section Starts Here -->
    <section class="room-search text-center">
        <div class="container">

            <form action="<?php echo SITEURL; ?>room-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for room.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- room sEARCH Section Ends Here -->



    <!-- room MEnu Section Starts Here -->
    <section class="room-menu">
        <div class="container">
            <h2 class="text-center">Room Menu</h2>

            <?php 
                //Display room that are active
                $sql = "SELECT * FROM tbl_room WHERE active='Yes'";

                //Execute the Query 
                $res = mysqli_query($conn, $sql);

                //Count rows
                $count = mysqli_num_rows($res);

                //Check whether the rooms are available or not 
                if($count>0)
                {
                    //rooms Available 
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //Get the values 
                        $id = $row['id'];
                        $title = $row['title'];
                        $description = $row['description'];
                        $price = $row['price'];
                        $image_name = $row['image_name'];
                    ?>
                                <div class="room-menu-box">
                                    <div class="room-menu-img">
                                        <?php 
                                            //Check whether image available or not 
                                            if ($image_name=="") 
                                            {
                                                echo "Image not available";
                                            }
                                            else
                                            {
                                                //Image available 
                                                ?>

                                                    <img src="<?php echo SITEURL;?>images/room/<?php echo $image_name;?>" class="img-responsive img-curve">

                                                <?php
                                            }

                                        ?>
                                        
                                    </div>

                                    <div class="room-menu-desc">
                                        <h4><?php echo $title;?></h4>
                                        <p class="room-price">Nrp<?php echo $price;?></p>
                                        <p class="room-detail">
                                            <?php echo $title;?>
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
                    //rooms not available 
                    echo "room not found.";
                }
            ?>






            <div class="clearfix"></div>



        </div>

    </section>
    <!-- room Menu Section Ends Here -->

    <?php include('partials-front/footer.php');?>