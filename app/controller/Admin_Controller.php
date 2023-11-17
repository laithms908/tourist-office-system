<?php
namespace admin_c ;

class Admin_Controller{
    private $model;
    
    public function __construct(){
        #$this->model = new Admin_Controller();
        #$this->db = $db;

    }
    public function login(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $email = $_post['email'];
            $password = $_post['password'];

            // Validate 
            $admin = $this->model->findAdminByEmail($email);
            if ($admin && password_verify($password, $admin->password)) {
                // Login successful
                session_start();
                $_SESSION['admin_id'] = $admin->id;
                header('Location:' . BASE_PATH);
                
                $data = [
                    'redirect_url' => '/index.php',
                ];
                
                echo json_encode($data);
            } else {
                // Login failed
                $errors = [
                    'email' => 'Email or password is incorrect.',
                ];
                
                echo json_encode($errors);;
            }
        }
    }

    public function bookTicket() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $customer_id = $_POST['customer_id'];
            $flight_id = $_POST['flight_id'];

            $booking_id = $this->model->bookTicket($customer_id);

            if ($booking_id) {
                $data = [
                    'message' => 'Ticket booked successfully.',
                ];

                echo json_encode($data);
            } else {
                $errors = [
                    'error' => 'Failed to book ticket.'
                ];
                echo json_encode($errors);
            }
        } 
            
        
    }
}
?>