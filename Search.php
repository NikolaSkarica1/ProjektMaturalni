<?php
session_start();
if($_SESSION['isLoggedIn']==1){
    $stranica="profile.php";
}else{
    $stranica="login.php";
}
?>
<html>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="izgled.css">
    <title>Search</title>
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
    <?php
        $unos=$_GET['select'];
        $sort=$_GET['filter']
    ?>
    <div id='Section-search'><h2>Results for '<?php echo($unos)?>'</h2> <br/>
    <form action='Search.php' method='GET'>
        Sort by:
        <input type='hidden' name='select' value='<?php echo($unos)?>'>
        <select name='filter'>  
            <option value="Vote_Count DESC">Popularity DESC</option>  
            <option value="Vote_Count ASC">Popularity ASC</option>   
            <option value="Relese_date DESC">Newest</option>  
            <option value="Relese_date ASC">Oldest</option>  
            <option value="Vote_Average DESC">Heigest rated</option>  
            <option value="Vote_Average ASC">Lowest rated</option>  
            <option value="Title ASC">Alphabetical (A>Z)</option>
            <option value="Title DESC">Alphabetical (Z>A)</option>  
        </select> 
        <input type='submit' value='Filter'>
    </form><br/>
<?php
    $connection=mysqli_connect("localhost","root","","baza");
    $select="SELECT * FROM filmovi WHERE title LIKE '%".$unos."%' ORDER BY `filmovi`.".$sort;
    $selected=mysqli_query($connection,$select);
    foreach ($selected as $key => $value) {
        $parts = explode('-', $value['Relese_date']);
        echo("
        <form action='film.php' method='GET'>
            <input type='hidden' name='id' value='".$value['id_film']."'/>
            <button type='submit' id='prijelaz'>
                <div id='film'>
                    <img id='poster-index' src='https://www.themoviedb.org/t/p/w1280/".$value['poster_path']."'></img>
                    <p id='title'>".$value['Title']."</p>
                    <p id='index-score'>".$value['Vote_Average']."</p><img id='index-star' src='slike/star.png'></img>
                    <p id='index-score'>|".$parts[0]."</p>
                </diV>
            </button> 
        </form>
        ");
    }
    echo("</div>")
?>  
<div id="footer">
    <p>© 2024 Copyright: Nikola Škarica</p>
    Powered by: <a href="https://www.themoviedb.org"><img src="slike/tmdb.svg" width="200px"/></a>
</div>
</body>
</html>