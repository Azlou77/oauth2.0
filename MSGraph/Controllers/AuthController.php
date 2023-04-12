<?php
use Microsoft\Graph\Graph;
use Microsoft\Graph\Model;

namespace App\Controller;
// Enable loading of Composer dependencies
require_once realpath(__DIR__ . '/vendor/autoload.php');


//Class to authentificate with authorization code flow
class AuthController 
{
   
    public function login(){
    // Load .env file
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
    $dotenv->required(['CLIENT_ID', 'TENANT_ID', 'GRAPH_USER_SCOPES']);

    // Get env variables
    $clientId = $_ENV['CLIENT_ID'];
    $client_secret = $_ENV['CLIENT_SECRET'];
    $tenantId = $_ENV['TENANT_ID'];
    $scopes = $_ENV['GRAPH_USER_SCOPES'];
    $redirect_uri = "http://localhost/oauth2.0/MSGraph/";

    //Get the authorization url
    $authUrl = "https://login.microsoftonline.com/$tenantId/oauth2/v2.0/authorize?client_id=$clientId&response_type=code&redirect_uri=$redirect_uri&scope=$scopes";


    }

}
        
//     public function signin()
    
//     {
     
//         // Initialize the authorization code
//         $tokenRequestContext = new AuthorizationCodeContext(
//             'tenantId',
//             'clientId',
//             'clientSecret',
//             'authCode',
//             'redirectUri'
//         );
//         $scopes = ['User.Read'];

//         // Initialize the OAuth client
//         $authProvider = new PhpLeagueAuthenticationProvider($tokenRequestContext, $scopes);
   
        
//     }
// }

 
  

?>