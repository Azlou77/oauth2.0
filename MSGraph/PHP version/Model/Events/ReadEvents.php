<?php
//Get the access token from MSGraph class
$token = GraphHelper::getAppOnlyToken();

//Set the access token to the GraphHelper class
$graph->setAccessToken($token);

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

  //Get the events
  //Path where the requests will be sent
    $events = $graph->createRequest('GET', '/users/{user-id}/calendar/events')
    ->setReturnType(Model\Event::class)
    ->execute();
    echo "List all events";



?>