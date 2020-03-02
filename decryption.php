<?php

  session_start();

  //Initialisating Session Variables
  $_SESSION['message'] = "";

  //Initialising Variables
  $semail = "";
  $msgsub = "";
  $enmsg = "";
  $dekey = "";
  $cipher = "";
  $method = "";
  $message = "";

  //Create Connection
  $conn = mysqli_connect("localhost","root","","message_transfer");

  //Check Connection
  if (!$conn){
    die("Connection Failed: " . mysqli_connect_error());
  }

  //Checking if fields are empty or not

  if(isset($_POST['decrypt'])){
    if(empty($_POST['semail']) || empty($_POST['msgsub']) || empty($_POST['enmsg']) || empty($_POST['dekey'])){
      echo '<script>alert("Please enter all the fields")</script>';
    }
    else{

      //Fetch data from the form and store in the variables

      $semail = mysqli_real_escape_string($conn, $_POST['semail']);
      $msgsub = mysqli_real_escape_string($conn, $_POST['msgsub']);
      $enmsg = mysqli_real_escape_string($conn, $_POST['enmsg']);
      $dekey = mysqli_real_escape_string($conn, $_POST['dekey']);

      $user_check_query = "SELECT * FROM users WHERE email = '$semail'";
      $data_check_query = "SELECT * FROM data_store WHERE msgsub = '$msgsub' and cipher_key = '$dekey'";
      $result1 = mysqli_query($conn, $user_check_query);
      $result2 = mysqli_query($conn, $data_check_query);
      $mail = mysqli_fetch_assoc($result1);
      $data = mysqli_fetch_assoc($result2);

      if($mail['email'] === $remail){

        if($data['msgsub'] === $msgsub and $data['cipher_key'] === $dekey){

          if($enmsg === $_SESSION['enmsg']){

            $cipher = $data['cipher'];

          }

        }

      }

      //Providing a initialising vector
      $de_iv = "1029199712021998";
      $options = 0;

      //Decryption using RC4
      if($cipher === "RC4"){
        
          $method = "RC4";
          $iv_length = openssl_cipher_iv_length($method);

          $message = openssl_decrypt($enmsg, $method, $dekey, $options);
          echo '<script>alert("Recieved Successfully.")</script>';

      }
      
      //Encryption using AES-128-CBC
      if($cipher === "AES-128"){
        
        $method = "AES-128-CBC";
        $iv_length = openssl_cipher_iv_length($method);

        $message = openssl_decrypt($enmsg, $method, $dekey, $options, $de_iv);
        echo '<script>alert("Recieved Successfully.")</script>';

      }

      //Encryption using AES-192-CBC
      if($cipher === "AES-192"){
        
        $method = "AES-192-CBC";
        $iv_length = openssl_cipher_iv_length($method);

        $message = openssl_decrypt($enmsg, $method, $dekey, $options, $de_iv);
        echo '<script>alert("Recieved Successfully.")</script>';

      }

      //Encryption using AES-256-CBC
      if($cipher === "AES-256"){
        
        $method = "AES-256-CBC";
        $iv_length = openssl_cipher_iv_length($method);

        $message = openssl_decrypt($enmsg, $method, $dekey, $options, $de_iv);
        echo '<script>alert("Recieved Successfully.")</script>';

      }

    }

    $_SESSION['message'] = $message;
    
  }

  else{

    if(isset($_POST['back'])){
      header('location: encryption.php');
    }

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

    <title>Decrypt Here</title>
</head>
<body>
    
    <div class="container">
        <div class="setting">
          <div class="row">
            <form class="col s11" method="POST">

              <div class="row">
                <div class="input-field">
                  <i class="material-icons prefix">email</i>
                  <input id="semail" type="email" class="validate">
                  <label for="semail">Recieved From</label>
                </div>
              </div>

              <div class="row">
                <div class="input-field">
                  <i class="material-icons prefix">subject</i>
                  <input id="msgsub" type="text">
                  <label for="msgsub">Subject</label>
                </div>
              </div>

              <div class="row">
                <div class="input-field">
                  <i class="material-icons prefix">message</i>
                  <textarea id="enmsg" class="materialize-textarea"></textarea>
                  <label for="enmsg">Recieved Message</label>
                </div>
              </div>
              <!-- the user only gets the option to decrypt. no knowledge of encryption algorithm to be provided -->
              <div class="row">
                <div class="input-field">
                  <i class="material-icons prefix">vpn_key</i>
                  <input id="dekey" type="text">
                  <label for="dekey">Decryption Key</label>
                </div>
              </div>              

              <div class="center-align">
                <button class="btn waves-effect waves-light" type="submit" name="decrypt">Decrypt</button>
                <button class="btn waves-effect waves-light" type="submit" name="back">Back to Dashboard</button>
              </div>

            </form>
          </div>
        </div>
    </div>

</body>
</html>