<?php
require '../common.php';

$size = $_REQUEST["size"];
$place = $_REQUEST["place"];
$breed = explode(", ", $_REQUEST["breed"]);

$return_data = array();

$filterQuery = $database->getReference('posts');

$filteredData = [];
$queryResult = $filterQuery->getValue();

if (!empty($queryResult)) {
    // 필터링 작업을 이곳에서 수행해야 합니다.
    foreach ($queryResult as $key => $item) {
        if (
            $item['size'] === $size &&
            $item['place'] === $place &&
            in_array($item["breed"], $breed)
        ) {
            $filteredData[$key] = $item;
        }
    }
}

$return_data["result_code"] = "0000";
$return_data["result_msg"] = "ok";
$return_data["result_data"] = array_values($filteredData);
$return_data["body"] = array(
    "size" => $size,
    "place" => $place,
    "breed" => $breed
);

echo json_encode($return_data, JSON_UNESCAPED_UNICODE);
?>
