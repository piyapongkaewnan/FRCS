<?php
//session_start();

$set_times = 10; // Set timeout period in minutes
$inactive = $set_times * 60; // Converts minutes to seconds

if (isset($_SESSION['timeout'])) {
    $session_life = time() - $_SESSION['timeout'];
    if ($session_life >= $inactive) {
      //  session_destroy();
        @header("Location: logout.php");
    }
}

$_SESSION['timeout'] = time();


/*echo  'เวลาที่ตั้งไว้ให้ Timeout (นาที) : '.$set_times;
echo '<hr>ระยะเวลาทั้งหมดที่กำหนดให้ Timeout (วินาที)  : '.$inactive;
echo  '<hr>เวลาที่ไม่ได้เปิดเพจ (วินาที) : '.$session_life;
*/
?>