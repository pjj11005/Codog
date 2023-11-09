<?php
//echo "<pre>";
//print_r($_POST);
//echo "</pre>";
//
//echo "<pre>";
//print_r($_FILES);
//echo "</pre>";
//exit;
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
$return_data = array();


//if($_FILES['upload_file']['size'] > 0) {

$file = $_FILES['upload_file']['tmp_name'];
$upload_directory = $_SERVER["DOCUMENT_ROOT"]. "/upload/";
$ext_str = "jpeg,hwp,xls,doc,xlsx,docx,pdf,jpg,gif,png,txt,ppt,pptx";
$allowed_extensions = explode(',', $ext_str);


$max_file_size = 5242880;
$ext = substr($_FILES['upload_file']['name'], strrpos($_FILES['upload_file']['name'], '.') + 1);

$path = md5(microtime()) . '.' . $ext;
$save_filename = $upload_directory . $path;

$destination_path = dirname(getcwd()).DIRECTORY_SEPARATOR;
$target_path = $destination_path . 'upload/'. $path;
@move_uploaded_file($_FILES['upload_file']['tmp_name'], $target_path);


$return_data["result_code"] = "0000";
$return_data["result_msg"] = $path;


echo json_encode($return_data, JSON_UNESCAPED_UNICODE);

