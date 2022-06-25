<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Room</h1>
        <br><br><br>

                
<!--Button to add admin-->
<a href="<?php echo SITEURL;?>admin/add-room.php" class="btn-primary">Add room</a>
<br><br><br>

    <?php
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }   
        if(isset($_SESSION['delete']))
        {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        if(isset($_SESSION['unauthorize']))
        {
            echo $_SESSION['unauthorize'];
            unset($_SESSION['unauthorize']);
        }
        if(isset($_SESSION['update']))
        {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
    ?>


<table  class="tbl-full">
    <tr>
        <th>S.N.</th>
        <th>Title: </th>
        <th>Price: </th>
        <th>Image: </th>
        <th>Featured: </th>
        <th>Active: </th>
        <th>Actions: </th>
    </tr>
        <?php 
            //Create a SQL query to get all the room 
            $sql = "SELECT * FROM tbl_room";

            //Execute the query
            $res = mysqli_query($conn, $sql);

            //Count rows to check whether we have room or not 
            $count = mysqli_num_rows($res);

            //Create Serial number variable and set default value
            $sn=1;

            if($count>0)
            {
                //We have room in database
                //Get the rooms from database and Display 
                while($row=mysqli_fetch_assoc($res))
                {
                    //get the value from individual columns
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $image_name = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                    ?>

                        <tr>
                                <td><?php echo $sn++;?></td>
                                <td><?php echo $title;?></td>
                                <td>$<?php echo $price;?></td>
                                <td>
                                    <?php 
                                        //Check whether we have image or not 
                                        if($image_name=="")
                                        {
                                            //we do not have image, display error message
                                            echo "image not added";
                                        }
                                        else
                                        {
                                            // we have image, Display image
                                            ?>
                                              <img src="<?php echo SITEURL; ?>images/room/<?php echo $image_name; ?>" width="150px">             
                                            <?php
                                        }
                                    ?>
                                </td>
                                <td><?php echo $featured;?></td>
                                <td><?php echo $active;?></td>
                                <td>
                                <a href="<?php echo SITEURL; ?>admin/update-room.php?id=<?php echo $id;?>" class="btn-secondary">Update room</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-room.php?id=<?php echo $id;?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete room</a>
                                </td>
                        </tr>

                    <?php
                }
            }
            else
            {
                //room not added in database
                echo "<tr><td colspan='7'> room not Added yet.</td></tr>";
            }
        ?>


</table>

    </div>
    
</div>



<?php include('partials/footer.php');?>