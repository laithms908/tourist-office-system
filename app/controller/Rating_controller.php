<?php
namespace rating_c;

class Rating_controller
{
private $rating;

public function __construct($rating)
{
    $this->rating = $rating;
}
    public function selectRatings()
    {
        $ratings = $this->rating->getRatings();

        echo json_encode($ratings);
    }

    public function insertRatings()
    {
        $customerId = $_POST['customer_id'];
        $hotelId=$_POST["hotel_id"];
        $star = $_POST['star'];
        $comment =$_POST['comment'];
        
        if ($this->validateId($customerId) && $this->validateId($hotelId) &&
         $this->validateStar($star) && $this-> validateComment($comment)  ) {
            var_dump($star);
            $data = [
                "star" => "$star",
                "customer_id" => "$customerId",
                "hotel_id" => "$hotelId",
                "comment"=>"$comment"
            ];
            $insert = $this->rating->insertRatings($data);
            echo json_encode($insert);
        }
        
    }

    public function updateRating($id)
    {
        $check_id=$this->rating->getRatings($id);
        if ($check_id==null){            
            $update=['message'=>'sorry but this id not exist'];
        }
        else{
            
            $star = $_POST['star'];
            $customerId = $_POST['customer_id'];
            $hotelId = $_POST["hotel_id"];
            $comment=$_POST["comment"];
            $data = array('star'=>$star,'comment'=>$comment);    
            $data['comment']=$this->validateComment($_POST["comment"]);
            if (!empty($customerId and $hotelId)) {

                if ($this->validateId($id)) {
                    $update = $this->rating->updateRatings($data, $id);
                }
            }    
        }
        echo json_encode($update);
    }
    public function deleteRating($id)
    {
        $check_id=$this->rating->getRatings($id);
        if ($check_id==null){            
            $delete=['message'=>'sorry but this id not exist'];
        }
        else{
            if($this->validateId($id)) {
            $delete = $this->rating->deleteRatings($id);
        }}
        echo json_encode($delete);
    }
    public  function validateStar($star){
        if (is_integer($star) && $star>0 && $star<8)
        {
            return $star;
        }
        else{
            $response["msgErr"] = "sorry but the stars should be between 1 and 7'";
            echo json_encode($response);   
        }
    
        }
    function validateComment($data){
        $data = trim($data);
        $data = htmlspecialchars($data);
        $data = stripslashes($data);
        return $data;
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
// public function showReviews($hotel_id){

//     $hotel_name=$this->rating->showReviews($hotel_id);
//     // var_dump($hotel_name);

// }
// public function showTheTotalRate($hotel_id){}
// public function insertRateAndComment(){}
// public function editCommentOrRate($customer_id){}
// public function deleteRate($id){}

// }

?>