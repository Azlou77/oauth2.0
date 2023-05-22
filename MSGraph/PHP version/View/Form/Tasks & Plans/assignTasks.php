<!-- Display assign tasks -->
<h1>Assign tasks</h1>
<table class="table">
    <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Plan id</th>
            <th scope="col">Order hint</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($newplanbuckets as $newplanbucket): ?>
            <tr>
                <td><?php echo $newplanbucket->getName(); ?></td>
                <td><?php echo $newplanbucket->getPlanId(); ?></td>
                <td><?php echo $newplanbucket->getOrderHint(); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>