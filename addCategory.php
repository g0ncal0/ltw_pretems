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
?>

<form class="category-form" action="/actions/action_add_category.php" method="post">
    <label for="name">Category Name:</label>
    <input type="text" id="name" name="name" required>    
    <button class="button" type="submit" value="Add Category">Add Category</button>
</form>

<h2>Existing categories</h2>
<ul><?php
    foreach ($categories as $category) {
        echo '<li>' . $category['name'] . '</li>';
    }
?></ul>

<?php 
if (isset($_GET['message'])) {
    echo "<p>{$_GET['message']}</p>"; // Print if category was added successfully
} 

output_footer(); ?>