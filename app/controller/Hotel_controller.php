<?php
namespace hotel_c;
class Hotel_controller
{ private $hotel;
public function __construct($hotel)
    {
        $this->hotel=$hotel;
    }
    //..........................................................
    public function viewHotels()
    {
        $results=$this->hotel->getHotels();
        echo json_encode($results);
    }
    //...........................................................
    public function viewHotelByCityId($id)
    {
        $result=$this->hotel->getHotelByCityId($id);
        echo json_encode($result);
    }
    //..............................................................
    public function addhotel()
    {
        if ($_SERVER['REQUEST_METHOD']=='POST')
        {  
             $name=$_POST['name'];
            $city=$_POST['city_id'];
            $phone=$_POST['phone'];
            $data=[
               'name'=>$name,
               'city_id'=>$city,
               'phone'=>$phone
            ];
            $results=$this->hotel->insertHotel($data);
            echo json_encode($results);
        }}
        //.....................................................
    public function updatehotel($id)
    {   if($_SERVER['REQUEST_METHOD'] === 'POST') 
      {
         $this->hotel->getHotel($id);
        $name=$_POST['name'];
        $city=$_POST['city_id'];
        $phone=$_POST['phone'];
        $data=[
           'name'=>$name,
           'city_id'=>$city,
           'phone'=>$phone
        ];
        $results=$this->hotel->updateHotel($id,$data);
        if($results)
        { echo json_encode($results);}
        else
        {  $message = ['message' => 'falid update'];
            echo json_encode($message);} 
      }
    }
    //.................................................
    public function deletehotel($id)
    {   $this->hotel->getHotel($id);
       $result= $this->hotel->deleteHotel($id);
       if ($result)
       {echo json_encode($result);}
       else 
       {  $message = ['message' => 'falid delete'];
        echo json_encode($messsage);} 
       }
    }

    
?>