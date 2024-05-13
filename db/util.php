<?php 

declare(strict_types = 1);

function fetchAll(PDO $db, string $query, ?array $array) {
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $stmt = $db->prepare($query);
    if(isset($array)){
        $stmt->execute($array);
    }else{
        $stmt->execute();
    }
    $result = $stmt->fetchAll();
    return $result;
}

function fetch(PDO $db, string $query, ?array $array) {
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $stmt = $db->prepare($query);
    if(isset($array)){
        $stmt->execute($array);
    }else{
        $stmt->execute();
    }
    $result = $stmt->fetch();
    return $result;
}


function execute(PDO $db, string $action, array $data) : void {
    $stmt = $db->prepare($action);
    if(isset($data)){
        $stmt->execute($data);
    }else{
        $stmt->execute();
    }
}

/******* USEFUL FUNCTIONS ********/

?>