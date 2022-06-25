<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Booking</h1>
        <br><br><br>

            <?php
                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
            ?>    
        <br><br><br>
            <table  class="tbl-full">
                <tr>
                    <th>S.N.</th>
                    <th>Room</th>
                    <th>Price</th>
                    <th>No of rooms</th>
                    <th>Total</th>
                    <th>Check in Date</th>
                    <th>Check out Date</th>
                    <th>Status</th>
                    <th>Customer Name</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>

                <?php
                    //get all  the Booking from database
                    $sql = "SELECT * From tbl_booking ";
                    //Execute Query
                    $res = mysqli_query($conn, $sql);
                    //count the rows
                    $count = mysqli_num_rows($res);

                    $sn = 1; //Create a serial number and set the value 1

                    if($count>0)
                    {
                        //Booking Available
                        while($row=mysqli_fetch_assoc($res))
                        {
                            //Get all the booking details
                            $id = $row['id'];
                            $room = $row['room'];
                            $price = $row['price'];
                            $nor = $row['no_of_rooms'];
                            $total = $row['total'];
                            $checkindate = $row['check_in_date'];
                            $checkoutdate = $row['check_out_date'];
                            $status = $row['status'];
                            $customer_name = $row['customer_name'];
                            $customer_contact = $row['customer_contact'];
                            $customer_email = $row['customer_email'];
                            $customer_address = $row['customer_address'];

                            ?>
                                
                                <tr>
                                    <td><?php echo $sn++; ?></td>
                                    <td><?php echo $room; ?></td>
                                    <td><?php echo $price; ?></td>
                                    <td><?php echo $nor; ?></td>
                                    <td><?php echo $total; ?></td>
                                    <td><?php echo $checkindate; ?></td>
                                    <td><?php echo $checkoutdate; ?></td>

                                    <td>
                                        <?php 
                                            //Booked ,Pending,Cancelled

                                            if($status=="Booked")
                                            {
                                                echo"<label style='color: green;'>$status</label>";
                                            }
                                            elseif($status=="Pending")
                                            {
                                                echo"<label style='color: orange;'>$status</label>";
                                            }
                                            elseif($status=="Cancelled")
                                            {
                                                echo"<label style='color: red;'>$status</label>";
                                            }
                                        ?> 
                                    </td>

                                    <td><?php echo $customer_name; ?></td>
                                    <td><?php echo $customer_contact; ?></td>
                                    <td><?php echo $customer_email; ?></td>
                                    <td><?php echo $customer_address; ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL; ?>admin/update-booking.php?id=<?php echo $id; ?>" class="btn-secondary">Update Booking</a>
                                        <a href="<?php echo SITEURL; ?>admin/invoice.php?id=<?php echo $id; ?>" class="btn-primary">Print</a>

                                    </td>
                                </tr>


                            <?php
                        }
                    }
                    else
                    {
                        //Booking not available
                        echo"<tr><td colspan='12' class='error'>Booking Not Available.</td></tr>";
                    }

                ?>
                
            </table>

    </div>
    
</div>



<?php include('partials/footer.php');?>