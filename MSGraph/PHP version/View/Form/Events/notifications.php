    <!-- Create form to send events -->
    <html>
        <head>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        </head>
        <body>
        <h1>Send notifications</h1>

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
    Request to send notifications */

    // Create new notifications
    $newMail = [
        'message' => [

            // Set topic
            'topic' => [
                'source' => 'entityUrl',
                'value' => 'https://graph.microsoft.com/v1.0/users/{userId}/teamwork/installedApps/{installationId}',

            ],

            // Set activityType
            'activityType' => $taskCreated,

            // Set previewText
            'previewText' => [
                'content' => '',
            ],
            // Set templateParameters 
            'templateParameters' => [
                [
                    'name' => '',
                    'value' => '',
                
                ],
            ],
        ],

    ];


    /* Get post variables 
    Request to send notifications */

    // Check if the form if the method is POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

    /* Create new notifications
    Get post recipients in array */

    $notifications = [
        'topic' => [
            'source' => 'entityUrl',
            'value' => $_POST["value"],

        ],
        // Set activityType
        'activityType' => $taskCreated,

        // Set previewText
        'previewText' => [
            'content' => $_POST["content"],
        ],
        // Set templateParameters
        'templateParameters' => [
            [
                'name' => '',
                'value' => '',
            
            ],
        ],
    ];


    // Send notifications
    $response = $graph->createRequest('POST', '/users/louis.nguyen@network-systems.fr/teamwork/sendActivityNotification')
        ->attachBody($newMail)
        ->execute();
    }

    ?>
