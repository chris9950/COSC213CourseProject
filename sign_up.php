<?php

$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$email = $_POST["email"];
$password = $_POST["password"];
$birthday = $_POST["Year"]."-".$_POST["Month"]."-".$_POST["Day"];
$gender = $_POST["gender"];
$display_message;
    
if (!isset($_POST['submit']) && ($firstname == NULL || $lastname == NULL || $email == NULL || $password == NULL || $birthday == NULL || $gender == NULL)) { 
?>

<html>
    <title>
        Sign Up Form
    </title>
    <body>
        <?php echo "$display_message" ?>
        <h1> Sign Up </h1>
        <form method = 'post' action = 'sign_up.php'>
            <p><strong>First Name:</strong>
            <input type="text" name="firstname"/></p>
            <p><strong>Last Name:</strong>
            <input type="text" name="lastname"/></p> 
            <p><strong>Email:</strong>
            <input type="text" name="email"/></p> 
            <p><strong>Password:</strong>
            <input type="password" name="password"/></p> 
            <strong>Birthday:</strong>
            <select name = "Month">
                <option value = "Month">Month</option>
                <option value = "Jan">Jan</option>
                <option value = "Feb">Feb</option>
                <option value = "Mar">Mar</option>
                <option value = "Apr">Apr</option>
                <option value = "May">May</option>
                <option value = "Jun">Jun</option>
                <option value = "Jul">Jul</option>
                <option value = "Aug">Aug</option>
                <option value = "Sep">Sep</option>
                <option value = "Oct">Oct</option>
                <option value = "Nov">Nov</option>
                <option value = "Dec">Dec</option>
            </select>
            <select name ="Day">
            <option value = "Day">Day</option>
            <?php for($i=1;$i<=31;$i++) echo "<option value= '$i'>$i</option>"; ?>
            </select>
            <select name ="Year">
            <option value = "Year">Year</option>
            <?php for($i=2015;$i>=1905;$i--) echo "<option value= '$i'>$i</option>"; ?>
            </select>
            <p><strong>Gender:</strong>
            <input type="radio" value="Male" name="gender"><strong>Male</strong>
            <input type="radio" value="Female" name="gender"><strong>Female</strong><br /></p>
            <input type="submit" value="Sign Up" name="submit">
        </form>
    </body>
</html>

<?php
}else if( $firstname == NULL || $lastname == NULL || $email == NULL || $password == NULL || testDate($birthday) || $gender == NULL){
    if($firstname == NULL)
        $display_message.="Please enter a valid Firstname! <br/>";
    if($lastname == NULL)
        $display_message.="Please enter a valid last name! <br/>";
    if($email == NULL)
        $display_message.="Please enter a valid email! <br/>";
    if($password == NULL)
        $display_message.="Please enter a valid password! <br/>";
    if(testDate($birthday))
        $display_message.="Please enter a valid birthdate! <br/>";
    if($gender == NULL){
        $display_message.="Please enter a valid gender! ";
        $display_message.=getAge($birthday)."<br/>";}
?>

<html>
    <title>
        Sign Up Form
    </title>
    <body>
        <?php printf("$display_message") ?>
        <h1> Sign Up </h1>
        <form method = 'post' action = 'sign_up.php'>
            <p><strong>First Name:</strong>
            <input type="text" name="firstname"/></p>
            <p><strong>Last Name:</strong>
            <input type="text" name="lastname"/></p> 
            <p><strong>Email:</strong>
            <input type="text" name="email"/></p> 
            <p><strong>Password:</strong>
            <input type="text" name="password"/></p> 
            <strong>Birthday:</strong>
            <select name = "Month">
                <option value = "Month">Month</option>
                <option value = "Jan">Jan</option>
                <option value = "Feb">Feb</option>
                <option value = "Mar">Mar</option>
                <option value = "Apr">Apr</option>
                <option value = "May">May</option>
                <option value = "Jun">Jun</option>
                <option value = "Jul">Jul</option>
                <option value = "Aug">Aug</option>
                <option value = "Sep">Sep</option>
                <option value = "Oct">Oct</option>
                <option value = "Nov">Nov</option>
                <option value = "Dec">Dec</option>
            </select>
            <select name ="Day">
            <option value = "Day">Day</option>
            <?php for($i=1;$i<=31;$i++) echo "<option value= '$i'>$i</option>"; ?>
            </select>
            <select name ="Year">
            <option value = "Year">Year</option>
            <?php for($i=2015;$i>=1905;$i--) echo "<option value= '$i'>$i</option>"; ?>
            </select>
            <p><strong>Gender:</strong><br />
            <input type="radio" value="Male" name="gender"><strong>Male</strong>
            <input type="radio" value="Female" name="gender"><strong>Female</strong><br /></p>
            <input type="submit" value="submit" name="submit">
        </form>
    </body>
</html>

<?php
        
}else if($email != NULL){
    $mysqli = mysqli_connect("localhost", "cs213user", "letmein", "COSC213CourseProject");
    $targetemail = filter_input(INPUT_POST, 'email');
    $sql = "SELECT * FROM members where email='".$targetemail."'";
    $result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
    if (mysqli_num_rows($result) == 1) {
        echo "Your email address has already been used! Please use a different email address for a new account.";
    }else{
        $sql = "INSERT into members values ( '".$firstname."', '".$lastname."', '".strtolower($email)."', PASSWORD('".$password."') , '".$gender."', str_to_date('".$birthday." ','%Y-%M-%d'), curdate(), ".getAge($birthday).", 0 )";
        $result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
        mkdir("/var/www/html/COSC213CourseProjectDirectory/".$email, 0733);
        $display_message="Your new account has been created. Thank you for joining us!";
?>

 <html>
    <title>
        Sign Up Form
    </title>
    <body>
        <?php printf("$display_message") ?><a href="index.php">Login page</a>
        <h1> Sign Up </h1>
        <form method = 'post' action = 'applyaccount.php'>
            <p><strong>First Name:</strong>
            <input type="text" name="firstname"/></p>
            <p><strong>Last Name:</strong>
            <input type="text" name="lastname"/></p> 
            <p><strong>Email:</strong>
            <input type="text" name="email"/></p> 
            <p><strong>Password:</strong>
            <input type="text" name="password"/></p> 
            <p><strong>Age:</strong>
            <input type="text" name="age"/></p> 
            <p><strong>Gender:</strong><br />
            <input type="radio" value="Male" name="gender"><strong>Male</strong>
            <input type="radio" value="Female" name="gender"><strong>Female</strong><br /></p>
            <input type="submit" value="submit" name="submit">
        </form>
    </body>
</html>

<?php
    }
   }
   
   function getAge($arg1){
       $age = 0;
       $currentDate = date("Y-M-d");
       $age += (intval(substr($currentDate,0,4))-intval(substr($arg1,0,4)));
       if(getMonth(substr($currentDate,5,3)) < getMonth(substr($arg1,5,3))){
            $age--;
       }else if(getMonth(substr($currentDate,5,3)) == getMonth(substr($arg1,5,3))){
            if(intval(substr($currentDate,10,2)) > intval(substr($arg1,10,2)))
                 $age--;
       }
            
       return $age;
   }
   
   function testDate($birthday){
       return (strpos($birthday,'Year') !== false || strpos($birthday,'Month') !== false || strpos($birthday,'Day') !== false || $birthday == NULL);
   }
   
   function getMonth($arg1){
       switch ($arg1){
           case "Jan":
               return 01;
           case "Feb":
               return 02;
           case "Mar":
               return 03;
           case "Apr":
               return 04;
           case "May":
               return 05;
           case "Jun":
               return 06;
           case "Jul":
               return 07;
           case "Aug":
               return 08;
           case "Sep":
               return 09;
           case "Oct":
               return 10;
           case "Nov":
               return 11;
           case "Dec":
               return 12;
           default:
               return "error";
       }
   }


?>

