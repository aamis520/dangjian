<?php

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


if($_FILES["file"]["error"]) {
    $result = array('Status' => "failed", 'error' => $_FILES["file"]["error"]);
    echo json_encode($result);
} else {
    if(($_FILES["file"]["type"]=="image/jpeg" || $_FILES["file"]["type"]=="image/png") && $_FILES["file"]["size"]<102400) {
   		$usrid = $_POST["usrid"];
        $filename = "./avatar/".$usrid.".jpg";
        $filename = iconv("UTF-8","gb2312",$filename);
        move_uploaded_file($_FILES["file"]["tmp_name"],$filename);
        $result = array('Status' => "success", 'filename' => $filename);
        echo json_encode($result);
    }
    else {
        $result = array('Status' => "failed", 'error' => "您的文件过大，请重新选择");
        echo json_encode($result);
    }
}

?>