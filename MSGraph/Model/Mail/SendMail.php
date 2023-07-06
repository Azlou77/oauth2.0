<?php
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
<?php

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