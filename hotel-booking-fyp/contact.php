<?php include('config/constants.php');?>
<head>
  <link rel="stylesheet" href="css/contact.css">
</head>
<div class="container">

  <form action="" method="POST">

    <label for="fname">First Name</label>
    <input type="text" id="fname" name="fname" placeholder="Your name..">

    <label for="lname">Last Name</label>
    <input type="text" id="lname" name="lname" placeholder="Your last name..">

    <label for="email">Email</label>
    <input type="text" id="email" name="email" placeholder="Your email..">

    <label for="subject">Message</label>
    <textarea id="subject" name="subject" placeholder="Write something.." style="height:200px"></textarea>

    <input type="submit" name="submit" value="Submit">

  </form>

</div>
<a href="<?php echo SITEURL; ?>index.php" class="btn-danger">Cancel</a>



    <?php
        //check whether submit button is clicked or not
        if(isset($_POST['submit']))
        {
           //get all the details from the form
              $f_name = $_POST['fname'];
              $L_name = $_POST['lname'];
              $Email = $_POST['email'];
              $Message = $_POST['subject'];
              


                  //Save the order in database
                  //Create sql to save the data
                  $sql = "INSERT INTO feedback SET
                      first_name = '$f_name',
                      last_name = '$L_name',
                      email = '$Email',
                      message = '$Message'                      
                       
                      ";

                      
                      ///Execute the query
                      $res = mysqli_query($conn, $sql);
                      //Check whether query executed successfully or not
                      if($res==true)
                      {
                          //Query executed and booking saved
                          $_SESSION['feedback'] = "<div class='success text-center'>Feedback posted successfully.</div>";
                          header('location:'.SITEURL);
                      }
                      else
                      {
                          //Failed to save booking
                          $_SESSION['feedback'] = "<div class='error text-center'>Failed post Feedback.</div>";
                          header('location:'.SITEURL);
                      }
        }
            
    ?>

  