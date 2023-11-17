<?php

namespace customer_m;

class Customer_model{
    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function getCustomer(){
        return $this->db->get('customers');

    }

    public function addCustomer(){
        return $this->db->insert('customers', $data);
    }
    public function editCustomer(){
        $this->db->where('id', $id);
        return $this->db->update('customers', $data);

    }
    public function deleteCustomer(){
        $this->db->where('id', $id);
        return $this->db->delete('customers');

    }
    
   
    
}

?>

