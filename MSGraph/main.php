<!-- Include header for MSgraph dependencies and load env variables -->
<?php include './View/partials/header_PHP.php'; ?> 

<?php
use Microsoft\Graph\Model;
// Add request to get events from user
$events = $graph->createCollectionRequest('GET', '/users/louis.nguyen@network-systems.fr/events')
    ->setReturnType(Model\Event::class)
    ->setPageSize(25);  
$newEvents = $events->getPage();

?>

<!-- Include HTML header to dsiplay events -->
<html lang="en">
<?php include './View/partials/header_HTML.php'; ?>
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


