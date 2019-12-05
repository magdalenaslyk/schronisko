<?php
include "php/class/Filter.php";
$filter = new Filter();
$animal_display = $filter->getAllAnimals();
$i = 0;
while($i<$animal_display){
    echo '<img src="/schronisko'.$animal_display[$i]['zdjecie'].'"></p>';
    echo '<p>Imie:'.$animal_display[$i]['imie'].'</p>';
    echo '<p>Gatunek:'.$animal_display[$i]['gatunek'].'</p>';
    echo '<p>Rasa:'.$animal_display[$i]['rasa'].'</p>';
    echo '<p>Płeć:'.$animal_display[$i]['plec'].'</p>';
    echo '<p>Wiek:'.$animal_display[$i]['wiek'].'</p>';
    echo '<p>Status:'.$animal_display[$i]['status'].'</p>';
    echo '<p>Opis:'.$animal_display[$i]['opis'].'</p>';
    echo "<a href=\'index.php?a=del&amp;id={$animal_display[$i]['id']}\'>Edytuj</a>";
    $i++;
}
?>