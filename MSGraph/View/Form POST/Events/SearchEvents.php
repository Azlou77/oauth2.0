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


// Request to search duedates events

// Select properties
$select = '$select=subject,body,start,end,isReminderOn,reminderMinutesBeforeStart';

$searchEvents = $graph->createCollectionRequest('GET', '/users/louis.nguyen@network-systems.fr/events?' . $select)
                            ->setReturnType(Model\Event::class)
                            ->setPageSize(4);

$events = $searchEvents->getPage();

?>

<html>
    <head>
        <title>My Duedates Events</title>
        <!-- Bootstrap assets -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <!-- Bootstrap theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
        <!-- Bootstrap JS -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>
    <html>
    <body>
        <!-- Display duedates events -->
<h1>My duedates Events </h1>
<div class="container">
    <div class="row">
        <?php foreach ($events as $event): ?>
            <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                    <div class="caption">
                        <h3><?php echo $event->getSubject(); ?></h3>
                        <p><?php echo $event->getBody()->getContent(); ?></p>
                        <p><?php echo $event->getStart()->getDateTime(); ?></p>
                        <p><?php echo $event->getEnd()->getDateTime(); ?></p>
                        <p><?php echo $event->getReminderMinutesBeforeStart(); ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    </body>
</html>

   