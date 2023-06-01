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



//Get the events
$events = $graph->createCollectionRequest('GET', '/users/louis.nguyen@network-systems.fr/calendar/events')
    ->setReturnType(Model\Event::class);
$newEvents = $events->getPage();

?>
<html>
    <head>
        <title>Display events</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <style>
            table, th, td {
                border: 1px solid black;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <!-- Display events on cards -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $event->getSubject(); ?></h5>
                    <h6 class="card-subtitle mb-2 text-muted"><?php echo $event->getStart()->getDateTime(); ?></h6>
                    <h6 class="card-subtitle mb-2 text-muted"><?php echo $event->getEnd()->getDateTime(); ?></h6>
                    <p class="card-text"><?php echo $event->getBody() ?></p>
                </div>
                </div>

          
    </body>
</html>