<?php
session_start();
if($_SESSION['isLoggedIn']==1){
    $stranica="profile.php";
}else{
    $stranica="login.php";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="izgled.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>People</title>
</head>
<body>
    <div id="header">
        <a href="http://localhost/ProjektMaturalni/">
            <img src="slike/ikona.png" id="ikona"/>        
            <h1 id="Naziv-Stranica">Filmovi!</h1>
        </a>
        <form action=<?php echo($stranica) ?> method="POST"  id="header-login">
            <button type="submit"><img class="search-slika" src="slike/login.png"></img></button>
        </form>
        <form action="Search.php" method="GET" id="Search">
            <input type="text" name="select" id="search-input" placeholder="Search"/>
            <input type='hidden' name='filter' value='Vote_Count DESC'/>
            <button type="submit"><img class="search-slika" src="slike/search.png"></img></button>
        </form>
    </div>
    <div id="a"></div>
<script>
    const options = {
        method: 'GET',
        headers: {
            accept: 'application/json',
            Authorization: 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI2MGIwNTY2YjQ0MGM3YzEyMzczNTk3ZGNkNmU0NGE2MyIsInN1YiI6IjY1ODE4MjI0MjI2YzU2MDdmZTlmMTJmMyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.RUvOSEO-KbF9h1Ta9J6ylU-5BhXLebJ2qpmTxw14hjk'
        }
    };

    async function logMovies() {
        const response = await fetch('https://api.themoviedb.org/3/person/'+<?php echo($_GET['id']) ?>+'?append_to_response=credits&language=en-US', options);
        const actor = await response.json();
        console.log(actor);
        let gen;
        if(actor.gender==1){
            gen="Female"
        }else if(actor.gender==2){
            gen="Male"
        }else if(actor.gender==3){
            gen="Non-binary"
        }

        let slika;
        if(actor.profile_path==null){
            slika="slike/empty-actor.png";
        }else{
            slika='https://www.themoviedb.org/t/p/w1280/'+actor.profile_path;
        }

        $("body").append(`
            <div id='actor-info'>
                <img width='90%' src='${slika}'></img>
                <h2>Personal info:</h2>
                <h3>Name: ${actor.name}</h3><br/>
                <h4>Birthday: ${actor.birthday}</h4><br/>
                <h4>Place of birth: ${actor.place_of_birth}</h4><br/>
                <h4>Gender:${gen}</h4>
            </div>
            <div id='actor-movies'>
                <h1>Known for:</h1>
            </div>
        `);
        for (let i = 0; i < actor.credits.cast.length; i++) {
            if(actor.credits.cast[i].vote_count>500){
                $('#actor-movies').append(`
                <form action='film.php' method='GET'>
                    <input type='hidden' name='id' value='${actor.credits.cast[i].id}'/>
                    <button type='submit' id='prijelaz'>
                        <div id='film'>
                            <img id='poster-index' src='https://www.themoviedb.org/t/p/w1280/${actor.credits.cast[i].poster_path}'></img>
                            <p id='title'>${actor.credits.cast[i].title}</p>
                            <p id='index-score'>As: ${actor.credits.cast[i].character}</p>
                        </diV>
                    </button> 
                </form>
                `);
            }
        }
    }
    logMovies();
</script>
</body>
</html>