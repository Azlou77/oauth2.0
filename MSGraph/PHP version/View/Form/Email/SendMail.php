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
$target_dir = "C:/Users/user1/AppData/Roaming/Microsoft/Templates";

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
if($imageFileType != "oft") {
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

