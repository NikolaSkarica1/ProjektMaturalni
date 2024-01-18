<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="izgled.css">
    <title>Index</title>
</head>
<body>
    <div id="header">
        <!-- Treba dodat da se na Filmovi! klik vrati na pocetnu -->
        <h1 id="Naziv-Stranica">Filmovi!</h1>
        <form action="Search.php" method="GET" id="Search">
            <input type="text" name="select" id="search-input" placeholder="Tražite filmove"/>
            <button type="submit"><img class="search-slika" src="slike/search.png"></img></button>
        </form>
    </div>

    <?php
        $zarnovi=array(
            array("Najbolje ocjenjeni","SELECT * FROM `filmovi` ORDER BY `filmovi`.`Vote_Average` DESC LIMIT 15"),
            array("Najnoviji","SELECT * FROM `filmovi` ORDER BY `filmovi`.`Relese_date` DESC LIMIT 15"),
            array("Akcija i Advantura","SELECT * FROM `filmovi` WHERE genre_id = 28 or 12 and genre_id_2 = 28 or 12 LIMIT 15"),
            array("Horor","SELECT * FROM `filmovi` WHERE genre_id = 27 or genre_id_2 = 27 LIMIT 15"),
            array("Ljubavni","SELECT * FROM `filmovi` WHERE genre_id = 10749 or genre_id_2 = 10749 LIMIT 15"),
            array("Znanstvena Fantastika","SELECT * FROM `filmovi` WHERE genre_id = 878 or genre_id_2 = 878 LIMIT 15"),
            array("Fantazija","SELECT * FROM `filmovi` WHERE genre_id = 14 or genre_id_2 = 14 LIMIT 15"),
            array("Animacija","SELECT * FROM `filmovi` WHERE genre_id = 16 or genre_id_2 = 16 LIMIT 15"),
            array("Komedija","SELECT * FROM `filmovi` WHERE genre_id = 35 or genre_id_2 = 35 LIMIT 15"),
            array("Kriminalni","SELECT * FROM `filmovi` WHERE genre_id = 80 or genre_id_2 = 80 LIMIT 15"),
            array("Drame","SELECT * FROM `filmovi` WHERE genre_id = 18 or genre_id_2 = 18 LIMIT 15"),
            array("Obiteljski","SELECT * FROM `filmovi` WHERE genre_id = 10751 LIMIT 15"),
            array("Povjesni","SELECT * FROM `filmovi` WHERE genre_id = 36 or genre_id_2 = 36 LIMIT 15"),
            array("Misteriski","SELECT * FROM `filmovi` WHERE genre_id = 9648 or genre_id_2 = 9648 LIMIT 15"),
            array("Trileri","SELECT * FROM `filmovi` WHERE genre_id = 53 or genre_id_2 = 53 LIMIT 15"),
            array("Ratni","SELECT * FROM `filmovi` WHERE genre_id = 10752 or genre_id_2 = 10752 LIMIT 15"),
            array("Westerni","SELECT * FROM `filmovi` WHERE genre_id = 37 or genre_id_2 = 37 LIMIT 15")
        );
        $connection=mysqli_connect("localhost","root","","baza");
        $opcije=array("");
        for ($i=0; $i < 9; $i++) { 
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
                <div id='section'>
                    <h2>".$zarnovi[$nasumicni][0]."</h2>
            ");
            foreach ($selected as $key => $value) {
                echo("
                    <div id='film'>
                        <img id='poster-index' src='https://www.themoviedb.org/t/p/w1280/".$value['poster_path']."'></img>
                        <p id='title'>".$value['Title']."</p>
                        <p id='index-score'>".$value['Vote_Average']."</p><img id='index-star' src='slike/star.png'></img>
                    </div>  
                    ");
            }
            echo("
                </div>
            ");
        }
    ?>
</body>
</html>