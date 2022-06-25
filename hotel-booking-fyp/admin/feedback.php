<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Feedback</h1>
        <br><br><br>
        
            <table  class="tbl-full">
                <tr>
                <th>S.N.</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Message</th>
                </tr>
                <?php
                    //get all  the Booking from database
                    $sql = "SELECT * From feedback";
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
                        $fname = $row['first_name'];
                        $lname = $row['last_name'];
                        $email = $row['email'];
                        $message = $row['message'];

                        ?>
                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $fname; ?></td>
                            <td><?php echo $lname; ?></td>
                            <td><?php echo $email; ?></td>
                            <td><?php echo $message; ?></td>
                                

                        </tr>
                        <?php
                        }
                    }
                    else
                    {
                        //Feedback not available
                        echo"<tr><td colspan='12' class='error'>Feedback Not Available.</td></tr>";
                    }

                ?>
                
            </table>

    </div>
    
</div>
<?php include('partials/footer.php');?>