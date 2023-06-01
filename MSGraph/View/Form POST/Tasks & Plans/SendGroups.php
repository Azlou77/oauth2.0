<!-- Create form to create groups -->
<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
       
    </head>
    <body>
    <h1>Create groups</h1>
    
       <!-- Form post -->
       <form  method="POST" action="">

        <!-- Field texte displayName -->
        <div class="form-group">
                <label for="title">displayName</label>
                <input type="text" class="form-control" id="displayName" name="displayName" placeholder="displayName">
        </div>

        <!-- Field texte description -->
        <div class="form-group">
                <label for="title">description</label>
                <input type="text" class="form-control" id="description" name="description" placeholder="description">
        </div>

        <!-- Field texte mailNickname -->
        <div class="form-group">
                <label for="title">mailNickname</label>
                <input type="text" class="form-control" id="mailNickname" name="mailNickname" placeholder="mailNickname">
        </div>


        <!-- Button submit -->
        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </body>
</html>
