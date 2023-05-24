

<!-- Display  tasks plan -->
<html>
    <head>
        <title>Tasks</title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    </head>
    <body>
        <h1>Tasks board</h1>
        <!-- Boststrap table -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Task ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Assignments</th>
                    <th scope="col">Created by</th>
                    <th scope="col">Created date</th>
                    <th scope="col">Duedate</th>
                </tr>
            </thead>
            <tbody>
                <!-- Loop through tasks -->
                <?php foreach ($tasks as $task): ?>
                    <tr>
                        <!-- Id -->
                        <td><?php echo $task->getId(); ?></td>

                        <!-- Title -->
                        <td><?php echo $task->getTitle(); ?></td>

                        <!-- Image of personne which tasks is asssigned to-->
                        <td><img src="<?php echo $task->getAssignments()->getAssignedTo()->getPhoto(); ?>" alt="Image of personne which tasks is asssigned to" width="50" height="50"></td>
                        
                        <!-- Name of personne which tasks is asssigned to-->
                        <td><?php echo $task->getCreatedBy(); ?></td>

                        <!-- Created date -->
                        <td><?php echo $task->getCreatedDateTime(); ?></td>

                        <!-- Due date -->
                        <td><?php echo $task->getDueDateTime(); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </body>
</html>
