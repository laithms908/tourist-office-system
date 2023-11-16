<?php

namespace city_c;

class City_controller
{
    private $city;

    public function __construct($city)
    {
        $this->city = $city;
    }

    public function selectCities()
    {
        $cites = $this->city->getCities();

        echo json_encode($cites);
    }

    public function insertCity()
    {
        $name = $_POST['name'];
        $country = $_POST['country'];

        $data = [
            "name" => "$name",
            "country" => "$country",
        ];

        $insert = $this->city->insertcities($data);
        if ($insert){
        $response= ['message'=>'City was added'];
        echo json_encode($response);
        }
    }

    public function updateCity()
    {

        $name = $_POST['name'];
        $country = $_POST['country'];
        $data=array();

        if (!empty($name)) {
            $data['name'] = $name;
        }

        if (!empty($country)) {
            $data['country'] = $country;
        }

        if (!empty($data)) {
            $id = $_GET["id"];
            $update=$this->city->updateCities($data, $id);
            echo json_encode($update);
        }  
    }
    public function deleteCity(){
        $id = $_GET["id"];
        $delete = $this->city->deleteCities($id);
        echo json_encode($delete);
    }

}
