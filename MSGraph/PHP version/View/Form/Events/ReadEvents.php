<html>
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