<?php

  session_start();

  //Initialising Session variables\
  $_SESSION['enmsg'] = "";
  $_SESSION['semail'] = "";
  //$_SESSION['remail'] = "";
  $_SESSION['msgsub'] = "";
  $_SESSION['cipher'] = "";

  //Variable Initialisation
  $semail = "";
  $remail = "";
  $msgsub = "";
  $message = "";
  $cipher = "";
  $enkey = "";
  $enmsg = "";
  $method ="";

  //Create Connection
  $conn = mysqli_connect("localhost","root","","message_transfer");

  //Check Connection
  if (!$conn){
    die("Connection Failed: " . mysqli_connect_error());
  }

  //For entering the data in table

  //check the fields are empty or not

  if(isset($_POST['encrypt'])){
    if(empty($_POST['semail']) || empty($_POST['remail']) || empty($_POST['msgsub']) || empty($_POST['message']) || empty($_POST['cipher']) || empty($_POST['enkey'])){
      echo '<script>alert("Please fill all the fields")</script>';
    }
    else{

      //fetch data from the form and store in variables

      $semail = mysqli_real_escape_string($conn, $_POST['semail']);
      $remail = mysqli_real_escape_string($conn, $_POST['remail']);
      $msgsub = mysqli_real_escape_string($conn, $_POST['msgsub']);
      $message = mysqli_real_escape_string($conn, $_POST['message']);
      $cipher = mysqli_real_escape_string($conn, $_POST['cipher']);
      $enkey = mysqli_real_escape_string($conn, $_POST['enkey']);

      $user_check_query = "SELECT * FROM users WHERE email='$semail' AND email='$remail'";
      $result = mysqli_query($conn, $user_check_query);
      $mail = mysqli_fetch_assoc($result);

      if($mail['email'] === $semail and $mail['email'] === $remail){
        
        //Providing a initialising vector
        $en_iv = "1029199712021998";
        $options = 0;

        //Encryption using RC4
        if($cipher === "RC4"){
          
            $method = "RC4";
            $iv_length = openssl_cipher_iv_length($method);

            $enmsg = openssl_encrypt($message, $method, $enkey, $options);
            echo '<script>alert("Sent Successfully.")</script>';

        }
        
        //Encryption using AES-128-CBC
        if($cipher === "AES-128"){
          
          $method = "AES-128-CBC";
          $iv_length = openssl_cipher_iv_length($method);

          $enmsg = openssl_encrypt($message, $method, $enkey, $options, $en_iv);
          echo '<script>alert("Sent Successfully.")</script>';

        }

        //Encryption using AES-192-CBC
        if($cipher === "AES-192"){
          
          $method = "AES-192-CBC";
          $iv_length = openssl_cipher_iv_length($method);

          $enmsg = openssl_encrypt($message, $method, $enkey, $options, $en_iv);
          echo '<script>alert("Sent Successfully.")</script>';

        }

        //Encryption using AES-256-CBC
        if($cipher === "AES-256"){
          
          $method = "AES-256-CBC";
          $iv_length = openssl_cipher_iv_length($method);

          $enmsg = openssl_encrypt($message, $method, $enkey, $options, $en_iv);
          echo '<script>alert("Sent Successfully.")</script>';

        }
        
        //Insert into table

        $query = "INSERT INTO data_store (semail, remail, msgsub, msg, cipher, cipher_key, enmsg) VALUES('$semail', '$remail', '$msgsub', '$message', '$cipher', '$enkey', '$enmsg')";
        mysqli_query($conn, $query);
        echo '<script>alert("Sent Successfully.")</script>';
        header('location: sentmsg.php');

      }
      
    }

  }

  $_SESSION['enmsg'] = $enmsg;
  $_SESSION['cipher'] = $method;
  $_SESSION['msgsub'] = $msgsub;

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

    <!-- Initialisation for the Encryption Cipher Dropdown -->
    <script>
      $(document).ready(function() {
         $('select').formSelect();
      });
   </script>

    <title>Encrypt Here</title>
</head>
<body>
    
    <div class="container">
        <div class="setting">
          <div class="row">
            <form class="col s11" method="POST">

              <div class="row">
                <div class="input-field">
                  <i class="material-icons prefix">email</i>
                  <input id="semail" type="email" class="validate" name="semail">
                  <label for="semail">Sender's Email</label>
                </div>
              </div>

              <div class="row">
                <div class="input-field">
                  <i class="material-icons prefix">email</i>
                  <input id="remail" type="email" class="validate" name="remail">
                  <label for="remail">Reciever's Email</label>
                </div>
              </div>

              <div class="row">
                <div class="input-field">
                  <i class="material-icons prefix">subject</i>
                  <input id="msgsub" type="text" name="msgsub">
                  <label for="msgsub">Subject</label>
                </div>
              </div>

              <div class="row">
                <div class="input-field">
                  <i class="material-icons prefix">message</i>
                  <textarea id="message" class="materialize-textarea" name="message"></textarea>
                  <label for="message">Message</label>
                </div>
              </div>

              <div class="row">
                <div class="input-field">
                  <i class="material-icons prefix">lock</i>
                  <select name="cipher">
                    <option value="" disabled selected>Choose your option</option>
                    <option value="1">AES-128</option>
                    <option value="2">AES-192</option>
                    <option value="3">AES-256</option>
                    <option value="3">RC4</option>
                  </select>
                  <label>Encryption Cipher</label>
                </div>
              </div>

              <div class="row">
                <div class="input-field">
                  <i class="material-icons prefix">vpn_key</i>
                  <input id="enkey" type="text" name="enkey">
                  <label for="enkey">Encryption Key</label>
                </div>
              </div>              

              <div class="center-align">
                <button class="btn waves-effect waves-light" type="submit" name="encrypt">Encrypt</button>
                <button class="btn waves-effect waves-light" type="submit" name="back">Back to Dashboard</button>
              </div>

            </form>
          </div>
        </div>
    </div>

  </body>
</html>