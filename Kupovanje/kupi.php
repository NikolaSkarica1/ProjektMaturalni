<?php
    session_start();
    $connection=mysqli_connect("localhost","root","","baza");

    $film_id=$_POST['film_id'];
    $unos="INSERT INTO kupljeno(id_film,username) VALUES('".$film_id."','".$_SESSION['username']."')";
    $query=mysqli_query($connection,$unos);
    echo("You have succesfully pourchused the movie");

    exit;
?>
