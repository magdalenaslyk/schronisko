<?php
include "templates/header.php";
include "php/class/Filter.php";
include "php/class/DBConnection.php";

?>
<?php 
$filter = new Filter();
$animal_display = $filter->getAllAdverts();
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
                        ?>
                        <form action="test.php" method="post" name="zid">
                            <input type="hidden" value="<?php echo $row["id"] ?>" name="zid" hidden/>
                            <button type="submit" name="submit" class="float-right btn btn-primary">PRZYGARNIJ</button>
                        </form>
                        <?php
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