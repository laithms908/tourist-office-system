<?php

namespace booking_m;

class Booking_model{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getBookings()
    {
        return $this->db->get("bookings");
    }

    public function insertBookings($data)
    {
        $this->db->insert('bookings', $data);
    }

    public function updateBookings($data, $id)
    {
        $this->db->where("id", $id);
        $this->db->update("bookings", $data);
    }

    public function deleteBookings($id)
    {
        $this->db->where("id", $id);
        $this->db->delete("bookings");
    }
}

?>
