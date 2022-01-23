<?php

require_once "db.php";

$brand = $_POST["brand"];
$model = $_POST["model"];
$year = $_POST["year"];
$condition = $_POST["condition"];

$image = rand(1000,10000) . '-' . $_FILES["image"]["name"];
$imageFile = $_FILES["image"]["tmp_name"];
$upload = 'photos';

move_uploaded_file($imageFile, $upload . '/' . $image);

try
{
    $query = "INSERT INTO cars (`brand`, `model`,`condition`, `year`,`car_image`) VALUES (?,?,?,?,?)";

    $db = new Db();
    $db = $db->connect();

    $stmt = $db->prepare($query);
    $stmt->execute([$brand, $model, $condition, $year, $image]);

    $db = null;

    $data = array(
        "status" => "added"
    );

    echo json_encode($data);

}catch(PDOException $e)
{
    $data = array(
        "status" => "failed"
    );

    echo json_encode($data);
}

?>