<?php
//SIGN UP
function emptyInputSignup($username,$email,$password,$passwordRepeat){
    $result;
    if(empty($username)||empty($email)||empty($password)||empty($passwordRepeat)){
        $result=true;
    }else{
        $result=false;
    }
    return $result;
}

function invalidUsername($username){
    $result;
    if(!preg_match("/[a-zA-Z0-9]*$/", $username)){
        $result=true;
    }else{
        $result=false;
    }
    return $result;
}

function invalidEmail($email){
    $result;
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $result=true;
    }else{
        $result=false;
    }
    return $result;
}

function pwdMatch($password,$passwordRepeat){
    $result;
    if($password!==$passwordRepeat){
        $result=true;
    }else{
        $result=false;
    }
    return $result;
}

function usernameExists($conn,$username,$email){
    $sql="SELECT * FROM users WHERE username = ? OR email = ?;";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location:../signUp.php?error=usernametaken");
        exit();
    }
    mysqli_stmt_bind_param($stmt,"ss",$username,$email);
    mysqli_stmt_execute($stmt);

    $resultData=mysqli_stmt_get_result($stmt);

    if($row=mysqli_fetch_assoc($resultData)){
        return $row;
    }else{
        $result=false;
        return $result;
    }
    mysqli_stmt_close($stmt);

}

function createUser($conn,$username,$email,$password){
    $sql="INSERT INTO users (username,email,userPassword) VALUES (?, ?, ?);";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location:../signUp.php?error=stmtfailed2");
        exit();
    }
    $hashPwd=password_hash($password, PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stmt,"sss",$username,$email,$hashPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location:../signUp.php?error=none");
    exit();
}

//LOG IN
function emptyInputLogin($username,$password){
    $result;
    if(empty($username)||empty($password)){
        $result=true;
    }else{
        $result=false;
    }
    return $result;
}

function loginUser($conn,$username,$password){
    $usernameExists=usernameExists($conn,$username,$username);
    if($usernameExists===false){
        header('location:../login.php?error=wronglogin1');
        exit();
    }
    $pwdHashed=$usernameExists['userPassword'];
    $checkPwd=password_verify($password,$pwdHashed);

    if($checkPwd == false){
        header('location:../login.php?error=passwordFailed');
        exit();
    }else{
        session_start();
        $_SESSION["userId"]=$usernameExists["userId"];
        $_SESSION["username"]=$usernameExists["username"];
        $_SESSION["dateJoined"]=$usernameExists["dateJoined"];
        header("location:../account.php");
        exit(); 
    }
}
?>