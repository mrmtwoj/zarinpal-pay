<?php
// Disable Error php
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
    $expire = time( )+900; //15min
    setcookie ( "filter_ip",$user_ip, $expire , "192.168.1.9" ) ; //ex 192.168.1.9 == addrress web site
   // require_once'checkip.php'; //check ip filters
    $user_ip = getUserIP(); // $user_ip : ip user detail
    $time = date('Y-m-d'); // time day 
    $tokenid =htmlentities(htmlspecialchars(rand())); //gnarat number (0000)
// connect to database 
   	require_once'config.php';
    if($connect){
        $id = htmlentities(htmlspecialchars($_GET['id'])); // input id GET web site : user web site
        $cash = htmlentities(htmlspecialchars($_GET['cash'])); // input id GET web site : cash oanel id
    }else{
    $error='Error Connect To Database request.php';
    }
    
// generat cookie (10 mint) (PaymentRequest : $id : ID web site user  )
    $expire = time( )+60; //edit time
    $domain = $_SERVER['REQUEST_URI'];
    setcookie ( "cash",$cash, $expire , "192.168.1.9" ) ; //ex 192.168.1.9 == addrress web site
    setcookie ( "tokenid",$tokenid, $expire , "192.168.1.9" ) ; //ex 192.168.1.9 == addrress web site
// generat session :id_site 
    session_start('a')   ;
    $_SESSION [ 'id' ] = $id ; //-> id in the session
    $_SESSION [ 'cash' ] = $cash ; //-> cash in the session
// input zarinpal 
    $MerchantID = 'test';  //Merche ID zarinpal
    $Amount = $cash; // input cash use id
    if($id == '10'){
    $Description = 'Using 10 Panle'; 
    }elseif ($id == '20') {
    $Description = 'Using 20 Panle'; 
    }else{
    $error='User Delete Or Change id number request.php';
    }
    if($cash == '100'){ 
    }elseif ($cash == '200') {
    }else{
    $error='User Delete Or Change cash number request.php';
    }
// connect to zarinpal script
    $CallbackURL = 'http://192.168.1.9/pay/verify.php'; //ex 192.168.1.9 == addrress web site
    $client = new SoapClient('https://sandbox.zarinpal.com/pg/services/WebGate/wsdl',array('encoding' => 'UTF-8')); // edit address sandbox
    $result = $client->PaymentRequest(
                                        array(

                                            'MerchantID'     => $MerchantID,
                                            'Amount'         => $Amount,
                                            'Description'    => $Description,
                                            'Email'          => $Email,
                                            'Mobile'         => $Mobile,
                                            'CallbackURL'    => $CallbackURL,
                                        ) 
    );
    $au = $result->Authority; 
    $status=$result->Status;
    if($au!=''){
    $sql = "INSERT INTO pay (authority, amount, data,ip,tokenid) VALUES ('$au', '$Amount', '$time','$user_ip','$tokenid')"; // Insert Data in Database
    if(mysqli_query($connect, $sql)){
        echo "";
    }
    }
    if($status==100) {
        header('Location: https://sandbox.zarinpal.com/pg/StartPay/' . $au); // Send Data To Zarinpal

    }else{
        $log = "INSERT INTO log (ip,time,error) VALUES ('$user_ip', '$time', '$error')"; // Insert Data in Database
         if(mysqli_query($log_db, $log)){
         echo "Plase Reload Payment Your Ip : $user_ip ";

    }
    }
    $connect->close();
?>
