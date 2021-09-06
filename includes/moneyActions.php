<?php include_once 'dib.inc.php'?>
<?php
$date = date('Y-m-d H:i:s');
    if(isset($_POST['addNewWallet'])){
      $walletName=$_POST['walletName'];
      $userId=$_POST['userId'];
      $walletType=$_POST['walletType'];
      $walletInitial=$_POST['walletInitial'];
      $walletCurrency=$_POST['walletCurrency'];
      $conn=new mysqli('localhost', 'root','','dashsafewallets');
      $date = date('Y-m-d H:i:s');
      //check connection to the server & database
          $stmt= $conn->prepare("INSERT INTO dashsafe(name,userId,type,amount,currency,dateUpdated) VALUES (?,?,?,?,?,?)");
          var_dump($stmt);
          $stmt->bind_param("sisiss",$walletName,$userId,$walletType,$walletInitial,$walletCurrency,$date);
          $execval=$stmt->execute();
          header('Location:../account.php');

	      //tapos kailangan iclose naten ung connection
    	$conn->close();
    }
    if(isset ($_POST['walletDeleteKey'])){
      $conn=new mysqli('localhost', 'root','','dashsafewallets');
      $walletKey=$_POST['walletKey'];
      //deleting part na sa mySQL database
      $submitDelete=$_POST['submitDelete'];
      $queryDelete= "DELETE FROM dashsafe where walletKey= '$walletKey'" or die("not deleted" . mysql_error());
      $result=$conn->query($queryDelete);
      $conn->close();
      header('Location:../account.php');
    }
    
    if(isset($_POST['walletActionsDeposit']) AND !empty($_POST['walletActionsDeposit'])){
       $walletActionsDeposit= $_POST['walletActionsDeposit'];
       $walletActionsAmount=$_POST['walletActionsAmount'];
       $walletKey=$_POST['walletKey'];
       $initialAmount = $conn->query("SELECT amount FROM dashsafe WHERE walletKey=$walletKey");
       $initialAmount2 = $initialAmount->fetch_array()[0];
       $finalAmount=$initialAmount2 + $walletActionsAmount;
       $sql = "UPDATE dashsafe SET amount=$finalAmount WHERE walletKey=$walletKey";
       if ($conn->query($sql) === TRUE) {
        header('Location:../account.php?walletKey='.$walletKey);
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
        if($initialAmount2<$walletActionsAmount){
          header('Location:../account.php?walletKey='.$walletKey.'&error=Withdraw Failed');
        }else{
          $finalAmount=$initialAmount2 - $walletActionsAmount;

          $sql = "UPDATE dashsafe SET amount=$finalAmount WHERE walletKey=$walletKey";
          if ($conn->query($sql) === TRUE) {
            header('Location:../account.php?walletKey='.$walletKey);
         } else {
           echo "Error updating record: " . $conn->error;
         }
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
        if($initialAmount2<$walletActionsAmount){
          header('Location:../account.php?walletKey='.$walletKey.'&error=Transfer Failed');
        }else{
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
            header('Location:../account.php?walletKey='.$walletKey);
           }  
        }


    }

	//tapos kailangan iclose naten ung connection
	$conn->close();
?>