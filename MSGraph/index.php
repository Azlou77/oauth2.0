<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar</title>
    <!--Bootstrap assets-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <!--Font awesome assets-->
    <script src="https://kit.fontawesome.com/2b554022ef.js" crossorigin="anonymous"></script>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <!-- Jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script> 

    <!-- Script fullcalendar Api -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
    <script>

        /* events as Json feed  from MSGraph*/
        document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',
          initialDate: '2021-06-07',
          headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
          },

           // Modal onclick dayGridMonth
           dateclick: function(info) {
            $('#myModal').modal('show');

           },
           // Display events from MSGraph
              events: 'https://graph.microsoft.com/v1.0/me/calendar/events',
                eventClick: function(info) {
                    info.jsEvent.preventDefault(); // don't let the browser navigate
                    if (info.event.url) {
                    window.open(info.event.url);
                    }
                },
                loading: function(bool) {
                    document.getElementById('loading').style.display =
                    bool ? 'block' : 'none';
                }
                


    
        });
        calendar.render();
        });
    </script>
<body>
    <!-- Navbar -->
    <?php include 'View/partials/navbar.php'; ?>

    <!-- Header -->
    <header>
        <h3 class="ms-fontSize-42 ms-fontWeight-regular">Welcome to Blazor Calendar</h3>
        <p class="ms-fontSize-14 ms-fontWeight-regular">Blaozr Calendar allows you to manage all you events within your
            Outlook Calendar</p>
        <!-- NotAuthenticated Users-->
        <p class="ms-fontSize-14 ms-fontWeight-regular">Please Sign in with your Micorosft Account to get started</p>
        <a href="#" class="microsoft-login-button shadow-effect"><img src="assets/images/microsoft.png" alt=""> Sign in
            with Microsoft</a>
    </header>

    <div class="row">
        <div id='calendar'></div>
       <?php  include 'View/partials/modal.php'; ?>
    </div>
</body>
</html>
