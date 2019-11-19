<!DOCTYPE html>
<html>
<title>Employee Timesheets</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../assets/css/main.css">
 <!-- Bootstrap CSS -->
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
 
<body>

<!-- Navbar (sit on top) -->
<div class="w3-top">
  <div class="w3-bar w3-white w3-wide w3-padding w3-card">
    <a href="index.php" class="w3-bar-item w3-button"><b>Employee</b> Timesheets</a>
    <!-- Float links to the right. Hide them on small screens -->
    <div class="w3-right w3-hide-small">
      <a href="#projects" class="w3-bar-item w3-button">Sites</a>
    <!--  <a href="#about" class="w3-bar-item w3-button">About</a>
      <a href="#contact" class="w3-bar-item w3-button">Contact</a>
    -->
    </div>
  </div>
</div>

<!-- Header -->
<header class="w3-display-container w3-content w3-wide" style="max-width:1500px;" id="home">
  <img class="w3-image" src="http://www.rochester.edu/parking/wp-content/uploads/2016/08/employees.jpg" alt="Architecture" width="1500" height="800">
  <div class="w3-display-middle w3-margin-top w3-center">
    <h1 class="w3-xxlarge w3-text-white"><span class="w3-padding w3-black w3-opacity-min"><b>Employee</b></span> <span class="w3-hide-small w3-text-light-grey">Timesheets</span></h1>
  </div>
</header>

<!-- Page content -->
<div class="w3-content w3-padding" style="max-width:1564px">

  <!-- Project Section -->
  <div class="w3-container w3-padding-32" id="projects">
    <h3 class="w3-border-bottom w3-border-light-grey w3-padding-16">Sites</h3>
  </div>

  <div class="w3-row-padding">
    <div class="w3-col l3 m6 w3-margin-bottom">
    <a href="./viewSchedule.php">
      <div class="w3-display-container">
        <div class="w3-display-topleft w3-black w3-padding">View Schedule</div>
        <img src="https://d3tvpxjako9ywy.cloudfront.net/blog/content/uploads/2017/05/rawpixel-633847-unsplash-1302x914.jpg?av=ebd3ac603a2f60d6cbc4a6428fc6f995" style="width:100%; height: 230px;">
      </div>
    </a>
    </div>
    <div class="w3-col l3 m6 w3-margin-bottom">
    <a href="./scheduleTime.php">
      <div class="w3-display-container">
        <div class="w3-display-topleft w3-black w3-padding">Schedule Time Off</div>
        <img src="http://www.hrovercoffee.com/wp-content/uploads/2017/01/Time-off.jpg"  style="width:100%; height: 230px;">
      </div>
    </a>
    </div>
    <div class="w3-col l3 m6 w3-margin-bottom">
    <a href="./coverShifts.php">
      <div class="w3-display-container">
        <div class="w3-display-topleft w3-black w3-padding">Cover Shifts</div>
        <img src="http://www.quickmeme.com/img/59/5929bfdc2eb7f2d36c59e45de7c7edc2b7c27c0662d70fd1b737928f85a1a6a0.jpg" style="width:100%; height: 230px;">
      </div>
    </a>
    </div>
    <div class="w3-col l3 m6 w3-margin-bottom">
      <a href="./employeeList.php">
        <div class="w3-display-container">
          <div class="w3-display-topleft w3-black w3-padding">Employee List</div>
          <img src="https://www.incimages.com/uploaded_files/image/970x450/getty_690855708_327837.jpg" style="width:100%; height: 230px;">
        </div>
      </a>
      </div>
    <div class="w3-col l3 m6 w3-margin-bottom">
   
    </div>
  </div>

<!-- End page content -->
</div>


<!-- Footer -->
<footer class="w3-center w3-black w3-padding-16">

</footer>

</body>
</html>
