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
            $this->assertEquals([$test_Cuisine1, $test_Cuisine2], $output);
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

    }
        // export PATH=$PATH:./vendor/bin first and then you will only have to run  $ phpunit tests
?>
