<?php
//Dependencies require MS-Graph
use Microsoft\Graph\Graph;
use Microsoft\Graph\Http;
use Microsoft\Graph\Model;
use GuzzleHttp\Client;


class GraphHelper
 {
    //Variables MS-Graph
    private static Client $tokenClient;
    private static string $clientId = '';
    private static string $tenantId = '';
    private static string $graphUserScopes = '';
    private static Graph $userClient;
    private static string $userToken;

    //Instanciation class MS-Graph
    public static function initializeGraphForUserAuth(): void
    {
        GraphHelper::$tokenClient = new Client();
        GraphHelper::$clientId = $_ENV['CLIENT_ID'];
        GraphHelper::$tenantId = $_ENV['TENANT_ID'];
        GraphHelper::$graphUserScopes = $_ENV['GRAPH_USER_SCOPES'];
        GraphHelper::$userClient = new Graph();
    }


    //Get  the MS-Graph token
    public static function getUserToken(): string
        {
        /* If we already have a user token, just return it
           Tokens are valid for one hour, after that it needs to be refreshed */
        if (isset(GraphHelper::$userToken)) {
            return GraphHelper::$userToken;
        }
        
        //Redirect code and token url
        // https://learn.microsoft.com/azure/active-directory/develop/v2-oauth2-device-code
        $deviceCodeRequestUrl = 'https://login.microsoftonline.com/'.GraphHelper::$tenantId.'/oauth2/v2.0/devicecode';
        $tokenRequestUrl = 'https://login.microsoftonline.com/'.GraphHelper::$tenantId.'/oauth2/v2.0/token';

        // First POST to /devicecode
        $deviceCodeResponse = json_decode(GraphHelper::$tokenClient->post($deviceCodeRequestUrl, [
            'form_params' => [
                'client_id' => GraphHelper::$clientId,
                'scope' => GraphHelper::$graphUserScopes
            ]
        ])->getBody()->getContents());

        // Display the user prompt
        print($deviceCodeResponse->message.PHP_EOL);

        /* Response also indicates how often to poll for completion
            And gives a device code to send in the polling requests */
          $interval = (int)$deviceCodeResponse->interval;
          $device_code = $deviceCodeResponse->device_code;

        /* Do polling - if attempt times out the token endpoint
           returns an error */
        while (true) {
            sleep($interval);

            // POST to the /token endpoint
            $tokenResponse = GraphHelper::$tokenClient->post($tokenRequestUrl, [
                'form_params' => [
                    'client_id' => GraphHelper::$clientId,
                    'grant_type' => 'urn:ietf:params:oauth:grant-type:device_code',
                    'device_code' => $device_code
                ],
               /*  These options are needed to enable getting
                the response body from a 4xx response */
                'http_errors' => false,
                'curl' => [
                    CURLOPT_FAILONERROR => false
                ]
            ]);

            // Reponse errors
            if ($tokenResponse->getStatusCode() == 200) {
                // Return the access_token
                $responseBody = json_decode($tokenResponse->getBody()->getContents());
                GraphHelper::$userToken = $responseBody->access_token;
                return $responseBody->access_token;
            } else if ($tokenResponse->getStatusCode() == 400) {
                // Check the error in the response body
                $responseBody = json_decode($tokenResponse->getBody()->getContents());
                if (isset($responseBody->error)) {
                    $error = $responseBody->error;
                    // authorization_pending means we should keep polling
                    if (strcmp($error, 'authorization_pending') != 0) {
                        throw new Exception('Token endpoint returned '.$error, 100);
                    }
                }
            }
        }
    }


    // Get user data
    public static function getUser(): Model\User {
        $token = GraphHelper::getUserToken();
        GraphHelper::$userClient->setAccessToken($token);

        return GraphHelper::$userClient->createRequest('GET', '/me?$select=displayName,mail,userPrincipalName')
                                       ->setReturnType(Model\User::class)
                                       ->execute();
    }


    // Get inbox messages
   public static function getInbox(): Http\GraphCollectionRequest {
    $token = GraphHelper::getUserToken();
    GraphHelper::$userClient->setAccessToken($token);

    // Only request specific properties
    $select = '$select=from,isRead,receivedDateTime,subject';
    // Sort by received time, newest first
    $orderBy = '$orderBy=receivedDateTime DESC';

    $requestUrl = '/me/mailFolders/inbox/messages?'.$select.'&'.$orderBy;
    return GraphHelper::$userClient->createCollectionRequest('GET', $requestUrl)
                                   ->setReturnType(Model\Message::class)
                                   ->setPageSize(25);
}

    // Send events
    public static function sendMail(string $subject, string $body, string $recipient): void {
        $token = GraphHelper::getUserToken();
        GraphHelper::$userClient->setAccessToken($token);

        $sendMailBody = array(
            'message' => array (
                'subject' => $subject,
                'body' => array (
                    'content' => $body,
                    'contentType' => 'text'
                ),
                'toRecipients' => array (
                    array (
                        'emailAddress' => array (
                            'address' => $recipient
                        )
                    )
                )
            )
        );

        GraphHelper::$userClient->createRequest('POST', '/me/sendMail')
                                ->attachBody($sendMailBody)
                                ->execute();
    }


//Send reminders on Teams Calendar
public  static function sendEventsonCalendar(): void {
   
  //Get the access token from MSGraph class
  $token = GraphHelper::getUserToken();

  //Set the access token to the GraphHelper class
  GraphHelper::$userClient->setAccessToken($token);

  //Set the users who participate to the event
  $attendees = [];
  array_push($attendees, [
          
      //Description user data
          'emailAddress' => [
          'address' => 'hyro.tsitana-iloharaoke@network-systems.fr',
          'name' => 'Hyro'
          ],
          
      //Precise if the users presence must come or not 
          'type' => 'required'
          ]);

      //Set the event data
      $newEvent = [
        'subject' => 'Test jeudi 13 avril 2022',
        'attendees' => $attendees,
       
      //Set the start and end date of the event
      'start' => [
        'dateTime' => '2023-06-12T22:00:00',
        'timeZone' => 'Pacific Standard Time'
      ],
      'end' => [
        'dateTime' => '2023-06-12T23:10:00',
        'timeZone' => 'Pacific Standard Time'
      ],

      //Set the goal of the event
      'body' => [
        "contentType" => "HTML",
        "content" => "Chat about new hire"
      ]
    ];

    //Create the event
    //Path where the requests will be sent
   
    $response = $graph->createRequest('POST', '/users/louis.nguyen@network-systems.fr/events')
      ->attachBody($newEvent)
      ->setReturnType(Model\Event::class)
      ->execute();
    
    echo "Created event - {$response->getSubject()}.";
    } 
}

?>