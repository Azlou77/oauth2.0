<html>
    <head>
        <title>Send event</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    </head>
    <body>
        <h1>Send events</h1>
        <!-- Create form to send events -->
        <form>
            <div class="form-group">
                <label for="subject">Subject</label>
                <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject">
            </div>
            <div class="form-group">
                <label for="body">Body</label>
                <input type="text" class="form-control" id="body" name="body" placeholder="Body">
            </div>
            <div class="form-group">
                <label for="start">Start</label>
                <input type="date" class="form-control" id="start" name="start" placeholder="Start">
            </div>
            <div class="form-group">
                <label for="end">End</label>
                <input type="date" class="form-control" id="end" name="end" placeholder="End">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </body>
</html>
