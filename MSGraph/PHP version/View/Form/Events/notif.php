<?php
// Request to send notifications on Teams channel
$response = $graph->createRequest('POST', '/teams/{id}/sendActivityNotification')
    ->attachBody($notifications)
    ->execute();