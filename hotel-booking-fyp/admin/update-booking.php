<?php include('partials/menu.php'); ?>
<?php
ob_start();
?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Update Booking</h1>
            <br><br>


            <?php

                //check whether id is set or not
                if(isset($_GET['id']))
                {
                    //Get the order Details
                    $id=$_GET['id'];

                    //get all Booking details based on this id
                    //Sql query ton get the booking detais
                    $sql = "SELECT * FROM tbl_booking WHERE id=$id";
                    //Execute Query
                    $res = mysqli_query($conn, $sql);
                    //Count Rows
                    $count = mysqli_num_rows($res);

                    if($count==1)
                    {
                        //Detail Available
                        $row=mysqli_fetch_assoc($res);

                        $room = $row['room'];
                        $price = $row['price'];
                        $nor = $row['no_of_rooms'];
                        $checkindate = $row['check_in_date'];
                        $checkoutdate = $row['check_out_date'];
                        $status = $row['status'];
                        $customer_name = $row['customer_name'];
                        $customer_contact = $row['customer_contact'];
                        $customer_email = $row['customer_email'];
                        $customer_address = $row['customer_address'];
                    }
                    else
                    {
                        //Detail not available
                        //Redirect to manage booing 
                        header('location:'.SITEURL.'admin/manage-booking.php');
                    }
                }
                else
                {
                    //redirect to Manage booing page
                    header('location:'.SITEURL.'admin/manage-booking.php');
                }
            
            ?>

                <form action="" method="POST">

                    <table class="tbl-30">
                        <tr>
                            <td>
                                Room Name</td>
                            <td><b><?php echo $room; ?></b></td>

                        </tr>
                        <tr>
                            <td>
                                Price</td>
                            <td><b><?php echo $price; ?></b></td>

                        </tr>
                        <tr>
                            <td>
                                No of Rooms</td>
                            <td>
                                <input type="number" name="nor" value="<?php echo $nor; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Status
                            </td>
                            <td>
                                <select name="status">
                                    <option <?php if($status=="Booked"){echo "selected";}?> value="Booked">Booked</option>
                                    <option <?php if($status=="Pending"){echo "selected";}?> value="Pending">Pending</option>
                                    <option <?php if($status=="Cancelled"){echo "selected";}?> value="Cancelled">Cancelled</option>
                                </select>
                            </td>
                            
                        </tr>
                        <tr>
                            <td>
                                Customer Name</td>
                            <td>
                                <input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Customer Contact</td>
                            <td>
                                <input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Customer Email</td>
                            <td>
                                <input type="text" name="customer_email" value="<?php echo $customer_email; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Customer Address</td>
                            <td>
                                <textarea name="customer_address" cols="20" rows="5"><?php echo $customer_address; ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <input type="hidden" name="price" value="<?php echo $price; ?>">

                                <input type="submit" name="submit" value="Update Booking" class="btn-secondary">
                            </td>
                        </tr>
                    </table>


                </form>

                <?php
                    //CHeck whether the button is clicked or not
                    if(isset($_POST['submit']))
                    {
                        //Echo"Clicked";
                        $id = $_POST['id'];
                        $price = $_POST['price'];
                        $nor = $_POST['nor'];
                        $total = $price * $nor;
                        $status = $_POST['status'];
                        $customer_name = $_POST['customer_name'];
                        $customer_contact = $_POST['customer_contact'];
                        $customer_email = $_POST['customer_email'];
                        $customer_address = $_POST['customer_address'];

                        //Update the value
                        $sql2 = "UPDATE tbl_booking SET
                            no_of_rooms = $nor,
                            total = $total,
                            status = '$status',
                            customer_name = '$customer_name',
                            customer_contact = '$customer_contact',
                            customer_email = '$customer_email',
                            customer_address = '$customer_address'  
                            WHERE id=$id
                        ";
                        //Execute the query
                        $res2 = mysqli_query($conn, $sql2);

                        //Check whether update or not
                        //And redirect to manage booking with message
                        if($res2==true)
                        {
                            //Updated
                            $_SESSION['update'] ="<div class='success'>Booking Updated Successfully.</div>";
                            header('location:'.SITEURL.'admin/manage-booking.php');
                        }
                        else
                        {
                            //Failed to Update
                            $_SESSION['update'] = "<div class='error'>Failed to Update Booking.</div>";
                            header('location:'.SITEURL.'admin/manage-booking.php');

                        }
                    }
                
                
                ?>

            <br><br>
        </div>
    </div>        

<?php include('partials/footer.php');?>