<?php

require_once "db.php";

$id = $_GET["id"];

try
{
    $query = "SELECT * FROM cars where id='$id'";

    $db = new Db();
    $db = $db->connect();

    $stmt = $db->prepare($query);
    $stmt->execute();

    $db = null;

    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

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