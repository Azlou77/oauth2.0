<html>
    <head>
        <title>Send mail</title>
        <!-- Bootstrap assets-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <style>
        label {
            font-weight: semi bold;
            color: #007bff;
        }
        select {
            background: #007bff !important;
            color:#FFF !important;
            text-shadow:0 1px 0 rgba(0, 0, 0, 0.4);
        }
        option:not(:checked) {
                background-color: #FFF;
                color:#000 !important;
        }

    </style>
    </head>
    <body>
        <!-- Create form to send events -->
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1>Send mail</h1>
               
                    <!-- Form post -->
                    <form  method="POST" action="" enctype="multipart/form-data">
            
                        <!-- Field select-->
                        <div class="form-group">
                            <label for="select">Templates mails</label>
                            <select class="form-control" id="select" name="select">
                                <option id="none" value="send" >None</option>
                                <option id="candidate" value="send">Candidate</option>
                                <option id="recruiters" value="send">Recruiters</option>
                            </select>
                        <script>
                            /* Event onclik for options in the form
                            Filled automatically the fields form*/
                            // None option
                            document.getElementById("none").addEventListener("click", fillFormN);

                            function fillFormN() {
                            document.getElementById("subject").value = "";
                            document.getElementById("body").value = "";
                            }

                            // Candidate option
                            document.getElementById("candidate").addEventListener("click", fillFormC);

                            function fillFormC() {
                            document.getElementById("subject").value = "Candidate";
                            document.getElementById("body").value = "Je m'appelle Louis et je suis actuellement à la recherche d'un stage de fin d'études dans le domaine de l'informatique. ";
                            }

                            // Recruiter option
                            document.getElementById("recruiters").addEventListener("click", fillFormR);
                            function fillFormR() {
                            document.getElementById("subject").value = "Recruiter";
                            document.getElementById("body").value = "Je m'appelle Louis et je recrute dans le domaine de l'informatique. ";
                            }
                        </script>

                        <!-- Field texte subject -->
                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <input type="text" class="form-control is-invalid" id="subject" name="subject" placeholder="Subject">
                        </div>
                        

                        <!-- Field text body-->
                        <div class="form-group">
                            <label for="body">Body</label>
                            <input type="text" class="form-control is-invalid" id="body" name="body" placeholder="Body">
                        </div>

                        <!-- Field to set recipient -->
                        <div class="form-group">
                            <label for="email">Recipient</label>
                            <input type="email" class="form-control is-invalid" name="toRecipients" placeholder="Recipient">
                        </div>

                        <!-- Field to set attachment -->
                        <div class="form-group">
                            <label for="attachments">Attachment</label>
                            <input type="file" class="form-control-file" id="attachments" name="attachments">
                        </div>
    
                        <!-- Button submit -->
                        <button type="submit" name="submit" value="Valider" class="btn btn-primary">Submit</button>
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

/*  Helps to debug
echo 'Voici quelques informations de débogage :';
print_r($_FILES); 
echo '</pre>';*/

else {
    echo "Sorry, there was an error uploading your file.";
  }

}



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

// Return message error Bootstrap if inputs fields are empty
if (empty($_POST["subject"]) || empty($_POST["body"]) || empty($_POST["toRecipients"])) {
    echo '<div class="alert alert-danger" role="alert">Veuillez remplir tous les champs</div>';
  } else {
    echo '<div class="alert alert-success" role="alert">Votre mail a bien été envoyé</div>';
  }

// Send mail
$response = $graph->createRequest('POST', '/users/louis.nguyen@network-systems.fr/sendMail')
    ->attachBody($newMail)
    ->execute();
}



// Return message success Bootstrap
if ($response->getStatus() === 202) {
    echo '<div class="alert alert-success" role="alert">
    Mail envoyé avec succès !
    </div>';
}

// Return message error Bootstrap
else {
    echo '<div class="alert alert-danger" role="alert">
    Une erreur est survenue lors de l\'envoi du mail.
    </div>';
}

?>