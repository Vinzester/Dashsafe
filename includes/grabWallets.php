<?php

					$userId=$_SESSION['userId'];
					$sql="SELECT * from dashsafe where userId LIKE '%$userId%' ";
					$result=$conn->query($sql);
					if($result->num_rows>0){
						while($row=$result->fetch_assoc()){
							$_SESSION['walletsExist']=true;
							 echo "<tr scope='row'><td>".
							 $row["name"]."</td><td>". $row["type"]."</td><td>". 
							 $row["amount"]."</td><td>". 
							 $row["currency"]."</td><td>".
							 $row["dateCreated"]."</td><td>".
							 $row["dateUpdated"]."</td>
							 <td><form action='' method='post'><input type='submit' value='🔑' name='walletOpenKey'></input><input type='hidden' name='walletKey'  value='" . htmlspecialchars($row["walletKey"]) . "''></input></form></td>
							 <td><form onsubmit='return confirm(\"Do you really want to delete this wallet?\");' action='./includes/moneyActions.php' method='post'><input type='submit' value='❌' name='walletDeleteKey'/><input type='hidden' name='walletKey' value='".htmlspecialchars($row["walletKey"])."'/></form></td>";
						}
					}else{
						$_SESSION['walletsExist']=false;
					}
				
				$conn->close();
?>