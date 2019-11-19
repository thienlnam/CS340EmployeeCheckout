<!DOCTYPE html>
<html>
<head>
    <title>Employee Timesheets</title>
	<!-- demo stylesheet -->
    	<link type="text/css" rel="stylesheet" href="../assets/css/layout.css" />
        <link type="text/css" rel="stylesheet" href="../assets/css/calendar_white.css" />
        <link rel="stylesheet" href="assets/css/main.css">
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
        <div class="main">

            <div style="float:left; width: 160px;">
                <div id="nav"></div>
            </div>
            <div style="margin-left: 160px;display='none';">
                <div id="dp"></div>
            </div>

            <script type="text/javascript">

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
                dp.theme = 'calendar_white'
                dp.eventDeleteHandling = "Update";

                dp.onEventDeleted = function(args) {
                    $.post("backend_delete.php",
                        {
                            id: args.e.id()
                        },
                        function() {
                            console.log("Deleted.");
                        });
                };

                dp.onEventMoved = function(args) {
                    $.post("backend_move.php",
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
                    $.post("backend_resize.php",
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
                    var name = prompt("New event name:", "Event");
                    dp.clearSelection();
                    if (!name) return;
                    var e = new DayPilot.Event({
                        start: args.start,
                        end: args.end,
                        id: DayPilot.guid(),
                        resource: args.resource,
                        text: name
                    });
                    dp.events.add(e);

                    $.post("backend_create.php",
                            {
                                start: args.start.toString(),
                                end: args.end.toString(),
                                name: name
                            },
                            function() {
                                console.log("Created.");
                            });

                };

                dp.onEventClick = function(args) {
                    alert("clicked: " + args.e.id());
                };

                dp.init();

                loadEvents();

                function loadEvents() {
                    dp.events.load("backend_events.php");
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

