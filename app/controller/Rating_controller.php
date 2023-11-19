<?php
namespace rating_c;

class Rating_controller
{
    private $rating;
    private $customer;
    public function __construct($rating)
    {
        $this->rating = $rating;
    }

    public function insertRatings()
    {
        $customer_id = $_POST['customer_id'] ?? "" ;
        $hotel_id=$_POST["hotel_id"] ?? "";
        $star = $_POST['star'] ?? "";
        $comment =$_POST['comment'] ?? "";
        
        if ($this->validateId($customer_id) && $this->validateId($hotel_id) &&
         $this->validateStar($star) && $this-> validateComment($comment)  ) {

            $data = [
                "star" => "$star",
                "customer_id" => "$customer_id",
                "hotel_id" => "$hotel_id",
                "comment"=>"$comment"
            ];
            $insert = $this->rating->insertRatings($data);
            echo json_encode($insert);
        }
        
    }
//...................................................................................................
    public function updateRating($id)
    {
        if ($this->validateId($id)) {

            $check_id=$this->rating->getRatings($id);
            if ($check_id==null){            
                $update=['message'=>'sorry but this id not exist'];
            }
            else{
                $customer_id = $_POST['customer_id'] ?? "";
                $hotel_id = $_POST["hotel_id"] ?? "";
                $star = $_POST['star'] ?? "";;
                $comment=$_POST["comment"] ?? "";
                if ($this->validateId($customer_id) && $this->validateId($hotel_id) &&
                    $this->validateStar($star) && $this-> validateComment($comment)  ) {
                        $data = [
                             "star" => "$star",
                             "customer_id" => "$customer_id",
                             "hotel_id" => "$hotel_id",
                             "comment"=>"$comment"];
                if (!empty($data)) {

                        $update = $this->rating->updateRatings($data, $id);
                        echo json_encode($update);
                    }
                }    
        }
    }}
//...................................................................................................
    public function deleteRating($id)
    {   
        if($this->validateId($id)) {
            $check_id=$this->rating->getRatings($id);
            if ($check_id==null){            
                $delete=['message'=>'sorry but this id not exist'];
            }
            else{

                $delete = $this->rating->deleteRatings($id);
            }
            echo json_encode($delete);
        }
    }
//...................................................................................................
    public  function validateStar($star){

        $validStars=array("0","0,5","1.5","1.5","2","2.5","3","3.5","4","4.5","5");
        if(in_array($star,$validStars)){
            return true;
        }
        else{
            $response["msgErr"] = "sorry but the stars should be between 0 and 5";
            echo json_encode($response);   
        }
    
    }
//...................................................................................................
    public function validateComment($data){
        $data = trim($data);
        $data = htmlspecialchars($data);
        $data = stripslashes($data);
        return $data;
    }
//..................................................................................................
    public function validateId($id)
    {       
        if (is_numeric($id)) {
            return true;
        } else {
            $response["msgErr"] = "id should be integer number";
            echo json_encode($response);
        }
    }    
}
// THE END
?>