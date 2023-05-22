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

// Only request specific properties
$select = 'id,title,assignments,createdBy,createdDateTime,dueDateTime';


// Get tasks plan
$tasks = $graph->createRequest('GET', '/planner/plans/A94Nset1eEy-nhtf2GrQvZgAH0Uf/tasks?'.$select)
    ->setReturnType(Model\PlannerTask::class)
    ->execute();
    
?>

