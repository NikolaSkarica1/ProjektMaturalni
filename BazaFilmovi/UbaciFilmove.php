<?php
    $primljeno=$_POST['myJSONText'];
    $data = json_decode($primljeno,true);
    var_dump($data[0]);
    $connection=mysqli_connect("localhost","root","","baza");

    for ($i=0; $i < count($data); $i++) { 
        $title=$data[$i]['title'];
        $title_fix=str_replace("'", "''", $title);
        $release_date=$data[$i]['release_date'];
        $vote_average=$data[$i]['vote_average'];
        $vote_count=$data[$i]['vote_count'];
        $overview=$data[$i]['overview'];
        $owerview_fix=str_replace("'", "''", $overview);
        $original_language=$data[$i]['original_language'];
        $film_id=$data[$i]['id'];
        $genre=$data[$i]['genre_ids'][0];
        $genre2=$data[$i]['genre_ids'][1];
        $genre3=$data[$i]['genre_ids'][2];
        $poster=$data[$i]['poster_path'];
        $backdrop=$data[$i]['backdrop_path'];
        // echo("<br/><br/>".$title_fix." ".$release_date." ".$vote_average." ".$vote_count." ".$owerview_fix." ".$original_language." ".$film_id." ".$genre."</br></br></br>");       
        
        $unos="INSERT INTO filmovi(Title, Relese_date, Vote_Average, Vote_Count, Overview, original_language, id_film, genre_id, genre_id_2, genre_id_3, poster_path, backdrop_path) VALUES('".$title_fix."','".$release_date."','".$vote_average."','".$vote_count."','".$owerview_fix."','".$original_language."','".$film_id."','".$genre."','".$genre2."','".$genre3."','".$poster."','".$backdrop."')";
        $query=mysqli_query($connection,$unos);
    }
    exit;
?>