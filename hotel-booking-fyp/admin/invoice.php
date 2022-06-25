<?php include('../config/constants.php');?>

<head>
<meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>

    <!-- Link our CSS file -->
	<link rel="stylesheet" href="../css/admin.css">
	<title>Hotel Lake vision</title>
		<style type="text/css">
		body {		
			font-family: Verdana;
		}
		
		div.invoice {
		align-content: center;
		border:1px solid #ccc;
		padding:10px;
		height:350pt;
		
		}

		div.company-address {
			border:1px solid #ccc;
			float:left;
			width:200pt;
		}
		
		div.invoice-details {
			border:1px solid #ccc;
			float:right;
			width:200pt;
		}
		
		div.customer-address {
			border:1px solid #ccc;
			float:right;
			margin-bottom:50px;
			margin-top:100px;
			width:200pt;
		}
		
		div.clear-fix {
			clear:both;
			float:none;
		}
		
		table {
			width:100%;
		}
		
		th {
			text-align: left;
		}
		
		.text-left {
			text-align:left;
		}
		
		.text-center {
			text-align:center;
		}
		
		.text-right {
			text-align:right;
		}
		
		</style>
</head>

			<?php
			//check whether id is set or not
			if(isset($_GET['id']))
			{
				//Get the order Details
				$id=$_GET['id'];
                    //get all  the Booking from database
                    $sql = "SELECT * From tbl_booking WHERE id=$id";
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
                            $customer_name = $row['customer_name'];
                            $customer_address = $row['customer_address'];
							$checkindate = $row['check_in_date'];

                ?>
					<a href="#" title="Logo" >
                    	<img src="../images/print.jpg" alt="Restaurant Logo" class="img-responsive">
                	</a>	
							<div class="invoice">
								<div class="company-address">
									Hotel Lake Vision
									<br />
									33700 Pokhara 
									<br />
									Lakeside-6, Khahare
									<br />
								</div>
							
								<div class="invoice-details">
								<?php echo $id; ?>
									<br />
									DATE:<?php echo $checkindate; ?>
								</div>
								
								<div class="customer-address text-center">
									To:
									<br />
									<?php echo $customer_name; ?>
									<br />
									<?php echo $customer_address; ?>
								</div>
								
								<div class="clear-fix"></div>
									<table border='1' cellspacing='0' class="tbl-full">
										<tr>
											<th width=250>Description</th>
											<th width=160>No of Rooms Booked</th>
											<th width=100>Unit price</th>
											<th width=100>Total price</th>
										</tr>
										
														
														<tr>
															<td><?php echo $room; ?></td>
															<td><?php echo $nor; ?></td>
															<td><?php echo $price; ?></td>
															<td><?php echo $total; ?></td>
															
															
														
														</tr>


                            <?php
                        }
                    }
                    else
                    {
                        //No invoice available
                        echo"<tr><td colspan='12' class='error'>No invoice found.</td></tr>";
                    }
				}
				else{
					 //redirect to Manage booing page
					 header('location:'.SITEURL.'admin/manage-booking.php');
				}

                ?>

<a href="<?php echo SITEURL; ?>admin/manage-booking.php?id=<?php echo $id; ?>" class="btn-danger">Cancel</a>


			</table>
		</div>
		<?php include('partials/footer.php');?>		
	

