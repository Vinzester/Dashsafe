<?php include_once'header.php'?>
<section>
    <h1>Log In</h1>
    <form action="includes/login.inc.php" method="post">
        <input name="username" placeholder="username"></input>
        <input name="password" type="password" placeholder="password"></input>  
        <input type="submit" value="login" name="submit"/>
    </form>
    <?php
if(isset($_GET['error'])){
    if($_GET["error"]=="emptyinput"){
        echo "<p>Fill in all fields</p>";
    }
    else if($_GET["error"]=="wronglogin1"){
        echo "<p>invalid username or email</p>";
    }
    else if($_GET["error"]=="passwordFailed"){
        echo "<p>password invalid</p>";
    }

}
?>
</section>
<?php include_once'footer.php'?>
