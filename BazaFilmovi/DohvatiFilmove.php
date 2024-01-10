<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
</head>
<body>
<form>
    <input type="button" id="submit"/>
</form>
<p id="Ispis">
<script type="text/javascript">
    const options = {
        method: 'GET',
        headers: {
            accept: 'application/json',
            Authorization: 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI2MGIwNTY2YjQ0MGM3YzEyMzczNTk3ZGNkNmU0NGE2MyIsInN1YiI6IjY1ODE4MjI0MjI2YzU2MDdmZTlmMTJmMyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.RUvOSEO-KbF9h1Ta9J6ylU-5BhXLebJ2qpmTxw14hjk'
        }
    };
    let myJSONText="";
    async function logMovies() {
        // for (let i = 1; i <= 3; i++) {
            const response = await fetch('https://api.themoviedb.org/3/discover/movie?include_adult=false&include_video=false&language=en-US&page=3&sort_by=popularity.desc', options);
            const movies = await response.json();
            console.log(movies);
            myJSONText=JSON.stringify(movies.results);
            console.log(myJSONText);             
        // }
    }
    logMovies();

    $("#submit").click(function(){
        $.ajax({
            type:"POST",
            data:{myJSONText : myJSONText},
            url:"UbaciFilmove.php",
            success: function(data) {
                $("#Ispis").html(data);
            }
        });
    });
    

</script>
</body>
</html>