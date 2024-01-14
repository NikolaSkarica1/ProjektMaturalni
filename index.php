<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
</head>
<body>
    <h1>Filmovi</h1>
    <form action="Search.php" method="GET">
        Unesite Ime filma:<input type="text" name="select" >
        <input type="submit" value="Upit na bazu">
    </form>

    <h2>Top Rated</h2>
    <?php
        $connection=mysqli_connect("localhost","root","","baza");
        $select="SELECT * FROM `filmovi` ORDER BY `filmovi`.`Vote_Average` DESC LIMIT 8";
        $selected=mysqli_query($connection,$select);
        foreach ($selected as $key => $value) {
            echo("<img width=180px height=260px src='https://www.themoviedb.org/t/p/w1280/".$value['poster_path']."'></img>");
        }
    ?>

    <h2>Newest</h2>
    <?php
        $select="SELECT * FROM `filmovi` ORDER BY `filmovi`.`Relese_date` DESC LIMIT 8";
        $selected=mysqli_query($connection,$select);
        foreach ($selected as $key => $value) {
            echo("<img width=180px height=260px src='https://www.themoviedb.org/t/p/w1280/".$value['poster_path']."'></img>");
        }
    ?>

    <h2>Oldest</h2>
    <?php
        $select="SELECT * FROM `filmovi` ORDER BY `filmovi`.`Relese_date` ASC LIMIT 8";
        $selected=mysqli_query($connection,$select);
        foreach ($selected as $key => $value) {
            echo("<img width=180px height=260px src='https://www.themoviedb.org/t/p/w1280/".$value['poster_path']."'></img>");
        }
    ?>

    <h2>Action-Adventure</h2>
    <?php
        $select="SELECT * FROM `filmovi` WHERE genre_id = 28 or 12 and genre_id_2 = 28 or 12 LIMIT 8";
        $selected=mysqli_query($connection,$select);    
        foreach ($selected as $key => $value) {
            echo("<img width=180px height=260px src='https://www.themoviedb.org/t/p/w1280/".$value['poster_path']."'></img>");
        }
    ?>

    <h2>Romance</h2>
    <?php
        $select="SELECT * FROM `filmovi` WHERE genre_id = 10749 or genre_id_2 = 10749 LIMIT 8";
        $selected=mysqli_query($connection,$select);
        foreach ($selected as $key => $value) {
            echo("<img width=180px height=260px src='https://www.themoviedb.org/t/p/w1280/".$value['poster_path']."'></img>");
        }
    ?>

    <h2>Horror</h2>
    <?php
        $select="SELECT * FROM `filmovi` WHERE genre_id = 27 or genre_id_2 = 27 LIMIT 8";
        $selected=mysqli_query($connection,$select);
        foreach ($selected as $key => $value) {
            echo("<img width=180px height=260px src='https://www.themoviedb.org/t/p/w1280/".$value['poster_path']."'></img>");
        }
    ?>

    <h2>Fantasy</h2>
    <?php
        $select="SELECT * FROM `filmovi` WHERE genre_id = 14 or genre_id_2 = 14 LIMIT 8";
        $selected=mysqli_query($connection,$select);
        foreach ($selected as $key => $value) {
            echo("<img width=180px height=260px src='https://www.themoviedb.org/t/p/w1280/".$value['poster_path']."'></img>");
        }
    ?>

    <h2>Sci-Fi</h2>
    <?php
        $select="SELECT * FROM `filmovi` WHERE genre_id = 878 or genre_id_2 = 878 LIMIT 8";
        $selected=mysqli_query($connection,$select);
        foreach ($selected as $key => $value) {
            echo("<img width=180px height=260px src='https://www.themoviedb.org/t/p/w1280/".$value['poster_path']."'></img>");
        }
    ?>
</body>
</html>