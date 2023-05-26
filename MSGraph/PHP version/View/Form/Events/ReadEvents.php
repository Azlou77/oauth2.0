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
            <h1>Display events</h1>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Subject</th>
                        <th>Body</th>
                        <th>Start</th>
                        <th>End</th>
                        <th>Reminder</th>
                        <th>Reminder minutes before start</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($newEvents as $event): ?>
                        <tr>
                            <td><?php echo $event->getSubject(); ?></td>
                            <td><?php echo $event->getBody()->getContent(); ?></td>
                            <td><?php echo $event->getStart()->getDateTime(); ?></td>
                            <td><?php echo $event->getEnd()->getDateTime(); ?></td>
                            <td><?php echo $event->getIsReminderOn(); ?></td>
                            <td><?php echo $event->getReminderMinutesBeforeStart(); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </body>
</html>