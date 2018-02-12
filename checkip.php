<?php      
error_reporting(0);
$time = date('Y-m-d'); // time day 
require_once'config.php';
$sql = "SELECT ip FROM log WHERE time='$time'"; //WHERE time on database
$result = $log_db->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    	if($result->num_rows > 0){
      $ip=$row["ip"];
  }
    }
} else {
    echo "";
}
$iptookien = htmlentities(htmlspecialchars($_COOKIE["filter_ip"])); //filters all character and all A-z
if (($_SERVER['REMOTE_ADDR']==$ip) && ($iptookien == $ip)) {
   header("location: filter.php");
   exit();
}
?>