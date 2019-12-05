<?php
include "templates/header.php";
include "php/class/Filter.php";
?>
<?php 
$filter = new Filter();
$animal_display = $filter->getAllAnimals();
$i = 0;
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
            <div class="col-lg-8">
                <span>Zaadoptuj przjaciela</span>
                <h1 class="light-text">Nasze schronisko elektroniczne</h1>
                <p>Teraz możesz pomagać zwierzakom nawet jeśli nie ma Cię w pobliżu</p>
                <a class="main-btn" href="#">Przygarnij zwierzaka</a>
                <a class="main-btn" href="#">Adopcja wirtualna</a>
            </div>
            <div class="col-lg-4"></div>
        </div>
      </div>
      <div class="container adopt-section pt-5">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>Każda pomoc się liczy</h2>
                <h1>Możliwości pomocy jest wiele</h1>
            </div>
        </div>
            <div class="row mt-5">
              <div class="col-lg-6 adopt">
                  <h2 class="adopt-subtitle">ZAADPTUJ ZWIERZAKA</h2>
                  <p>Bezpośrednio pomóż naszym pupilom zostając jego właścicielem! Pobierz formularz, wypełnij a następnie wyślij by rozpocząć adopcję.</p>
                  <a class="main-btn" href="#">Pobierz formularz</a>
                </div>
              <div class="col-lg-6 adopt">
                  <h2 class="adopt-subtitle">ADOPCJA WIRTUALNA</h2>
                  <p>Chcesz pomóc zwierzakom, lecz nie masz na to warunków? Dokonaj wpłaty na jego utrzymanie by zostać jego wirtualnym właścicielem!</p>
                  <a class="main-btn" href="#">Zaadoptuj wirtualnie</a>
                </div>
          </div>
      </div>
      <div class="container animals">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>ZAADOPTUJ</h2>
                    <h1>Nasi podopieczni</h1>
                </div>
            </div>
            <div class="row">
                
                <?php 
                    while($i<3){
                        echo '<div class="col-lg-4">
                        <div class="row" style="flex-direction:column;">';
                        echo '<p class="text-center"><img class="animal-img"src="/schronisko'.$animal_display[$i]['zdjecie'].'"></p>';
                        echo '<p>Imie:'.$animal_display[$i]['imie'].'</p>';
                        echo '<p>Gatunek:'.$animal_display[$i]['gatunek'].'</p>';
                        echo '<p>Rasa:'.$animal_display[$i]['rasa'].'</p>';
                        echo '<p>Płeć:'.$animal_display[$i]['plec'].'</p>';
                        echo '<p>Wiek:'.$animal_display[$i]['wiek'].'</p>';
                        echo '<p>Status:'.$animal_display[$i]['status'].'</p>';
                        echo '<p>Opis:'.$animal_display[$i]['opis'].'</p>';
                        
                        echo '</div> </div>';
                        $i++;
                    }
                ?>
                </div>
                <div class="col-lg-4"></div>
                <div class="col-lg-4"></div>
            </div>
      </div>
</body>
</html>
