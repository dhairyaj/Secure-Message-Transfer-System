<?php

  include('server.php')

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
              
    <title>Login</title>
</head>
<body>
    
    <div class="container">
        <div class="settinglogin">
          <div class="row">
            <form class="col s10" method="POST" action="login.php">

              <div class="row">
                <div class="input-field">
                  <i class="material-icons prefix">email</i>
                  <input id="email" type="email" class="validate" name="email">
                  <label for="email">Email</label>
                </div>
              </div>

              <div class="row">
                <div class="input-field">
                  <i class="material-icons prefix" id="lockicon">lock </i>
                  <input id="password" type="password" name="pass" onfocus="iconChange()" onblur="iconUnchange()">
                  <label for="password">Password</label>
                  <i class="material-icons prefix" id="iconpass" onclick="passwordVisibility()">visibility_off</i>
                </div>
              </div>

              <button class="btn waves-effect waves-light" type="submit" name="login">Login</button>

              <p>Don't have an account. <a href="register.html">Register here.</a></p>

            </form>
          </div>
        </div>
    </div>

    <!-- Custom JavaScript -->
    <script>

      function iconChange() {
        var x = document.getElementById("lockicon");
        x.innerHTML = "lock_open";
      }

      function iconUnchange() {
        var x = document.getElementById("lockicon");
        x.innerHTML = "lock";
      }

      function passwordVisibility() {
          var x = document.getElementById("password");
          var y = document.getElementById("iconpass");
          if (x.type === "password") {
            x.type = "text";
            y.innerHTML = "visibility";
          } else {
            x.type = "password";
            y.innerHTML = "visibility_off";
          }
      }
    </script>
    
</body>
</html>