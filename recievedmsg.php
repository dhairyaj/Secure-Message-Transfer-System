<?php

    session_start();

    $message = $_SESSION['message'];

    if(isset($_POST['back'])){
        header('location: decryption.php');
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

    <title>Message Recieved</title>
</head>
<body>
    
    <div class="container">
        <div class="message">
            <h3>You have recieved the following message.</h3>
            <!-- <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Consectetur exercitationem dicta nostrum aspernatur officia molestias numquam dolorum aliquam, iusto tempore hic tenetur mollitia explicabo in voluptates rerum recusandae fugiat. Minima. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Repudiandae rerum doloremque, id nesciunt quibusdam nisi rem officiis, aspernatur nobis, magnam odit corporis iusto nostrum ad temporibus quod quos maiores totam. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Consectetur rerum soluta et itaque quaerat quas hic quidem nostrum molestias animi obcaecati ipsum vel repellat, sint qui quod magnam debitis voluptatem. Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum dolor ducimus, perferendis expedita fugiat atque reiciendis voluptatum in blanditiis obcaecati enim quidem voluptas aut similique, aperiam ipsam quas odio. Harum. Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto odio illo a vel ullam, sit impedit, corrupti non itaque asperiores ducimus optio. Repellat nostrum numquam ut expedita doloribus aut debitis. Lorem ipsum dolor sit amet consectetur adipisicing elit. At expedita odit, rerum sapiente, perspiciatis ex ullam id ea, quisquam consequuntur corporis accusamus maiores eligendi eum quos provident nesciunt totam quidem!</p> -->
            <p><?php echo $message; ?></p>
        </div>
        <form method="POST">
            <div class="back">
                <button class="btn-large waves-effect waves-light" type="submit" name="back">Back to Dashboard</button>
                <!-- <a class="waves-effect waves-light btn-large">Back to Dashboard</a> -->
            </div>
        </form>
    </div>

</body>
</html>