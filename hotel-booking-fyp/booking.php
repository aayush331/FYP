<?php include('partials-front/menu.php');?>
<?php
ob_start();
?>
    <?php
        //Check whether room id is set or not
        if(isset($_GET['room_id']))
        {
            //get the room id and details of the selected room
            $room_id = $_GET['room_id'];

            //Get the details of the selected room
            $sql = "SELECT * FROM tbl_room WHERE id=$room_id";

            //EXCUTE the Query
            $res = mysqli_query($conn, $sql);
            
            //Count the rows
            $count = mysqli_num_rows($res);

            //check whether the data is available or not

            if($count==1)
            {
                //We have data
                //GEt the data from Database
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $price = $row['price'];
                $image_name = $row['image_name'];
                $title = $row['title'];

            }
            else
            {
                //Room not Available
                //Redirect to home page
                header('location:'.SITEURL);
            }
        }
        else
        {
            //Redirect to Homepage
            //header('location:'.SITEURL);
        }
    
    ?>
    <!-- room sEARCH Section Starts Here -->
    <section class="room-search">
        <div class="container">

            <h2 class="text-center text-white">Fill this form to confirm your booking.</h2>

            <form action="" method="POST" class="book">
                <fieldset>
                    <legend>Selected Room</legend>

                    <div class="room-menu-img">
                        <?php
                        
                            //Check whether the image is available or not
                            if($image_name=="")
                            {
                                //Image not Available
                                echo "<div class='error'>Image not Available,</div>";
                            }
                            else
                            {
                                //Image is available
                                ?>
                                    <img src="<?php echo SITEURL; ?>images/room/<?php echo $image_name; ?>" class="img-responsive img-curve">
                                <?php
                            }
                        
                        ?>
                        
                    </div>

                    <div class="room-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="room" value="<?php echo $title; ?>">

                        <p class="room-price"><?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price ; ?>">


                        <div class="book-label">No of rooms</div>
                        <input type="number" name="nor" class="input-responsive" value="1" required>

                    </div>

                </fieldset>

                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="book-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Aayush Khadka" class="input-responsive" required>

                    <div class="book-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9818xxxxxx" class="input-responsive" required>

                    <label class="book-label">Checkin:</label>
                    <input type="date" id="Checkin" name="Checkindate" class="input-responsive" required>

                    <label class="book-label">Checkout:</label>
                    <input type="date" id="Checkout" name="Checkoutdate" class="input-responsive" required>

                    <div class="book-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. itsme@ayushkhadka.com" class="input-responsive" required>

                    <div class="book-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm booking" class="btn btn-primary">
                </fieldset>

            </form>

            <?php
                //check whether submit button is clicked or not
                if(isset($_POST['submit']))
                {
                    //get all the details from the form

                    $room = $_POST['room'];
                    $price = $_POST['price'];
                    $nor = $_POST['nor'];

                    $total = $price * $nor;//total = price in number

                    $checkindate = $_POST['Checkindate'];
                    $checkoutdate = $_POST['Checkoutdate'];
                    $status = "Pending";// booked,pending Cancelled
                    $customer_name = $_POST['full-name'];
                    $customer_contact = $_POST['contact'];
                    $customer_email = $_POST['email'];
                    $customer_address = $_POST['address'];

                    //Save the order in database
                    //Create sql to save the data
                    $sql2 = "INSERT INTO tbl_booking SET
                        room = '$room',
                        price = $price,
                        no_of_rooms = $nor,
                        total = $total,
                        check_in_date = '$checkindate',
                        check_out_date = '$checkoutdate',
                        status = '$status',
                        customer_name = '$customer_name',
                        customer_contact = '$customer_contact',
                        customer_email = '$customer_email',
                        customer_address = '$customer_address'                      
                        
                        ";
                        ///Execute the query
                        $res2 = mysqli_query($conn, $sql2);

                        //Check whether query executed successfully or not
                        if($res2==true)
                        {
                            //Query executed and booking saved
                            $_SESSION['booking'] = "<div class='success text-center'>Room Booked successfully.</div>";
                            header('location:'.SITEURL);
                        }
                        else
                        {
                            //Failed to save booking
                            $_SESSION['booking'] = "<div class='error text-center'>Failed to book room.</div>";
                            header('location:'.SITEURL);
                        }
                }
            
            ?>
        </div>
    </section>
    <!-- room sEARCH Section Ends Here -->


    <?php include('partials-front/footer.php');?>
