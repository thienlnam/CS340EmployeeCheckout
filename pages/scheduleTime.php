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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <?php 
      require_once('../dbFunctions.php');
      $db = new dbfunctions();
      $result = $db->selectEmployeeShifts();
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
                <form id="contact" action="../modules/insert.php" method="post">
                  <h3>Request a shift to be covered</h3>
                  <h4>This must be done atleast 48 hours before the time of your shift!</h4>
                  <input name="action" value="insertShiftToBeCovered" style="display:none">
                  <fieldset>
                  <h2>Employee:</h2>
                    <select name="shiftID" class="largeInput" onchange="updateFields(this.value)">
                      <option></option>
                      <?php 
                      if ($result->num_rows > 0) {
                          
                        while($row = $result->fetch_assoc()) {
                    
                          echo '
                          <option value="'.$row['scheduleID'].'">'.$row['lastName']. ", " .$row['firstName']. " - " . $row['workDay'] . " - " . $row['timeStart']. "-" . $row['timeEnd']. " - " . $row['shiftType'] .'</option>
                          ';
                       
                        }
                      }


                      ?>
                    </select>
                  </fieldset>
                  <br><br>
                    <div id="dateToCover">
                    </div>

                </form>
               
                
              </div>








   
  </body>

  <script>
    function updateFields(shiftID){
      $.ajax({
        url: "../modules/populate.php",
        type: "post",
        data: {
          action: "updateDate",
          shiftID: shiftID
        },

        success: function (response) {
            //alert(response);
            document.getElementById('dateToCover').innerHTML = response;
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
    });

    


    }
        
 
 

  



  function updateDateDropdown(){

  }

</script>
</html>