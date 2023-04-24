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
GraphHelper::initializeGraphForUserAuth();

// Get user data
$user = GraphHelper::getUser();

//Instanciation new MS Graph
$messages = GraphHelper::getInbox();

?>
<!-- Display inbox messages user -->
<html>
  <head>
    <title>MS Graph API</title>
  </head>
  <body>
    <h2>Mail inbox</h2>
    <table>
      <thead>
        <tr>
          <th>From</th>
          <th>Subject</th>
          <th>Received</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($messages->getPage() as $message): ?>
          <tr>
            <td><?php echo $message->getFrom()->getEmailAddress()->getName(); ?></td>
            <td><?php echo $message->getSubject(); ?></td>
            <td><?php echo $message->getReceivedDateTime()->format('m/d/Y g:i A'); ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
  </body>
</html>

