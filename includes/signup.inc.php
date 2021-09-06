<?php
if(isset($_POST['submit']))
{
    $username=$_POST['username'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $passwordRepeat=$_POST['passwordRepeat'];

    require_once  'dib.inc.php';
    require_once 'functions.inc.php';

    if(emptyInputSignup($username,$email,$password,$passwordRepeat)!==false){
        header("location:../signUp.php?error=emptyinput");
        exit();
    }
    if(invalidUsername($username)!==false){
        header("location:../signUp.php?error=invalidUsername");
        exit();
    }
    if(invalidEmail($email)!==false){
        header("location:../signUp.php?error=invalidEmail");
        exit();
    }
    if(pwdMatch($password,$passwordRepeat)!==false){
        header("location:../signUp.php?error=pwdsnotmatch");
        exit();
    }
    if(usernameExists($conn,$username,$email)!==false){
        header("location:../signUp.php?error=usernametaken");
        exit();
    }
    createUser($conn,$username,$email,$password);
}else{
    header("location:../signUp.php");
    exit();
}

?>
