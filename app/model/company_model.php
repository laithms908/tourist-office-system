<?php

namespace company_m;

class Company_model{

    private $db;
    
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getCompany($id=null)
    {
        if ($id!==null){
            $this->db->where("id", $id);
            return $this->db->get("companies");    
        }
        return $this->db->get("companies");
    }

    public function insertcompanies($data)
    {
        $company=$this->db->insert('companies', $data);
        $company = ['message' => 'company was added successfully'];
        return $company;
    }

    public function updateCompanies($data, $id)
    {   var_dump($id);
        $this->db->where("id", $id);
        if($this->db->update("companies", $data)){

                $response = ['message' => 'company was updated'];
                return $response;
            }
        else{
            $response=['message'=>'update failed : '. $this->db->getLastError()];
            return $response;
        }
    }

    public function deleteCompanies($id)
    {
        $this->db->where("id", $id);
        if($this->db->delete('companies')){

            $response = ['message' => 'company was deleted'];
            return $response;
        }
        else{

            $response = ['message' => 'delete failed : ' . $this->db->getLastError()];
            return $response;
        }
    }


}

?>