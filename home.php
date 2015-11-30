<?php
session_start();



$mysqli = mysqli_connect("localhost", "cs213user", "letmein", "COSC213CourseProject");

$sql = "SELECT * from members WHERE email = '".filter_input(INPUT_POST,'email').
                    "' AND password = "."PASSWORD('".filter_input(INPUT_POST,'password')."');";
$result = mysqli_query($mysqli,$sql) or die(mysqli_error($mysqli));

    if (mysqli_num_rows($result) == 1)
        while ($info = mysqli_fetch_array($result)) 
            $log_status = stripslashes($info['log_status']);
        
        
if($_SESSION['email'] != NULL || $log_status != 0){

    if(isset($_POST["lgout"])){
        $sql = "Update members set log_status=0 where email='".$_SESSION['email']."'";
        $result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
        session_destroy();
        header("Location: https://temp");
    }

    echo "<html><header><title>home page</title></header><body><form action='home.php' method='POST'>";
    echo "<h2>Welcome to your home page</h2>";
    echo "<input type='submit' name='lgout' value='Log Out'></input></form></body></html>";
}else
    header("Location: https://temp")

    
    
    ?>
