<?php 
    declare(strict_types=1);
    function getDatabaseConnection() : PDO {
        $dbh = new PDO('sqlite:' . __DIR__  .'/database.db');
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $dbh;
    }
?>