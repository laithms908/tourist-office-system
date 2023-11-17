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
    public function bookTicket($customer_id) {
        return $this->db->insert('customers', $data);

       
    }
}

?>