<?php
//declaration of variables
$conn=new mysqli('localhost', 'root','','dashsafewallets');
//check connection to the server & database
$sql=mysqli_query($conn,"SELECT * FROM dahsafe");
$result=mysqli_fetch_all($sql,MYSQLI_ASSOC);
exit(json_encode($result));

	//tapos kailangan iclose naten ung connection

?>