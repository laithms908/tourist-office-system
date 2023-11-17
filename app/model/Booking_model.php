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

    public function getOneBooking($id)
    {
        $this->db->where("id", $id);
        return $this->db->getOne("bookings");
    }

    public function insertBookings($data)
    {
        $booking=$this->db->insert('bookings', $data);
        if ($booking) {
            $response = ['message' => 'booking was added'];
            return $response;
        } else {
            $response = ['message' => 'failed to add booking: ' . $this->db->getLastError()];
            return $response;
        }
    }

    public function updateBookings($data, $id)
    {
        $this->db->where("id", $id);
        if ($this->db->update("bookings", $data)) {
            $response = ['message' => 'Booking was updated'];
            return $response;
        } else {
            $response = ['message' => 'update failed : ' . $this->db->getLastError()];
            return $response;
        }
    }

    public function deleteBookings($id)
    {
        $this->db->where("id", $id);
        if ($this->db->delete("bookings")) {
            $response = ['message' => 'Booking was deleted'];
            return $response;
        } else {
            $response = ['message' => 'delete failed : ' . $this->db->getLastError()];
            return $response;
        }
    }
}

?>
