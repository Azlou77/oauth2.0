<?php
use Microsoft\Graph\Graph;
// Use the Beta namespace to test requests MS Graph Beta endpoints
use Beta\Microsoft\Graph\Model as BetaModel;
require_once  'vendor/autoload.php';


class UseBeta
{
 
    public function run()
    {
        // Load .env file
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
        $dotenv->load();
        $dotenv->required(['ACCESS_TOKEN' ]);
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