<?php
include "templates/header.php";
include "php/class/Filter.php";
include "php/class/DBConnection.php";

?>
<?php 
$filter = new Filter();
$animal_display = $filter->getAllAdverts();
if(isset($_GET['status'])){
    $adam = $_GET['status'];
    $animal_filtered = $filter->getAnimalFiltered($adam);
}
else{
    $animal_filtered = $filter->getAnimalFiltered('do adopcji');
}

?>
    <div class="container-fluid hero-container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1 class="text-light display-1">Zaadoptuj przyjaciela</h1>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>ZAADOPTUJ</h2>
                <h1>Nasi podopieczni</h1></div>
        </div>
        <div class="row">
            <div class="col-lg-12">
            <form action='' method='post' name='add' enctype='multipart/form-data'>
            
            <div class="form-group d-flex justify-content-around">
            <?php echo "<a class=' btn btn-primary flex-fill mr-3' href='\schronisko/adoption.php?a=del&amp;status=w domu'>W domu</a>"; ?>
            <?php echo "<a class=' btn btn-primary flex-fill mr-3' href='\schronisko/adoption.php?a=del&amp;status=died'>Umarnął</a>"; ?>
            <?php echo "<a class=' btn btn-primary flex-fill mr-3' href='\schronisko/adoption.php?a=del&amp;status=do adopcji'>Do adopcji</a>"; ?>
            </div>
            </form>
            </div>
        </div>
    </div>
    <div class="container-fluid animals pt-5 px-5">
            <div class="row">
                
                <?php 
                    foreach($animal_filtered as $row){
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
                            <p>Opis:</p><p>'.$t.'</p>';
                        ?>
                        <?php
                            if($row['status']=="do adopcji"){
                                echo'
                                <form action="test.php" method="post" name="zid">
                                    <input type="hidden" value="'.$row['id'].'" name="zid" hidden/>
                                    <button type="submit" name="submit" class="float-right btn btn-primary">PRZYGARNIJ</button>
                                </form>';
                            }
                        ?>
                        <!--<form action="test.php" method="post" name="zid">
                            <input type="hidden" value="<?php echo $row["id"] ?>" name="zid" hidden/>
                            <button type="submit" name="submit" class="float-right btn btn-primary">PRZYGARNIJ</button>
                        </form>-->
                        <?php
                        echo '</div> </div>';

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