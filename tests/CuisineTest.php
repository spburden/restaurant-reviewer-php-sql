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

    class CuisineTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Restaurant::deleteAll();
            Cuisine::deleteAll();
        }

        function test_save()
        {
            //Arrange
            $name = "Greek";

            $test_Cuisine = new Cuisine($id = null, $name);

            //Act
            $test_Cuisine->save();
            $output = Cuisine::getAll();

            //Assert
            $this->assertEquals([$test_Cuisine], $output);
        }

        function test_getAll()
        {
            //Arrange
            $name1 = "Greek";
            $test_Cuisine1 = new Cuisine($id = null, $name1);

            $name2 = "American";
            $test_Cuisine2 = new Cuisine($id = null, $name2);

            //Act
            $test_Cuisine1->save();
            $test_Cuisine2->save();
            $output = Cuisine::getAll();

            //Assert
            $this->assertEquals([$test_Cuisine2, $test_Cuisine1], $output);
        }

        function test_deleteAll()
        {
            //Arrange
            $name = "Greek";

            $test_Cuisine = new Cuisine($id = null, $name);

            //Act
            $test_Cuisine->save();
            Cuisine::deleteAll();
            $output = Cuisine::getAll();

            //Assert
            $this->assertEquals([], $output);
        }

        function test_find_restaurants()
        {
            //Arrange
            $name1 = "Greek";
            $test_Cuisine1 = new Cuisine($id = null, $name1);
            $test_Cuisine1->save();
            $name2 = "American";
            $test_Cuisine2 = new Cuisine($id = null, $name2);
            $test_Cuisine2->save();

            $name1 = "Zaytoon";
            $address1 = "Santa Barbara";
            $phone1 = "805-398-2323";
            $cuisine_id = $test_Cuisine1->getId();

            $test_Restaurant1 = new Restaurant($id = null, $name1, $address1, $phone1, $cuisine_id);
            $test_Restaurant1->save();

            $name2 = "The Habit";
            $address2 = "Santa Barbara";
            $phone2 = "555-555-5555";
            $cuisine_id = $test_Cuisine2->getId();

            $test_Restaurant2 = new Restaurant($id = null, $name2, $address2, $phone2, $cuisine_id);
            $test_Restaurant2->save();

            //Act
            $output = $test_Cuisine1->findRestaurants();

            //Assert
            $this->assertEquals([$test_Restaurant1], $output);
        }

        function test_find_cuisine()
        {
            //Arrange
            $name1 = "Greek";
            $test_Cuisine1 = new Cuisine($id = null, $name1);
            $test_Cuisine1->save();
            $name2 = "American";
            $test_Cuisine2 = new Cuisine($id = null, $name2);
            $test_Cuisine2->save();

            $search_id = $test_Cuisine1->getId();

            //Act
            $output = Cuisine::find($search_id);

            //Assert
            $this->assertEquals($test_Cuisine1, $output);
        }


    }
        // export PATH=$PATH:./vendor/bin first and then you will only have to run  $ phpunit tests
?>
