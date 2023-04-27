<!-- Fusion html form post and php main
     send data post in same page -->

<!-- Create form to send events -->
<html>
    <head>
        <title>Send event</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    </head>
    <body>
        <h1>Send events</h1>
       <!-- Form post -->
        <form  method="POST" action="">
            <!-- Field texte -->
            <div class="form-group">
                <label for="subject">Subject</label>
                <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject">
            </div>
                <!-- Field select -->
                <div class="form-group">
                <label for="reminder">Reminder</label>
                <select class="form-control" id="reminderMinutesBeforeStart" name="reminderMinutesBeforeStart">
                    <!-- Field option -->
                    <option value="0">No reminder</option>
                    <option value="15">15 minutes</option>
                    <option value="30">30 minutes</option>
                    <option value="60">1 hour</option>
                    <option value="120">2 hours</option>
                    <option value="1440">1 day</option>
                    <option value="2880">2 days</option>
                    <option value="4320">3 days</option>
                    <option value="10080">1 week</option>
                </select>
            <div class="form-group">
                <label for="body">Body</label>
                <input type="text" class="form-control" id="body" name="body" placeholder="Body">
            </div>
            <!-- Field date -->
            <div class="form-group">
                <label for="start">Start</label>
                <input type="date" class="form-control" id="start" name="start" placeholder="Start">
            </div>
            <div class="form-group">
                <label for="end">End</label>
                <input type="date" class="form-control" id="end" name="end" placeholder="End">
            </div>
            <!-- Button submit -->
            <button type="submit" name="submit" value="Valider" class="btn btn-primary">Submit</button>
        </form>
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


// define variables and set to empty values
$newEvent =
[
    'subject' => '',
    'reminderMinutesBeforeStart' => '',
    'isReminderOn' => true,
    'body' => [
        'contentType' => 'HTML',
        'content' => ''
    ],
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
  $newEvent = [
    'subject' => $_POST['subject'],
    // Set reminder
    'reminderMinutesBeforeStart' => $_POST['reminderMinutesBeforeStart'],
    'isReminderOn' => true,
    
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




 

 
// Version 2 separate files to send events
// Use dependencies commposer
// require_once 'vendor/autoload.php';
// require_once 'GraphHelper.php';

// // Use features MSGraph
// use Microsoft\Graph\Graph;
// use Microsoft\Graph\Model;

// // Load .env file
// $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
// $dotenv->load();
// $dotenv->required(['CLIENT_ID', 'TENANT_ID', 'GRAPH_USER_SCOPES']);

// // Initialisze MS-Graph client authentification
// GraphHelper::initializeGraphForAppOnlyAuth();
// $graph = new Graph();

// //Get the access token from MSGraph class
// $token = GraphHelper::getAppOnlyToken();
      
// //Set the access token to the GraphHelper class
// $graph->setAccessToken($token);

// //Create a new event
// $newEvent = [
//     'subject' => $_POST['subject'],
//     // Set reminder
//     'reminderMinutesBeforeStart' => $_POST['reminderMinutesBeforeStart'],
    
//     'body' => [
//         'contentType' => 'HTML',
//         'content' => $_POST['body']
//     ],
//     // Set start and end time
//     'start' => [
//         'dateTime' => $_POST['start'],
//         'timeZone' => 'Pacific Standard Time'
//     ],
//     'end' => [
//         'dateTime' => $_POST['end'],
//         'timeZone' => 'Pacific Standard Time'
//     ],

// ];

// // Request with users
// $response = $graph->createRequest('POST', '/users/louis.nguyen@network-systems.fr/events')
//     ->attachBody($newEvent)
//     ->setReturnType(Model\Event::class)
//     ->execute();

// // Debuging
// if ($response != null) {
//     echo "Event created successfully";
// } else {
//     echo "Error creating event";
// }

