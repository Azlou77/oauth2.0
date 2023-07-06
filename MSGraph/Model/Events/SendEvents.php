<?php
// Set attendees
$attendees = [];
array_push($attendees, [
        'emailAddress' => [
        'address' => '',
        'name' => ''
        ],
        'type' => 'required'
        ]);

// define variables and set to empty values
$newEvent =
[
    // Set empty subject
    'subject' => '',

    // Set attendees
    'attendees' => $attendees,

    // Set empty subject
    'reminderMinutesBeforeStart' => '',
    // Set empty reminder
    'isReminderOn' => true,
    // Set empty body
    'body' => [
        'contentType' => 'HTML',
        'content' => ''
    ],
    // Set empty start and end time
    'start' => [
        'dateTime' => '',
        'timeZone' => 'Pacific Standard Time'
    ],
    'end' => [
        'dateTime' => '',
        'timeZone' => 'Pacific Standard Time'
    ],
    
];



// Check if the form if the method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Set attendees
    $attendees = [];
    array_push($attendees, [
            'emailAddress' => [
            'address' => $_POST['attendees'],
            'name' => $_POST['attendees']
            ],
            'type' => 'required'
            ]);

  $newEvent = [
    'subject' => $_POST['subject'],
    'attendees' => $attendees,
    // Set reminder
    'reminderMinutesBeforeStart' => $_POST['reminderMinutesBeforeStart'],
    'isReminderOn' => true,
    
    'body' => [
        'contentType' => 'HTML',
        'content' => $_POST['body']
    ],
    // Set start and end time
    'start' => [
        'dateTime' => $_POST['start'],
        'timeZone' => 'Pacific Standard Time'
    ],
    'end' => [
        'dateTime' => $_POST['end'],
        'timeZone' => 'Pacific Standard Time'
    ],
  ];