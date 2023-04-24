<?php
namespace App\Controllers\Auth;
//Class to get env variables
class GetEnv extends LoadEnv
{
    private  static string $clientId = "";
    private  static string $tenantId = "";
    private  static string $client_secret = "";
    //Scopes are authorizations users can have on apps
    private  static string  $scopes = "";

    //Use new global variable $_ENV to get env variables
   public static function getEnv(): void
   {
    GetEnv::$clientId = $_ENV['CLIENT_ID'];
    GetEnv::$tenantId = $_ENV['TENANT_ID'];
    GetEnv::$client_secret = $_ENV['CLIENT_SECRET'];
    GetEnv::$scopes = $_ENV['GRAPH_USER_SCOPES'];
    
   }
}

?>