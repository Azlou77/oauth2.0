<html>
    <body>
    <!--Showing Calendar Events  -->
    <h1>My Events </h1>
    <table>
        <tr>
            <th>Subject</th>
            <th>Start</th>
            <th>End</th>
        </tr>
        <?php foreach ($events as $event) : ?>
            <tr>
                <td><?php echo $event->getSubject(); ?></td>
                <td><?php echo $event->getStart()->getDateTime(); ?></td>
                <td><?php echo $event->getEnd()->getDateTime(); ?></td>
            </tr>
        <?php endforeach; ?>
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