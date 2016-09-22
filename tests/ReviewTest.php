<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Restaurant.php";
    require_once "src/Cuisine.php";
    require_once "src/Review.php";

    $server = 'mysql:host=localhost;dbname=restaurants_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class ReviewTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Restaurant::deleteAll();
            Cuisine::deleteAll();
            Review::deleteAll();
        }

        function test_save()
        {
            //Arrange
            $author = "Bob";
            $description = "Very Good!";
            $rating = 8;
            $restaurant_id = 12;
            $test_Review = new Review($id = null, $author, $description, $rating, $restaurant_id);
            $test_Review->save();

            //Act
            $output = Review::getAll();

            //Assert
            $this->assertEquals([$test_Review], $output);
        }

        function test_getAll()
        {
            //Arrange
            $author1 = "Bob";
            $description1 = "Very Good!";
            $rating1 = 8;
            $restaurant_id1 = 12;
            $test_Review1 = new Review($id = null, $author1, $description1, $rating1, $restaurant_id1);
            $test_Review1->save();

            $author2 = "Bob";
            $description2 = "Very Good!";
            $rating2 = 8;
            $restaurant_id2 = 12;
            $test_Review2 = new Review($id = null, $author2, $description2, $rating2, $restaurant_id2);
            $test_Review2->save();

            //Act
            $output = Review::getAll();

            //Assert
            $this->assertEquals([$test_Review2, $test_Review1], $output);
        }

        function test_deleteAll()
        {
            //Arrange
            $author = "Bob";
            $description = "Very Good!";
            $rating = 8;
            $restaurant_id = 12;
            $test_Review = new Review($id = null, $author, $description, $rating, $restaurant_id);
            $test_Review->save();

            //Act
            Review::deleteAll();
            $output = Review::getAll();

            //Assert
            $this->assertEquals([], $output);
        }
    }
?>
