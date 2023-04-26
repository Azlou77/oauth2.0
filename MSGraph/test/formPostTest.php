<?php
/*This is a code extract from Youtube video: https://www.youtube.com/watch?v=Z9X4lysFr64
https://www.youtube.com/watch?v=GLV8XtUWVjk */


$appid = "xxx";

$tennantid = "xxx";

$secret = "xxx";

$login_url ="https://login.microsoftonline.com/".$tennantid."/oauth2/v2.0/authorize";

session_start ();

$_SESSION['state']=session_id();

echo "<h1>MS OAuth2.0 Demo </h1><br>";

if (isset ($_SESSION['msatg'])){

   echo "<h2>Authenticated ".$_SESSION["uname"]." </h2><br> ";

   echo '<p><a href="?action=logout">Log Out</a></p>';

} //end if session

else   echo '<h2><p>You can <a href="?action=login">Log In</a> with Microsoft</p></h2>';

if ($_GET['action'] == 'login'){

   $params = array ('client_id' =>$appid,

      'redirect_uri' =>'https://msdemo1.freecluster.eu/',

      'response_type' =>'token',

       'response_mode' =>'form_post',

      'scope' =>'https://graph.microsoft.com/User.Read',

      'state' =>$_SESSION['state']);

   header ('Location: '.$login_url.'?'.http_build_query ($params));

}

if (array_key_exists ('access_token', $_POST))

 {

   

   $_SESSION['t'] = $_POST['access_token'];

   $t = $_SESSION['t'];

$ch = curl_init ();

curl_setopt ($ch, CURLOPT_HTTPHEADER, array ('Authorization: Bearer '.$t,

                                            'Conent-type: application/json'));

curl_setopt ($ch, CURLOPT_URL, "https://graph.microsoft.com/v1.0/me/");

curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);

$rez = json_decode (curl_exec ($ch), 1);

if (array_key_exists ('error', $rez)){  

 var_dump ($rez['error']);    

 die();

}

else  {

$_SESSION['msatg'] = 1;  //auth and verified

$_SESSION['uname'] = $rez["displayName"];

$_SESSION['id'] = $rez["id"];

}

curl_close ($ch);

   header ('Location: https://msdemo1.freecluster.eu/');

}

if ($_GET['action'] == 'logout'){

   unset ($_SESSION['msatg']);

   header ('Location: https://msdemo1.freecluster.eu/');

}

