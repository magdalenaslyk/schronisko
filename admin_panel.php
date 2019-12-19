<?php
include "templates/header.php";
include "php/class/User.php";
include "php/class/DBConnection.php";
include "php/class/Adoption.php";
include "php/class/Payment.php";

$user = new User();
if(!empty($_SESSION['id'])){
    $uid = $_SESSION['id'];

}
if($_SESSION['rola']!=="admin"){
    header("location:user_panel.php");
} 
if ($user->getSession()===FALSE) {
   header("location:login.php");
}
if (isset($_GET['q'])) {
    $user->logout();
    header("location:login.php");
}
$user->setID($uid);
$userInfo = $user->getUserInfo();
?>
      <div class="container-fluid hero-container-pages">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1 class="text-light display-1">Witaj w panelu admina</h1>
            </div>
        </div>
      </div>
      
    <div class="container pt-5">
    <div class="row">
        <div class="col-lg-10">
            <h2>Witaj <?php print $userInfo['imie'];?></h2>                 
        </div>
        <div class="col-lg-2">
            <a href="<?php print SITE_URL; ?>admin_panel.php?q=logout" class="float-right btn btn-danger btn-sm">LOGOUT</a>
        </div>
    </div>
        <div class="row mb-5">
            <div class="col-lg-12">
            <form action="" method="post">
                <a class="btn btn-primary"  href="" role="button">Zarządzaj płatnościami</a>
                <a class="btn btn-primary"  href="add_animal.php" role="button">Dodaj zwierzaka</a>
                <a class="btn btn-primary"  href="edit_animal.php" role="button">Edytuj zwierzaka</a>
                <!--<button type="submit" class="btn btn-primary" name="add_animal">Dodaj zwierzaka</button>-->
            </form>

            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
            <?php
            $pay = new Payment();
            $platnosci = $pay -> getPaymentsHistory();
                foreach ($platnosci as $row){
                    echo "
                <div class='d-flex flex-column border bd-highlight p-3 mb-3'>
                    <p><strong>Id adopcji: </strong>". $row['id']."</p>
                    <p><strong>Id adoptującego: </strong>". $row['id_klienta']."</p>
                    <p><strong>Data płatności: </strong>". $row['data_platnosci']."</p>
                    <p><strong>Kwota: </strong>". $row['kwota']."</p>
                    <p><strong>Oplacone na miesiące: </strong>". $row['ile_miesiecy']."</p>
                    
                 </div>";
                }
            ?>
            </div>
        </div>
    </div>

    <?php
    /*if(isset($_POST['add_animal'])){
        include 'add_animal_copy.php';
    }*/
    ?>
<?php
    include "templates/footer.php";
?>