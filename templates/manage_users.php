<?php
    function output_users($users){
        ?><h2>Users</h2>  
        <table><?php
        foreach ($users as $user) {
            ?><tr><?php 
            ?><td><img src=<?php echo $user['profileImg']?> alt="Profile Image" id="profile_image"></td><?php
            echo '<td>' . $user['name'] . '</td>';
            echo '<td>' . $user['email'] . '</td>';
            if (!$user['admin']) {
                ?><td> Not an admin </td>
                <td><a href=/actions/action_elevate_admin.php> Elevate to admin </a></td><?php // TODO: Change link 
            }
            else {
                echo '<td> Admin </td>';
            }
            ?></tr><?php 
        }
        ?></table>
    <?php }

?>