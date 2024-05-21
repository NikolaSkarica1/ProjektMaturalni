<?php
    $primljeno=$_POST['myJSONText'];
    $data = json_decode($primljeno,true);
    $connection=mysqli_connect("localhost","root","","baza");

    for ($i=0; $i < count($data); $i++) { 
        $title=$data[$i]['title'];
        $title_fix=str_replace("'", "''", $title);
        $release_date=$data[$i]['release_date'];
        $vote_average=$data[$i]['vote_average'];
        $vote_count=$data[$i]['vote_count'];
        $film_id=$data[$i]['id'];
        $genre=$data[$i]['genre_ids'][0];
        $poster=$data[$i]['poster_path'];
        
        $unos="INSERT INTO filmovi(Title, Relese_date, Vote_Average, Vote_Count, id_film, genre_id, poster_path) VALUES('".$title_fix."','".$release_date."','".$vote_average."','".$vote_count."','".$film_id."','".$genre."','".$poster."')";
        $query=mysqli_query($connection,$unos);
    }
    exit;
?>