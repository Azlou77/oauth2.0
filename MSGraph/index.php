<?php include 'SendEvents.php'; ?>

<?php   
//Get the events
$events = $graph->createCollectionRequest('GET', '/users/louis.nguyen@network-systems.fr/events')
->setReturnType(Model\Event::class)
->setPageSize(25);

$newEvent = $events->getPage()

?>

<?php 
// Return message success Bootstrap
if (isset($_POST['submit'])) {
    echo '<div class="alert alert-success" role="alert">
    Event created successfully !
    </div>';
}
// Return message error Bootstrap
else {
    echo '<div class="alert alert-danger" role="alert">
    Error !
    </div>';
}
?>

<?php include 'View/partials/header.php'; ?>

<body>
    <!-- Navbar -->
    <?php include 'View/partials/navbar.php'; ?>

    <!-- Header -->
    <header>
        <h3 class="ms-fontSize-42 ms-fontWeight-regular">Welcome to Blazor Calendar</h3>
        <p class="ms-fontSize-14 ms-fontWeight-regular">Blaozr Calendar allows you to manage all you events within your
            Outlook Calendar</p>
        <!-- NotAuthenticated Users-->
        <p class="ms-fontSize-14 ms-fontWeight-regular">Please Sign in with your Micorosft Account to get started</p>
        <a href="#" class="microsoft-login-button shadow-effect"><img src="assets/images/microsoft.png" alt=""> Sign in
            with Microsoft</a>
    </header>

       <div class="container">
        <div class="row">
            <div id='calendar'></div>
            <?php  include 'View/partials/modal.php'; ?>
            <h1>Display events</h1>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Subject</th>
                                        <th>Body</th>
                                        <th>Start</th>
                                        <th>End</th>
                                    </tr>
                                </thead>
                        <?php foreach ($newEvent as $event): ?>
                            <tr>
                                <td><?php echo $event->getSubject(); ?></td>
                                <td><?php echo $event->getBody()->getContent(); ?></td>
                                <td><?php echo $event->getStart()->getDateTime(); ?></td>
                                <td><?php echo $event->getEnd()->getDateTime(); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
</body>
</html>
