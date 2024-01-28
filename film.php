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
        <input type="text" name="select" id="search-input" placeholder="Search"/>
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
        const response = await fetch('https://api.themoviedb.org/3/movie/'+film_id+'?append_to_response=credits&language=en-US', options);
        const film = await response.json();
        console.log(film);

        const godina=film.release_date.split("-");

        let zarnovi="";
        for (let i = 0; i < film.genres.length;) {
            zarnovi+=film.genres[i].name;
            i++;
            if(i !=film.genres.length){
                zarnovi+=", ";
            }
        }

        let jezici="";
        for (let i = 0; i < film.spoken_languages.length;) {
            jezici+=film.spoken_languages[i].english_name;
            i++;
            if(i !=film.spoken_languages.length){
                jezici+=", ";
            }
        }

        let kompanije="";
        for (let i = 0; i < film.production_companies.length;) {
            kompanije+=film.production_companies[i].name;
            i++;
            if(i !=film.production_companies.length){
                kompanije+=", ";
            }
        }

        let drzave="";
        for (let i = 0; i < film.production_countries.length;) {
            drzave+=film.production_countries[i].name;
            i++;
            if(i !=film.production_countries.length){
                drzave+=", ";
            }
        }

        $("body").append(`
            <img id='backdrop' src='https://www.themoviedb.org/t/p/w1280/${film.backdrop_path}"'/>
            <div id="content">
                <img id="poster-film" width=250px height=380px src='https://www.themoviedb.org/t/p/w1280/${film.poster_path}"'></img>
                <button type="submit" id="kupi-button">Buy 20€</button>
                <div id='title-container'>
                    <p id='title-film'>${film.title}</p>
                    <h2 id='tagline'>${film.tagline}</h2>
                    <p id='film-score'>${film.vote_average} </p><img id='film-star' src='slike/BlackStar.png'/>
                    <p id='film-info'>| ${film.runtime} min | ${godina[0]} | ${zarnovi}</p>
                    <div id="content-container">
                        <h2>About:</h2>
                        <p id="overview">${film.overview}</p><br/>
                        <h3>Languages:</h3>
                        <p>${jezici}</p><br/>
                        <h3>Production companies:</h3>
                        <p>${kompanije}</p><br/>
                        <h3>Production countries:</h3>
                        <p>${drzave}</p><br/>
                        <h3>Budget:</h3>
                        <p>${film.budget}$</p>
                        <h3>Revenue:</h3>
                        <p>${film.revenue}$</p>
                    </div>
                </div>
            </div>
        `);
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
            console.log(godinaKol[0]);
            var datum = new Date();
            let sad=datum.getYear()+1900;
            Relese=parseInt(godinaKol[0])
            if(sad<Relese || godinaKol[0]==""){
                console.log("Bruh")
            }else{
                $("#collection").append(`
                <form action='film.php' method='GET'>
                    <input type='hidden' name='id' value='${kolekcija.parts[i].id}'/>
                    <button type='submit' id='prijelaz'>
                        <div id='film-collection'>
                            <img id='poster-collection' src='https://www.themoviedb.org/t/p/w1280/${kolekcija.parts[i].backdrop_path}'></img>
                            <p id='title'>${kolekcija.parts[i].title}</p>
                            <p id='index-score'>${kolekcija.parts[i].vote_average}</p><img id='index-star' src='slike/star.png'></img>
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


</script>
</body>
</html>