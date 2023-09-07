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

if($_FILES['upload_file']['size'] > 0) {

    $file = $_FILES['upload_file']['tmp_name'];
    $upload_directory = $_SERVER["DOCUMENT_ROOT"]. "/upload/";
    $ext_str = "jpeg,hwp,xls,doc,xlsx,docx,pdf,jpg,gif,png,txt,ppt,pptx";
    $allowed_extensions = explode(',', $ext_str);


    $max_file_size = 5242880;
    $ext = substr($_FILES['upload_file']['name'], strrpos($_FILES['upload_file']['name'], '.') + 1);

//    // 확장자 체크
//    if (!in_array($ext, $allowed_extensions)) {
//        $return_data["result_code"] = "2222";
//        $return_data["result_msg"] = "업로드할 수 없는 확장자 입니다.";
//    }
//
//    // 파일 크기 체크
//    if ($file['size'] >= $max_file_size) {
//        $return_data["result_code"] = "3333";
//        $return_data["result_msg"] = "5MB 까지만 업로드 가능합니다.";
//    }

    $path = md5(microtime()) . '.' . $ext;
    $save_filename = $upload_directory . $path;

    $destination_path = dirname(getcwd()).DIRECTORY_SEPARATOR;
    $target_path = $destination_path . 'upload/'. $path;
    @move_uploaded_file($_FILES['upload_file']['tmp_name'], $target_path);

//    $file_upload	= move_uploaded_file($_FILES['upload_file']['tmp_name'], $save_filename);

    $return_data["result_code"] = "0000";
    $return_data["result_msg"] = $path;

//    if (move_uploaded_file($file['tmp_name'], $upload_directory . $path)) {
//
//        $file_id = md5(uniqid(rand(), true));
//        $name_orig = $file['name'];
//        $name_save = $path;
//
//        $return_data["result_code"] = "0000";
//        $return_data["result_msg"] = "ok";
//    }else {
//        $return_data["result_code"] = "4444";
//        $return_data["result_msg"] = "파일이 업로드되지 않았습니다.";
//    }
} else{
    $return_data["result_code"] = "1111";
    $return_data["result_msg"] = "파일이 업로드되지 않았습니다.";
}

echo json_encode($return_data, JSON_UNESCAPED_UNICODE);
