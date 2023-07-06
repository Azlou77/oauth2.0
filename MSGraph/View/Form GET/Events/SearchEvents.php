<body>
<!-- Display duedates events -->
<h1>My duedates Events </h1>
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
                        <p><?php echo $event->getReminderMinutesBeforeStart(); ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    </body>
</html>

   