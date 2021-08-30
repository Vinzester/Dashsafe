<?php
$conn=new mysqli('localhost', 'root','','dashsafewallets');
$date = date('Y-m-d H:i:s');

if($conn->connect_error){
    echo "$conn->connect_error";
    die('Connection Failed :'.$conn->connect_error);

}else{
    if(isset($_POST['walletActionsDeposit']) AND !empty($_POST['walletActionsDeposit'])){
       $walletActionsDeposit= $_POST['walletActionsDeposit'];
       $walletActionsAmount=$_POST['walletActionsAmount'];
       $walletKey=$_POST['walletKey'];
       $initialAmount = $conn->query("SELECT amount FROM dashsafe WHERE walletKey=$walletKey");
       $initialAmount2 = $initialAmount->fetch_array()[0];
       $finalAmount=$initialAmount2 + $walletActionsAmount;
       $sql = "UPDATE dashsafe SET amount=$finalAmount WHERE walletKey=$walletKey";
       if ($conn->query($sql) === TRUE) {
        header('Location:index.php?walletKey='.$walletKey);
      } else {
        echo "Error updating record: " . $conn->error;
      }
    }
    if(isset($_POST['walletActionsWithdraw']) AND !empty($_POST['walletActionsWithdraw'])){
        $walletActionsWithdraw= $_POST['walletActionsWithdraw'];
        $walletActionsAmount=$_POST['walletActionsAmount'];
        $walletKey=$_POST['walletKey'];
        $initialAmount = $conn->query("SELECT amount FROM dashsafe WHERE walletKey=$walletKey");
        $initialAmount2 = $initialAmount->fetch_array()[0];
        $finalAmount=$initialAmount2 - $walletActionsAmount;
        $sql = "UPDATE dashsafe SET amount=$finalAmount WHERE walletKey=$walletKey";
        if ($conn->query($sql) === TRUE) {
         header('Location:index.php?walletKey='.$walletKey);
       } else {
         echo "Error updating record: " . $conn->error;
       }
    }
    if(isset($_POST['walletActionsTransfer']) AND !empty($_POST['walletActionsTransfer'])){
        $walletActionsTransfer= $_POST['walletActionsTransfer'];
        $walletActionsAmount=$_POST['walletActionsAmount'];
        $walletKey=$_POST['walletKey'];
        $receiverAcc=$_POST['walletActionsTransferTo'];

        //Transfer From
        $initialAmount = $conn->query("SELECT amount FROM dashsafe WHERE walletKey=$walletKey");
        $initialAmount2 = $initialAmount->fetch_array()[0];
        $finalAmount=$initialAmount2 - $walletActionsAmount;
        $sql = "UPDATE dashsafe SET amount=$finalAmount WHERE walletKey=$walletKey";
        if (!$conn->query($sql) === TRUE) {
          echo "Error updating record: " . $conn->error;
         } 
        //Tranfer To
        $initialAmount3 = $conn->query("SELECT amount FROM dashsafe WHERE walletKey=$receiverAcc");
        $initialAmount4 = $initialAmount3->fetch_array()[0];
        $finalAmount2=$initialAmount4 + $walletActionsAmount;
        $sql2 = "UPDATE dashsafe SET amount=$finalAmount2 WHERE walletKey=$receiverAcc";
   
        if (!$conn->query($sql2) === TRUE) {
          echo "Error updating record: " . $conn->error;
         } else{
          header('Location:index.php?walletKey='.$walletKey);
         }
    }
}
	//tapos kailangan iclose naten ung connection
	$conn->close();
?>