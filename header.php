<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bs/css/bootstrap.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Dashsafe</title>
</head>
<body class='bg-secondary text-white'>
<nav class="navbar text-light navbar-light bg-dark">
<div class="container-fluid">
    <a class="navbar-brand text-primary" href="#">Dashsafe</a>

<ul class="nav nav-pills  justify-content-end bg-dark  text-light">
  <li class="nav-item">
    <a class="nav-link active" href="index.php">Main</a>
  </li>
  <li class="nav-item">
  <?php
  if(!isset($_SESSION['userId'])){
    echo '<a class="nav-link" href="signUp.php">Sign Up</a>';
    } ?>
  
  </li>
  <li class="nav-item">
    <?php
  if(isset($_SESSION['userId'])){
    echo '<a class="nav-link" href="account.php">Account</a>';
    } ?>
  </li>
  <li class="nav-item">
    <?php
    if(!isset($_SESSION['userId'])){
      echo '<a class="nav-link" href="logIn.php">Log In</a>';
    }else{
      echo '<a class="nav-link" href="logout.php">Log Out</a>';
    }
    

    ?>
  </li>
</ul>
</div>
</nav>