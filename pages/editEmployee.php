<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link type="text/css" rel="stylesheet" href="../assets/css/scheduleTime.css" />
    <link rel="stylesheet" href="../assets/css/main.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <?php 
    require_once('../dbFunctions.php');
    $UID = $_POST['UID'];
    $db = new dbfunctions();
    
    
    $result = $db->selectEmployeeFromID($UID);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $first_name = $row['firstName'];
            $last_name = $row['lastName'];
            $phone = $row['phone'];
            $email = $row['email'];
        }
    } else {
        echo "User not found";
    }
    
    

    ?>
    <title>Add Employee</title>
  </head>
  <body>

            <!-- Navbar (sit on top) -->
            <div class="w3-top">
                    <div class="w3-bar w3-white w3-wide w3-padding w3-card">
                      <a href="index.php" class="w3-bar-item w3-button"><b>Employee</b> Timesheets</a>
                      <!-- Float links to the right. Hide them on small screens -->
                      <div class="w3-right w3-hide-small">
                     
                      <!--  <a href="#about" class="w3-bar-item w3-button">About</a>
                        <a href="#contact" class="w3-bar-item w3-button">Contact</a>
                      -->
                      </div>
                    </div>
                  </div>
                  </div>

        <div class="container">  
                <form id="contact" action="../modules/update.php" method="post">
                  <h3>Add a new employee to the database</h3>
                  <h4>This will a necessary step if they want to work shifts!</h4>
                  <input style="display:none;" name="uid" type="text" tabindex="1" value="<?php echo $UID; ?>">
                  <fieldset>
                    <input placeholder="Your First Name" name="first" type="text" tabindex="1" value="<?php echo $first_name; ?>" required autofocus>
                  </fieldset>
                  <fieldset>
                    <input placeholder="Your Last Name" name="last" type="text" tabindex="2" value="<?php echo $last_name; ?>" required>
                  </fieldset>
                  <fieldset>
                    <input placeholder="Your Phone Number" name="phone" type="tel" tabindex="3" value="<?php echo $phone; ?>" required>
                  </fieldset>
                  <fieldset>
                    <input placeholder="Your Email"  name="email" type="email" tabindex="4" value="<?php echo $email; ?>" required>
                  </fieldset>
                  <fieldset>
                    <button name="submit" type="submit" id="contact-submit" value="Submit">Submit</button>
                  </fieldset>
                </form>
               
                
              </div>








    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
