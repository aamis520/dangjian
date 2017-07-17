<?php
header('content-type:application:json;charset=utf8');
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Methods:POST');
header('Access-Control-Allow-Headers:x-requested-with,content-type');

if($_FILES["file"] == null){
    $result = array('Status' => "failed", 'error' => "no file selected");
    echo json_encode($result);
    return;
}

if(!isset($_POST["usrid"])){
    $result = array('Status' => "failed", 'error' => "usrid参数问题，无法提交");
    echo json_encode($result);
    return;
}

//个人上传的文件，存放到用户id自己下的url中去。
if($_FILES["file"]["error"]) {
    $result = array('Status' => "failed", 'error' => $_FILES["file"]["error"]);
    echo json_encode($result);
} else {
    if($_FILES["file"]["size"]<2048000) { //先定义限制为两M
   		$usrid = $_POST["usrid"];
        $filepath = "./uploadfile/".$usrid;
        if (!file_exists($filepath)){
            mkdir($filepath);
        }
        $filename = "./uploadfile/".$usrid."/".$_FILES["file"]["name"];
        try{
            move_uploaded_file($_FILES["file"]["tmp_name"],$filename);
        }catch (Exception $e){};
        $result = array('filename' => $_FILES["file"]["name"]);
        echo json_encode($result);
        exit();
    }
    else {
        $result = array('Status' => "failed", 'error' => "您的文件过大，请重新选择");
        echo json_encode($result);
        exit();
    }
}

?>