<?php
// Use dependencies commposer
require_once 'vendor/autoload.php';
require_once 'GraphHelper.php';

// Use features MSGraph
use Microsoft\Graph\Graph;
use Microsoft\Graph\Model;

// Load .env file
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$dotenv->required(['CLIENT_ID', 'TENANT_ID', 'GRAPH_USER_SCOPES']);

// Initialisze MS-Graph client authentification
GraphHelper::initializeGraphForAppOnlyAuth();
$graph = new Graph();

//Get the access token from MSGraph class
$token = GraphHelper::getAppOnlyToken();
    
//Set the access token to the GraphHelper class
$graph->setAccessToken($token);

// Request to get photo from user
$response = $graph->createRequest('GET', '/users/louis.nguyen@network-systems.fr/photo/$value')
    ->addHeaders( ["Content-Type" => "image/jpg"])
    ->execute();
?>

<html>
    <head>
        <title>MSGraph</title>
    </head>
    <body>
        <h1>MSGraph</h1>
        <h2>Get photo</h2>
        <p>Get photo from user</p>
        <!-- Display photo with getRawBody-->
        <img src="data:image/jpg;base64,<?php echo base64_encode($response->getRawBody()); ?>" />

    </body>
</html>
