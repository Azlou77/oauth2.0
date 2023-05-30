<!-- Create form to create groups -->
<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
       
    </head>
    <body>
    <h1>Create groups</h1>
    
       <!-- Form post -->
       <form  method="POST" action="">

        <!-- Field texte displayName -->
        <div class="form-group">
                <label for="title">displayName</label>
                <input type="text" class="form-control" id="displayName" name="displayName" placeholder="displayName">
        </div>

        <!-- Field texte description -->
        <div class="form-group">
                <label for="title">description</label>
                <input type="text" class="form-control" id="description" name="description" placeholder="description">
        </div>

        <!-- Field texte mailNickname -->
        <div class="form-group">
                <label for="title">mailNickname</label>
                <input type="text" class="form-control" id="mailNickname" name="mailNickname" placeholder="mailNickname">
        </div>


        <!-- Button submit -->
        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </body>
</html>

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


// define variables and set to empty values
$newGroup = 
[
    // Set displayName
    "displayName" => "",

    // Set description
    "description" => "",

    // Set groupTypes
    "groupTypes" => [
        "Unified"
    ],

    // Set mailEnabled
    "mailEnabled" => true,

    // Set mailNickname
    "mailNickname" => "",

    // Set securityEnabled
    "securityEnabled" => false

];

// Check if the form if the method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{

// Get POST values
$newGroup = 
[
    // Set displayName
    "displayName" => $_POST["displayName"],

    // Set description
    "description" => $_POST["description"],

    // Set groupTypes
    "groupTypes" => [
        "Unified"
    ],

    // Set mailEnabled
    "mailEnabled" => true,

    // Set mailNickname
    "mailNickname" => $_POST["mailNickname"],

    // Set securityEnabled
    "securityEnabled" => false
];


// Request to create groups
$request = $graph->createRequest("POST", "/groups")
    ->attachBody($newGroup)
    ->setReturnType(Model\Group::class)
    ->execute();

}
?>