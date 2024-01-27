<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="izgled.css">
    <title>Document</title>
</head>
<body>
    <div id="header">
        <a href="http://localhost/Projekt/">
            <img src="slike/ikona.png" id="ikona"/>        
            <h1 id="Naziv-Stranica">Filmovi!</h1>
        </a>
        <form action="Search.php" method="GET" id="Search">
            <input type="text" name="select" id="search-input" placeholder="Tražite filmove"/>
            <button type="submit"><img class="search-slika" src="slike/search.png"></img></button>
        </form>
    </div>
    <div id="a"/>
    <div id="container"></div>
<script>
    var film_id='<?php echo($_GET['id']) ?>';
    console.log(film_id);
    const options = {
        method: 'GET',
        headers: {
            accept: 'application/json',
            Authorization: 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI2MGIwNTY2YjQ0MGM3YzEyMzczNTk3ZGNkNmU0NGE2MyIsInN1YiI6IjY1ODE4MjI0MjI2YzU2MDdmZTlmMTJmMyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.RUvOSEO-KbF9h1Ta9J6ylU-5BhXLebJ2qpmTxw14hjk'
        }
    };
    async function film() {
        const response = await fetch('https://api.themoviedb.org/3/movie/'+film_id+'?language=en-US', options);
        const film = await response.json();
        console.log(film);
        $("body").append(`
            <img id='backdrop' src='https://www.themoviedb.org/t/p/w1280/${film.backdrop_path}"'/>
            <div id="content">
                <img id="poster-film" width=250px height=380px src='https://www.themoviedb.org/t/p/w1280/${film.poster_path}"'></img>
                <div id='title-container'>
                    <p id='title-film'>${film.title}</p>
                    <h2 id='tagline'>${film.tagline}</h2>
                <div/>
            </div>
            `);
    }
    film();
</script>
</body>
</html>