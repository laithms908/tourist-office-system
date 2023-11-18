<?php
namespace  customer_c;
class Customer_Controller{
    private $customer;

    public function __construct(){
        $this->customer = $customer;

    }
    public function index() {
        $customers = $this->db->getCustomer();

        
    }

    public function insertCustomer() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $customername = $_POST['name'];
            $customerphone = $_POST['phone'];
            $customergender = $_POST['gender'];
            $customeremail = $_POST['email'];
            $data = [
                'name' => $customername,
                'phone' => $customerphone,
                'gender' => $customergender,
                'email' => $customeremail,
            ];

            if ($this->db->addCustomer($data)) {
                
                echo json_encode(['status' => true, 'message' => 'Customer added successfully.']);
            } else {
                echo json_encode(['status' => false, 'message' => 'Failed to add customer.']);
            }
        }
    }


    public function updateCustomer($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $data = [
                'username' => $username,
                'password' => $password,
            ];

            if ($this->db->editCustomer($id, $data)) {
                echo json_encode(['status' => true, 'message' => 'Customer updated successfully.']);
                
            } else {
                echo json_encode(['status' => false, 'message' => 'Failed to update customer.']);
            }
        } 
    }
    
    public function deleteCustomers($id) {
        if ($this->model->deleteCustomer($id)) {
            header('Location:' . BASE_PATH);
            echo json_encode(['status' => true, 'message' => 'Customer deleted successfully.']);
        } else {
            echo json_encode(['status' => false, 'message' => 'Failed to delete customer.']);
        }
    }


}
?>

