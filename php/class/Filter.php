
<?php
include "db.php";

class Filter
{
//do filtracji
    protected $db;
    private $_id;
    private $_gatunek;
    private $_rasa;
    private $_plec;
    private $_status;
    private $_do_adopcji;
    private $_kastracj;
    private $_szczepienie;

    //potrzebne do pobrania całości
    private $_imie;
    private $_wiek;
    private $_opis;
    private $_zdjecie;
    private $_koszta_miesiac;


    public function setID($id) {
        $this->_id = $id;
    }

    public function setGatunek($gatunek)
    {
        $this->_gatunek = $gatunek;
    }

    public function setRasa($rasa)
    {
        $this->_rasa = $rasa;
    }

    public function setPlec($plec)
    {
        $this->_plec = $plec;
    }

    public function setStatus($status)
    {
        $this->_status = $status;
    }
    public function setDoAdopcji($do_adopcji){
        $this->_do_adopcji = $do_adopcji;
    }

    public function setKastracja($kastracja)
    {
        $this->_kastracj = $kastracja;
    }

    public function setSzczepienie($szczepienie)
    {
        $this->_szczepienie = $szczepienie;
    }

    //--------------------------------------------
    public function setImie($imie)
    {
        $this->_imie = $imie;
    }

    public function setWiek($wiek)
    {
        $this->_wiek = $wiek;
    }

    public function setOpis($opis)
    {
        $this->_opis = $opis;
    }

    public function setZdjecie($zdjecie)
    {
        $this->_zdjecie = $zdjecie;
    }

    public function setKoszta($koszta_miesiac)
    {
        $this->_koszta_miesiac = $koszta_miesiac;
    }

//obiekt do łaczenia z bazą danych
    public function __construct()
    {
        $this->db = new DBConnection();
        $this->db = $this->db->returnConnection();
    }
    public function getAllAnimals() {
        $query = "SELECT * FROM zwierzeta";
        $result = $this->db->query($query) or die($this->db->error);
        $animal_data = $result->fetch_array(MYSQLI_ASSOC);
        return $animal_data;
    }

    public function getAllAdverts()
    {
        $query = "SELECT * FROM zwierzeta WHERE status = 'do adopcji'";
        $result = $this->db->query($query) or die($this->db->error);
        $animal_data = $result->fetch_array(MYSQLI_ASSOC);
        return $animal_data;
    }

}
?>


