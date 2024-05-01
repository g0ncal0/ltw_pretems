<?php 
    require_once('include.php');
    $session = new Session();

    $db = getDatabaseConnection();
    
   
    output_header($db, "Search", null, $session->getId());

    simpleheader("Search Everywhere");


?>

<form id="search-form">
    <input type="text" value="<?=htmlentities($_GET['q'])?>" name="q">
    <button type="submit" >Search</button>
</form>

<section id="search-results">

</section>
<?php output_footer(); ?>