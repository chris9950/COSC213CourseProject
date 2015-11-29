<?php
session_start();

if (!(filter_input(INPUT_POST,'email')) || !(filter_input(INPUT_POST,'password'))) {
	header("Location: login.html");
	exit;
}

$mysqli = mysqli_connect("localhost", "cs213user", 'letmein', "COSC213CourseProject");

$sql = "SELECT * from members WHERE email = '".filter_input(INPUT_POST,'email').
                    "' AND password = "."PASSWORD('".filter_input(INPUT_POST,'password')."');";
$result = mysqli_query($mysqli,$sql) or die(mysqli_error($mysqli));

if (mysqli_num_rows($result) == 1){
    
    while ($info = mysqli_fetch_array($result)) {
                $user_name = stripslashes($info['email']);
		$f_name = stripslashes($info['first_name']);
		$l_name = stripslashes($info['last_name']);
	}
        
        if($_SESSION['email'] == NULL){
          $_SESSION['email'] = $user_name;
        }else if($_SESSION['email'] != $user_name){
          $_SESSION['email'] = $user_name; 
        }
        
        header("Location: home.php");
}else{
    header("Location: login.html");
}

?>
