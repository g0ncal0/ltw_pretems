<?php 
    function output_profile($profile) { ?>
        <h2>User Profile</h2>
        <section id="profile_info">
            <label>Name: <span id="name"><?php echo $profile['name']?></span></label>
            <label>Username: <span id="username"><?php echo $profile['username']?></span></label>
            <label>Email: <span id="email"><?php echo $profile['email']?></span></label>
            <img src=<?php echo $profile['profileImg']?> alt="Profile Image" id="profile_image">
        </section>
    <?php }

    function output_user_area() { ?>
        <a href="changeProfile.php"><button class="button">Change Profile</button></a>
        <a href="addProduct.php"><button class="button">Add Product</button></a>
    <?php }

    function output_admin_area() {
        ?><a href="admin_area.php?area=category"><button class="button">Add Category</button></a>
        <a href="admin_area.php?area=size"><button class="button">Add Size</button></a>
        <a href="admin_area.php?area=condition"><button class="button">Add Condition</button></a>
        <a href="manage_users.php"><button class="button">Manage Users</button></a><?php 
        echo "<p>You are an admin</p>"; // TODO: Temporary
    }

    function output_profile_items($selling_items, $sold_items){
        ?> <h2> Items that you are selling </h2> <?php
        if($selling_items){
            foreach ($selling_items as $selling_item) {
                output_profile_selling_item($selling_item);
            }
        } else {
            echo "<p> No items </p>";
        }

        ?> <h2> Items that you sold </h2> <?php
        if($sold_items){
            foreach ($sold_items as $sold_item) {
                output_profile_sold_item($sold_item);
            }
        } else {
            echo "<p> No items </p>";
        }
    }

    function output_profile_selling_item($product) {    
        $db = getDatabaseConnection();     
        ?><div class="box-item">             
            <img src="<?php echo $product['firstImg'] ?>">
        
            <div class="box-details">
                <a href="/item.php?id=<?php echo $product['id']?>">
                <h3><?php echo $product['name']?></h3></a>
                <p class="info"><span>NEW</span><span><?php echo getBrand($db, $product['brand'])?></span></p>
                <div>
                    <p><?php echo $product['price']?></p>
                </div>
            </div>
        </div>
    <?php }

    function output_profile_sold_item($product) {    
        $db = getDatabaseConnection(); 
        $shipping_info_ids = getShippingIds($db, $product['id']);
    
        ?><div class="box-item">             
            <img src="<?php echo $product['firstImg'] ?>">
        
            <div class="box-details">
                <a href="/item.php?id=<?php echo $product['id']?>">
                <h3><?php echo $product['name']?></h3></a>
                <p class="info"><span>NEW</span><span><?php echo getBrand($db, $product['brand'])?></span></p>
                <div>
                    <p><?php echo $product['price']?></p>
                    <a href="shipping_form.php?product_id=<?php echo $product['id']; ?>&purchase_id=<?php echo $shipping_info_ids['purchase_id'];?>"><button class="button">Print Shipping Forms</button></a>
                </div>
            </div>
        </div>
    <?php }
    

    

?>