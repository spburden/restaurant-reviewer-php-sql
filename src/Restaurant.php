<?php
    class Restaurant
    {
        private $id;
        private $name;
        private $address;
        private $phone;
        private $cuisine_id;


        function __construct ($id = null, $name, $address, $phone, $cuisine_id)
        {
            $this->id = $id;
            $this->name = $name;
            $this->address = $address;
            $this->phone = $phone;
            $this->cuisine_id = $cuisine_id;
        }

        function getId()
        {
            return $this->id;
        }

        function setName($new_name)
        {
            $this->name = $new_name;
        }

        function getName()
        {
            return $this->name;
        }

        function setAddress($new_address)
        {
            $this->address = $new_address;
        }

        function getAddress()
        {
            return $this->address;
        }

        function setPhone($new_phone)
        {
            $this->phone = $new_phone;
        }

        function getPhone()
        {
            return $this->phone;
        }

        function setCuisineId($new_cuisine_id)
        {
            $this->cuisine_id = $new_cuisine_id;
        }

        function getCuisineId()
        {
            return $this->cuisine_id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO restaurants (name, address, phone, cuisine_id) VALUES ('{$this->getName()}','{$this->getAddress()}','{$this->getPhone()}',{$this->getCuisineId()});");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_restaurants = $GLOBALS['DB']->query("SELECT * FROM restaurants ORDER BY name ASC;");
            $restaurants = array();
            foreach($returned_restaurants as $restaurant) {
                $id = $restaurant['id'];
                $name = $restaurant['name'];
                $address = $restaurant['address'];
                $phone = $restaurant['phone'];
                $cuisine_id = $restaurant['cuisine_id'];
                $new_restaurant = new Restaurant($id, $name, $address, $phone, $cuisine_id);
                array_push($restaurants, $new_restaurant);
            }
            return $restaurants;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM restaurants;");
        }

        static function find($search_id)
        {
            $found_restaurant = null;
            $restaurants = Restaurant::getAll();
            foreach($restaurants as $restaurant) {
                $restaurant_id = $restaurant->getId();
                if ($restaurant_id == $search_id) {
                    $found_restaurant = $restaurant;
                }
            }
            return $found_restaurant;
        }

        function updateRestaurant($edit_name, $edit_address, $edit_phone, $edit_cuisine_id)
        {
            $GLOBALS['DB']->exec("UPDATE restaurants SET name = '{$edit_name}', address = '{$edit_address}', phone = '{$edit_phone}', cuisine_id = '{$edit_cuisine_id}' WHERE id = {$this->getId()};");
            $this->setName($edit_name);
            $this->setAddress($edit_address);
            $this->setPhone($edit_phone);
            $this->setCuisineId($edit_cuisine_id);
        }

        function deleteRestaurant()
        {
            $GLOBALS['DB']->exec("DELETE FROM restaurants WHERE id = {$this->getId()};");
        }






    }
?>
