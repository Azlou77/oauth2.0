<?php
/*
 * Kiota is a command line tool for generating an API client
 * to call any OpenAPI described API you are interested in. 
 * Kiota is used for BETA testing only with Microsoft Graph requests.
 */
use Microsoft\Kiota\Authentication\Oauth\ClientCredentialContext;
/*
 * PHP League OAuth2 Client is a third-party library that provides
 * a client for the OAuth 2.0 protocol.
*/
use Microsoft\Kiota\Authentication\PhpLeagueAuthenticationProvider;
/*
 * The GraphRequestAdapter class is a wrapper for the
 * Microsoft Graph API. It is used to make requests to the
 * API and return the results.
*/
use Microsoft\Graph\GraphRequestAdapter;
/*
 * GraphServiceClient is to receive requests from the client
 * without a signed-in user (using application permissions)
*/
use Microsoft\Graph\GraphServiceClient;
use Microsoft\Graph\Core\GraphClientFactory;

//Instanciation of new Azure AD client
$tokenRequestContext = new ClientCredentialContext(
    'tenantId',
    'clientId',
    'clientSecret'
);

//Set the authorizations scopes(read, delete, write, etc.)
$scopes = ['https://graph.microsoft.com/.default'];

//Instanciation of new authentication provide
$authProvider = new PhpLeagueAuthenticationProvider($tokenRequestContext, $scopes);

//Initialize Guuzzle http client
$guzzleConfig = [
    // your custom config
];
$httpClient = GraphClientFactory::createWithConfig($guzzleConfig);

/*
    * The GraphRequestAdapter class is a wrapper for the
    * Microsoft Graph API. It is used to make requests to the
    * API and return the results.
    *GraphServiceClient is a wrapper for the GraphRequestAdapter class.
*/
$requestAdapter = new GraphRequestAdapter($authProvider, $httpClient);
$betaGraphServiceClient = new GraphServiceClient($requestAdapter);

//Debugging
try {
    $response = $betaGraphServiceClient->usersById('[userPrincipalName]')->get();
    $user = $response->wait();
    echo "Hello, I am {$user->getGivenName()}";

} catch (ApiException $ex) {
    echo $ex->getMessage();
}

?>