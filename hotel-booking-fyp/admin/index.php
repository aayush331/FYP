<?php
include('partials/menu.php');
?>

    <!-- Main Content Section Starts -->
    <div class="main-content">
    <div class="wrapper">
        <H1>DASHBOARD</H1>
        <br><br>



        <?php 
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
        ?>
            <br><br>

        <div class="col-4 text-centre">

            <?php
                //Sql Query
                    $sql = "SELECT * FROM tbl_category";
                    //Execute query
                    $res = mysqli_query($conn,$sql);
                    //Count Rows
                    $count = mysqli_num_rows($res);
            ?>
            <h1><?php echo $count; ?></h1>
            <br>
            Categories
        </div>
        <div class="col-4 text-centre">

            <?php
                //Sql Query
                    $sql2 = "SELECT * FROM tbl_room";
                    //Execute query
                    $res2 = mysqli_query($conn,$sql2);
                    //Count Rows
                    $count2 = mysqli_num_rows($res2);
            ?>
            <h1><?php echo $count2; ?></h1>
            <br>
            Rooms
        </div>
        <div class="col-4 text-centre">
        <?php
                    //Sql Query
                        $sql3 = "SELECT * FROM tbl_booking";
                        //Execute query
                        $res3 = mysqli_query($conn,$sql3);
                        //Count Rows
                        $count3 = mysqli_num_rows($res3);
                ?>
                <h1><?php echo $count3; ?></h1>
            <br>
            Booking
        </div>
        <div class="col-4 text-centre">
            
        <?php
            //Create sql query to get total revenue generated
            //Aggregate function in sql
            $sql4 = "SELECT SUM(total) AS Total FROM tbl_booking";
                
            //Execute the query
            $res4 = mysqli_query($conn, $sql4);

            //Get the value
            $row4 = mysqli_fetch_assoc($res4);

            //Get the total revenue
            $total_revenue = $row4['Total'];

        ?>
            <h1><?php echo $total_revenue; ?></h1>
            <br/>
            Revenue Generated
        </div>
        <div class="clearfix"></div>

    </div>
    <!-- Main Content Section Ends -->

<?php include('partials/footer.php')?>

