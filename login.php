<?php
session_start();
?>
<!DOCTYPE HTML>  
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="izgled.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <title>Login</title>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  
    <div id="header">
        <a href="http://localhost/ProjektMaturalni/">
            <img src="slike/ikona.png" id="ikona"/>        
            <h1 id="Naziv-Stranica">Filmovi!</h1>
        </a>
        <form action="Search.php" method="GET" id="Search">
            <input type="text" name="select" id="search-input" placeholder="Search"/>
            <input type='hidden' name='filter' value='Vote_Count DESC'/>
            <button type="submit"><img class="search-slika" src="slike/search.png"></img></button>
        </form>
    </div>
    <div id="a"></div>
<?php
// define variables and set to empty values
$usernameErr = $nameErr = $LastNameErr = $emailErr = $genderErr = $passwordErr =$passwordConfirmErr = $LOGusernameErr = $LOGpasswordErr = $LOGemailErr = "";
$username = $name = $LastName = $email = $gender= $password = $passwordConfirm  = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $con=mysqli_connect("localhost","root","","baza");
    if(isset($_POST['submit'])){
        $usernameErr = $nameErr = $LastNameErr = $emailErr = $genderErr = $passwordErr =$passwordConfirmErr = "";

        $users="SELECT username FROM users WHERE username = '".$_POST["username"]."'";
        $results=mysqli_query($con,$users);
        if (empty($_POST["username"])) {
            $usernameErr = "Username is required";
        } else if($results->num_rows !== 0) {
            $usernameErr = "Username is taken";
        }else{
            $username = test_input($_POST["username"]);
        }
        $mails="SELECT email FROM users WHERE username = '".$_POST["username"]."'";
        $results=mysqli_query($con,$users);
        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
        }else if($results->num_rows !== 0) {
            $emailErr = "Email is already taken";
        } else {
            $email = test_input($_POST["email"]);
        }
        if (empty($_POST["name"])) {
            $nameErr = "Name is required";
        } else {
            $name = test_input($_POST["name"]);
        }
        if (empty($_POST["Lname"])) {
            $LastNameErr = "Last name is required";
        } else {
            $LastName = test_input($_POST["Lname"]);
        }
        if (empty($_POST["gender"])) {
            $genderErr = "Gender is required";
        } else {
            $gender = test_input($_POST["gender"]);
        }
        if (empty($_POST["password"])) {
            $passwordErr = "Password is required";
        } else {
            $password = test_input($_POST["password"]);
        }
        if (empty($_POST["passwordConfirm"])) {
            $passwordConfirmErr = "Password conformation is required";
        } else {
            $passwordConfirm = test_input($_POST["passwordConfirm"]);
        }
        if ($_POST["passwordConfirm"]!==$_POST["password"]) {
            $passwordConfirmErr = "Passwords must match";
        } else {
            $passwordConfirm = test_input($_POST["passwordConfirm"]);
        }
        if($usernameErr=="" && $nameErr=="" && $LastNameErr=="" && $emailErr=="" && $genderErr=="" && $passwordErr=="" && $passwordConfirmErr==""){
            $con=mysqli_connect("localhost","root","","baza");
            $unos="INSERT INTO users(username, email, name, lastName, gender, password) VALUES('".$username."','".$username."','".$name."','".$LastName."','".$gender."','".$password."')";
            mysqli_query($con,$unos);
            $_SESSION['username']=$username;
            $_SESSION['isLoggedIn']=true;
            header("Location: index.php");
        }
    }
    if(isset($_POST['login'])){
        // Dodat login matchaju li sve info
        $users="SELECT username FROM users WHERE username = '".$_POST["username"]."'";
        $results=mysqli_query($con,$users);
        if (empty($_POST["username"])) {
            $LOGusernameErr = "Username is required";
        } else if($results->num_rows == 0) {
            $LOGusernameErr = "Account does not exist";
        }else{
            $username = test_input($_POST["username"]);
        }
        $mails="SELECT email FROM users WHERE username = '".$_POST["username"]."'";
        $results=mysqli_query($con,$users);
        if (empty($_POST["email"])) {
            $LOGemailErr = "Email is required";
        }else if($results->num_rows == 0) {
            $LOGemailErr = "There is no account with this username";
        } else {
            $email = test_input($_POST["email"]);
        }
        if (empty($_POST["password"])) {
            $LOGpasswordErr = "Password is required";
        } else {
            $password= test_input($_POST["password"]);
        }
    }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<div id="signup">
    <center>
    <h1>Sign Up</h1>
    <p><span class="error">* required field</span></p><br>
    <form method="post">  
        Username: <input type="text" name="username">
        <span class="error">*  <br/><?php echo $usernameErr;?></span>
        <br>
        E-mail: <input type="text" name="email">
        <span class="error">* <br><?php echo $emailErr;?></span>
        <br>
        First name: <input type="text" name="name">
        <span class="error">* <br><?php echo $nameErr;?></span>
        <br>
        Last name: <input type="text" name="Lname">
        <span class="error">* <br><?php echo $LastNameErr;?></span>
        <br>
        Gender:
        <input type="radio" name="gender" value="female">Female
        <input type="radio" name="gender" value="male">Male
        <input type="radio" name="gender" value="other">Other
        <span class="error">* <br><?php echo $genderErr;?></span>
        <br>
        Password: <input type="password" name="password">
        <span class="error">* <br><?php echo $passwordErr;?></span>
        <br>
        Confirm password: <input type="password" name="passwordConfirm">
        <span class="error">* <br><?php echo $passwordConfirmErr;?></span>
        <br><br>
        <input type="submit" name="submit" value="Sign In">  
    </form>
    </center>
</div>
<div id="LogIn">
    <center>
        <h1>Log In</h1>
        <p><span class="error">* required field</span></p><br>
        <form method="post">  
            Username: <input type="text" name="username">
            <span class="error">* <br><?php echo $LOGusernameErr;?></span>
            <br>
            E-mail: <input type="text" name="email">
            <span class="error">* <br><?php echo $LOGemailErr;?></span>
            <br>
            Password: <input type="password" name="password">
            <span class="error">* <br><?php echo $LOGpasswordErr;?></span>
            <br><br>
            <input type="submit" name="login" value="Log In">  
        </form>
    </center>
</div>
</body>
</html>
