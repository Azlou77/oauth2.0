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

// Get calendar view
$events = $graph->createCollectionRequest('GET', '/users/louis.nguyen@network-systems.fr/calendarView?startDateTime=2023-05-05T10:00-22:00&endDateTime=2023-05-28T10:00-22:00')
    ->setReturnType(Model\Event::class);
$newEvents = $events->getPage();


?>
<html>
    <head>
        <title>Get calendar view</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
    </head>
    <body>
        <!-- Display calendar view -->
        <div class="container">
            <h1>Get calendar view</h1>
            <p>Get calendar view from user</p>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Subject</th>
                        <th scope="col">Start</th>
                        <th scope="col">End</th>
                        <th scope="col">Name </th>
                        <th  scope="col">Email</th>
                        <th scope="col">Name attendees </th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($newEvents as $event) {
                        echo "<tr>";
                        echo "<td>" . $event->getSubject() . "</td>";
                        echo "<td>" . $event->getStart()->getDateTime() . "</td>";
                        echo "<td>" . $event->getEnd()->getDateTime() . "</td>";
                        echo "<td>" . $event->getOrganizer()->getEmailAddress()->getName() . "</td>";
                        echo "<td>" . $event->getOrganizer()->getEmailAddress()->getAddress() . "</td>";
                        
                        // Get properties to retrieve emailAddress 
                        $address = $event->getAttendees();
                        $name = $event->getAttendees();

                        //  Json encode to convert object to string -->
                        echo "<td>" . json_encode($name) . "</td>";
                        echo "<td>" . json_encode($address) . "</td>";

                        // Hide properties type, status, response, time from attendees
                        echo "<td>" . json_encode($name, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PARTIAL_OUTPUT_ON_ERROR) . "</td>";
                        echo "<td>" . json_encode($address, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PARTIAL_OUTPUT_ON_ERROR) . "</td>";
                        

                     
                          echo "</tr>";
                    }

                    ?>
                </tbody>
            </table>
            
        </div>
    </body>
</html>