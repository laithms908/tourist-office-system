<?php
namespace admin_c ;

class Admin_Controller{
    private $model;
    
    public function __construct($admin){
        $this->model = $admin;
        
    }
    public function login(){
            $email = $_POST['email'];
            $password = $_POST['password'];
            // Validate 
            $admin = $this->model->findAdminByEmail($email);
            if ($admin && password_verify($password, $admin->password)) {
                // Login successful
                session_start();
                // Set the session cookie to expire when the browser is closed
                setcookie(session_name(), session_id(), 0, '/', '', false, true);
                $id = $admin[0];
                $_SESSION['id'] = $id;
                $url = '/index.php';
                $json = json_encode(array('url' => $url));
                echo $json;
            } else {
                // Login failed
                $errors = [
                    'email' => 'Email or password is incorrect.'
                ];
                echo json_encode(array("status"=>true,
                "date"=>$data));
                echo json_encode($errors);
            }
    }

    public function signOut(){
        session_destroy();
    }
    public function addAdmin(){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $data = ["name"=>$name,
        "email"=>$email,
        "password"=>$password
         ];

        if($this->db=add($data)){
            echo json_encode(['status' => true, 'message' => 'Admin added successfully.']);
        } else {
            echo json_encode(['status' => false, 'message' => 'Failed to add admin.']);
        }

    }

    public function editAdmin($id){
        $this->id = $id;
        if($this->db=edit($id)){
            echo json_encode(['status' => true, 'message' => 'Admin edited successfully.']);
        } else {
            echo json_encode(['status' => false, 'message' => 'Failed to edit admin.']);
        }


    }
    public function deleteAdmin($id){
        $this->id = $id;
        if($this->db=delete($id)){
            echo json_encode(['status' => true, 'message' => 'Admin deleted successfully.']);
        } else {
            echo json_encode(['status' => false, 'message' => 'Failed to delete admin.']);
        }
    
    }
}
?>