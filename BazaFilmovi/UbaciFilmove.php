<?php
    $primljeno=$_POST['myJSONText'];
    // $data = json_decode($primljeno);
    // print_r($data);
    // echo("</br>");
    // echo("</br>");
    // echo("</br>");
    // var_dump($data);
    // echo("</br>");
    // echo("</br>");
    // echo("</br>");
    $rebelMoon=var_dump(json_decode($primljeno, true));
    exit;
?>