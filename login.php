<?php
session_start();

if($_SESSION['email'] != NULL){
    $sql = "SELECT * from members WHERE email = '".filter_input(INPUT_POST,'email').
                    "' AND password = "."PASSWORD('".filter_input(INPUT_POST,'password')."');";
    if (mysqli_num_rows($result) == 1){
        while ($info = mysqli_fetch_array($result)) {
            $log_status = stripslashes($info['log_status']);
        }
        if($log_status == 1)
            header("Location: home.php");
    }
    header("Location: home.php");
}

echo "<html>
<title>temp site</title>
<body>
<form method='POST' action='https://temp' >
<h2>Welcome to our first website from scratch!</h2>
<b>Username:</b></br>
<input type='text' name='email'/></br><b>Password:</b></br>
<input type='password' name='password'/></br></br>
<input type='submit' value='Login' >     <input type='submit' formaction='sign_up.php' value ='Sign Up'>
</form>
<a href='creaters.php'><b>Creaters</b></a>
</body>
</html>";


?>