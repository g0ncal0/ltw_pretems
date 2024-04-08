<?php 
    declare(strict_types=1);
    function getDatabaseConnection() : PDO {
        $dbh = new PDO('sqlite:db/create.db');
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $dbh;
    }
?>