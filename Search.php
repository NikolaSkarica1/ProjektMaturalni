<html>
<head>
    <title>Search</title>
    <link rel="stylesheet" href="izgled.css">
</head>
<body>
<?php
    $unos=$_GET['select'];
    echo("Resoults for search '".$unos."' <br/>");
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
?>    
</body>
</html>