<?php include 'header.php'; ?>
<h1>Send events</h1>
       
       <!-- Form post -->
        <form  method="POST" action="">

            <!-- Field texte subject -->
            <div class="form-group">
                <label for="subject">Subject</label>
                <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject">
            </div>

            <!-- Field select reminder -->
            <div class="form-group">
                <label for="reminder">Reminder</label>
                    <select class="form-control" id="reminderMinutesBeforeStart" name="reminderMinutesBeforeStart">
                        <!-- Field options -->
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

            <!-- Field text body-->
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

             <!--Field email and name -->
             <div class="form-group">
                <label for="attendees">Attendees</label>
                <input type="text" class="form-control" name="name" value="Hyro TSITANA ILOHARAOKE" placeholder="name">
                <input type="email" class="form-control" name="address" value="hyro.tsitana-iloharaoke@network-systems.fr" placeholder="email">
                <small  class="form-text text-muted">Enter the email of the attendees separated by a comma.</small>
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
     // Set empty attendees
     'attendees' => [
        'emailAddress' => [
            'address' => '',
            'name' => '',
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
                'address' => $_POST['emailAddress']['address'],
                'name' => $_POST['emailAddress']['name'],
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
?>







 

 
