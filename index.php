<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="izgled.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <title>Filmovi!</title>
</head>
<body>
    <div id="header">
        <a href="http://localhost/Projekt/">
            <img src="slike/ikona.png" id="ikona"/>        
            <h1 id="Naziv-Stranica">Filmovi!</h1>
        </a>
        <form action="Search.php" method="GET" id="Search">
            <input type="text" name="select" id="search-input" placeholder="Tražite filmove"/>
            <button type="submit"><img class="search-slika" src="slike/search.png"></img></button>
        </form>
    </div>
    <div id="a"></div>
    <?php
        $zarnovi=array(
            array("Najbolje ocjenjeni","SELECT * FROM `filmovi` ORDER BY `filmovi`.`Vote_Average` DESC LIMIT 15"),
            array("Najnoviji","SELECT * FROM `filmovi` ORDER BY `filmovi`.`Relese_date` DESC LIMIT 15"),
            array("Akcija i Advantura","SELECT * FROM `filmovi` WHERE genre_id = 28 or 12 and genre_id_2 = 28 or 12 LIMIT 15"),
            array("Horor","SELECT * FROM `filmovi` WHERE genre_id = 27 or genre_id_2 = 27 LIMIT 15"),
            array("Ljubavni","SELECT * FROM `filmovi` WHERE genre_id = 10749 or genre_id_2 = 10749 LIMIT 15"),
            array("Znanstvena Fantastika","SELECT * FROM `filmovi` WHERE genre_id = 878 LIMIT 15"),
            array("Fantazija","SELECT * FROM `filmovi` WHERE genre_id = 14 or genre_id_2 = 14 LIMIT 15"),
            array("Animacija","SELECT * FROM `filmovi` WHERE genre_id = 16 or genre_id_2 = 16 LIMIT 15"),
            array("Komedije","SELECT * FROM `filmovi` WHERE genre_id = 35 LIMIT 15"),
            array("Kriminalni","SELECT * FROM `filmovi` WHERE genre_id = 80 LIMIT 15"),
            array("Drame","SELECT * FROM `filmovi` WHERE genre_id = 18 LIMIT 15"),
            array("Obiteljski","SELECT * FROM `filmovi` WHERE genre_id = 10751 LIMIT 15"),
            array("Povjesni","SELECT * FROM `filmovi` WHERE genre_id = 36 LIMIT 15"),
            array("Misteriski","SELECT * FROM `filmovi` WHERE genre_id = 9648 LIMIT 15"),
            array("Trileri","SELECT * FROM `filmovi` WHERE genre_id = 53 LIMIT 15"),
            array("Ratni","SELECT * FROM `filmovi` WHERE genre_id = 10752 LIMIT 15"),
            array("Westerni","SELECT * FROM `filmovi` WHERE genre_id = 37 or genre_id_2 = 37 LIMIT 15")
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
                            <p id='index-score'>".$value['Vote_Average']."</p><img id='index-star' src='slike/star.png'></img>
                        </diV>
                    </button> 
                </form>
                ");
            }
            echo("
                </div>
            ");
        }
    ?>
</body>
</html>