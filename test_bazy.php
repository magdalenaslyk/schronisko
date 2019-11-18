<?php
    include 'php/db.php';
    $baza = new Db();
    $wynik = $baza->query("SELECT * FROM uzytkownik WHERE haslo='" . md5("admin") . "'");
    var_dump($wynik);
?>