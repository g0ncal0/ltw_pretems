<?php 
    require_once('include.php');

    $session = new Session();

    $db = getDatabaseConnection();

    $id = $session->getId();
    $categories = getCategories($db);
    $brands = getBrands($db);
    $sizes = getSizes($db);
    $conditions = getConditions($db);

    $product = getProduct($db, $_GET['productId']);
    $images = getImagesOfProduct($db, $_GET['productId']);

    output_header($db, 'Change Product', null, $session->getId(), $session); 
    protectPage($session);


    function printOptions($elements){
        foreach($elements as $element){
            ?>
                <option value="<?php echo $element['id']?>"><?php echo $element['name']?></option>
            <?php
        }
    }

    if ($id != $product['user']) { ?>
        <?php errorPage("Access Forbidden","You can not access this url.");?>
    <?php }

    else {
    ?>

    <section class="container">
        
        
        <h1>Change Product:</h1>
        <form class="product-form" action="/actions/action_change_product.php" method="post" enctype="multipart/form-data">
            <input type="hidden" class="csrf" name="csrf" value=<?php echo $session->getCSRF() ?>>

            <input type="hidden" id="productId" name="productId" value=<?php echo $product['id']?>>

            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="<?php echo $product['name']; ?>">

            <label for="category">Category:</label>
            <select id="category" name="category" value="<?php echo $product['category']; ?>" required>
                <?php printOptions($categories); ?>
            </select>

            <label for="brand">Brand:</label>
            <select id="brand" name="brand" value="<?php echo $product['brand']; ?>" required>
                <?php printOptions($brands); ?>
            </select>

            <label for="model">Model:</label>
            <input type="text" id="model" name="model" value="<?php echo $product['model']; ?>" required>

            <label for="size">Size:</label>
            <select id="size" name="size" value="<?php echo $product['size']; ?>" required>
                <?php printOptions($sizes); ?>
            </select>

            <label for="condition">Condition:</label>
            <select id="condition" name="condition" value="<?php echo $product['condition']; ?>" required>
                <?php printOptions($conditions) ?>
            </select>

            <label for="price">Price:</label>
            <input type="text" id="price" name="price" pattern="\d+(\.\d{1,2})?" title="price" value="<?php echo $product['price']; ?>" required>

            <label for="available">Available:</label>
            <input type="checkbox" id="available" name="available" checked="<?php if ($product['available']) echo "true"; else echo "false"; ?>">

            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="5" cols="50" required><?php echo $product['description']; ?></textarea>

            <label for="current_first_img">Current First Image:</label>
            <img src="<?php echo $product['firstImg']; ?>" alt="Product First Image" width="100">
            <br>
            <label for="firstImg">If you want to change your first image, please load a new one:</label>
            <input type="file" name="firstImg">

            <?php foreach ($images as $image) { 
                if ($image['path'] != $product['firstImg']) { ?>
                <label for="delete_image_<?php echo $image['id']; ?>">Delete this image?</label>
                <img src="<?php echo $image['path']; ?>" alt="Product Image" width="100">
                <input type="checkbox" name="deleted_images[]" id="delete_image_<?php echo $image['id']; ?>" value="<?php echo $image['id']; ?>">
            <?php }
            } ?>

            <label for="images">More Pictures:</label>
            <input type="file" name="images[]" multiple>

            <label for="currentPassword">You must type your current password to perform changes:</label>
            <input type="password" name="currentPassword" id="currentPassword">

            <button class="button" type="submit">Save Changes</button>
        </form>
    </section>

    <?php output_footer();

    }
?>