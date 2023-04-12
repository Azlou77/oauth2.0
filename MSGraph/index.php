<?php

// Enable loading of Composer dependencies
require_once realpath(__DIR__ . '/vendor/autoload.php');
require_once 'GraphHelper.php';

print('PHP Graph Tutorial'.PHP_EOL.PHP_EOL);

// Load .env file
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$dotenv->required(['CLIENT_ID', 'TENANT_ID', 'GRAPH_USER_SCOPES']);

//Get env variables
$clientId = $_ENV['CLIENT_ID'];
$tenantId = $_ENV['TENANT_ID'];
$scopes = $_ENV['GRAPH_USER_SCOPES'];

//Add device code for an acess token
$deviceCode = GraphHelper::getDeviceCode($clientId, $tenantId, $scopes);
print('Please go to the following URL and enter the code: '.$deviceCode->verification_uri.PHP_EOL);
print('Code: '.$deviceCode->user_code.PHP_EOL);

//Get acess token
$accessToken = GraphHelper::getAccessToken($clientId, $tenantId, $deviceCode->device_code, $scopes);
print('Access token: '.$accessToken.PHP_EOL);

//Check if token is valid
if (GraphHelper::isTokenValid($accessToken)) {
    print('Token is valid'.PHP_EOL);
} else {
    print('Token is not valid'.PHP_EOL);
}

//Display messages inbox
$messages = GraphHelper::getMessages($accessToken);
print('Messages:'.PHP_EOL);
foreach ($messages as $message) {
    print('Subject: '.$message->subject.PHP_EOL);
    print('From: '.$message->from->emailAddress->address.PHP_EOL);
    print('Body: '.$message->bodyPreview.PHP_EOL);
    print('Received: '.$message->receivedDateTime.PHP_EOL);
    print('Is read: '.$message->isRead.PHP_EOL);
    print('Has attachments: '.$message->hasAttachments.PHP_EOL);
    print('Web link: '.$message->webLink.PHP_EOL);
    print(''.PHP_EOL);
}



?>
<html>
<head>
    <title>PHP Graph Tutorial</title>
    <!-- Boosstrap style -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <!-- Boosstrap script -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
</head>
<body>
    <h1>PHP Graph Tutorial</h1>
    <p>Check the console for the output.</p>
    
</body>
</html>