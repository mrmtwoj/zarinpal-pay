<?php
    error_reporting(0);
    function getUserIP()
    {
    $client  = @$_SERVER['HTTP_CLIENT_IP']; // information ip client
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR']; // information ip forwarde
    $remote  = $_SERVER['REMOTE_ADDR']; // remote ip 

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    return $ip;
}
  $user_ip = getUserIP(); // $user_ip : ip user detail
  $expire = time( )+900; // time 15 mint
    setcookie ( "filter_ip",$user_ip, $expire , "192.168.1.9" ) ; //ex 192.168.1.9 == addrress web site
  //  require_once'checkip.php';
    $time = date('Y-m-d'); // time day 
    require_once'config.php';

  $cash_cookie = htmlentities(htmlspecialchars($_COOKIE["cash"]));
  $tokenid = htmlentities(htmlspecialchars($_COOKIE["tokenid"]));
  session_start('a');
  if($_SESSION [ 'id' ] != ''){
  $id= htmlentities(htmlspecialchars($_SESSION [ 'id' ]));
  $cash_session = htmlentities(htmlspecialchars($_SESSION [ 'cash' ]));
}
  else
  {
    $error='user change or delete session verify.php';
  }
if($cash_cookie != $cash_session){
  $error="user change Cash plan verify.php";
  unset($_SESSION['id']);
  unset($_SESSION['cash']);
  $log = "INSERT INTO log (ip,time,error) VALUES ('$user_ip', '$time', '$error')"; // Insert Data in Database
         if(mysqli_query($log_db, $log)){
         echo "
         <h3>Error</h3>
        Please not change cash plan !! your ip filter $user_ip
        <hr>
     <font size='2px'>PowerBy : phpIDS & WafProments,2017</font>
         ";
         $connect->close();
}
else
{

}
}
    $MerchantID = 'test';
    $Amount = $cash_cookie; //Amount will be based on Toman
    $Authority = htmlentities(htmlspecialchars($_GET['Authority'])); //insert input : URL back
    $query = "SELECT Authority FROM pay WHERE tokenid = '$tokenid' AND Authority = '$Authority'";
    if(mysqli_connect_errno($connect) > 0)
        echo "Can not connect to server<br/>";
    else{
        $result = mysqli_query($connect, $query);
        while($persons = mysqli_fetch_array($result)){
        $authority_out= $persons['Authority'];
         }
    }
    if($Authority!=$authority_out){
        $error="user change Authority in the verify.php";
        unset($_SESSION['id']);
        unset($_SESSION['cash']);
        $log = "INSERT INTO log (ip,time,error) VALUES ('$user_ip', '$time', '$error')"; // Insert Data in Database
        if(mysqli_query($log_db, $log)){
        echo "
        <h3>Error</h3>
        Please not change Authority  !! your ip filter $user_ip
        <hr>
        <font size='2px'>PowerBy : phpIDS & WafProments,2017</font> 
         ";
         $connect->close();
    }
}
    if($_GET['Status'] == 'OK') {  //OK status IF
        $client = new SoapClient('https://sandbox.zarinpal.com/pg/services/WebGate/wsdl', array('encoding' => 'UTF-8'));
        $result=$client->PaymentVerification(
                                            array(
                                                'MerchantID'     => $MerchantID,
                                                'Authority'      => $Authority,
                                                'Amount'         => $Amount,
                                            )

        );
    }
        if ($result->Status == 100) {
            $refid=$result->RefID;
            $sql = "UPDATE pay SET refid='$refid' WHERE tokenid='$tokenid'";
            if (mysqli_query($connect, $sql)) {
              if($refid != ''){
            echo "Record updated successfully";
          }else
          $error="refid no paramerts !!";
            } else {
        $error="payment error becuase change parametrs verify.php";
        $log = "INSERT INTO log (ip,time,error) VALUES ('$user_ip', '$time', '$error')"; // Insert Data On Database
        if(mysqli_query($log_db, $log)){
    }
            }
    }
    if($_GET['Status'] == 'NOK'){
        echo "ERROR No Price MINT";
    }
$connect->close();
//delete all sessions and cookies 
  session_start('a');
  unset($_SESSION['id']);
  unset($_SESSION['cash']);
  if (isset($_COOKIE['cash'])) {
    unset($_COOKIE['cash']);
    unset($_COOKIE['tokenid']);
    setcookie('tokenid', null, -1, '/');
    setcookie('cash', null, -1, '/');
    return true;
} else {
    return false;
}
?>