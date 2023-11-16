<?php

namespace city_m;

class City_model{
    private $db;
    

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getCities()
    {
        return $this->db->get("cities");
    }

    public function insertCities($data)
    {
        $city=$this->db->insert('cities', $data);
        return $city;
    }

    public function updateCities($data, $id)
    {
        $this->db->where("id", $id);
        if($this->db->update("cities", $data)){
                $response = ['message' => 'City was updated'];
                return $response;
            }
        else{
            $response=['message'=>'update failed : '. $this->db->getLastError()];
            return $response;
        }
    }

    public function deleteCities($id)
    {
        $this->db->where("id", $id);
        if($this->db->delete('cities')){
            $response = ['message' => 'City was deleted'];
            return $response;
        }
        else{
            $response = ['message' => 'delete failed : ' . $this->db->getLastError()];
            return $response;
        }
    }
    
}

?>