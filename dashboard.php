<?php

    session_start();

    if(isset($_POST['encrypt'])){
        header('location: encryption.php');
    }

    if(isset($_POST['decrypt'])){
        header('location: decryption.php');
    }

    if(isset($_POST['logout'])){
        header('location: login.php');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!--Import Custom CSS-->
    <link rel="stylesheet" href="/styles/style.css">

    <!-- Compiled and minified jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    <title>Dashboard</title>
</head>
<body>
    
    <div class="container">
        <div class="settingDashboard">
            <form method="POST"> 
                <button class="btn-large waves-effect waves-light" type="submit" name="encrypt" id="left">Encrypt</button>
                <button class="btn-large waves-effect waves-light" type="submit" name="decrypt" id="right">Decrypt</button><br><br><br>
                <!-- <a class="waves-effect waves-light btn-large" id="left">Encrypt</a>
                <a class="waves-effect waves-light btn-large" id="right">Decrypt</a><br><br><br> -->
                <button class="btn-large waves-effect waves-light" type="submit" name="logout">Logout</button>
            </form>
        </div>

        <div>
            
        </div>
    </div>

</body>
</html>