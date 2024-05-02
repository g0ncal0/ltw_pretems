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

    output_header($db, 'Change Product', null, $session->getId()); 
    protectPage($session);

    $error = $_GET['error'];

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
        <?php if ($error) { ?>
            <h1>Invalid Password. Please try again</h1>
        <?php } ?>
        
        <h1>Change Product:</h1>
        <form class="product-form" action="/actions/action_change_product.php" method="post" enctype="multipart/form-data">
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
            <input type="text" id="price" name="price" title="price" value="<?php echo $product['price']; ?>" required>

            <label for="available">Available:</label>
            <input type="checkbox" id="available" name="available" checked="<?php if ($product['available']) echo "true"; else echo "false"; ?>">

            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="5" cols="50" required><?php echo $product['description']; ?></textarea>

            <label for="currentPassword">You must type your current password to perform changes:</label>
            <input type="password" name="currentPassword" id="currentPassword">

            <button class="button" type="submit">Save Changes</button>
        </form>
    </section>

    <?php output_footer();

    }
?>