<?php
session_start();
if(isset($_SESSION['isLoggedIn'])){
    if($_SESSION['isLoggedIn']==1){
        $stranica="profile.php";
    }else{
        $stranica="login.php";
    } 
}else{
    $_SESSION['isLoggedIn']=0;
    $stranica="login.php";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="design/Header.css">
    <link rel="stylesheet" type="text/css" href="design/Index.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <title>Filmovi!</title>
</head>
<body>
    <div id="header">
        <a href="http://localhost/ProjektMaturalni/">
            <img src="slike/ikona.png" id="ikona"/>        
            <h1 id="Naziv-Stranica">Filmovi!</h1>
        </a>
        <form action=<?php echo($stranica) ?> method="POST"  id="header-login">
            <button type="submit"><img class="search-slika" src="slike/login.png"></img></button>
        </form>
        <form action="Search.php" method="GET" id="Search">
            <input type="text" name="select" id="search-input" placeholder="Search"/>
            <input type='hidden' name='filter' value='Vote_Count DESC'/>
            <button type="submit"><img class="search-slika" src="slike/search.png"></img></button>
        </form>
    </div>
    <div id="a"></div>
<?php
    $zarnovi=array(
        array("Highest Rated","SELECT * FROM `filmovi` ORDER BY `filmovi`.`Vote_Average` DESC LIMIT 15"),
        array("Newest","SELECT * FROM `filmovi` ORDER BY `filmovi`.`Relese_date` DESC LIMIT 15"),
        array("Action-Adventure","SELECT * FROM `filmovi` WHERE genre_id = 28 or 12 and genre_id_2 = 28 or 12 LIMIT 15"),
        array("Horror","SELECT * FROM `filmovi` WHERE genre_id = 27 or genre_id_2 = 27 LIMIT 15"),
        array("Romance","SELECT * FROM `filmovi` WHERE genre_id = 10749 or genre_id_2 = 10749 LIMIT 15"),
        array("Sci-Fi","SELECT * FROM `filmovi` WHERE genre_id = 878 LIMIT 15"),
        array("Fantasy","SELECT * FROM `filmovi` WHERE genre_id = 14 or genre_id_2 = 14 LIMIT 15"),
        array("Animation","SELECT * FROM `filmovi` WHERE genre_id = 16 LIMIT 15"),
        array("Comedy","SELECT * FROM `filmovi` WHERE genre_id = 35 LIMIT 15"),
        array("Crime","SELECT * FROM `filmovi` WHERE genre_id = 80 LIMIT 15"),
        array("Drama","SELECT * FROM `filmovi` WHERE genre_id = 18 LIMIT 15"),
        array("Family","SELECT * FROM `filmovi` WHERE genre_id = 10751 LIMIT 15"),
        array("History","SELECT * FROM `filmovi` WHERE genre_id = 36 LIMIT 15"),
        array("Mistery","SELECT * FROM `filmovi` WHERE genre_id = 9648 LIMIT 15"),
        array("Thriller","SELECT * FROM `filmovi` WHERE genre_id = 53 LIMIT 15"),
        array("War","SELECT * FROM `filmovi` WHERE genre_id = 10752 LIMIT 15"),
        array("Western","SELECT * FROM `filmovi` WHERE genre_id = 37 LIMIT 15")
    );
    $connection=mysqli_connect("localhost","root","","baza");
    $opcije=array("");
    for ($i=0; $i < 16; $i++) { 
        $nasumicni=rand(0,16);
        for ($j=0; $j <= $i; $j++) { 
            if($nasumicni==$opcije[$j]){
                $nasumicni=rand(0,16);
                $j=0;
            }
        }
        array_push($opcije,$nasumicni);
        $selected=mysqli_query($connection,$zarnovi[$nasumicni][1]);
        echo("
            <h2 id='SectionTitle'>".$zarnovi[$nasumicni][0]."</h2>
            <div id='section'>
        ");
        foreach ($selected as $key => $value) {
            echo("
            <form action='film.php' method='GET'>
                <input type='hidden' name='id' value='".$value['id_film']."'/>
                <button type='submit' id='prijelaz'>
                    <div id='film'>
                        <img id='poster-index' src='https://www.themoviedb.org/t/p/w1280/".$value['poster_path']."'></img>
                        <p id='title'>".$value['Title']."</p>
                        <p id='index-score'>".$value['Vote_Average']." </p><img id='index-star' src='slike/star.png'></img>
                        <p id='index-score'> ◦ 20€</p>
                    </div>
                </button> 
            </form>
            ");
        }
        echo("
            </div>
        ");
    }
?>
<div id="footer">
    <p>© 2024 Copyright: Nikola Škarica</p>
    Powered by: <a href="https://www.themoviedb.org"><img src="slike/tmdb.svg" width="200px"/></a>
</div>
</body>
</html>