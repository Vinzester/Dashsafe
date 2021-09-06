<div class="profile">
	<div id="profile_img_con">
		<img id="profile_img" src="imgs/pp.jpg"></img>
		<div>
			<small>premium</small>
		</div>
	</div>
	<div id="profile_text">
	<div id="profile_name">
	<?php 
		if(isset($_SESSION['username'])){
			echo $_SESSION['username'];
		}
		?>
	</div>
	<div id="profile_details">
		joined since March 2020
	</div>
	<div id="profile_total">
		total money: 5,432.12 PHP
	</div>
	</div>
</div>

<!-- ADD WALLET FORM -->
<form id="addWalletForm" action="addWallet.php" method="post">
<input name="walletName" placeholder="Wallet Name"></input>
<input name="walletInitial" id="addInitialMoney"type="number" min=0 step="0.1" placeholder="Initial Money">
<select name="walletType">
	<option value="" disabled selected>Select your option</option>
	<option value="piggy bank">piggy bank</option>
	<option value="bank">bank</option>
	<option value="e-bank">e-bank</option>
	<option value="others">others</option>
</select>
<select name="walletCurrency" id="walletCurrency">
	<option value="" disabled selected>Select your currency</option>
</select>
<button id="addWalletBtn" onclick="jack">Add Wallet</button>
</form>
<div id="wallet">
	<h1>Wallets Overview</h1>
		<table id="walletOverviewTable">
			<thead>
				<tr>
					<th>Wallet Name</th>
					<th>Wallet Type</th>
					<th>Amount Inside</th>
					<th>Currency</th>
					<th>Date Created</th>
					<th>Date Updated</th>
					<th></th>
					<th></th>
				</tr>
			</thead>	
			<tbody>
				<?php

				$conn=new mysqli('localhost', 'root','','dashsafewallets');
				if($conn->connect_error){
					//kapag may error
					echo "$conn->connect_error";
					die('Connection Failed :'.$conn->connect_error);
				}else{
					$sql="SELECT * from dashsafe" ;
					$result=$conn->query($sql);
					if($result->num_rows>0){
						while($row=$result->fetch_assoc()){
							echo "<tr><td>".
							 $row["name"]."</td><td>". $row["type"]."</td><td>". 
							 $row["amount"]."</td><td>". 
							 $row["currency"]."</td><td>".
							 $row["dateCreated"]."</td><td>".
							 $row["dateUpdated"]."</td>
							 <td><form action='' method='post'><input type='submit' value='open' name='walletOpenKey'></input><input type='hidden' name='walletKey'  value='" . htmlspecialchars($row["walletKey"]) . "''></input></form></td>
							 <td><form action='deleteWallet.php' method='post'><input type='submit' value='delete' name='walletDeleteKey'/><input type='hidden' name='walletKey' value='".htmlspecialchars($row["walletKey"])."'/></form></td>";
						}
					}
				}
				$conn->close();
				?>
			</tbody>
		</table>

</div>
<div id="walletViewer">
				<h1>Wallet Viewer</h1>
				<div id="wallet">
					<div id="walletInfo">
						<div id="walletDetails">
						<?php

if (isset($_POST['walletKey']) OR isset($_GET['walletKey']))
{
$conn=new mysqli('localhost', 'root','','dashsafewallets');
		if($conn->connect_error){
			//kapag may error
			echo "$conn->connect_error";
			die('Connection Failed :'.$conn->connect_error);
		}
        else{
			if(isset($_POST['walletKey']) or isset($_GET['walletKey'])){

				if(isset($_POST['walletKey'])){
					$trueWalletKey=$_POST['walletKey'];
				}else{
					$trueWalletKey=$_GET['walletKey'];
				}
		
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
			

		
}


}
?>
</div>
<?php
	if(isset($_POST['walletKey']) or isset($_GET['walletKey'])){

		if(isset($_POST['walletKey'])){
			$trueWalletKey=$_POST['walletKey'];
		}else{
			$trueWalletKey=$_GET['walletKey'];
		}
		echo"<div id='walletActions'>
	<form action='moneyActions.php' method='POST'>
		<input type='number' name='walletActionsAmount'/>
		<input type='hidden' name='walletKey' value='".$trueWalletKey."'/>
		<input type='submit' name='walletActionsDeposit' value='deposit'/>
	</form>
	<form action='moneyActions.php' method='POST'>
		<input type='number' name='walletActionsAmount'/>
		<input type='hidden' name='walletKey' value='".$trueWalletKey."'/>
		<input type='submit' name='walletActionsWithdraw' value='withdraw'/>
	</form>
	<form action='moneyActions.php' method='POST'>
		<input type='number' name='walletActionsAmount'/>
		<select name='walletActionsTransferTo'>";

		$conn=new mysqli('localhost', 'root','','dashsafewallets');
		if($conn->connect_error){
			//kapag may error
			echo "$conn->connect_error";
			die('Connection Failed :'.$conn->connect_error);
		}
		else{
			
			$searchForNames ="SELECT name,walletKey from dashsafe";
			$result=$conn->query($searchForNames);
			if($result->num_rows>0){
				while($row=$result->fetch_assoc()){
				echo "<option value='".$row['walletKey']."'>".$row['name']."</option>";
				
			}
		echo"</select>
		<input type='hidden' name='walletKey' value='".$trueWalletKey."'/>
		<input type='submit' name='walletActionsTransfer' value='transfer'/>
		</form>";
}}
	}else{
		echo "";
	}


	?>	
	
	
</div>
					
					</div>
				</div>
</div>
</body>
<script>

//LOAD CURRENCIES WHEN PAGE LOADED
var walletCurrency=document.querySelector("#walletCurrency")
	const currencyList=fetch('https://openexchangerates.org/api/currencies.json').then(response=>response.json()).then(data=>{
		Object.keys(data).forEach(values=>{
			var myNewOption = new Option(values,values)
			walletCurrency.add(myNewOption)
		})
	})


	

</script>
</html>
