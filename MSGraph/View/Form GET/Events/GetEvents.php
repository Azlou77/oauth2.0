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
        <title>Get events</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
    </head>
    <body>
        <!-- Display events -->
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>Events</h1>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Subject</th>
                                <th scope="col">Start</th>
                                <th scope="col">End</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($newEvents as $event) {
                                echo "<tr>";
                                echo "<td>" . $event->getSubject() . "</td>";
                                echo "<td>" . $event->getStart()->getDateTime() . "</td>";
                                echo "<td>" . $event->getEnd()->getDateTime() . "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>










            


        </div>
    </body>
</html>