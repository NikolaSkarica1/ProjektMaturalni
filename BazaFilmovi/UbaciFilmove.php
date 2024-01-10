<?php
    $primljeno=$_POST['myJSONText'];
    $data = json_decode($primljeno,true);
    var_dump($data[0]);
    $connection=mysqli_connect("localhost","root","","baza");

    for ($i=0; $i < count($data); $i++) { 
        $title=$data[$i]['title'];
        $release_date=$data[$i]['release_date'];
        $vote_average=$data[$i]['vote_average'];
        $vote_count=$data[$i]['vote_count'];
        $overview=$data[$i]['overview'];
        $original_language=$data[$i]['original_language'];
        $film_id=$data[$i]['id'];
        $genre=$data[$i]['genre_ids'][0];
        echo($title." ".$release_date." ".$vote_average." ".$vote_count." ".$overview." ".$original_language." ".$film_id." ".$genre."</br></br></br>");       
        
        $unos='INSERT INTO filmovi(Title, Relese_Date, Vote_Average, Vote_Count, Overview, original_language, id_film, genre_ids) VALUES("'.$title.'","'.$release_date.'","'.$vote_average.'","'.$vote_count.'","'.$overview.'","'.$original_language.'","'.$film_id.'","'.$genre.'")';
        $query=mysqli_query($connection,$unos);
    }
    exit;
?>