<?php
include "php/class/Filter.php";
include "php/class/DBConnection.php";
include "php/class/User.php";
include "php/class/Animal.php";
?>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">aDogted</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/schronisko/glowna.php">Glowna <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/schronisko/adoption.php">Do adopcji</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/schronisko/login.php">Panel użytkownika</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container-fluid hero-container">
    <div class="row">
        <div class="col-lg-12 text-center">
            <h1 class="text-light display-1">Zaadoptuj przjaciela</h1>
        </div>
    </div>
</div>
<div class="container-fluid animals pt-5 px-5">
    <div class="row">
        <div class="col-lg-12 text-center">
            <h2>ZAADOPTUJ</h2>
            <h1>Nasi podopieczni</h1>
        </div>
    </div>
    <div class="row">
<?php
$usr = new User();
$animal = new Animal();
$filter = new Filter();
$animal_display = $filter->getAllAnimals();

if($usr->getSession()){
    $usr->setID($_SESSION['id']);
    $dane_usera = $usr->getUserInfo();
    $usr->setRola($dane_usera['rola']);
}

//sprawdzenie uprawnień
if ($dane_usera['rola'] != 'admin' ){
    header("location:home.php");
}
//pobranie informacji o zwierzęciu za pomocą id
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $animal->setID($id);
    $dane_animal = $animal->getAnimalInfo();
;

    //jeśli został klikniętny przycisk submit
if(isset($_POST['submit'])){
    extract($_POST);
    //Get the values of our form fields.
    $uimie = isset($uimie) ? $uimie : null;
    $ugatunek = isset($ugatunek) ? $ugatunek : null;
    $urasa = isset($urasa) ? $urasa: null;
    $uplec = isset($uplec) ? $uplec : null;
    $uwiek = isset($uwiek) ? $uwiek : null;
    $ustatus = isset($ustatus) ? $ustatus : null;
    $uopis = isset($uopis) ? $uopis : null;
    $uzdjecie = isset($uzdjecie) ? $uzdjecie : null;
    $ukastracja = isset($ukastracja) ? $ukastracja : null;
    $uszczepienia = isset($uszczepienia) ? $uszczepienia : null;
    $ukoszta= isset($ukoszta) ? $ukoszta : null;

    if(strlen(trim($uimie)) === 0){
        $errors[] = "You must enter imie!";
    }
    if(strlen(trim($ugatunek)) === 0){
        $errors[] = "You must enter gatunek!";
    }
    if(strlen(trim($urasa)) === 0){
        $errors[] = "You must enter rasa!";
    }
    if(strlen(trim($uplec)) === 0){
        $errors[] = "You must enter płeć";
    }
    if(strlen(trim($uwiek)) === 0){
        $errors[] = "You must enter wiek!";
    }
    if(strlen(trim($ustatus)) === 0){
        $errors[] = "You must enter status!";
    }
    if(strlen(trim($ukastracja)) === 0){
        $errors[] = "You must enter kastracja!";
    }
    if(strlen(trim($uszczepienia)) === 0){
        $errors[] = "You must enter szczepienia!";
    }
    if(strlen(trim($ukoszta)) === 0){
        $errors[] = "You must enter koszt!";
    }

    //If our $errors array is empty, we can assume that everything went fine.
    if(empty($errors)){
        //insert data into database.
        $animal->setID($id);
        $animal->setImie($uimie);
        $animal->setGatunek($ugatunek);
        $animal->setRasa($urasa);
        $animal->setPlec($uplec);
        $animal->setWiek($uwiek);
        $animal->setStatus($ustatus);
        $animal->setOpis($uopis);
        $animal->setZdjecie($uzdjecie);
        $animal->setKastracja($ukastracja);
        $animal->setSzczepienia($uszczepienia);
        $animal->setKoszta($ukoszta);
        $editAnimal = $animal->editAnimal();
        if ($editAnimal) {
            $status = "<div class='alert alert-success' style='text-align:center'>Edit successful <a href='".SITE_URL."home.php'>Click here</a> to see</div>";
        } else {
            $status = "<div class='alert alert-danger' style='text-align:center'>Edit failed. Try again.</div>";
        }
    }
}
else

  //jeśli nic nie zostało kliknięte to pokazuje wypełniony formularz
    echo "<div class='row'>
        <div class='col-lg-12'>
            <form action='' method='post' name='add' enctype='multipart/form-data'>
        Imię zwierzaka: <input type='text' name='uimie' value =".$dane_animal["imie"]."></input><br>
    Gatunek: <select name='ugatunek' >
                    <option value='pies'>Pies</option>
                    <option value='kot'>Kot</option>
                    <option value=".$dane_animal["gatunek"]." selected disabled='disabled'>".$dane_animal["gatunek"]."</option>
                </select><br>
    Rasa: <input type='text' name='urasa' value =".$dane_animal["rasa"]."></input><br>
    Płeć: <select name='uplec' value =".$dane_animal["plec"].">
                    <option value='pies'>Pies</option>
                    <option value='suka'>Suka</option>
                    <option value='kot'>Kot</option>
                    <option value='kotka'>Kotka</option>
                    <option value=".$dane_animal["plec"]." selected disabled='disabled'>".$dane_animal["plec"]."</option>
                </select><br>
    Wiek: <input type='text' name='uwiek' value =".$dane_animal["wiek"]."></input><br>
    Status: <select name='ustatus'>
                    <option value='do adopcji'>Do adopcji</option>
                    <option value='w domu'>W domu</option>
                    <option value='died'>Za tęczowym mostem</option>
                    <option value='zaadoptowany wirtualnie'>Zaadoptowany wirtualnie</option>
                    <option value=".$dane_animal["status"]." selected disabled='disabled'>".$dane_animal["status"]."</option>
                </select><br>
    Opis: <textarea name='uopis' rows='10' cols='30' >".$dane_animal["opis"]."</textarea><br>
    Czy zwierzę miało zabieg kastracji/sterylizacji? <select name='ukastracja'  >
                    <option value='tak'>Tak</option>
                    <option value='nie'>Nie</option>
                    <option value=".$dane_animal["kastracja"]." selected disabled='disabled'>".$dane_animal["kastracja"]."</option>
                </select><br>
    Czy zwierzę jest szczepione? <select name='uszczepienia'>
                    <option value='tak'>Tak</option>
                    <option value='nie'>Nie</option>
                    <option value=".$dane_animal["szczepienia"]." selected disabled='disabled'>".$dane_animal["szczepienia"]."</option>
                </select><br>
    Miesięczny koszt utrzymania: <input type='number' name='ukoszta' min='1' max='9999999999' value =".$dane_animal["koszta_miesiac"]."><br>
               <button type=\"submit\" name=\"submit\" class=\"float-right btn btn-primary\">Edytuj</button>
            </form>
        </div>
    </div>";

}

else



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

    </div>
    <div class="col-lg-4"></div>
    <div class="col-lg-4"></div>
</div>
</div>
</body>
</html>

