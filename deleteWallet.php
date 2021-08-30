<?php
//declaration of variables

//kapag pinindot ung delete, ung 'submitDelete' may value yan ng CriminalId sa row na buburahem, ung value na yun ung hahanapen sa database at buburahen.
if(isset ($_POST['walletDeleteKey'])){
	$conn=new mysqli('localhost', 'root','','dashsafewallets');
	$walletKey=$_POST['walletKey'];
	if($conn->connect_error){
	//check muna kung nakokonekta sa database
	echo "$conn->connect_error";
	die('Connection Failed :'.$conn->connect_error);

}else{
	//deleting part na sa mySQL database
	$submitDelete=$_POST['submitDelete'];
	$queryDelete= "DELETE FROM dashsafe where walletKey= '$walletKey'" or die("not deleted" . mysql_error());
	$result=$conn->query($queryDelete);
	$conn->close();
	header('Location:index.php');
}

}
	

?>