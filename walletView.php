<?php include 'C:\xampp\htdocs\Dashsafe\includes\dib.inc.php'?>
<div id="walletViewer" class='form-group m-2'>
				<h1>Wallet Viewer</h1>
				<div id="wallet">
					<div id="walletInfo">
						<div id="walletDetails">
						<?php

			if(isset($_REQUEST['walletKey'])){

				$trueWalletKey=$_REQUEST['walletKey'];
				$searchForWalletKey ="SELECT * from dashsafe where walletKey like '%$trueWalletKey%' ";
				$result=$conn->query($searchForWalletKey);
				if (!$result) {
					trigger_error('Invalid query: ' . $conn->error);
				}
				if($result->num_rows>0){
					while($row=$result->fetch_assoc()){
				echo "<div id='walletDetailsName'>". $row["name"]."</div><br>
				<div id='walletDetailsType'>". $row["type"]."</div><br>
				<div id='walletDetailsCurrency'>". $row["currency"]."</div><br>
				<div id='walletDetailsAmount'>". $row["amount"]."</div><br>
				<div id='walletDetailsDateUpdated'". $row["dateUpdated"]."></div><br>";
					}
			}}
			

		



?>
</div>