<?php
include "templates/header.php";
include "php/class/Filter.php";
include "php/class/DBConnection.php";
?>
<?php 
$filter = new Filter();
$animal_display = $filter->getAllAdverts();
?>
      <div class="container-fluid hero-container">
        <div class="row">
            <div class="col-lg-8">
                <span>Zaadoptuj przjaciela</span>
                <h1 class="light-text">Nasze schronisko elektroniczne</h1>
                <p>Teraz możesz pomagać zwierzakom nawet jeśli nie ma Cię w pobliżu</p>
                <a class="main-btn" href="<?php echo SITE_URL;?>/user_panel.php">Przygarnij zwierzaka</a>
                <a class="main-btn" href="<?php echo SITE_URL;?>/user_panel.php">Adopcja wirtualna</a>
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
                  <a class="main-btn" href="<?php echo SITE_URL;?>/user_panel.php">Pobierz formularz</a>
                </div>
              <div class="col-lg-6 adopt">
                  <h2 class="adopt-subtitle">ADOPCJA WIRTUALNA</h2>
                  <p>Chcesz pomóc zwierzakom, lecz nie masz na to warunków? Dokonaj wpłaty na jego utrzymanie by zostać jego wirtualnym właścicielem!</p>
                  <a class="main-btn" href="<?php echo SITE_URL;?>/user_panel.php">Zaadoptuj wirtualnie</a>
                </div>
          </div>
      </div>
      <div class="container-fluid animals">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>ZAADOPTUJ</h2>
                    <h1>Nasi podopieczni</h1>
                </div>
            </div>
            <div class="row">
                
                <?php
                foreach($animal_display as $row){
                    $t = substr($row['opis'],0,200);
                    echo '
                    <div class="col-lg-4 card-animal">
                        <div class="row" style="flex-direction:column;padding:15px;">
                            <p class="text-center"><img class="animal-img"src="/schronisko'.$row['zdjecie'].'"></p>
                            <p>Imie:</p><p class="bg-primary">'.$row['imie'].'</p>
                            <p>Gatunek:</p><p class="bg-primary">'.$row['gatunek'].'</p>
                            <p>Rasa:</p><p class="bg-primary">'.$row['rasa'].'</p>
                            <p>Płeć:</p><p class="bg-primary">'.$row['plec'].'</p>
                            <p>Wiek:</p><p class="bg-primary">'.$row['wiek'].'</p>
                            <p>Status:</p><p class="bg-primary">'.$row['status'].'</p>
                            <p>Opis:</p><p>'.$t.'</p>
                        </div> 
                    </div>';
                }
                ?>
                </div>
                <div class="col-lg-4"></div>
                <div class="col-lg-4"></div>
            </div>
      </div>
      <?php
include('templates/footer.php');
?>