<?php
include "php/class/Filter.php";
include "php/class/DBConnection.php";
include "php/class/User.php";
$usr = new User();

if($usr->getSession()){
    $usr->setID($_SESSION['id']);
    $dane_usera = $usr->getUserInfo();
    $usr->setRola($dane_usera["rola"]);
}


$filter = new Filter();
$animal_display = $filter->getAllAnimals();

foreach($animal_display as $row){
    echo '<div class="col-lg-4 card-animal">
          <div class="row" style="flex-direction:column;padding:15px;">';
    echo '<p class="text-center"><img class="animal-img"src="/schronisko'.$row['zdjecie'].'"></p>';
    echo '<p>Imie:'.$row['imie'].'</p>';
    echo '<p>Gatunek:'.$row['gatunek'].'</p>';
    echo '<p>Rasa:'.$row['rasa'].'</p>';
    echo '<p>Płeć:'.$row['plec'].'</p>';
    echo '<p>Wiek:'.$row['wiek'].'</p>';
    echo '<p>Status:'.$row['status'].'</p>';
    echo '<p>Opis:'.$row['opis'].'</p>';
    echo "<a href='\schronisko/edit_animal.php?a=del&amp;id={$row['id']}'>Edytuj</a>";
    echo '</div> </div>';

}


?>