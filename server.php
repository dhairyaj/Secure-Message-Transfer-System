<?php

session_start();

//Initialise variables
$servername = "localhost";
$uname = "root";
$password = "";
$dbname = "message_transfer";

$user = "";
$email = "";

// Create connection
$conn = mysqli_connect($servername, $uname, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//For Registering the user

//check fields are empty or not
if(isset($_POST['submit'])){
  if(empty($_POST['name']) || empty($_POST['email']) || empty($_POST['pass']) || empty($_POST['cpass'])){
    echo '<script>alert("Please fill all the fields")</script>';
  }
  else
  {
    //Define $user, $email and $pass
    // $user=$_POST['name'];
    // $email=$_POST['email'];
    // $pass=$_POST['pass'];
    // $cpass=$_POST['cpass'];

    $user = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, $_POST['pass']);
    $cpass = mysqli_real_escape_string($conn, $_POST['cpass']);

    if($pass != $cpass){
      echo '<script>alert("The passwords donot match.")</script>';
    }
    else{
      $user_check_query = "SELECT * FROM users WHERE name='$user' OR email='$email' LIMIT 1";
      $result = mysqli_query($conn, $user_check_query);
      $username = mysqli_fetch_assoc($result);
      
      if ($username) { // if user exists
        if ($username['name'] === $user) {
          echo '<script>alert("Username already exists")</script>';
        }

        if ($username['email'] === $email) {
          echo '<script>alert("Email already exists")</script>';
        }
      }

      $query = "INSERT INTO users (name, email, password) 
  			  VALUES('$user', '$email', '$pass')";
  	  mysqli_query($conn, $query);
      echo '<script>alert("Registered Successfully. Redirecting to login page.")</script>';
      header('location: login.php');
    }
  }
}

//For Logging in the user

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, $_POST['pass']);
  
    if (empty($email)) {
        echo '<script>alert("Email address is required")</script>';
    }
    if (empty($pass)) {
        echo '<script>alert("Password is required")</script>';
    }

    $pass = md5($pass);
  	$query = "SELECT * FROM users WHERE username='$username' AND password='$pass'";
  	$results = mysqli_query($conn, $query);
  	if (mysqli_num_rows($results) == 1) {
  	  echo '<script>alert("Logged in successfully")</script>';
  	  header('location: dashboard.html');
    }
      else {
        echo '<script>alert("Wrong Credentials")</script>';
  	}

}

mysqli_close($conn);

?>