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
        document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',
            initialDate: '2021-07-07',
            headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },

        // Modal onclick dayGridMonth
        dateClick: function(info) {
        $('#myModal').modal('show');
        },

		// Events sources options
        EventSources : [
            {
                url: 'https://graph.microsoft.com/v1.0/users/louis.nguyen@network-systems.fr/events',
                method: 'POST',
                extraParams: {
                    orderby: 'createdDateTime DESC',
                    select: 'subject,organizer,start,end,attendees,bodyPreview',
                    top: 50
                },
                failure: function() {
                    alert('there was an error while fetching events!');
                },
                color: 'yellow',   // a non-ajax option
                textColor: 'black' // a non-ajax option
            }
        ],
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

<?php
// Use dependencies commposer
require_once 'vendor/autoload.php';
require_once 'GraphHelper.php';

// Use features MSGraph
use Microsoft\Graph\Graph;
use Microsoft\Graph\Model;

// Load .env file
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$dotenv->required(['CLIENT_ID', 'TENANT_ID', 'GRAPH_USER_SCOPES']);

// Initialisze MS-Graph client authentification
GraphHelper::initializeGraphForAppOnlyAuth();
$graph = new Graph();

//Get the access token from MSGraph class
$token = GraphHelper::getAppOnlyToken();
    
//Set the access token to the GraphHelper class
$graph->setAccessToken($token);
// Set attendees
$attendees = [];
array_push($attendees, [
        'emailAddress' => [
        'address' => '',
        'name' => ''
        ],
        'type' => 'required'
        ]);

// define variables and set to empty values
$newEvent =
[
    // Set empty subject
    'subject' => '',

    // Set attendees
    'attendees' => $attendees,


  
    // Set empty body
    'body' => [
        'contentType' => 'HTML',
        'content' => ''
    ],
    // Set empty start and end time
    'start' => [
        'dateTime' => '',
        'timeZone' => 'Pacific Standard Time'
    ],
    'end' => [
        'dateTime' => '',
        'timeZone' => 'Pacific Standard Time'
    ],
    
];



// Check if the form if the method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Set attendees
    $attendees = [];
    array_push($attendees, [
            'emailAddress' => [
            'address' => $_POST['attendees'],
            'name' => $_POST['attendees']
            ],
            'type' => 'required'
            ]);

  $newEvent = [
    'subject' => $_POST['subject'],
    'attendees' => $attendees,

    'body' => [
        'contentType' => 'HTML',
        'content' => $_POST['body']
    ],
    // Set start and end time
    'start' => [
        'dateTime' => $_POST['start'],
        'timeZone' => 'Pacific Standard Time'
    ],
    'end' => [
        'dateTime' => $_POST['end'],
        'timeZone' => 'Pacific Standard Time'
    ],
  ];
  

// Request with users
$response = $graph->createRequest('POST', '/users/louis.nguyen@network-systems.fr/events')
    ->attachBody($newEvent)
    ->setReturnType(Model\Event::class)
    ->execute();
}

// Return message error Bootstrap if inputs fields are empty
if (empty($_POST['subject']) || empty($_POST['attendees'])  || empty($_POST['body']) || empty($_POST['start']) || empty($_POST['end'])) {
    echo '<div class="alert alert-danger" role="alert">
    Veuillez remplir tous les champs.
    </div>';
}


// Return message success Bootstrap
if (isset($_POST['submit'])) {
    echo '<div class="alert alert-success" role="alert">
    Event created successfully !
    </div>';
}
// Return message error Bootstrap
else {
    echo '<div class="alert alert-danger" role="alert">
    Error !
    </div>';
}


?>
