<?php
require_once 'vendor/autoload.php';
require_once 'GraphHelper.php';

use Microsoft\Graph\Graph;
use Microsoft\Graph\Model;

// Load .env file
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$dotenv->required(['CLIENT_ID', 'TENANT_ID', 'GRAPH_USER_SCOPES']);

// Initialisze MS-Graph client authentification
GraphHelper::initializeGraphForAppOnlyAuth();

$graph = new Graph();
// Get token code
$token = GraphHelper::getAppOnlyToken();
// Set token code
$graph->setAccessToken($token);

// Only request specific properties
$select = '$select=from,isRead,receivedDateTime,subject';
// Sort by received time, newest first
$orderBy = '$orderBy=receivedDateTime DESC';

$ptr = $graph->createCollectionRequest('GET', '/users/9b3008f7-d1f4-4f8b-8a1a-163473441064/mailFolders/inbox/messages?'.$select.'&'.$orderBy)
                ->setReturnType(Model\Message::class)
                ->setPageSize(25);
$msgs = $ptr->getPage();

?>

<html>
    <!-- Display inbox messages -->
    <h1>My inbox</h1>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">From</th>
                <th scope="col">Subject</th>
                <th scope="col">Received</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($msgs as $msg): ?>
                <tr>
                    <td><?php echo $msg->getFrom()->getEmailAddress()->getName(); ?></td>
                    <td><?php echo $msg->getSubject(); ?></td>
                    <td><?php echo $msg->getReceivedDateTime()->format('Y-m-d H:i:s'); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
</html>
