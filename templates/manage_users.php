<?php
    function output_users($users){
        ?><section class="container">
            <h1>Manage Users</h1>  
            <div class="manage-users">
                <?php
                foreach ($users as $user) { ?> 
                    <div class="user">
                        <img src="<?= $user['profileImg'] ?>" alt="Profile Image" class="profile-image">
                        <p class="user-name">Name: <?= $user['name'] ?></p>
                        <p class="user-email">Email: <?= $user['email'] ?></p>
                        <p class="user-role">Role: 
                            <?php if (!$user['admin']) { ?>
                                Not an admin <a href="/actions/action_elevate_admin.php?id=<?= $user['id'] ?>">Elevate to admin</a>
                            <?php } else { ?>
                                Admin
                            <?php } ?>
                        </p>
                    </div><?php
                }
            ?></div>
        </section>
    <?php }

?>