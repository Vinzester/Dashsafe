<?php include_once 'C:\xampp\htdocs\Dashsafe\includes\dib.inc.php'?>
<?php
	if(isset($_REQUEST['walletKey'])){

		$trueWalletKey=$_REQUEST['walletKey'];

		echo"<div id='walletActions' class='form-group m-2'>
		 
	<form class='form-inline' action='./includes/moneyActions.php' method='POST'>
	<div class='form-group mb-2'>
		<input type='number' min='1' name='walletActionsAmount'/>
		<input type='hidden' name='walletKey' value='".$trueWalletKey."'/>
		<input type='submit' class='btn btn-dark' name='walletActionsDeposit' value='deposit'/>
	</div>
	</form>
	<form action='./includes/moneyActions.php' method='POST'>
	<div class='form-group mb-2'>
		<input type='number' min='1' name='walletActionsAmount'/>
		<input type='hidden' name='walletKey' value='".$trueWalletKey."'/>
		<input type='submit' class='btn btn-dark' name='walletActionsWithdraw' value='withdraw'/>
		</div>
	</form>
	<form action='./includes/moneyActions.php' method='POST'>
	<div class='form-group mb-2'>
		<input type='number' min='1' name='walletActionsAmount'/>
		<select class='form-select-sm' name='walletActionsTransferTo'>";
			$searchForNames ="SELECT name,walletKey from dashsafe";
			$result=$conn->query($searchForNames);
			if($result->num_rows>0){
				while($row=$result->fetch_assoc()){
				if($trueWalletKey!=$row['walletKey']){
					echo "<option value='".$row['walletKey']."'>".$row['name']."</option>";		
				}
			}
		echo"</select>
		<input type='hidden' name='walletKey' value='".$trueWalletKey."'/>
		<input type='submit' class='btn btn-dark' name='walletActionsTransfer' value='transfer'/>
		</div>
		</form>";
}
	}
		if(isset($_GET['error'])){
			echo '<small>'.$_GET['error'].'</small>';
		}

	?>	
	
	
</div>
					
</div>
</div>
</div>
