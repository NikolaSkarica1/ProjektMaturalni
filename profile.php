<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="izgled.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <title>Login</title>
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
    You are loged in<br>
    <form method="POST" action="profile.php">
        <input type="submit"  name="LogOut" value="Log Out"/>
    </form>
    <div id='Section-search'><br/>
<?php
    if(isset($_POST["LogOut"])){
        $_SESSION["isLoggedIn"]=0;
        header("Location: index.php");
    }
    
    echo($_SESSION["username"]."<br>");
    $connection=mysqli_connect("localhost","root","","baza");
    $kupljeni="SELECT * FROM kupljeno WHERE username='".$_SESSION['username']."'";;
    $query=mysqli_query($connection,$kupljeni);
    echo("<h2>Vaši filmovi:</h2>");
    foreach ($query as $key => $value) {
        $film="SELECT * FROM filmovi WHERE id_film=".$value['id_film'];
        $filmovi=mysqli_query($connection,$film);
        foreach ($filmovi as $key => $value) {
            $parts = explode('-', $value['Relese_date']);
            echo("
            <form action='film.php' method='GET'>
                <input type='hidden' name='id' value='".$value['id_film']."'/>
                <button type='submit' id='prijelaz'>
                    <div id='film'>
                        <img id='poster-index' src='https://www.themoviedb.org/t/p/w1280/".$value['poster_path']."'></img>
                        <p id='title'>".$value['Title']."</p>
                        <p id='index-score'>".$value['Vote_Average']."</p><img id='index-star' src='slike/star.png'></img>
                        <p id='index-score'>".$parts[0]."</p>
                    </diV>
                </button> 
            </form>
            ");
        }
    }
    echo("</div>");
?>
</body>
</html>