<?php

namespace hotel_m;

class Hotel_model{
private $db;
 public function __construct($db){
     $this->db=$db;
    }

    public function getHotels()
    {
        return $this->db->get('hotels');
    }

    public function getHotel($id)
    {     $this->db->where('id',$id);
        return $this->db->get('hotels');
    }
   
    public function getHotelByCityId($id)
    {
        return $this->db->where('city_id',$id)->get('hotels');
    }

    public function insertHotel($data)
    {
        return $this->db->insert('hotels',$data);
    }

    public function updateHotel($id,$data)
    {     $this->db->where('id',$id);
        return $this->db->update('hotels',$data);
    }
    
    public function deleteHotel($id)
    {   $this->db->where('id',$id);
        return $this->db->delete('hotels');
    }


}

?>