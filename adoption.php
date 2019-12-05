<?php
include "templates/header.php";
include "php/class/Filter.php";
?>
<?php 
$filter = new Filter();
$animal_display = $filter->getAllAnimals();
$animal_counter = $filter->getAnimalsAmmount();
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
                    while($i<$animal_counter){
                        echo '<div class="col-lg-4 card-animal">
                        <div class="row" style="flex-direction:column;padding:15px;">';
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