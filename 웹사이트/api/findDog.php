<?php

require '../common.php';

$size = $_REQUEST["size"];
$place = $_REQUEST["place"];
$breed = explode(", ", $_REQUEST["breed"]);

$return_data = array();

$filterQuery = $database->getReference('posts');
//    ->orderByChild('size')
//    ->equalTo($size);

$filteredData = [];
$queryResult = $filterQuery->getValue();
if (!empty($queryResult)) {
    $filteredData = array_values($queryResult);
}

//$results = array_filter($filteredData, function($item) {
//    return $item['size'] === $_REQUEST["size"] && $item['place'] === $_REQUEST["place"] &&
//        ($item["breed"] === $_REQUEST["breed"][0] || $item["breed"] === $_REQUEST["breed"][1] || $item["breed"] === $_REQUEST["breed"][2] || $item["breed"] === $_REQUEST["breed"][3]);
//});

$return_data["result_code"] = "0000";
$return_data["result_msg"] = "ok";
$return_data["result_data"] = $filteredData;
$return_data["body"] = array(
    "size" => $size,
    "place" => $place,
    "breed" => $breed
);

echo json_encode($return_data, JSON_UNESCAPED_UNICODE);