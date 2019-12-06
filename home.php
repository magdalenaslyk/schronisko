<?php

include "php/class/User.php";
include "php/class/DBConnection.php";
include "php/class/Adoption.php";

$user = new User();
if(!empty($_SESSION['id'])){
    $uid = $_SESSION['id'];

}
if ($user->getSession()===FALSE) {
   header("location:index.php");
}
if (isset($_GET['q'])) {
    $user->logout();
    header("location:index.php");
}
$user->setID($uid);
$userInfo = $user->getUserInfo();
?>
<?php
//include('templates/header.php');
?>
<div class="row">
    <div class="col-lg-12">
        <h2>Simple Login & Registration system using PHP & MySQL</h2>                 
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <a href="<?php print SITE_URL; ?>home.php?q=logout" class="float-right btn btn-danger btn-sm">LOGOUT</a>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <p><strong>Full Name: </strong><?php print $userInfo['imie'];?></p>        
        <p><strong>Email: </strong><?php print $userInfo['email'];?></p>
    </div>
</div>
    <div class="row">
        <div class="col-lg-12">
            <?php
                $ad = new Adoption();
                $ad->setIdUzytkownik($user->getId());
                $adopcje = $ad->getUserAdoptions();
                foreach ($adopcje as $row){
                    echo "<p><strong>Adopcja: </strong>". $row['id']." status: ". $row["status"]."</p>";

                }

            ?>
        </div>
    </div>
<?php
//include('templates/footer.php');
?>