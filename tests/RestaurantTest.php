<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Restaurant.php";
    require_once "src/Cuisine.php";

    $server = 'mysql:host=localhost;dbname=restaurants_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class RestaurantTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Restaurant::deleteAll();
            Cuisine::deleteAll();
        }

        function test_save()
        {
            //Arrange
            $name = "Zaytoon";
            $address = "Santa Barbara";
            $phone = "805-398-2323";
            $cuisine_id = 12;
            $picture = "imagejpeg";

            $test_Restaurant = new Restaurant($id = null, $name, $address, $phone, $cuisine_id, $picture);

            //Act
            $test_Restaurant->save();
            $output = Restaurant::getAll();

            //Assert
            $this->assertEquals([$test_Restaurant], $output);
        }

        function test_getAll()
        {
            //Arrange
            $name1 = "Zaytoon";
            $address1 = "Santa Barbara";
            $phone1 = "805-398-2323";
            $cuisine_id = 12;

            $test_Restaurant1 = new Restaurant($id = null, $name1, $address1, $phone1, $cuisine_id);

            $name2 = "The Habit";
            $address2 = "Santa Barbara";
            $phone2 = "555-555-5555";
            $cuisine_id = 12;

            $test_Restaurant2 = new Restaurant($id = null, $name2, $address2, $phone2, $cuisine_id);

            //Act
            $test_Restaurant1->save();
            $test_Restaurant2->save();
            $output = Restaurant::getAll();

            //Assert
            $this->assertEquals([$test_Restaurant1, $test_Restaurant2], $output);
        }

        function test_deleteAll()
        {
            //Arrange
            $name = "Zaytoon";
            $address = "Santa Barbara";
            $phone = "805-398-2323";
            $cuisine_id = 12;

            $test_Restaurant = new Restaurant($id = null, $name, $address, $phone, $cuisine_id);

            //Act
            $test_Restaurant->save();
            Restaurant::deleteAll();
            $output = Restaurant::getAll();

            //Assert
            $this->assertEquals([], $output);
        }

        function test_find_restaurant()
        {
            //Arrange
            $name = "Zaytoon";
            $address = "Santa Barbara";
            $phone = "805-398-2323";
            $cuisine_id = 12;

            $test_Restaurant = new Restaurant($id = null, $name, $address, $phone, $cuisine_id);

            $test_Restaurant->save();

            //Act
            $search_id = $test_Restaurant->getId();
            $output = Restaurant::find($search_id);

            //Assert
            $this->assertEquals($test_Restaurant, $output);
        }

        function test_getRating()
        {
            //Arrange
            $name = "Zaytoon";
            $address = "Santa Barbara";
            $phone = "805-398-2323";
            $picture = "";
            $total_rating = 100;
            $rating_count = 12;
            $cuisine_id = 12;

            $test_Restaurant = new Restaurant($id = null, $name, $address, $phone, $cuisine_id, $picture, $total_rating, $rating_count);

            $test_Restaurant->save();

            //Act
            $output = $test_Restaurant->getRating();

            //Assert
            $this->assertEquals(8.3, $output);
        }

        function test_updateRating()
        {
            //Arrange
            $name = "Zaytoon";
            $address = "Santa Barbara";
            $phone = "805-398-2323";
            $picture = "";
            $total_rating = 100;
            $rating_count = 12;
            $cuisine_id = 12;

            $test_Restaurant = new Restaurant($id = null, $name, $address, $phone, $cuisine_id, $picture, $total_rating, $rating_count);

            $test_Restaurant->save();

            //Act
            $test_Restaurant->updateRating(5);
            $output = $test_Restaurant->getRating();

            //Assert
            $this->assertEquals(8.1, $output);
        }




    }
        // export PATH=$PATH:./vendor/bin first and then you will only have to run  $ phpunit tests
?>
