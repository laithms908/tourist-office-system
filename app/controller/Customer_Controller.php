<?php
namespace  customer_c;
class Customer_Controller{

    public function __construct(){
        $this->model = new Customer_model();

    }
    public function index() {
        $customers = $this->model->getCustomers();

        return view('customers.index', [
            'customers' => $customers,
        ]);
    }

    public function add() {
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

            if ($this->model->addCustomers($data)) {
                header('Location:' . BASE_PATH);
                echo json_encode(['success' => true, 'message' => 'Customer added successfully.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to add customer.']);
            }
        }
    }


    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $data = [
                'username' => $username,
                'password' => $password,
            ];

            if ($this->model->editCustomers($id, $data)) {
                echo json_encode(['success' => true, 'message' => 'Customer updated successfully.']);
                header('Location:' . BASE_PATH);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to update customer.']);
            }
        } 
    }
    
    public function delete($id) {
        if ($this->model->deleteCustomer($id)) {
            header('Location:' . BASE_PATH);
            echo json_encode(['success' => true, 'message' => 'Customer deleted successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to delete customer.']);
        }
    }


}
?>

