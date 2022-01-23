<?php

require_once "db.php";

$id = $_POST["id"];
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

    if(!empty($imageFile))
    {
        $query = "UPDATE cars SET `brand`='$brand', `model`='$model', `year`='$year', `condition`='$condition', `car_image`='$image' where `id`='$id'";
    }
    else
    {
        $query = "UPDATE cars SET `brand`='$brand', `model`='$model', `year`='$year', `condition`='$condition' where `id`='$id'";
    }

    

    $db = new Db();
    $db = $db->connect();

    $stmt = $db->prepare($query);
    $stmt->execute();

    $db= null;

    $data = array(
        "status" => "updated"
    );

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