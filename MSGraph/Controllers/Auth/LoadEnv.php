<?php
namespace MSGraph\Controllers\Auth;
/*
  *Class parent to instance child class and
  *to load env variables
*/
class LoadEnv
{
    public function __construct()
    {
        $dotenv = Dotenv\Dotenv::createImmutable('/vendor/autoload.php');
        $dotenv->required(['CLIENT_ID', 'TENANT_ID', 'GRAPH_USER_SCOPES']);
    }
}

?>