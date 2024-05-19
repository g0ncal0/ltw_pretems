<?php
require_once('include.php');
$session = new Session();
$db = getDatabaseConnection();
$users = getAllUsers($db);

output_header($db, 'Manage Users', null, $session->getId()); 
protectPage($session);
simpleheader("Manage Users");
output_users($users);
output_footer(); 
?>
