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

//Create a new event
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



?>
