<!-- Display tasks plans -->
<html>
    <head>
        <title>Tasks & Plans</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
        <style>
            .container {
                margin-top: 50px;
            }
        </style>
    </head>
    <body>
        <h1> Tasks</h1>
        <div class="container">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Plan id</th>
                        <th scope="col">Bucket id</th>
                        <th scope="col">Order hint</th>
                        <th scope="col">Assignments</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($newplantasks as $newplantask): ?>
                        <tr>
                            <td><?php echo $newplantask->getTitle(); ?></td>
                            <td><?php echo $newplantask->getPlanId(); ?></td>
                            <td><?php echo $newplantask->getBucketId(); ?></td>
                            <td><?php echo $newplantask->getOrderHint(); ?></td>
                            <td><?php echo $newplantask->getAssignments(); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
    </body>
</html>