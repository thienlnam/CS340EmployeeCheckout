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
      $db = new dbfunctions();
      $result = $db->selectEmployees();
    ?>
    <title>Request Shift To Be Covered</title>
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
                <form id="contact" action="" method="post">
                  <h3>Request a shift to be covered</h3>
                  <h4>This must be done atleast 48 hours before the time of your shift!</h4>
                  <fieldset>
                  <h2>Employee:</h2>
                    <select name="employeeID" class="largeInput">
                      <?php 
                      if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                    
                          echo '
                          <option value="'.$row['employeeID'].'">'.$row['firstName']. " " .$row['lastName'].'</option>
                          ';
                       
                        }
                      }


                      ?>
                    </select>
                  </fieldset>
                  <br><br>
                  <fieldset>
                    <input placeholder="Date you are requesting IE: 10/24/2019" type="email" tabindex="2" required>
                  </fieldset>
                  <fieldset>
                    <input placeholder="Your Phone Number" type="tel" tabindex="3" required>
                  </fieldset>
                  <fieldset>
                    <input placeholder="Shift duration in hours IE: 3.5 " type="url" tabindex="4" required>
                  </fieldset>
                  <fieldset>
                    <textarea placeholder="Additional notes for information needed for shift..." tabindex="5" required></textarea>
                  </fieldset>
                  <fieldset>
                    <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Submit</button>
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