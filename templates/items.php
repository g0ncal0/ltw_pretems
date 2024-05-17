<?php 
    declare(strict_types = 1);

    function output_item(array $product, PDO $db) : void {
        $session = new Session();
        ?>
        
        <div class="box-item">             
            <img alt="<?=$product['description']?>" src="<?php echo $product['firstImg'] ?>">
        
            <div class="box-details">
                <a href="/item.php?id=<?php echo $product['id']?>">
                <h3><?php echo $product['name']?></h3></a>
                <p class="info"><span><?php echo getBrand($db, $product['brand'])?></span></p>
                <div>
                    <p><?php echo $product['price']?>€</p>
                    <?php if ((($session->getId() != $product['user']) || (!$session->isLoggedIn())) && $product['available']) echo '<button data-id=' . $product['id'] .  ' class="button add-cart">ADD TO CART</button>'; ?>
                </div>
            </div>
        </div>
    <?php }

    function output_full_item(array $product, ?int $id, ?array $images, array $user, string $category, string $brand, string $size, string $condition, ?array $fav, Session $session) : void { ?>

        <section class="item-page">
            <div class="item-page-photos">
                <?php foreach($images as $image) { ?>
                    <img  alt="<?=$product['description']?>" class="product-imgs" src=<?php echo $image['path']?>>
                <?php } ?>
            </div>
        
            <div class="container">
                <div>
                    <div>
                        <h1><?php echo $product['name']?></h1>
                        <p class="price-info"><?=$product['price']?>€</p>
                    </div>
                    <div class="user-profile-pr">
                        <img alt="Profile Image" class="profile-img" src=<?=$user['profileImg']?>>
                        <p><a href="profile.php?id=<?php echo $product['user'] ?>"><?php echo $user['username']?></a></p>
                    </div>
                </div>
                <div>
                    <div>
                        <p><?=$product['description']?></p>
                        <p><span class="special">Category:</span> <?php echo $category?></p>
                        <p><span class="special">Brand:</span> <?php echo $brand?></p>
                        <p><span class="special">Size:</span> <?php echo $size?></p>
                        <p><span class="special">Model:</span> <?= $product['model']?></p>
                        <p><span class="special">Condition:</span> <?php echo $condition?></span> 
                        <p><span class="special">Uploaded:</span> <?= $product['date']?></span> 
                    </div>
                    <div>
                        <?php if ($id !== $product['user']) {
                            if($product['available']){
                            if(isset($id)){
                                if (!$fav) { ?>

                                    <button data-id="<?php echo $product['id']?>" class="button add-favorites">FAVORITES</button>
                                
                                    <?php } 
                                    else 
                                    { ?>
                                    <button data-id="<?php echo $product['id']?>" class="button add-favorites favorited">REMOVE FAVS</button>
                                <?php }}
                                ?>

                                <button data-id="<?php echo $product['id']?>" class="button add-cart">ADD TO CART</button>
                                <?php } ?>
                                <a href="chat.php?buyerId=<?php echo $id ?>&productId=<?php echo $product['id']?>"><button class="button">ASK USER</button></a>
                        <?php }

                        else { ?>
                            <a href="listChats.php?productId=<?php echo $product['id']?>"><button class="button">SEE CHATS</button></a>
                            <a href="changeProduct.php?productId=<?php echo $product['id']?>"><button class="button">EDIT PRODUCT</button></a>
                            
                            <form action="/actions/action_add_feature.php" method="post">
                                <input type="hidden" class="csrf" name="csrf" value=<?php echo $session->getCSRF() ?>>

                                <input type="hidden" name="product" value="<?=$product['id']?>">
                                <button type="submit" class="button">Feature Item</button>
                            </form>

                            <form action="/actions/action_delete_product.php" method="post">
                                <input type="hidden" class="csrf" name="csrf" value=<?php echo $session->getCSRF() ?>>

                                <input type="hidden" name="productId" value="<?php echo $product['id']?>">
                                <button type="submit" class="button" onclick="return confirm('Are you sure you want to delete this product?')">DELETE PRODUCT</button>
                            </form>    
                        <?php } ?>
                        <?php if ($session->getAdmin() && $id !== $product['user']) { ?>
                            <h3>Admin Actions:</h3>

                            <form action="/actions/action_delete_product.php" method="post">
                                <input type="hidden" class="csrf" name="csrf" value=<?php echo $session->getCSRF() ?>>

                                <input type="hidden" name="productId" value="<?php echo $product['id']?>">
                                <button type="submit" class="button" onclick="return confirm('Are you sure you want to delete this product?')">DELETE PRODUCT</button>
                            </form> 
                        <?php } ?>
                    </div>
                </div>
            </div>
        </section>
    <?php }

    function output_list_items(array $products, PDO $db) : void {?>
        <section class="products" class="container products">
            <?php foreach($products as $product) {
                output_item($product, $db);
            } ?>
        </section>
    <?php }

?>