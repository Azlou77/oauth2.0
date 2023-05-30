<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blazor Calendar</title>
    <!--Bootstrap assets-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!--Font awesome assets-->
    <script src="https://kit.fontawesome.com/2b554022ef.js" crossorigin="anonymous"></script>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
        <script>

document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');

  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    initialDate: '2023-05-07',
    headerToolbar: {
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth,timeGridWeek,timeGridDay'
    },
    events: [
        
    ],
  });
  calendar.render();

}
</script>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">
            <div class="ms-BrandIcon--icon48 ms-BrandIcon--outlook"></div>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
            aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
            </ul>
            <span class="navbar-text">
                Login Section
            </span>
        </div>
    </nav>

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

       
                      
                            <div class="day shadow-effect">
                                <h3 class="ms-fontSize-24 ms-fontWeight-regular">17</h3>

                                  <!-- Button modal-->
                                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                                    Open modal
                                  </button>
                                </div>
                                
                                <!-- The Modal -->
                                <div class="modal" id="myModal">
                                  <div class="modal-dialog modal-dialog-centered">
                                  <!-- Form post -->
                                  <form  method="POST" action="">
                                  <div class="modal-content">
                                
                                      <!-- Modal Header -->
                                      <div class="modal-header">
                                        <h5 class="modal-title">Add an event</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                      </div>
                                
                                      <!-- Modal body -->
                                      <div class="modal-body">
                                
                                      <!-- Input subject-->
                                        <div class="mb-3">
                                            <label for="" class="form-label">subject</label>
                                            <input type="text" class="form-control" id="subject" name="subject" placeholder="Enter subject">
                                      </div>
                                
                                        <!-- Input  body-->
                                        <div class="mb-3">
                                            <label for="body" class="form-label">body</label>
                                            <input type="text" class="form-control" id="body" name="body" placeholder="Enter body">
                                        </div>
                                   
                                
                                        <!-- Email attendees-->
                                        <div class="mb-3">
                                            <label for="attendees" class="form-label">attendees</label>
                                            <input type="email" class="form-control" id="attendees" name="attendees" placeholder="Enter attendees">
                                        </div>
                                
                                        <!-- Input start date-->
                                        <div class="mb-3">
                                            <label for="start" class="form-label">Start date</label>
                                            <input type="date" class="form-control" id="start" name="start">
                                        </div>

                                
                                        <!-- Input end date-->
                                        <div class="mb-3">
                                            <label for="end" class="form-label">End date</label>
                                            <input type="date" class="form-control" id="end" name="end">
                                        </div>

                                      </div>
                                    

                                
                                    
                                      <!-- Modal footer -->
                                      <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Add</button>
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                      </div>
                                
                                </div>
                                </form>
                               </div>
                             </div>   
                        
                 
             
</body>
</html>


<?php
// Use dependencies commposer
require_once 'vendor/autoload.php';
require_once 'GraphHelper.php';

// Use features MSGraph²
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
if (empty($_POST['subject']) || empty($_POST['attendees']) || empty($_POST['reminderMinutesBeforeStart']) || empty($_POST['body']) || empty($_POST['start']) || empty($_POST['end'])) {
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

// Request to get all events
$response = $graph->createRequest('POST', '/users/louis.nguyen@network-systems.fr/events')
    ->attachBody($newEvent)
    ->setReturnType(Model\Event::class)
    ->execute();



?>
