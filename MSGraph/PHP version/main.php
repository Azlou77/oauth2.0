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
// Create new mail
$newMail = [
    'message' => [

        // Set subject
        'subject' => '',

        // Set recipients
        'toRecipients' => $toRecipients,

        // Set body
        'body' => [
            'contentType' => 'Text',
            'content' => '',
        ],
        // Set attachments files
        'attachments' => [
            [
                '@odata.type' => '#microsoft.graph.fileAttachment',
                'name' => '',
                'contentBytes' => '',
               
            ],
        ],
    ],

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

// Verifications files
if   (!empty($_FILES['attachments']['name']))
{

//Define files's location to be uploaded
$target_dir = "uploads/";

//Define files's format
$target_file = $target_dir . basename($_FILES["attachments"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
  }

// Check file size
if ($_FILES["attachments"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
  } 

// Allow certain file formats
if($imageFileType != "png") {
    echo "Sorry, only oft models outlook files are allowed.";
    $uploadOk = 0;
  }

//  Helps to debug
echo 'Voici quelques informations de débogage :';
print_r($_FILES); 

echo '</pre>';
}

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
        // Get post attachments files
        'attachments' => [
            [
                '@odata.type' => '#microsoft.graph.fileAttachment',
                'name' => $_FILES['attachments'] ['name'],
               
                // Encode file in base64
                'contentBytes' => base64_encode($_FILES['attachments'] ['tmp_name']),

            ],

        ],
    ],

]; 

// Send mail
$response = $graph->createRequest('POST', '/users/louis.nguyen@network-systems.fr/sendMail')
    ->attachBody($newMail)
    ->execute();
}

?>


