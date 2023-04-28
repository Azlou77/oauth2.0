<?php
//Request to send mail
$newMail = [
    'message' => [
        'subject' => 'Meet for lunch?',
        'body' => [
            'contentType' => 'Text',
            'content' => 'The new cafeteria is open.'
        ],
        'toRecipients' => [
            [
                'emailAddress' => [
                    'address' => '',
                ],
            ],
        ],
    ],
    'saveToSentItems' => 'true',
];

// Send mail
$response = $graph->createRequest("POST", "/me/sendMail")
    ->attachBody($newMail)
    ->setReturnType(Model\User::class)
    ->execute();
    