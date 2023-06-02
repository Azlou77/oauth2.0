<?php include 'SendEvents.php'; ?>

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
                                <!-- Display events MSGraph -->
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

        <!-- Card events -->
        <div style="order: 1; background: rgb(199, 245, 217); color: rgb(11, 65, 33);" class="event event-1" data-mdb-event-key="1" data-mdb-event-order="0" draggable="true" data-mdb-toggle="tooltip" data-mdb-offset="0,10" data-mdb-html="true" data-mdb-original-title="<h6><strong>Angular Meetup</strong></h6><p><small><em>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur</em></small></p><p class=&quot;mb-0&quot;><small>
    <i class=&quot;fas fa-calendar-alt pr-1&quot;></i>
    30/05/2023 <small class=&quot;fw-light&quot;>10:00</small> -
    05/06/2023 <small class=&quot;fw-light&quot;>14:00</small></small></p>"><?php echo $event->getSubject(); ?></div>
    
</body>
</html>
