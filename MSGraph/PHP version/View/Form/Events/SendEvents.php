<html>
    <head>
        <title>Create events</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <style>
            label {
                font-weight: semi bold;
                color: #dc3545;
            }
            button {
                background-color: #dc3545 !important;
                color:#FFF !important;
                text-shadow:0 1px 0 rgba(0, 0, 0, 0.4);
            }
           
        </style>
    </head>
<body>
    <h1>Create events</h1>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Create events</h1>

                <!-- Form post -->
                <form  method="POST" action="">
                    
                    <!-- Field texte -->
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input type="text" class="form-control is-invalid" id="subject" name="subject" placeholder="Subject">
                    </div>

                        <!-- Field select -->
                        <div class="form-group">
                            <label for="reminder">Reminder</label>
                        <select class="form-control is-invalid" id="reminderMinutesBeforeStart" name="reminderMinutesBeforeStart">
                            
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
                        </div>

                        <!-- Field texte -->
                        <div class="form-group">
                            <label for="body">Body</label>
                            <input type="text" class="form-control is-invalid" id="body" name="body" placeholder="Body">
                        </div>

                        <!-- Field date -->
                        <div class="form-group">
                            <label for="start">Start</label>
                            <input type="date" class="form-control is-invalid" id="start" name="start" placeholder="Start">
                        </div>
                        <div class="form-group">
                            <label for="end">End</label>
                            <input type="date" class="form-control is-invalid" id="end" name="end" placeholder="End">
                        </div>
                        <!-- Button submit -->
                        <button type="submit" name="submit" value="Valider" class="btn btn-primary">Submit</button>
                    </form>
                </div>
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


// define variables and set to empty values
$newEvent =
[
    // Set empty subject
    'subject' => '',
    // Set empty subject
    'reminderMinutesBeforeStart' => '',
    // Set empty reminder
    'isReminderOn' => true,
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
    // Set empty attendees
    'attendees' => [
        'emailAddress' => [
            'address' => '',
            'name' => ''
        ],
        'type' => 'required'
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
    // Set attendees
    'attendees' => [
        'emailAddress' => [
            'address' => $_POST['address'],
            'name' => $_POST['name']
        ],
        'type' => 'required'
    ],
  ];

// Request with users
$response = $graph->createRequest('POST', '/users/louis.nguyen@network-systems.fr/events')
    ->attachBody($newEvent)
    ->setReturnType(Model\Event::class)
    ->execute();
}

// Return message error Bootstrap if inputs fields are empty
if (empty($_POST["subject"]) || empty($_POST["body"]) || empty($_POST["attendees"]) || empty($_POST["start"]) || empty($_POST["end"]) || empty($_POST["reminderMinutesBeforeStart"])) {
    echo '<div class="alert alert-danger" role="alert">Veuillez remplir tous les champs</div>';
  } else {
    echo '<div class="alert alert-success" role="alert">Votre Evènement a bien été envoyé</div>';
  }

// Return message success Bootstrap 
if ($response->getStatus() === 202) {
    echo '<div class="alert alert-success" role="alert">
Evènement envoyé avec succès !
    </div>';
}

// Return message error Bootstrap
else {
    echo '<div class="alert alert-danger" role="alert">
    Une erreur est survenue lors de l\'envoi de l\evènement.
    </div>';
}



?>