<?php
/*
    * This is the login page. It will redirect the user to the Google login page.
    * After the user logs in, Google will redirect the user to the connect.php page.
    * The config.php file contains the Google ID and secret.
    define ('GOOGLE_ID', 'YOUR_ID');
    define ('GOOGLE_SECRET', 'YOUR_SECRET');
*/
require ('config.php');
?>
<html>
    <head>
        <title>My Login Page</title>
    </head>
    <body>
        <h1>My Login Page</h1>
        <p><a href="https://accounts.google.com/o/oauth2/v2/auth?scope=email&access_type=online&redirect_uri=<?=urlencode('http://localhost/oauth2.0/connect.php')?>&response_type=code&client_id=<?= client_id ?>">
            Login with Google
        </a>
    </p>
</html>
<!-- Get token acess with code -->