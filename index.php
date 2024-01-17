<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="izgled.css">
    <title>Index</title>
</head>
<body>
    <div id="header">
        <h1 id="Naziv-Stranica">Filmovi!</h1>
        <form action="Search.php" method="GET" id="Search">
            <input type="text" name="select" id="search-input" placeholder="Tražite filmove"/>
            <button type="submit"><img class="search-slika" src="slike/search.png"></img></button>
        </form>
    </div>

    <div id="section">
        <h2>Top Rated</h2>
        <?php
            $connection=mysqli_connect("localhost","root","","baza");
            $select="SELECT * FROM `filmovi` ORDER BY `filmovi`.`Vote_Average` DESC LIMIT 15";
            $selected=mysqli_query($connection,$select);
            foreach ($selected as $key => $value) {
                echo("
                    <div id='film'>
                        <img id='poster-index' src='https://www.themoviedb.org/t/p/w1280/".$value['poster_path']."'></img>
                        <p id='title'>".$value['Title']."</p>
                    </div>  
                    ");
            }
        ?>
    </div>

    <div id="section">
        <h2>Newest</h2>
        <?php
            $select="SELECT * FROM `filmovi` ORDER BY `filmovi`.`Relese_date` DESC LIMIT 8";
            $selected=mysqli_query($connection,$select);
            foreach ($selected as $key => $value) {
                echo("
                <div id='film'>
                    <img id='poster-index' src='https://www.themoviedb.org/t/p/w1280/".$value['poster_path']."'></img>
                    <p id='title'>".$value['Title']."</p>
                </div>  
                ");
            }
        ?>
        </div>

    <div id="section">
        <h2>Oldest</h2>
        <?php
            $select="SELECT * FROM `filmovi` ORDER BY `filmovi`.`Relese_date` ASC LIMIT 8";
            $selected=mysqli_query($connection,$select);
            foreach ($selected as $key => $value) {
                echo("
                <div id='film'>
                    <img id='poster-index' src='https://www.themoviedb.org/t/p/w1280/".$value['poster_path']."'></img>
                    <p id='title'>".$value['Title']."</p>
                </div>  
                ");
            }
        ?>
    </div>

    <div id="section">
        <h2>Action-Adventure</h2>
        <?php
            $select="SELECT * FROM `filmovi` WHERE genre_id = 28 or 12 and genre_id_2 = 28 or 12 LIMIT 8";
            $selected=mysqli_query($connection,$select);    
            foreach ($selected as $key => $value) {
                echo("
                <div id='film'>
                    <img id='poster-index' src='https://www.themoviedb.org/t/p/w1280/".$value['poster_path']."'></img>
                    <p id='title'>".$value['Title']."</p>
                </div>  
                ");
            }
        ?>
    </div>

    <div id="section">
        <h2>Romance</h2>
        <?php
            $select="SELECT * FROM `filmovi` WHERE genre_id = 10749 or genre_id_2 = 10749 LIMIT 8";
            $selected=mysqli_query($connection,$select);
            foreach ($selected as $key => $value) {
                echo("
                <div id='film'>
                    <img id='poster-index' src='https://www.themoviedb.org/t/p/w1280/".$value['poster_path']."'></img>
                    <p id='title'>".$value['Title']."</p>
                </div>  
                ");
            }
        ?>
    </div>

    <div id="section">
        <h2>Horror</h2>
        <?php
            $select="SELECT * FROM `filmovi` WHERE genre_id = 27 or genre_id_2 = 27 LIMIT 8";
            $selected=mysqli_query($connection,$select);
            foreach ($selected as $key => $value) {
                echo("
                <div id='film'>
                    <img id='poster-index' src='https://www.themoviedb.org/t/p/w1280/".$value['poster_path']."'></img>
                    <p id='title'>".$value['Title']."</p>
                </div>  
                ");
            }
        ?>
    </div>
    
    <div id="section">
        <h2>Fantasy</h2>
        <?php
            $select="SELECT * FROM `filmovi` WHERE genre_id = 14 or genre_id_2 = 14 LIMIT 8";
            $selected=mysqli_query($connection,$select);
            foreach ($selected as $key => $value) {
                echo("
                <div id='film'>
                    <img id='poster-index' src='https://www.themoviedb.org/t/p/w1280/".$value['poster_path']."'></img>
                    <p id='title'>".$value['Title']."</p>
                </div>  
                ");
            }
        ?>
    </div>

    <div id="section">
        <h2>Sci-Fi</h2>
        <?php
            $select="SELECT * FROM `filmovi` WHERE genre_id = 878 or genre_id_2 = 878 LIMIT 8";
            $selected=mysqli_query($connection,$select);
            foreach ($selected as $key => $value) {
                echo("
                <div id='film'>
                    <img id='poster-index' src='https://www.themoviedb.org/t/p/w1280/".$value['poster_path']."'></img>
                    <p id='title'>".$value['Title']."</p>
                </div>  
                ");
            }
        ?>
    </div>
</body>
</html>