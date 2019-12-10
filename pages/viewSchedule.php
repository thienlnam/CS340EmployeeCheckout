<!DOCTYPE html>
<html>
<head>
    <title>Employee Timesheets</title>
	<!-- demo stylesheet -->
    	<link type="text/css" rel="stylesheet" href="../assets/css/layout.css" />
        <link type="text/css" rel="stylesheet" href="../assets/css/calendar_white.css" />
        <link rel="stylesheet" href="../assets/css/main.css">
	<!-- helper libraries -->
	<script src="../js/jquery-1.9.1.min.js" type="text/javascript"></script>

	<!-- daypilot libraries -->
        <script src="../js/daypilot/daypilot-all.min.js" type="text/javascript"></script>

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
<fieldset id="employees">
<h2>Select Employee:</h2>
  <select name="shiftID" class="largeInput" onchange="updateFields(this.value)">
    <option></option>
    <?php
        require_once('../dbFunctions.php');
        $db = new dbfunctions();
        $result = $db->selectEmployees();
    if ($result->num_rows > 0) {
        
      while($row = $result->fetch_assoc()) {
  
        echo '
        <option value="'.$row['employeeID'].'">'.$row['lastName']. ", " .$row['firstName'].'</option>
        ';
     
      }
    }


    ?>
  </select>
</fieldset>
        <div class="main">

            <div style="float:left; width: 160px;">
                <div id="nav"></div>
            </div>
            <div style="margin-left: 160px;display='none';">
                <div id="dp"></div>
            </div>

            <script type="text/javascript">
                var employeeID = -1;
                var nav = new DayPilot.Navigator("nav");
                nav.showMonths = 3;
                nav.skipMonths = 3;
                nav.selectMode = "week";
                nav.onTimeRangeSelected = function(args) {
                    dp.startDate = args.day;
                    dp.update();
                    loadEvents();
                };
                nav.init();

                var dp = new DayPilot.Calendar("dp");
                dp.viewType = "Week";
                dp.theme = 'calendar_white';
                dp.eventDeleteHandling = "Enabled";
            
                dp.onEventDeleted = function(args) {
                    dp.events.remove(args.e);
                    $.post("../modules/backend_delete.php",
                        {
                            id: args.e.id()
                        },
                        function(data) {
                            
                        });
                };

                dp.onEventMoved = function(args) {
                    $.post("../modules/backend_move.php",
                            {
                                id: args.e.id(),
                                newStart: args.newStart.toString(),
                                newEnd: args.newEnd.toString()
                            },
                            function() {
                                console.log("Moved.");
                            });
                };

                dp.onEventResized = function(args) {
                    $.post("../modules/backend_resize.php",
                            {
                                id: args.e.id(),
                                newStart: args.newStart.toString(),
                                newEnd: args.newEnd.toString()
                            },
                            function() {
                                console.log("Resized.");
                            });
                };

                // event creating
                dp.onTimeRangeSelected = function(args) {
                    //first add to db
                    var name = prompt("New event name:", "Event");
                    var index = -1;
                    console.log(args.start.toString());
                    $.post("../modules/backend_create.php",
                    {
                        id: employeeID,
                        start: args.start.toString(),
                        end: args.end.toString(),
                        name: name
                    },
                    function(data) {
                        allevents = JSON.parse(data);
                           index = allevents.id;
                    });
                    
                    
                    
                   
                    var id = DayPilot.guid();
                    dp.clearSelection();
                    if (!name) return;
                    var e = new DayPilot.Event({
                        start: args.start,
                        end: args.end,
                        id: index,
                        resource: args.resource,
                        text: name
                    });
                    dp.events.add(e);

                    

                };

                dp.onEventClick = function(args) {
                    alert("clicked: " + args.e.id());
                };

                dp.init();

                loadEvents();

                function loadEvents() {
                    dp.events.load("../modules/backend_events.php");
                }
                
                function updateFields(shiftID){
                    employeeID = shiftID;
                    var params = {
                        id: shiftID
                      };

                      $.post("../modules/backend_events.php", JSON.stringify(params), function(data) {
                             console.log(data);
                             allevents = JSON.parse(data);
                             
                             var i = 0;
                             for(value in allevents){
                             var e = new DayPilot.Event({
                                                        start: allevents[i].start,
                                                        end: allevents[i].end,
                                                        id: allevents[i].id,
                                                        text: allevents[i].text
                                                        });
                                dp.events.add(e);
                             i = i + 1;
                             }
                      });
                    
                    var dropdown = document.getElementById('employees');
                    dropdown.style.display = 'none';
                }
                
            </script>

            <script type="text/javascript">
            $(document).ready(function() {
                $("#theme").change(function(e) {
                    dp.theme = this.value;
                    dp.update();
                });
            });
            </script>

        </div>
        <div class="clear">
        </div>
</body>

</html>

