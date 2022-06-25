<?php include('partials-front/menu.php');?>


    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Rooms</h2>

            <?php 
            
                //Display all the categories that are active 
                //SQL Query
                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                //Execute the query 
                $res = mysqli_query($conn, $sql);

                //Count rows
                $count = mysqli_num_rows($res);

                //Check whether categories available or not
                if($count>0)
                {
                    //Categories Available 
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //Get the values
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>
                                                
                            <a href="category-rooms.php">
                                <div class="box-3 float-container">
                                    <?php
                                        if($image_name=="")
                                        {
                                            //Image not available 
                                            echo "Image not found.";
                                        }
                                        else
                                        {
                                            //Image available 
                                            ?>
                                            <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name; ?>"  class="img-responsive img-curve">
                                            <?php
                                        }
                                    ?>
                                    

                                    <h3 class="float-text text-white"><?php echo $title;?></h3>
                                </div>
                            </a>

                        <?php
                    }
                }
                else
                {
                    //Categories not available 
                    echo " Categories not available";
                }

            ?>






            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->



<?php include('partials-front/footer.php');?>