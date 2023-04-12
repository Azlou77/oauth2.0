<?php

// Enable loading of Composer dependencies
require_once realpath(__DIR__ . '/vendor/autoload.php');
?>

<html>
    <head>
        <title>My Login Page</title>
    </head>
    <body>
        <h1>My Login Page</h1>
        <p><a href="<?= $authUrl ?>"><img src="https://img.icons8.com/color/48/000000/microsoft-logo.png"
        ></a> 
        Login with Microsoft
    </p>
</html>
<!-- Get token acess with code -->

?>