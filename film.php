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
    <title>Filmovi!</title>
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
    <div id="a"/>
    <div id="container"></div>
<script>
    var film_id='<?php echo($_GET['id']) ?>';

    const options = {
        method: 'GET',
        headers: {
            accept: 'application/json',
            Authorization: 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI2MGIwNTY2YjQ0MGM3YzEyMzczNTk3ZGNkNmU0NGE2MyIsInN1YiI6IjY1ODE4MjI0MjI2YzU2MDdmZTlmMTJmMyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.RUvOSEO-KbF9h1Ta9J6ylU-5BhXLebJ2qpmTxw14hjk'
        }
    };

    async function film() {
        const response = await fetch('https://api.themoviedb.org/3/movie/'+film_id+'?append_to_response=credits%2Cvideos&language=en-US', options);
        const film = await response.json();
        console.log(film);

        const godina=film.release_date.split("-");

        var zarnovi = film.genres.map(function(item) {
            return item['name'];
        });

        var jezici = film.spoken_languages.map(function(item) {
            return item['english_name'];
        });

        var kompanije = film.production_companies.map(function(item) {
            return item['name'];
        });

        var drzave = film.production_countries.map(function(item) {
            return item['name'];
        });

        let dir=film.credits.crew.filter(({job})=> job ==='Director');
        console.log(dir);
        dir = dir.map(function(item) {
            return item['name'];
        });

        let trailers=film.videos.results.filter(({type})=> type ==='Trailer');

        $("body").append(`
            <img id='backdrop' src='https://www.themoviedb.org/t/p/w1280/${film.backdrop_path}"'/>
            <div id="content">
                <img id="poster-film" width=250px height=380px src='https://www.themoviedb.org/t/p/w1280/${film.poster_path}"'></img>
                <button type="submit" id="kupi-button">Buy 20€</button>
                <button id='trailer-btn' onClick=trailer()><img id='play' src='slike/play.png'/><p id='trailer-txt'>Trailer</p></button>
                <div id='title-container'>
                    <p id='title-film'>${film.title}</p>
                    <h2 id='tagline'>${film.tagline}</h2>
                    <p id='film-score'>${Math.round(film.vote_average * 10) / 10} </p><img id='film-star' src='slike/BlackStar.png'/>
                    <p id='film-info'>| ${film.runtime} min | ${godina[0]} | ${zarnovi}</p>
                    <div id="content-container">
                        <h2>About:</h2>
                        <p id="overview">${film.overview}</p><br/>
                        <h3>Directed by:</h3>
                        <p>${dir}</p><br/>
                        <h3>Languages:</h3>
                        <p>${jezici}</p><br/>
                        <h3>Production companies:</h3>
                        <p>${kompanije}</p><br/>
                        <h3>Production countries:</h3>
                        <p>${drzave}</p><br/>
                        <h3>Budget:</h3>
                        <p>${film.budget}$</p>
                        <h3>Revenue:</h3>
                        <p>${film.revenue}$</p><br/>
                        <h2>Staring:</h2>
                        <div id="actors"></div><br/>
                    </div>
                </div>
                <div id='video'>
                    <button onClick=zatvori()><img src="slike/x.png"/></button>
                    <center>
                        <iframe width="860" height="560" src="https://www.youtube.com/embed/${trailers[0].key}"/>
                    </center>
                </div>
            </div>
        `);
        for (let i = 0; i < film.credits.cast.length; i++) {
            let actor=film.credits.cast[i];
            let slika;
            if(actor.profile_path==null){
                slika="slike/empty-actor.png";
            }else{
                slika='https://www.themoviedb.org/t/p/w1280/'+actor.profile_path;
            }
            $("#actors").append(`
            <form action='People.php' method='GET' id='act-form'>
                <input type='hidden' name='id' value='${actor.id}'/>
                <button type='submit' id='prijelaz'>
                    <div id='actor'>
                        <img src='${slika}' width='200px' id='actor-img'></img>
                        <h4>${actor.name}</h4>
                        <p>${actor.character}</p>
                    </div>
                </button> 
            </form>
            `);
        }

        if(film.belongs_to_collection !=null){
            kolekcija();
        }
        async function kolekcija() {
            const response = await fetch('https://api.themoviedb.org/3/collection/'+film.belongs_to_collection.id+'?language=en-US', options);
            const kolekcija = await response.json();
            console.log(kolekcija);
            $("#content-container").append(`
                <h2>${kolekcija.name}:</h2>
                <div id="collection">
            `);
            const godinaKol=[];
            for (let i = 0; i < kolekcija.parts.length; i++) {
                godinaKol[0]=kolekcija.parts[i].release_date.split("-");
                var datum = new Date();
                let sad=datum.getYear()+1900;
                Relese=parseInt(godinaKol[0])
                if(sad>Relese && godinaKol[0]!=""){
                    $("#collection").append(`
                    <form action='film.php' method='GET'>
                        <input type='hidden' name='id' value='${kolekcija.parts[i].id}'/>
                        <button type='submit' id='prijelaz'>
                            <div id='film-collection'>
                                <img id='poster-collection' src='https://www.themoviedb.org/t/p/w1280/${kolekcija.parts[i].backdrop_path}'></img>
                                <p id='title'>${kolekcija.parts[i].title}</p>
                                <p id='index-score'>${Math.round(kolekcija.parts[i].vote_average * 10) / 10}</p><img id='index-star' src='slike/star.png'></img>
                                <p id='index-score'> ◦ 20€</p>
                            </div>
                        </button> 
                    </form>
                    `);   
                } 
            }
            $("#content-container").append('</div>');
        }
    }
    film();

    function trailer(){
        $("#video").css("display", "block");
    };
    function zatvori(){
        $("#video").css("display", "none");
    }
</script>
</body>
</html>