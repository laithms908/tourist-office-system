<?php

namespace admin_m;

class Admin_model{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }
    public function findAdminByEmail($email) {
        return $this->db->where('email', $email)->getOne('admins');

    }
    public function add() {
        return $this->db->insert('admins', $data);

       
    }
    public function edit() {
        $this->db->where('id', $id);
        return $this->db->update('admins', $data);

       
    }
    public function delete() {
        $this->db->where('id', $id);
        return $this->db->delete('admins', $data);
        
        

       
    }
    
}

?>