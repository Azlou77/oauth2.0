<!-- Create form to send events -->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    </head>
    <body>
       <h1>Send mail</h1>

       <!-- Form post -->
        <form  method="POST" action="formFileTest.php" enctype="multipart/form-data">

            <!-- Field to set attachment -->
            <div class="form-group">
                <label for="attachments">Attachment</label>
                <input type="file" class="form-control" id="attachments" name="attachments" placeholder="Attachment">
            </div>


            <!-- Button submit -->
            <button type="submit" name="submit" value="Valider" class="btn btn-primary">Submit</button>
        </form>
    </body>
</html>



<?php


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







?>
