<?php
// Only request specific properties
$select = '$select=from,isRead,receivedDateTime,subject';
// Sort by received time, newest first
$orderBy = '$orderBy=receivedDateTime DESC';

$ptr = $graph->createCollectionRequest('GET', '/users/9b3008f7-d1f4-4f8b-8a1a-163473441064/mailFolders/inbox/messages?'.$select.'&'.$orderBy)
                ->setReturnType(Model\Message::class)
                ->setPageSize(25);
$msgs = $ptr->getPage();

?>