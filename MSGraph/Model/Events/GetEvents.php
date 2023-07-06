<?php
use Microsoft\Graph\Model;
// Add request to get events from user
$events = $graph->createCollectionRequest('GET', '/users/louis.nguyen@network-systems.fr/events')
    ->setReturnType(Model\Event::class)
    ->addHeaders(array('Prefer' => 'outlook.timezone="Europe/Paris"'))
    ->setPageSize(50);  
$newEvents = $events->getPage();

?>