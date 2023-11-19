<?php
namespace admin_c ;

class Admin_Controller{
    private $admin;
    
    public function __construct($admin){
        $this->admin = $admin;
        
    }
    public function login(){
            $email = $_post['email'];
            $password = $_post['password'];
            // Validate 
            $admin = $this->model->findAdminByEmail($email);
            if ($admin && password_verify($password, $admin->password)) {
                // Login successful
                session_start();
                // Set the session cookie to expire when the browser is closed
                setcookie(session_name(), session_id(), 0, '/', '', false, true);
                $adminData = [
                    'admin_id' => $admin->id
                ];
                $_SESSION['id'] = $adminData;
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
            echo json_encode(['status' => true, 'message' => 'Admin added successfully.']);
        } else {
            echo json_encode(['status' => false, 'message' => 'Failed to add admin.']);
        }


    }
    public function deleteAdmin($id){
        $this->id = $id;
        if($this->db=delete($id)){
            echo json_encode(['status' => true, 'message' => 'Admin added successfully.']);
        } else {
            echo json_encode(['status' => false, 'message' => 'Failed to add admin.']);
        }
    
    }
}
?>