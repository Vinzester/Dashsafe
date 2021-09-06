<?php include_once'header.php'?>
<section>
    <h1>Sign Up</h1>
    <form action="includes/signup.inc.php" method="post">
         <input name="email" placeholder="email" type="email"></input>
        <input name="username" placeholder="username"></input>
        <input name="password" type="password" placeholder="password"></input>
        <input name="passwordRepeat" placeholder="repeat password"></input>
        <input type="submit" value="signup" name="submit">
    </form>
    <?php
if(isset($_GET['error'])){
    if($_GET["error"]=="emptyinput"){
        echo "<p>Fill in all fields</p>";
    }
    else if($_GET["error"]=="invalidusername"){
        echo "<p>Invalid Username</p>";
    }
    else if($_GET["error"]=="invalidemail"){
        echo "<p>invalid Email</p>";
    }
    else if($_GET["error"]=="pwdsnotmatch"){
        echo "<p>Passwords do not match< /p>";
    }
    else if($_GET["error"]=="usernametaken"){
        echo "<p>Username Taken</p>";
    }
    else if($_GET["error"]=="stmtfailed2"){
        echo "<p>Internal Error</p>";
    }
    else{
        echo "<p>error none</p>";
    }

}
?>
</section>
<?php include_once'footer.php'?>
