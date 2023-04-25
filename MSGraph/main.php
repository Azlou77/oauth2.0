<?php
require_once 'vendor/autoload.php';
require_once 'GraphHelper.php';

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

//Set the users who participate to the event
$attendees = [];
array_push($attendees, [
        
    //Description user data
        'emailAddress' => [
        'address' => 'hyro.tsitana-iloharaoke@network-systems.fr',
        'name' => 'Hyro'
        ],
        
    //Precise if the users presence must come or not 
        'type' => 'required'
        ]);

    //Set the event data
    $newEvent = [
      'subject' => 'Test jeudi 13 avril 2022',
      'attendees' => $attendees,
     
    //Set the start and end date of the event
    'start' => [
      'dateTime' => '2023-06-12T22:00:00',
      'timeZone' => 'Pacific Standard Time'
    ],
    'end' => [
      'dateTime' => '2023-06-12T23:10:00',
      'timeZone' => 'Pacific Standard Time'
    ],

    //Set the goal of the event
    'body' => [
      "contentType" => "HTML",
      "content" => "Chat about new hire"
    ]
  ];

  //Get the events
  //Path where the requests will be sent
    $events = $graph->createRequest('GET', '/users/{user-id}/calendar/events')
    ->setReturnType(Model\Event::class)
    ->execute();
    echo "List all events";


 


?>

<html>
    <!--Showing Calendar Events  -->
    <h1>My Events </h1>
    <table>
        <tr>
            <th>Subject</th>
            <th>Start</th>
            <th>End</th>
        </tr>
        <?php foreach ($events as $event) : ?>
            <tr>
                <td><?php echo $event->getSubject(); ?></td>
                <td><?php echo $event->getStart()->getDateTime(); ?></td>
                <td><?php echo $event->getEnd()->getDateTime(); ?></td>
            </tr>
        <?php endforeach; ?>
   
</html>
