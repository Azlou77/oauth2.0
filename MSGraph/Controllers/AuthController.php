<?php
use Microsoft\Graph\Graph;
use Microsoft\Graph\Model;
use Microsoft\Kiota\Authentication\Oauth\AuthorizationCodeContext;
use Microsoft\Kiota\Authentication\PhpLeagueAuthenticationProvider;
use Microsoft\Graph\Core\GraphClientFactory;
use Microsoft\Graph\Beta\GraphRequestAdapter;


//Class to authentificate with authorization code flow
class AuthController 
{
    public function signin()
    {
        // Initialize the authorization code
        $tokenRequestContext = new AuthorizationCodeContext(
            'tenantId',
            'clientId',
            'clientSecret',
            'authCode',
            'redirectUri'
        );
        $scopes = ['User.Read'];

        // Initialize the OAuth client
        $authProvider = new PhpLeagueAuthenticationProvider($tokenRequestContext, $scopes);


        //Configure the HTTP client with Guzzle
        $guzzle = new \GuzzleHttp\Client();
        $url = 'https://login.microsoftonline.com/' . $tenantId . '/oauth2/v2.0/token';
        $token = json_decode($guzzle->post($url, [
        'form_params' => [
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
            'scope' => 'https://graph.microsoft.com/.default',
            'grant_type' => 'client_credentials',
        ],
])->getBody()->getContents());
$accessToken = $token->access_token;
        
    }
}
    
 
  

?>