<html>
    <head>
        <title>Create events</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <style>
            label {
                font-weight: semi bold;
                color: #dc3545;
            }
            button {
                background-color: #dc3545 !important;
                color:#FFF !important;
                text-shadow:0 1px 0 rgba(0, 0, 0, 0.4);
            }
           
        </style>
    </head>
<body>
    <h1>Create events</h1>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Create events</h1>

                <!-- Form post -->
                <form  method="POST" action="">
                    
                    <!-- Field texte -->
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input type="text" class="form-control is-invalid" id="subject" name="subject" placeholder="Subject">
                    </div>

                        <!-- Field select -->
                        <div class="form-group">
                            <label for="reminder">Reminder</label>
                        <select class="form-control is-invalid" id="reminderMinutesBeforeStart" name="reminderMinutesBeforeStart">
                            
                            <!-- Field option -->
                            <option value="0">No reminder</option>
                            <option value="15">15 minutes</option>
                            <option value="30">30 minutes</option>
                            <option value="60">1 hour</option>
                            <option value="120">2 hours</option>
                            <option value="1440">1 day</option>
                            <option value="2880">2 days</option>
                            <option value="4320">3 days</option>
                            <option value="10080">1 week</option>
                        </select>
                        </div>

                        <!-- Field texte -->
                        <div class="form-group">
                            <label for="body">Body</label>
                            <input type="text" class="form-control is-invalid" id="body" name="body" placeholder="Body">
                        </div>

                        <!-- Field date -->
                        <div class="form-group">
                            <label for="start">Start</label>
                            <input type="date" class="form-control is-invalid" id="start" name="start" placeholder="Start">
                        </div>
                        <div class="form-group">
                            <label for="end">End</label>
                            <input type="date" class="form-control is-invalid" id="end" name="end" placeholder="End">
                        </div>

                        <!-- Field email -->
                        <div class="form-group">
                            <label for="address">Email</label>
                            <input type="email" class="form-control is-invalid" id="attendees" name="attendees" placeholder="Email">
                        </div>

                        <!-- Button submit -->
                        <button type="submit" name="submit" value="Valider" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>



  



// Request with users
$response = $graph->createRequest('POST', '/users/louis.nguyen@network-systems.fr/events')
    ->attachBody($newEvent)
    ->setReturnType(Model\Event::class)
    ->execute();
}

// Return message error Bootstrap if inputs fields are empty
if (empty($_POST['subject']) || empty($_POST['attendees']) || empty($_POST['reminderMinutesBeforeStart']) || empty($_POST['body']) || empty($_POST['start']) || empty($_POST['end'])) {
    echo '<div class="alert alert-danger" role="alert">
    Veuillez remplir tous les champs.
    </div>';
}


// Return message success Bootstrap
if (isset($_POST['submit'])) {
    echo '<div class="alert alert-success" role="alert">
    Event created successfully !
    </div>';
}
// Return message error Bootstrap
else {
    echo '<div class="alert alert-danger" role="alert">
    Error !
    </div>';
}




?>