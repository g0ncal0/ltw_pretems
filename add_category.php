<?php
/* TODO:
- Form for category data 
- (Show existing categories)
- (Option to remove a category, maybe add in different file called RemoveCategory??)
*/

require_once('include.php');

$session = new Session();
$db = getDatabaseConnection();
$categories = getCategories($db);

output_header($db, 'Add Category', null, $session->getId()); 
protectPage();
output_category_form();
output_existing_categories($categories);
 
if (isset($_GET['message'])) {
    ?><p><?php echo $_GET['message']?></p><?php // Print if category was added successfully
} 

output_footer(); ?>