<?php


class Payment
{
    protected $db;
    private $_id;
    private $_id_klienta;
    private $_id_adopcji;
    private $_data_platnosci;
    private $_kwota;
    private $_ile_miesiecy;

    /**
     * @return mixed
     */
    public function getKwota()
    {
        return $this->_kwota;
    }

    /**
     * @param mixed $kwota
     */
    public function setKwota($kwota)
    {
        $this->_kwota = $kwota;
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
    public function getIdKlienta()
    {
        return $this->_id_klienta;
    }

    /**
     * @param mixed $id_klienta
     */
    public function setIdKlienta($id_klienta)
    {
        $this->_id_klienta = $id_klienta;
    }

    /**
     * @return mixed
     */
    public function getIdAdopcji()
    {
        return $this->_id_adopcji;
    }

    /**
     * @param mixed $id_adopcji
     */
    public function setIdAdopcji($id_adopcji)
    {
        $this->_id_adopcji = $id_adopcji;
    }

    /**
     * @return mixed
     */
    public function getDataPlatnosci()
    {
        return $this->_data_platnosci;
    }

    /**
     * @param mixed $data_platnosci
     */
    public function setDataPlatnosci($data_platnosci)
    {
        $this->_data_platnosci = $data_platnosci;
    }

    /**
     * Payment constructor.
     */
    public function __construct()
    {
        $this->db = new DBConnection();
        $this->db = $this->db->returnConnection();
    }

    public function newPayment()
    {
        $usr = new User();
        $this->setDataPlatnosci(date("Y-m-d H:i:s"));
        if($usr->getSession()){
            $query = "SELECT id, id_zwierze, id_uzytkownik FROM adopcje WHERE id = ".$this->_id_adopcji;
            $result = $this->db->query($query) or die($this->db->error);
            $count_row = $result->num_rows;
            if($count_row == 1) {
                $query = 'INSERT INTO historia_platnosci SET 
                id_adopcji="'.$this->_id_adopcji.'",
                id_klienta="'.$this->_id_klienta.'",
                oplacone_do="'.$this->_oplacone_do.'",
                data_platnosci="'.$this->_data_platnosci.'",
                kwota="'.$this->_kwota.'",
                ile_miesiecy="'.$this->_ile_miesiecy .'"';
                $result = $this->db->query($query) or die($this->db->error);
                return true;
            } else {
                return false;
            }
        }else {
            return false;
        }
    }

}