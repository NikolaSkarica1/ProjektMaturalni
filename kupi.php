<?php
    session_start();
    if($_SESSION['isLoggedIn']==1){
        $connection=mysqli_connect("localhost","root","","baza");
        $film_id=$_POST['film_id'];
        $provjeraString="SELECT * FROM kupljeno WHERE id_film =".$film_id;
        $provjera=mysqli_query($connection,$provjeraString);
        foreach ($provjera as $key => $value) {
            if($value['username']==$_SESSION['username']){
                echo("Vec ste kupili film");
                exit;
            }
        }
        $unos="INSERT INTO kupljeno(id_film,username) VALUES('".$film_id."','".$_SESSION['username']."')";
        $query=mysqli_query($connection,$unos);
        echo("Uspjesno ste kupili film");
    }else{
        echo("Morate biti prijavljeni kako bi kupili film");
    }
    exit;
?>