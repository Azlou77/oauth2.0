<?php
// Request to save the content as file
$response = $graph->createRequest("POST", "/me/messages/{id}/attachments")
    ->attachBody($newMail)
    ->execute();




?>