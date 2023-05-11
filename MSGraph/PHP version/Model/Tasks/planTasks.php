<!-- Create form to create tasks for plan -->
<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
       
    </head>
    <body>
    <h1>Create tasks for plan </h1>
    
       <!-- Form post -->
       <form  method="POST" action="">

        <!-- Field texte title -->
        <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Title">
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
$newplanTasks = 
[
   // Set plan id
   "planId" => "",

   // Set bucket id
   "bucketId" => "", 

    // Set title
    "title" => "",

    // Set assignements
    "assignments" => [
        "6bb6a1cd-2dee-4e34-ae0d-3e585b4918ab" => [
            "@odata.type" => "#microsoft.graph.plannerAssignment",
            "orderHint" => " !"
        ]
    ]


];

// Check if the form if the method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{

// Get POST values
$newplanTasks = 
[
    // Set plan id
    "planId" => "A94Nset1eEy-nhtf2GrQvZgAH0Uf",
    
    // Set bucket id
    "bucketId" => "EFS1pRYH2EmwDZnlRH51upgABCLz" ,
    
     // Set title
     "title" => $_POST["title"],
    
     // Set assignements
     "assignments" => [
          "6bb6a1cd-2dee-4e34-ae0d-3e585b4918ab" => [
                "@odata.type" => "#microsoft.graph.plannerAssignment",
                "orderHint" => " !"
          ]
     ]
   
];


// Request to create tasks for a plan
$response = $graph->createRequest("POST", "/planner/tasks")
    ->attachBody($newplanTasks)
    ->setReturnType(Model\PlannerTask::class)
    ->execute();



}
?>