<?php 

function fetchAll($db, $query, $array){
    $stmt = $db->prepare($query);
    if(isset($array)){
        $stmt->execute($array);
    }else{
        $stmt->execute();
    }
    $result = $stmt->fetchAll();
    return $result;
}

function fetch($db, $query, $array){
    $stmt = $db->prepare($query);
    if(isset($array)){
        $stmt->execute($array);
    }else{
        $stmt->execute();
    }
    $result = $stmt->fetch();
    return $result;
}


function execute($db, $action, $data){
    $stmt = $db->prepare($action);
    if(isset($data)){
        $stmt->execute($data);
    }else{
        $stmt->execute();
    }
}

/******* USEFUL FUNCTIONS ********/

?>