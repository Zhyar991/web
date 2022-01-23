<?php

require_once "db.php";

try 
{
    $query = "SELECT * FROM cars";

    $db = new Db();
    $db = $db->connect();

    $stmt = $db->prepare($query);
    $stmt->execute();

    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $db = null;

    echo json_encode($data);
}
catch(PDOException $e)
{
    $data = array(
        "status" => "failed"
    );

    echo json_encode($data);
}

?>