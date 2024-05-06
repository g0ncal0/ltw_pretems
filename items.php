<?php 
    require_once('include.php');
    $session = new Session();

    $db = getDatabaseConnection();
    
   
    output_header($db, "Our catalogue", null, $session->getId());

    simpleheader("Our catalogue");

    $categories = getCategories($db);
    $brands = getBrands($db);
    $sizes = getSizes($db);
    $conditions = getConditions($db);

    function printOptions($elements, $idselected){
        foreach($elements as $element){
            if($element['id'] == $idselected){
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

<div class="container">
    <form id="form-filter">
        <label for="size">Size:</label>
        <select name="size" id="size">
            <option value="">Select Size</option>
            <?php printOptions($sizes, $_GET['size']);?>
        </select>

        <label for="category">Category</label>
        <select name="category" id="category">
            <option value="">Select Category</option>
            <?= printOptions($categories, $_GET['category'])?>
        </select>

        <label for="brand">Brand:</label>
        <select name="brand" id="brand">
        <option value="">Select Brand</option>
        <?php printOptions($brands, $_GET['brand']);?>
        </select>

        <label for="condition">Condition:</label>
        <select name="condition" id="condition">
        <option value="">Select Condition</option>
        <?php printOptions($conditions, $_GET['condition']);?>
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

        <label for="q">Search:</label>
        <input type="text" value="<?=htmlentities($_GET['q'])?>" name="q" id="q">

        <button id="submit-filter" class="button">Submit</button>
    </form>

<div id="products">
</div>
<button id="more-items">More items</button>
</div>

<?php
    output_footer();
?>
