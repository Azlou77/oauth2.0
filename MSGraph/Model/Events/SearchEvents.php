<?php
// Request to search duedates events

// Select properties
$select = '$select=subject,body,start,end,isReminderOn,reminderMinutesBeforeStart';

$searchEvents = $graph->createCollectionRequest('GET', '/users/louis.nguyen@network-systems.fr/events?' . $select)
                            ->setReturnType(Model\Event::class)
                            ->setPageSize(4);

$events = $searchEvents->getPage();

?>
