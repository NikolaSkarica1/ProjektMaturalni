<?php
    session_start();
    $connection=mysqli_connect("localhost","root","","baza");

    $film_id=$_POST['film_id'];
    $provjeraString="SELECT * FROM kupljeno WHERE id_film =".$film_id." AND username='".$_SESSION['username']."'";
    $provjera=mysqli_query($connection,$provjeraString);
    if(mysqli_num_rows($provjera)>0){
        echo(0);
    }else{
        echo(1);
    }
    exit;
?>