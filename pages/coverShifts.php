<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/coverShifts.css">
    <link rel="stylesheet" href="../assets/css/main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <title>Cover Shifts</title>
  </head>

  <?php       
      require_once('../dbFunctions.php');
      $db = new dbfunctions();
      $result = $db->selectEmployeeRequests();
  
  function populateSingleShiftRequest($dateToGetCovered, $timeStart, $timeEnd, $shiftType, $additionalDetails, $firstName, $lastName, $phone, $employeeCoveringID) {
    if ($employeeCoveringID){
      $button = '<div class="d-flex-card-button" style="background-color: grey">Shift has been taken</div>';
    } else {
      $button = '<a href="#" class="d-flex-card-button">Cover Shift</a>';
    }

    if ($additionalDetails){
      $additionalDetailsText = '<p>Additional Details: '.$additionalDetails.'</p>';
    } else {
      $additionalDetailsText = '';
    }
    
    echo  '
      <li>
      <div class="flex-card">
        <div class="card-content">
          <h3>Shift Cover Opportunity</h3>
          <div class="text">
            <p>Shift Date: '.$dateToGetCovered.'</p>
            <p>Shift Times: '.$timeStart. " - " .$timeEnd.' </p>
            <p>Shift Type: '.$shiftType.'</p>
            '.$additionalDetailsText.'
          </div>
          <h3>Contact Information: </h3>
          <div class="text">
            <p>Cover shift for: '.$firstName. " " .$lastName.'</p>
            <p>Contact Info: '.$phone.'</p>
          </div>
          '.$button.'
        </div>
      </div>
    </li>

      ';
  }


  ?>

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
  <br><br>
    <h1 class="headerTitle">Search (Hit enter on keyboard to search)</h1>
    <form id="search" class="search" method="post" action="">
    <input type="text" name="searchText" placeholder="Search..">
    </form>
    <br>
    <h1 id="titleForSearch" style="display:none;" class="headerTitle">Search Results For Shifts Request:</h1>
    <ul id="searchList" class="flex-card-list">
    </ul>
        <br><br>
        <h1 class="headerTitle">All Shift Requests</h1>
        <ul class="flex-card-list">
              <?php 
               if ($result->num_rows > 0) {
                          
                while($row = $result->fetch_assoc()) {
                  $dateToGetCovered = $row['workDay'];
                  $timeStart = $row['requestTimeStart'];
                  $timeEnd = $row['requestTimeEnd'];
                  $shiftType = $row['shiftType'];
                  $additionalDetails = $row['requestDetails'];
                  $firstName = $row['firstName'];
                  $lastName = $row['lastName'];
                  $phone = $row['phone'];
                  $employeeCoveringID = $row['employeeCoveringID'];
                  populateSingleShiftRequest($dateToGetCovered, $timeStart, $timeEnd, $shiftType, $additionalDetails, $firstName, $lastName, $phone, $employeeCoveringID); 
                }
              }
              
              ?>






                <!--
                <div class="flex-card">
                    <div class="card-img"><img src="http://placehold.it/350x150"></div>
                    <div class="card-content">
                    <h3>Shift Cover Opportunity</h3>
                    <div class="text">
                        <p>Cover shift for:_________</p>
                    </div>
                    <a href="#" class="d-flex-card-button">Cover Shift</a>
                    </div>
                </div>
                </li>
                -->



              </ul>
  





  
  </body>
  <script>
  $("#search").submit(function (e) {
    e.preventDefault();
    // Get input field values
    var search_val = $('input[name=searchText]').val();

    // Simple validation at client's end
    // We simply change border color to red if empty field using .css()
    var proceed = true;

    if (search_val === "") {
        $('input[name=searchText]').css('border-color', 'red');
        proceed = false;
    }

    if (proceed) {
      $.ajax({
        url: "../modules/search.php",
        type: "post",
        data: {
          action: "shiftRequestSearch",
          search_value: search_val
        },

        success: function (response) {
            if(response === ""){
              $('#titleForSearch').text('No Results Found!'); 
              $('#titleForSearch').attr('style', '');
            } else {
              $('#titleForSearch').text('Search Results For Shifts Request:'); 
              $('#titleForSearch').attr('style', '');
              document.getElementById('searchList').innerHTML = response;

            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
    });
    }
});
  </script>
</html>