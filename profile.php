<div class="d-flex justify-content-center align-items-center text-justify text-center bg-dark">
<div>
	<div id="profile_img_con">
		<img id="profile_img" src="imgs/pp.jpg"></img>
	</div>
	<div id="profile_text">
		<div id="profile_name">
			username:
		<?php 
			if(isset($_SESSION['username'])){
				echo $_SESSION['username'];
			}else{
				header("location:login.php");
			}
			?>
		</div>
		<div id="profile_details">
			date joined:
			<?php echo $_SESSION['dateJoined'];?>
		</div>
	</div>
		</div>
</div>