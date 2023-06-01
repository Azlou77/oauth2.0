<html>
    <head>
        <title>PHP CRUD  |  Add User</title>
        <!-- Bootstrap assets -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    </head>
</html>
<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'calendar');

//Define DNS 
$dns = 'mysql:host='.DB_HOST.';dbname='.DB_NAME;

try
{
    //Instanciation PDO
    $conn = new PDO($dns, DB_USER, DB_PASS);
    //Define method to get data
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->exec('SET NAMES utf8');
}
catch (PDOException $e)
{
    //Display error message
    echo '<div class="alert alert-danger" role="alert">Connection failed</div>' . $e->getMessage();
}
echo '<div class="alert alert-success" role="alert">Connection successfull</div>';






?>