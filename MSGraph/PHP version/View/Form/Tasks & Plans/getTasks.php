<!-- Display  tasks plan -->
<html>
    <head>
        <title>Tasks</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <h1>Tasks board</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Title</th
                    <th>Created by</th>
                    <th>Created date time</th>
                    <th>Due date time</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tasks as $task): ?>
                    <tr>
                        <td><?php echo $task->getId(); ?></td>
                        <td><?php echo $task->getTitle(); ?></td>
                        <td><?php echo $task->getCreatedBy()->getEmailAddress()->getAddress(); ?></td>
                        <td><?php echo $task->getCreatedDateTime(); ?></td>
                        <td><?php echo $task->getDueDateTime(); ?></td>
                        <td><?php echo $task->getCompletedDateTime(); ?></td>
                        <td><?php echo $task->getCompletedBy()->getEmailAddress()->getAddress(); ?></td>
                        <td><?php echo $task->getPercentComplete(); ?></td>
                        <td><?php echo $task->getBucketId(); ?></td>
                        <td><?php echo $task->getPlanId(); ?></td>
                        <td><?php echo $task->getBucketName(); ?></td>
                        <td><?php echo $task->getPlanName(); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>

    </body>
</html>
