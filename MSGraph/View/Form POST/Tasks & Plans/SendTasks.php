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
