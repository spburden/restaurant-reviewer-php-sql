<?php
    class Cuisine
    {
        private $id;
        private $name;


        function __construct ($id = null, $name)
        {
            $this->id = $id;
            $this->name = $name;
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

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO cuisines (name) VALUES ('{$this->getName()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_cuisines = $GLOBALS['DB']->query("SELECT * FROM cuisines ORDER BY name ASC;");
            $cuisines = array();
            foreach ($returned_cuisines as $cuisine) {
                $id = $cuisine['id'];
                $name = $cuisine['name'];
                $new_cuisine = new Cuisine($id, $name);
                array_push($cuisines, $new_cuisine);
            }
            return $cuisines;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM cuisines;");
        }

        function findRestaurants()
        {
            $returned_restaurants = $GLOBALS['DB']->query("SELECT * FROM restaurants WHERE cuisine_id = {$this->getId()} ORDER BY name ASC;");
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

        static function find($search_id)
        {
            $found_cuisine = null;
            $cuisines = Cuisine::getAll();
            foreach($cuisines as $cuisine) {
                $cuisine_id = $cuisine->getId();
                if ($cuisine_id == $search_id) {
                    $found_cuisine = $cuisine;
                }
            }
            return $found_cuisine;
        }


    }
?>
