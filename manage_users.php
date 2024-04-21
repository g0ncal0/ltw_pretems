<?php
/* TODO:
- List all users and status (admin or not admin)
- (Option to ban user (+ warning))
- Option to elevate user to admin (+ warning)
*/

require_once('include.php');
$session = new Session();
$db = getDatabaseConnection();
$users = getAllUsers($db);

output_header($db, 'Manage Users', null, $session->getId()); 
protectPage($session);
output_users($users);
output_footer(); 
?>
