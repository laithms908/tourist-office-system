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
    public function bookTicket($customer_id, $flight_id) {
        $sql = "INSERT INTO bookings (customer_id, flight_id) VALUES (:customer_id, :flight_id)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':customer_id', $customer_id);
        $stmt->bindParam(':flight_id', $flight_id);
        $stmt->execute();

        return $this->db->lastInsertId();
    }
}

?>