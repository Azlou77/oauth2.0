<html>
    <head>
        <title>Create tasks for plan</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <style>
            label {
                font-weight: semi bold;
                color: #28a745;
            }
            button {
                background-color: #28a745 !important;
                color:#FFF !important;
                text-shadow:0 1px 0 rgba(0, 0, 0, 0.4);
            }
           
        </style>
    </head>
    <body>

    <!-- Create form to create tasks for plan -->
     <div class="container">
            <div class="row">
                <div class="col">
                    <h1>Create tasks for plan</h1>
    
                    <!-- Form post -->
                    <form  method="POST" action="">

                        <!-- Field texte title -->
                        <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control is-invalid" id="title" name="title" placeholder="Title">
                        </div>

                        <!-- Field due date -->
                        <div class="form-group">
                                <label for="dueDate">Due date</label>
                                <input type="date" class="form-control" id="dueDateTime" name="dueDateTime" placeholder="Due date">
                        </div>
        
                        <!-- Button submit -->
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>

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