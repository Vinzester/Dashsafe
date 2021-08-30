<?php
//declaration of variables
$walletName=$_POST['walletName'];
$walletType=$_POST['walletType'];
$walletInitial=$_POST['walletInitial'];
$walletCurrency=$_POST['walletCurrency'];
$conn=new mysqli('localhost', 'root','','dashsafewallets');
$date = date('Y-m-d H:i:s');
//check connection to the server & database
if($conn->connect_error){
    echo "$conn->connect_error";
    die('Connection Failed :'.$conn->connect_error);
}else{
    echo "connection good";
    $stmt= $conn->prepare("INSERT INTO dashsafe(name,type,amount,currency,dateUpdated) VALUES (?,?,?,?,?)");
    var_dump($stmt);
    $stmt->bind_param("ssiss",$walletName,$walletType,$walletInitial,$walletCurrency,$date);
    $execval=$stmt->execute();
    var_dump($stmt);
	header('Location:index.php?');
}
	//tapos kailangan iclose naten ung connection
	$conn->close();
?>