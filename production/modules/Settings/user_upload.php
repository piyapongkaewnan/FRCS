<?php
//session_start();

$user_id = $_SESSION['sess_user_id'];
print_r($_FILES);
if(!empty($_FILES)){
    
    $targetDir = "../../images/avatar/tmp/";
    $fileName = $_FILES['file']['name'];
    $targetFile = $targetDir.$fileName;
    
    if(move_uploaded_file($_FILES['file']['tmp_name'],$targetFile)){
        //insert file information into db table
      //  $conn->query("INSERT INTO files (file_name, uploaded) VALUES('".$fileName."','".date("Y-m-d H:i:s")."')");
    }
    
}
?>