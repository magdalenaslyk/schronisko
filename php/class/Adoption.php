<?php
//include "DBConnection.php";
//include "User.php";
class Adoption
{
    protected $db;
    private $_id;
    private $_id_zwierze;
    private $_id_uzytkownik;
    private $_oplacone_do;
    private $_id_ost_platnosci;
    private $_status;
    private $_zdjecie;
    /**
     * @return mixed
     */
    public function getDb()
    {
        return $this->db;
    }

    /**
     * @param mixed $db
     */
    public function setDb($db)
    {
        $this->db = $db;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->_id = $id;
    }

    /**
     * @return mixed
     */
    public function getIdZwierze()
    {
        return $this->_id_zwierze;
    }

    /**
     * @param mixed $id_zwierze
     */
    public function setIdZwierze($id_zwierze)
    {
        $this->_id_zwierze = $id_zwierze;
    }

    /**
     * @return mixed
     */
    public function getIdUzytkownik()
    {
        return $this->_id_uzytkownik;
    }

    /**
     * @param mixed $id_uzytkownik
     */
    public function setIdUzytkownik($id_uzytkownik)
    {
        $this->_id_uzytkownik = $id_uzytkownik;
    }

    /**
     * @return mixed
     */
    public function getOplaconeDo()
    {
        return $this->_oplacone_do;
    }

    /**
     * @param mixed $oplacone_do
     */
    public function setOplaconeDo($oplacone_do)
    {
        $this->_oplacone_do = $oplacone_do;
    }

    /**
     * @return mixed
     */
    public function getIdOstPlatnosci()
    {
        return $this->_id_ost_platnosci;
    }

    /**
     * @param mixed $id_ost_platnosci
     */
    public function setIdOstPlatnosci($id_ost_platnosci)
    {
        $this->_id_ost_platnosci = $id_ost_platnosci;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->_status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->_status = $status;
    }

    /**
     * @return mixed
     */
    public function getZdjecie()
    {
        return $this->_zdjecie;
    }

    /**
     * @param mixed $zdjecie
     */
    public function setZdjecie($zdjecie)
    {
        $this->_zdjecie = $zdjecie;
    }

    public function __construct()
    {
        $this->db = new DBConnection();
        $this->db = $this->db->returnConnection();
    }

    public function newAdoption(){
        $usr = new User();
        $this->setOplaconeDo(date("Y-m-d H:i:s"));
        $this->setStatus("nieoplacone");
        if($usr->getSession()){
            $query = "SELECT id, id_zwierze, id_uzytkownik FROM adopcje WHERE id_zwierze = ".$this->_id_zwierze;
            $result = $this->db->query($query) or die($this->db->error);
            $count_row = $result->num_rows;
            if($count_row == 0) {
                $query = 'INSERT INTO adopcje SET 
                id_zwierze="'.$this->_id_zwierze.'",
                id_uzytkownik="'.$this->_id_uzytkownik.'",
                oplacone_do="'.$this->_oplacone_do.'",
                id_ost_platnosci= NULL  ,
                status="'.$this->_status.'",
                zdjecie="'.$this->getPathZdjecia() .'"';
                $result = $this->db->query($query) or die($this->db->error);
                $zwierz = new Animal();
                $zwierz->setId($this->getIdZwierze());
                $zwierz->updateStatusWhenAnimalAdopted();

                $this->setId($this->db->insert_id);
                return true;
            } else {
                return false;
            }
        }else {
            return false;
        }
    }

    public function getUserAdoptions(){
        $query = "SELECT * FROM adopcje WHERE id_uzytkownik = ".$this->getIdUzytkownik();
        $result = $this->db->query($query) or die($this->db->error);
        $count_row = $result->num_rows;
        $ret = [];
        for($i = 0; $i < $count_row; $i++)
        {
            $data = $result->fetch_array(MYSQLI_ASSOC);
            array_push($ret, $data);
        }
        return $ret;
    }

    public function getPathZdjecia(){
        $query = "SELECT zdjecie FROM zwierzeta WHERE id = ".$this->_id_zwierze;
        $result = $this->db->query($query) or die($this->db->error);
        $user_data = $result->fetch_array(MYSQLI_ASSOC);
        $count_row = $result->num_rows;

        if($count_row == 1){
            return $user_data["zdjecie"];
        }
    }

    public function updateOstatniaPlatnosc($ile_miesiecy, $id_platnosci){
        $query = "SELECT oplacone_do FROM adopcje WHERE id = ".$this->_id;
        $result = $this->db->query($query) or die($this->db->error);
        $user_data = $result->fetch_array(MYSQLI_ASSOC);
        $count_row = $result->num_rows;

        if($count_row == 1){
            $query = 'UPDATE adopcje SET 
                id_ost_platnosci="'.$id_platnosci.'",
                status= "oplacone",
                oplacone_do= DATE_ADD("'.$user_data["oplacone_do"].'", INTERVAL '.$ile_miesiecy.' MONTH)
                WHERE id ="'.$this->_id .'"';
            $result = $this->db->query($query) or die($this->db->error);
            return true;
        } else
        {
            return false;
        }
    }

}