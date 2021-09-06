<h1>Add New Wallet</h1>
<div <div class='form-group m-2'>
<div>
	<form id="addWalletForm" action="./includes/moneyActions.php" method="post">
</div>
<div class="mb-3">
	<input name="walletName" class="rounded" placeholder="Wallet Name"></input>
</div>
<div class="mb-3">
	<input name="walletInitial"  class="rounded" id="addInitialMoney"type="number" min=0 step="0.1" placeholder="Initial Money">
</div>
<div class="mb-3">
	<select name="walletType"  class="rounded">
		<option value="" disabled selected>Select your option</option>
		<option value="piggy bank">piggy bank</option>
		<option value="bank">bank</option>
		<option value="e-bank">e-bank</option>
		<option value="others">others</option>
	</select>
</div>
<div class="mb-3">
	<select name="walletCurrency"  class="rounded" id="walletCurrency">
		<option value="" disabled selected>Select your currency</option>
	</select>
</div>
	<input type="hidden" value="<?php echo htmlspecialchars($_SESSION['userId']); ?>" name="userId">
<div class="mb-3">
	<input type="submit" name="addNewWallet" class='btn btn-dark'  value="Add New Wallet"	id="addWalletBtn"/?>
</div>
</div>
</form>