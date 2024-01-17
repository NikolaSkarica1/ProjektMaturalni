<html>
<head>
    <title>Search</title>
    <link rel="stylesheet" href="izgled.css">
</head>
<body>
<div id="header">
        <h1 id="Naziv-Stranica">Filmovi!</h1>
        <form action="Search.php" method="GET" id="Search">
            <input type="text" name="select" id="search-input" placeholder="Tražite filmove"/>
            <button type="submit"><img class="search-slika" src="slike/search.png"></img></button>
        </form>
    </div>
<?php
    $unos=$_GET['select'];
    echo("<div id='Section'><h2>Results for search '".$unos."'</h2> <br/>");
    $connection=mysqli_connect("localhost","root","","baza");
    $select="SELECT * FROM filmovi WHERE title LIKE '%".$unos."%'";
    $selected=mysqli_query($connection,$select);
    foreach ($selected as $key => $value) {
        echo("
        <div id='film'>
            <img id='poster-index' src='https://www.themoviedb.org/t/p/w1280/".$value['poster_path']."'></img>
            <p id='title'>".$value['Title']."</p>
        </div>  
        ");
    }
    echo("</div>")
?>    
</body>
</html>