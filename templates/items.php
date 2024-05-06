<?php 
    function output_item($product, $db) {
     ?>
        
        <div class="box-item">             
            <img src="<?php echo $product['firstImg'] ?>">
        
            <div class="box-details">
                <a href="/item.php?id=<?php echo $product['id']?>">
                <h3><?php echo $product['name']?></h3></a>
                <p class="info"><span>NEW</span><span><?php echo getBrand($db, $product['brand'])?></span></p>
                <div>
                    <p><?php echo $product['price']?></p>
                    <button data-id="<?php echo $product['id'] ?>"  class="button add-cart">ADD TO CART</button>
                </div>
            </div>
        </div>
    <?php }

    function output_full_item($product, $id, $images, $db) {
        ?>

        <section class="item-page">
            <div class="item-page-photos">
                <?php foreach($images as $image) { ?>
                    <img class="product-imgs" src=<?php echo $image['path']?>>
                <?php } ?>
            </div>
        
            <div class="container">
                <div>
                    <div>
                        <h1><?php echo $product['name']?></h1>
                        <p class="price-info"><?=$product['price']?>€</p>
                    </div>
                    <div class="user-profile-pr">
                        <?php $user = getUser($db, $product['user']); ?>
                        <img class="profile-img" src=<?=$user['profileImg']?>>
                        <p><a href="profile.php?id=<?php echo $product['user'] ?>"><?php echo $user['username']?></a></p>
                    </div>
                </div>
                <div>
                    <div>
                        <p><?=$product['description']?></p>
                        <p><span class="special">Category:</span> <?php echo getCategory($db, $product['category'])?></p>
                        <p><span class="special">Brand:</span> <?php echo getBrand($db, $product['brand'])?></p>
                        <p><span class="special">Size:</span> <?php echo getSize($db, $product['size'])?></p>
                        <p><span class="special">Model:</span> <?= $product['model']?></p>
                        <p><span class="special">Condition:</span> <?php echo getCondition($db, $product['condition'])?></span> 
                        <p><span class="special">Uploaded:</span> <?= $product['date']?></span> 
                    </div>
                    <div>
                        <?php if ($id !== $product['user']) { ?>
                            <button class="button">FAVORITES</button>
                            <button data-id="<?php echo $product['id']?>" class="button add-cart">ADD TO CART</button>
                            <a href="chat.php?buyerId=<?php echo $id ?>&productId=<?php echo $product['id']?>"><button class="button">ASK USER</button></a>
                        <?php }    
                        else { ?>
                            <a href="listChats.php?productId=<?php echo $product['id']?>"><button class="button">SEE CHATS</button></a>
                            <a href="changeProduct.php?productId=<?php echo $product['id']?>"><button class="button">EDIT PRODUCT</button></a>

                            <form action="/actions/action_delete_product.php" method="post">
                                <input type="hidden" name="productId" value="<?php echo $product['id']?>">
                                <button type="submit" class="button" onclick="return confirm('Are you sure you want to delete this product?')">DELETE PRODUCT</button>
                            </form>    
                        <?php } ?>
                    </div>
                </div>
            </div>
        </section>
    <?php }

    function output_list_items($products, $db) {?>
        <section id="products" class="container products">
            <?php foreach($products as $product) output_item($product, $db); ?>
        </section>
    <?php }

    

?>