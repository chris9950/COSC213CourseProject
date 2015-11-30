<?php
session_start();

if (!(filter_input(INPUT_POST,'email')) || !(filter_input(INPUT_POST,'password'))) {
	header("Location: login.php");
	exit;
}

$mysqli = mysqli_connect("localhost", "cs213user", 'letmein', "COSC213CourseProject");

$sql = "SELECT * from members WHERE email = '".filter_input(INPUT_POST,'email').
                    "' AND password = "."PASSWORD('".filter_input(INPUT_POST,'password')."');";
$result = mysqli_query($mysqli,$sql) or die(mysqli_error($mysqli));

if($_SESSION['email'] != NULL){
    $sql = "SELECT * from members WHERE email = '".filter_input(INPUT_POST,'email').
                    "' AND password = "."PASSWORD('".filter_input(INPUT_POST,'password')."');";
    $result = mysqli_query($mysqli,$sql) or die(mysqli_error($mysqli));
    if (mysqli_num_rows($result) == 1){
        while ($info = mysqli_fetch_array($result)) {
            $log_status = stripslashes($info['log_status']);
        }
        if($log_status == 1)
            header("Location: home.php");
    }
    header("Location: home.php");
}

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
        
        $sql = "Update members set log_status=1 where email='".$_SESSION['email']."'";
        $result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
        
        header("Location: home.php");
}else{
    header("Location: login.php");
}

?>
