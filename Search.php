<html>
<head>
    <title>Search</title>
</head>
<body>
<?php
    $connection=mysqli_connect("localhost","root","","baza");
    $select="SELECT * FROM filmovi WHERE title LIKE '%".$_GET['select']."%'";
    $selected=mysqli_query($connection,$select);
    foreach ($selected as $key => $value) {
        echo("<img width=250px height=380px src='https://www.themoviedb.org/t/p/w1280/".$value['poster_path']."'></img>");
    }
?>    
</body>
</html>