<?php
//include "DBConnection.php";
//include "ImgUpload.php";
class Animal
{
    protected $db;
    private $_id;
    private $_imie;
    private $_gatunek;
    private $_rasa;
    private $_plec;
    private $_wiek;
    private $_status;
    private $_opis;
    private $_zdjecie;
    private $_path_zdjecia;
    private $_kastracja;
    private $_szczepienia;
    private $_koszta;

    public function setID($id) {
        $this->_id = $id;
    }
    public function setImie($imie) {
        $this->_imie = $imie;
    }
    public function setGatunek($gatunek) {
        $this->_gatunek = $gatunek;
    }
    public function setRasa($rasa) {
        $this->_rasa = $rasa;
    }
    public function setPlec($plec) {
        $this->_plec = $plec;
    }
    public function setWiek($wiek) {
        $this->_wiek = $wiek;
    }
    public function setStatus($status) {
        $this->_status = $status;
    }
    public function  setOpis($opis){
        $this->_opis =$opis;
    }
    public function setZdjecie($zdjecie) {
        $this->_zdjecie = $zdjecie;
    }
    public function setKastracja($kastracja) {
        $this->_kastracja = $kastracja;
    }
    public function setSzczepienia($szczepienia) {
        $this->_szczepienia = $szczepienia;
    }
    public function setKoszta($koszta) {
        $this->_koszta = $koszta;
    }
    public function setPath_zdjecia($path_zdjecia) {
        $this->_path_zdjecia = $path_zdjecia;
    }

    public function __construct() {
        $this->db = new DBConnection();
        $this->db = $this->db->returnConnection();
    }

    public function updateStatusWhenAnimalAdopted(){
        $query = 'UPDATE zwierzeta SET status = "w domu" WHERE id ="'.$this->_id .'"';
        $result = $this->db->query($query) or die($this->db->error);
        return true;
    }
    public function getAnimalInfo(){
        $query = "SELECT * FROM zwierzeta WHERE id = '".$this->_id."'";
        $result = $this->db->query($query) or die($this->db->error);
        $count_row = $result->num_rows;
        if ($count_row == 1) {
            $animal_data = $result->fetch_array(MYSQLI_ASSOC);
            return $animal_data;
        }else{
            return false;
        }
    }

    // Add Animal Method
    public function addAnimal()
    {
        $img_uploader = new ImgUpload();
        $path_zdjecia = $img_uploader->UploadImage($this->_imie, "img/animals_photo/");
        if (strlen($path_zdjecia) > 1) {
            $this->_path_zdjecia = $path_zdjecia;
        } else {
            return false;
        }


        $query = 'INSERT INTO zwierzeta SET 
            imie="' . $this->_imie . '",
            gatunek="' . $this->_gatunek . '",
            rasa="' . $this->_rasa . '",
            plec="' . $this->_plec . '",
            wiek="' . $this->_wiek . '",   
            status="' . $this->_status . '",
            opis="' . $this->_opis . '",
            zdjecie="' . $this->_path_zdjecia . '",
            kastracja="' . $this->_kastracja . '",
            szczepienia="' . $this->_szczepienia . '",
            koszta_miesiac="' . $this->_koszta . '"';
        $result = $this->db->query($query) or die($this->db->error);
        return true;
        }

    // Edit Animal Method
    public function editAnimal()
    {
        $query = 'UPDATE zwierzeta SET 
            imie="' . $this->_imie . '",
            gatunek="' . $this->_gatunek . '",
            rasa="' . $this->_rasa . '",
            plec="' . $this->_plec . '",
            wiek="' . $this->_wiek . '",   
            status="' . $this->_status . '",
            opis="' . $this->_opis . '",
            kastracja="' . $this->_kastracja . '",
            szczepienia="' . $this->_szczepienia . '",
            koszta_miesiac="' . $this->_koszta . '" 
            WHERE id="'. $this->_id .'"';
        $result = $this->db->query($query) or die($this->db->error);
        return true;
    }
    }
?>