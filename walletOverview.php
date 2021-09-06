<?php include 'C:\xampp\htdocs\Dashsafe\includes\dib.inc.php'?>
<h1>Wallets Overview</h1>
<?php
$userId=$_SESSION['userId'];
$sql="SELECT * from dashsafe where userId LIKE '%$userId%' ";
$result=$conn->query($sql);
if($result->num_rows>0){
	$_SESSION['walletsExist']=true;}
	else{
	$_SESSION['walletsExist']=false;
}
if(isset($_SESSION['walletsExist'])){
	if($_SESSION['walletsExist']==true){
		echo '<div id="wallet">
			<table class="table table-dark table-borderless align-middle text-justify text-center" id="walletOverviewTable">
				<thead>
					<tr class="table-primary">
						<th scope="col">Wallet Name</th>
						<th scope="col">Wallet Type</th>
						<th scope="col">Amount Inside</th>
						<th scope="col">Currency</th>
						<th scope="col">Date Created</th>
						<th scope="col">Date Updated</th>
						<th>open</th>
						<th>delete</th>
					</tr>
				</thead>	
				<tbody>';
	
}else{
	echo '<p class="m-3">no wallets found</p>';
}
}



					if($result->num_rows>0){
						$_SESSION['walletsExist']=true;
						while($row=$result->fetch_assoc()){
							 echo "<tr scope='row'><td>".
							 $row["name"]."</td><td>". $row["type"]."</td><td>". 
							 $row["amount"]."</td><td>". 
							 $row["currency"]."</td><td>".
							 $row["dateCreated"]."</td><td>".
							 $row["dateUpdated"]."</td>
							 <td><form action='' method='post'><input type='submit' value='🔑' name='walletOpenKey'></input><input type='hidden' name='walletKey'  value='" . htmlspecialchars($row["walletKey"]) . "''></input></form></td>
							 <td><form onsubmit='return confirm(\"Do you really want to delete this wallet?\");' action='./includes/moneyActions.php' method='post'><input type='submit' value='❌' name='walletDeleteKey'/><input type='hidden' name='walletKey' value='".htmlspecialchars($row["walletKey"])."'/></form></td>";
						}
						echo'</tbody></table></div>';
					}else{
						$_SESSION['walletsExist']=false;
					}
				
				$conn->close();
?>
		