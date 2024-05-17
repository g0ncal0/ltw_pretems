<?php 

declare(strict_types = 1);

function fetchAll(PDO $db, string $query, ?array $array) : ?array {
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $stmt = $db->prepare($query);
    if(isset($array)){
        $stmt->execute($array);
    }else{
        $stmt->execute();
    }
    $result = $stmt->fetchAll();

    if (!$result) $result = null;

    if ($result !== null && isset($result)) {
        for ($i = 0; $i < count($result); $i++) {
            foreach ($result[$i] as $key => $value) {
                if (is_string($value)) {
                    $result[$i][$key] = htmlentities($value);
                }
            }
        }
    }

    return $result;
}

function fetch(PDO $db, string $query, ?array $array) : ?array {
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $stmt = $db->prepare($query);
    if(isset($array)){
        $stmt->execute($array);
    }else{
        $stmt->execute();
    }
    $result = $stmt->fetch();

    if (!$result) $result = null;

    if ($result !== null && isset($result)) {
        foreach ($result as $key => $value) {
            if (is_string($value)) {
                $result[$key] = htmlentities($value);
            }
        }
    }

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