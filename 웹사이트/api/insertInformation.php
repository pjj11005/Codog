<?php
require '../common.php';

$fileName = $_REQUEST["fileName"];
$name = $_REQUEST["name"];
$password = $_REQUEST["password"];
$size = $_REQUEST["size"];
$place = $_REQUEST["place"];
$lively = $_REQUEST["lively"];
$neutered = $_REQUEST["neutered"];
$sex = $_REQUEST["sex"];
$breed = $_REQUEST["breed"];
$return_data = array();

$newData = [
    'photo' => $fileName,
    'name' => $name,
    'password' => $password,
    'size' => $size,
    'place' => $place,
    'lively' => $lively,
    'sex' => $sex,
    'neutered' => $neutered,
    'breed' => $breed
];

$reference = $database->getReference('posts');
$reference->push($newData);

$return_data["result_code"] = "0000";
$return_data["result_msg"] = "ok";
echo json_encode($return_data, JSON_UNESCAPED_UNICODE);