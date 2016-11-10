<?php
@session_start();
/*
  print "<pre>";
  print_r($_POST);
  print "</pre>"; */

include('../../includes/DBConnect.php');

$action = $_POST['action'];
$group_id = $_POST['id'];
$group_name = $_POST['group_name'];
$group_desc = $_POST['group_desc'];
$user_id = $_SESSION['sess_user_id'];


if ($action == "actionCreate") {

    $sql = "INSERT INTO user_group ( group_name , group_desc, update_by  )
            VALUES ('$group_name' , '$group_desc',  $user_id);";
} else if ($action == "actionUpdate") {

    $sql = "UPDATE user_group
            SET   
                group_name = '$group_name',
                group_desc = '$group_desc',
                update_by = $user_id
            WHERE group_id = $group_id ";
} else if ($action == "actionDelete") {
    $sql = "DELETE FROM user_group WHERE group_id IN ($group_id)";
}
$result = $db->Execute($sql);
if ($result) {
    echo "1";
} else {
    echo "0";
}
?>