<?php
// Use dependencies commposer
require_once 'vendor/autoload.php';
require_once 'GraphHelper.php';

// Use features MSGraph²
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
   "planId" => "g1TwMkyntEWczQ362ikmCpgAA6Dg",

   // Set bucket id
   "bucketId" => "Ug_9rFlJT02MKvRqZaVXjpgAJLOd", 

    // Set title
    "title" => "",

    // Set assignements
    "assignments" => [
        "6bb6a1cd-2dee-4e34-ae0d-3e585b4918ab" => [
            "@odata.type" => "#microsoft.graph.plannerAssignment",
            "orderHint" => " !"
        ]
    ],

    // Set due date
    "dueDateTime" => "",


];

// Check if the form if the method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{

// Get POST values
$newplanTasks = 
[
    // Set plan id
    "planId" => "g1TwMkyntEWczQ362ikmCpgAA6Dg",
    
    // Set bucket id
    "bucketId" => "Ug_9rFlJT02MKvRqZaVXjpgAJLOd" ,
    
     // Set title
     "title" => $_POST["title"],
    
     // Set assignements
     "assignments" => [
          "6bb6a1cd-2dee-4e34-ae0d-3e585b4918ab" => [
                "@odata.type" => "#microsoft.graph.plannerAssignment",
                "orderHint" => " !"
          ]
        ],


    // Set due date
    "dueDateTime" => $_POST["dueDateTime"],

];

// Request to create tasks for a plan
$response = $graph->createRequest("POST", "/planner/tasks")
    ->attachBody($newplanTasks)
    ->setReturnType(Model\PlannerTask::class)
    ->execute();
}

// Return message error Bootstrap if inputs fields are empty
if (empty($_POST["subject"]) || empty($_POST["body"]) || empty($_POST["toRecipients"])) {
    echo '<div class="alert alert-danger" role="alert">Veuillez remplir tous les champs</div>';
  } else {
    echo '<div class="alert alert-success" role="alert">Votre tâche a bien été envoyé</div>';
  }

// Return message success Bootstrap 
if ($response->getStatus() === 202) {
    echo '<div class="alert alert-success" role="alert">
Tâche envoyé avec succès !
    </div>';
}

// Return message error Bootstrap
else {
    echo '<div class="alert alert-danger" role="alert">
    Une erreur est survenue lors de l\'envoi de la âche.
    </div>';
}
?>