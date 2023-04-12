<?php
use Microsoft\Graph\Graph;
// Use the Beta namespace to test requests MS Graph Beta endpoints
use Beta\Microsoft\Graph\Model as BetaModel;
// Enable loading of Composer dependencies
require_once realpath(__DIR__ . '/vendor/autoload.php');
require_once 'GraphHelper.php';

class UseBeta
{

    // Load .env file
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
    $dotenv->required(['CLIENT_ID', 'TENANT_ID', 'GRAPH_USER_SCOPES']);

    //Get env variables
    $clientId = $_ENV['CLIENT_ID'];
    $tenantId = $_ENV['TENANT_ID'];
    $scopes = $_ENV['GRAPH_USER_SCOPES'];
    $accessToken = $_ENV['ACCESS_TOKEN'];


    public function run()
    {
        $accessToken =$_ENV['ACCESS_TOKEN'];

        $graph = new Graph();
        $graph->setAccessToken($accessToken);

        $user = $graph->setApiVersion("beta")
                      ->createRequest("GET", "/me")
                      ->setReturnType(BetaModel\User::class)
                      ->execute();

        echo "Hello, I am $user->getGivenName() ";
    }
}




?>