<html>
    <body>
      <!--Showing Calendar Events  -->
      <h1>My Events </h1>

<!-- Display events with bootstrap  -->
<table class="table table-striped">
    <thead>
        <tr>
            <th>Subject</th>
            <th>Start</th>
            <th>End</th>
            <th>Attendees</th>
            <th>Reminder</th>
            <th>Body</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Loop to display all events
        foreach ($events as $event) {
            echo '<tr>';
            echo '<td>' . $event->getSubject() . '</td>';
            echo '<td>' . $event->getStart()->getDateTime() . '</td>';
            echo '<td>' . $event->getEnd()->getDateTime() . '</td>';
            echo '<td>' . $event->getAttendees()[0]->getEmailAddress()->getAddress() . '</td>';
            echo '<td>' . $event->getReminderMinutesBeforeStart() . '</td>';
            echo '<td>' . $event->getBody()->getContent() . '</td>';
            echo '</tr>';
        }
        ?>
    </tbody>
</table>    


      <!-- Display events on card using bootstrap template -->
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
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
      </div>
    </body>
</html>