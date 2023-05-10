<!-- Create form to create plan -->
<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
       
    </head>
    <body>
    <h1>Create todo lists</h1>
    
       <!-- Form post -->
       <form  method="POST" action="">

        <!-- Field texte title -->
        <div class="form-group">
                <label for="title">Display name</label>
                <input type="text" class="form-control" id="title" name="displayName" placeholder="displayName">
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
$newTodoList = 
[
   // Set displayname
   "displayName" => "",
];

// Check if the form if the method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{

// Get POST values
$newTodoList = 
[
   // Set displayname
    "displayName" => $_POST["displayName"],
];


// Request to create todolist
$todolist = $graph->createRequest("POST", "/users/louis.nguyen@network-systems.fr/todo/lists")
->attachBody($newTodoList)
->setReturnType(Model\TodoTaskList::class)
->execute();


}
?>