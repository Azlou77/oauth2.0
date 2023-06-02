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

?>
<?php
//Get the events
$events = $graph->createCollectionRequest('GET', '/users/louis.nguyen@network-systems.fr/events')
->setReturnType(Model\Event::class)
->setPageSize(25);
$newEvent = $events->getPage()
?>