<?php
    $url = "https://graph.microsoft.com/v1.0/me/messages/{id}/$value";
    $response = $client->get($url);
    $body = $response->getBody();
    $decodedBody = base64_decode($body);
    file_put_contents("message.eml", $decodedBody);
?>