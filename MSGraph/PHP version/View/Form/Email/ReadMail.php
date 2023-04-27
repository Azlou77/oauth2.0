<html>
    <!-- Display inbox messages -->
    <h1>My inbox</h1>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">From</th>
                <th scope="col">Subject</th>
                <th scope="col">Received</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($msgs as $msg): ?>
                <tr>
                    <td><?php echo $msg->getFrom()->getEmailAddress()->getName(); ?></td>
                    <td><?php echo $msg->getSubject(); ?></td>
                    <td><?php echo $msg->getReceivedDateTime()->format('Y-m-d H:i:s'); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
</html>