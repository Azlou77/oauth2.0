
    <body>
        
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
                        </div>

                        <!-- Script to add templates mails -->
                        <script="C:\wamp64\www\oauth2.0\MSGraph\Assets\js\autocomplete.js"></script>
                        
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


