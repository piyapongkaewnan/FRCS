<?php
@session_start();
include('./includes/DBConnect.php');

############################
# Set Debug Mode for Develope / In case on Site  set to false
$db->debug = false; # Change to false for Production

switch ($_POST['action']) {
    case 'save_stat' :
        $sql_action = "INSERT INTO  stats_events  (user_id, session_id,menu_id)  VALUES(  " . $_SESSION['sess_user_id'] . " ,'" . $_SESSION['sess_id'] . "' , " . $_POST['menu_id'] . " )";
        break;

    case 'add_favorites' :
        $sql_action = "INSERT INTO  favorites  (user_id,menu_id)  VALUES( " . $_SESSION['sess_user_id'] . " , " . $_POST['menu_id'] . ")";
        break;

    case 'remove_favorites' :
        $sql_action = "DELETE FROM  favorites WHERE user_id =  " . $_SESSION['sess_user_id'] . " AND menu_id = " . $_POST['menu_id'] . " ";
        break;
}

$rs = $db->Execute($sql_action);
if ($rs) {
    echo true;
} else {
    echo false;
}
?>