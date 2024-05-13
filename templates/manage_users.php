<?php
    declare(strict_types = 1);

    function output_users(array $users) : void {
        ?><section class="container">
            <div class="manage-users">
                <?php
                foreach ($users as $user) { ?> 
                    <div class="user">
                        <img src="<?= $user['profileImg'] ?>" alt="Profile Image" class="profile-image">
                        <div class="manage-user-info">
                            <p class="user-name">Name: <?= $user['name'] ?></p>
                            <p class="user-email">Email: <?= $user['email'] ?></p>
                            <p class="user-role">Role: 
                                <?php if (!$user['admin']) { ?>
                                    Not an admin <a href="/actions/action_elevate_admin.php?id=<?= $user['id'] ?>">Elevate to admin</a>
                                <?php } else { ?>
                                    Admin
                                <?php } ?>
                            </p>
                        </div>
                    </div><?php
                }
            ?></div>
        </section>
    <?php }

?>