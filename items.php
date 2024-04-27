<?php 
    require_once('include.php');
    $session = new Session();

    $db = getDatabaseConnection();
    $title = "Products";
    $items = array();
    $category = "";
    if(isset($_GET['category'])){
        // the user is searching for category
        $catgid = $_GET['category'];
        $category = getCategory($db, $catgid);
        $title = $category;
        $items = getProductsOfCategory($db, $catgid);
    }
    else{
        $items = getAllProducts($db);
    }

    output_header($db, isset($category) ? $category : " Our catalogue", null, $session->getId());

    simpleheader($title);

    $categories = getCategories($db);
    $brands = getBrands($db);
    $sizes = getSizes($db);
    $conditions = getConditions($db);

    function printOptions($elements, $isCategory){
        foreach($elements as $element){
            if($isCategory && $element['id'] == $_GET['category']){
                ?>
                    <option selected value="<?php echo $element['id']?>"><?php echo $element['name']?></option>

                <?php
            }else{
            ?>
                <option value="<?php echo $element['id']?>"><?php echo $element['name']?></option>
            <?php
            }
        }
    }

?>
<script src="js/items.js" defer></script>

<div class="container">
    <form id="form-filter">
        <label for="size">Size:</label>
        <select name="size" id="size">
            <option value="">Select Size</option>
            <?php printOptions($sizes, false);?>
        </select>

        <label for="category">Category</label>
        <select name="category" id="category">
            <option value="">Select Category</option>
            <?= printOptions($categories, true)?>
        </select>

        <label for="brand">Brand:</label>
        <select name="brand" id="brand">
        <option value="">Select Brand</option>
        <?php printOptions($brands, false);?>
        </select>

        <label for="condition">Condition:</label>
        <select name="condition" id="condition">
        <option value="">Select Condition</option>
        <?php printOptions($conditions, false);?>
        </select>

        <div class="price-input-container"> 
            <div class="price-input"> 
                <div class="price-field"> 
                    <span>Minimum Price</span> 
                    <input type="number" 
                            name="min-price"
                            class="min-input" 
                            value="0" readonly> 
                </div> 
                <div class="price-field"> 
                    <span>Maximum Price</span> 
                    <input type="number" 
                            name="max-price"
                            class="max-input" 
                            value="700" readonly> 
                </div> 
            </div> 
            <div class="slider-container"> 
                <div class="price-slider"> 
                </div> 
            </div> 
        </div> 
    
        <!-- Slider -->
        <div class="range-input"> 
            <input type="range" 
                    class="min-range" 
                    min="0" 
                    max="700" 
                    value="0" 
                    step="10"> 
            <input type="range" 
                    class="max-range" 
                    min="0" 
                    max="700" 
                    value="700" 
                    step="10"> 
        </div> 

        <button id="submit-filter">Submit</button>
    </form>
</div>


<div id="products">
</div>
<button id="more-items">More items</button>

<?php
    output_footer();
?>
