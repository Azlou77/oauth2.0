<?php 
include './View/include/GraphInit.php';

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