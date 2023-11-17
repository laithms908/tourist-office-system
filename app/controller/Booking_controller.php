<?php

namespace booking_c;

class Booking_controller
{
    private $booking;

    public function __construct($booking)
    {
        $this->booking = $booking;
    }
    
    public function selectOneBooking()
    {
        $id = $_GET["id"];
        if ($this->validateId($id)) {
            $booking = $this->booking->getOneBooking($id);
            echo json_encode($booking);

        }
    }

    public function selectBookings()
    {
        $bookings = $this->booking->getBookings();

        echo json_encode($bookings);
    }

    public function insertBooking()
    {
        $ticketId = $_POST['ticketId'];
        $customerId = $_POST['customerId'];
        $hotelId=$_POST["hotelId"];
        $date = date("y/m/d");

        if ($this->validateId($ticketId) && $this->validateId($customerId) && $this->validateId($hotelId)) {
            $data = [
                "ticket_id" => "$ticketId",
                "customer_id" => "$customerId",
                "hotel_id" => "$hotelId",
                "date"=>"$date"
            ];
            $insert = $this->booking->insertBookings($data);
            echo json_encode($insert);
        }
    }

    public function updatebooking()
    {

        $ticketId = $_POST['ticketId'];
        $customerId = $_POST['customerId'];
        $hotelId = $_POST["hotelId"];
        $data = array();

        if ($this->validateId($ticketId)) {
            $data['ticket_id'] = $ticketId;
        }

        if ($this->validateId($customerId)) {
            $data['customer_id'] = $customerId;
        }

        if ($this->validateId($hotelId)) {
            $data['hotel_id'] = $hotelId;
        }

        if (!empty($data)) {
            $id = $_GET["id"];
            if ($this->validateId($id)) {
                $update = $this->booking->updatebookings($data, $id);
                echo json_encode($update);
            }
        }
    }

    public function deleteBooking()
    {
        $id = $_GET["id"];
        if ($this->validateId($id)) {
            $delete = $this->booking->deleteBookings($id);
            echo json_encode($delete);
        }
    }

    function validateId($id)
    {
        $response = array();

        if (is_numeric($id)) {
            return true;
        } else {
            $response["msgErr"] = "id should be integer number";
            echo json_encode($response);
        }
    }
}
