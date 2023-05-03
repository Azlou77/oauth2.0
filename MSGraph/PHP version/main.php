<!-- Create form to send events -->
<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    </head>
    <body>
       <h1>Send mail</h1>

       <!-- Form post -->
        <form  method="POST" action="" enctype="multipart/form-data">

            <!-- Field texte subject -->
            <div class="form-group">
                <label for="subject">Subject</label>
                <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject">
            </div>

          

            <!-- Field text body-->
            <div class="form-group">
                <label for="body">Body</label>
                <input type="text" class="form-control" id="body" name="body" placeholder="Body">
            </div>

              <!-- Field to set recipient -->
              <div class="form-group">
                <label for="email">Recipient</label>
                <input type="email" class="form-control" name="toRecipients" placeholder="Recipient">
            </div>

            <!-- Field to set attachment -->
            <div class="form-group">
                <label for="attachments">Attachment</label>
                <input type="file" class="form-control-file" id="attachments" name="attachments">

   
            <!-- Button submit -->
            <button type="submit" name="submit" value="Valider" class="btn btn-primary">Submit</button>
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

/* Define variables and set to empty values
Request to send mail */

// Set recipients in array
$toRecipients = [];
array_push($toRecipients,
[
    'emailAddress' => [
        'address' => '',
    ],
  ]
);

// File which contains all verifications
include 'View/include/upload.php';


// Create new mail
$newMail = [
    'message' => [

        // Set subject
        'subject' => '',

        // Set body
        'body' => [
            'contentType' => 'Text',
            'content' => '',
        ],
        // Set recipients
        'toRecipients' => $toRecipients,
    ],
    // 
];


/* Get post variables 
   Request to send mail */

// Check if the form if the method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

/* Create new mail
   Get post recipients in array */

$toRecipients = [];
array_push($toRecipients,
    [
        'emailAddress' => [
            'address' => $_POST['toRecipients'],
        ],
    ]
);
$newMail = [
    'message' => [

        // Get post subject
        'subject' => $_POST['subject'],

        // Get post recipients
        'toRecipients' => $toRecipients,

        // Get post body
        'body' => [
            'contentType' => 'Text',
            'content' => $_POST['body'],
        ],  
    ],
]; 

// Send mail
$response = $graph->createRequest('POST', '/users/louis.nguyen@network-systems.fr/sendMail')
    ->attachBody($newMail)
    ->execute();
}
?>


