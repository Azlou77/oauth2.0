<?php
use MSGraph\Controllers\Auth\GetEnv;
// Enable loading of Composer dependencies
require_once '/vendor/autoload.php';



//Class to authentificate with authorization code flow
class AuthController extends GetEnv
{
    //Get the authorization url
    public function getAuthUrl(): string
    {
        $authUrl = "https://login.microsoftonline.com/<?=tenantId ?>/oauth2/v2.0/authorize?client_id=<?=$clientId?>&response_type=code&redirect_uri=
        <?=urlencode('http://localhost/oauth2.0/connect.php')?>&
        scope=<?=$scopes?>";
        return $authUrl;
    }
}
?> 

