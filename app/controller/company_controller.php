<?php

namespace company_c;

class Company_controller
{
    private $company;

    public function __construct($company)
    {
        $this->company = $company;
    }

    public function selectCompany()
    {
        $companies = $this->company->getCompany();
        
        echo json_encode($companies);
        // header("location:/");
    }

    public function insertCompany()
    {

        $name = $_POST['name'];
        $phone = $_POST['phone'];

        if($this->validateName($name) && $this->validatePhoneNumber($phone)){
            $data = [
                "name" => "$name",
                "phone" => "$phone",
            ];
            if (!empty($data)) { 
                $insert = $this->company->insertcompanies($data);
                echo json_encode($insert);
            }    
        }
        
    }
    
    public function updateCompany($id)
    {
        if($this->validateId($id)){

            $check_id=$this->company->getCompany($id);
            
            if ($check_id==null){            
                $update=['message'=>'sorry but this id not exist'];
            }
            else {


                $name = $_POST['name'];
                $phone = $_POST['phone'];
                $data=array();
                if($this->validateName($name) && $this->validatePhoneNumber($phone)){
                    $data = [
                    "name" => "$name",
                    "phone" => "$phone",
                    ];    
                    if (!empty($data)) {              
                        $update = $this->company->updateCompanies($data, $id);
                        echo json_encode($update);
                    }
                }
            }
        }    
    }
        public function deletecompany($id){
            if($this->validateId($id)){
                
                $check_id=$this->company->getCompany($id);
                
                if ($check_id==null){            
                    $delete=['message'=>'sorry but this id not exist'];
                }
                else{
                    $delete = $this->company->deleteCompanies($id);
                }

                echo json_encode($delete);
                // header("location:/");
        }}
        public function test_input($data)
        {
            $data = trim($data);
            $data = htmlspecialchars($data);
            $data = stripslashes($data);
            return $data;
        }

        public function validateName($name)
        {
            $response=array();
            if (empty($name)) {
                $response['msgErr'] ='name is requird';
                echo json_encode($response);
            } else {
                $name = $this->test_input($name);
                if ((!preg_match("/^[a-zA-Z-' ]*$/", $name))) {
                    $response['Name Error'] = 'Name  should be  only letters and white space allowed';
                    echo json_encode($response);
                } else {
                    return true;
                }
            }
        }
        public function validatePhoneNumber($id){
            if (preg_match('/^[0-9]+$/', $id)) {
                return true;
            } 
            else {
                $phoneError=['Phone number'=> ' must be just a numbers fish'];
                echo json_encode($phoneError);
            }
        }
        
        public function validateId($id)
        {
            $response=array();

            if(is_numeric($id)){
                return true;
            }
            else{
                $response["Id Error"]="id should be integer number";
                echo json_encode($response);
            }
        }
    

    

        
}
//     if (!empty($name)) {
//         $data['name'] = $name;
//     }

//     if (!empty($phone)) {
//         $data['phone'] = $phone;
//     }

//     if (!empty($data)) {
//         $id = $_GET["id"];
    
//     else{
//         $update=$this->company->updateCompanies($data, $id);
//         echo json_encode($update);
//     }
//     // header("location:/");  
// }

